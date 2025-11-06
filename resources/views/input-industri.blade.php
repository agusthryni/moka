@extends('layout.main')

@section('title', 'MOKA | FORM LAPORAN')

@section('content')
    <section class="content" style="padding-top: 100px;">
        <div class="container-fluid">
            <div class="card border-0">
                <div class="card-header bg-success text-white">
                    <h5>LAPORAN DAN MONEV KINERJA PEGAWAI</h5>
                </div>

                {{-- Step Indicator --}}
                <div class="step-indicator d-flex justify-content-between align-items-center px-4 py-3">
                    <div class="step-circle active">1</i></div>
                    <div class="step-line"></div>
                    <div class="step-circle">2</div>
                    <div class="step-line"></div>
                    <div class="step-circle">3</div>
                    <div class="step-line"></div>
                    <div class="step-circle">4</div>
                    <div class="step-line"></div>
                    <div class="step-circle">5</div>
                    <div class="step-line"></div>
                    <div class="step-circle">6</div>
                    <div class="step-line"></div>
                    <div class="step-circle">7</div>
                </div>

                <style>
                    .step-indicator {
                    position: relative;
                    }
                    .step-circle {
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    background: #ccc;
                    color: white;
                    font-weight: bold;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 2;
                    transition: 0.3s;
                    }
                    .step-circle.active {
                    background: #28a745;
                    box-shadow: 0 0 8px #28a745;
                    }
                    .step-line {
                    flex: 1;
                    height: 4px;
                    background: #ccc;
                    z-index: 1;
                    }
                    .step-line.active {
                    background: #28a745;
                    }
                </style>

                {{-- LAPORAN --}}
                <div class="card-body">
                    <form id="monevForm">
                        @include('steps.step1-laporan')
                        @include('steps.step2-program')
                        @include('steps.step3-kegiatan')
                        @include('steps.step4-subkegiatan')
                        @include('steps.step5-penilaian')
                        @include('steps.step6-arahan')
                        @include('steps.step7-melaporkan')

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                            <button type="button" class="btn btn-success" id="nextBtn">Berikutnya <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <style>
        /* === Efek hijau sederhana untuk semua input, select, textarea === */
        .form-control:focus,
        .form-select:focus {
            border-color: #28a745 !important;
            box-shadow: 0 0 0 0.15rem rgba(40, 167, 69, 0.25) !important;
            outline: none !important;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #28a745 !important;
        }

        .form-select:focus-visible {
            border-color: #28a745 !important;
            outline: none !important;
            box-shadow: 0 0 0 0.15rem rgba(40, 167, 69, 0.25) !important;
        }
    </style>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const steps = document.querySelectorAll(".step");
        const circles = document.querySelectorAll(".step-circle");
        const lines = document.querySelectorAll(".step-line");
        const nextBtn = document.getElementById("nextBtn");
        const prevBtn = document.getElementById("prevBtn");
        let current = 0;

        function showStep(index) {
            for (let i = 0; i < steps.length; i++) {

                // tampilkan step yang aktif saja
                steps[i].classList.toggle("d-none", i !== index);

                // lingkaran aktif (yang sudah dilewati + yang sekarang)
                circles[i].classList.toggle("active", i <= index);

                // garis hanya untuk langkah yang sudah dilewati
                if (lines[i]) {
                    lines[i].classList.toggle("active", i < index);
                }
            }
            // Simpan posisi step saat ini
            localStorage.setItem("monev_current_step", index);

            // scroll otomatis ke atas
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // setting tombol prev dan next
            prevBtn.style.visibility = index === 0 ? "hidden" : "visible";
            nextBtn.innerHTML =
                index === steps.length - 1
                    ? '<i class="fas fa-check"></i> Selesai'
                    : 'Berikutnya <i class="fas fa-arrow-right"></i>';
        }

        // ✅ Fungsi Validasi Step
        function validateStep(stepIndex) {
            const inputs = steps[stepIndex].querySelectorAll(
                "input[required], select[required], textarea[required]"
            );

            let valid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add("is-invalid");
                    valid = false;
                } else {
                    input.classList.remove("is-invalid");
                }
            });

            // ✅ Tambahkan alert jika tidak valid
            if (!valid) {
                Swal.fire({
                    icon: "warning",
                    title: "Lengkapi data terlebih dahulu!",
                    text: "Masih ada field wajib yang belum diisi."
                });
            }

            return valid;
        }


        nextBtn.addEventListener("click", () => {
            // panggil fungsi validasi
            if (!validateStep(current)) return;

            // pindah step
            if (current < steps.length - 1) {
                current++;
                showStep(current);
            } else {
                document.getElementById("monevForm").submit();
            }
        });

        prevBtn.addEventListener("click", () => {
            if (current > 0) current--;
            showStep(current);
        });

        // Bila ada step tersimpan, gunakan itu
        const savedStep = localStorage.getItem("monev_current_step");
        if (savedStep !== null) {
            current = parseInt(savedStep);
        }

        // SIMPAN DATA SETIAP ADA PERUBAHAN
        document.querySelectorAll("input, select, textarea").forEach(el => {
            el.addEventListener("input", () => {
                localStorage.setItem(`monev_${el.name}`, el.value);
            });
        });

        // LOAD DATA YANG PERNAH DISIMPAN
        document.querySelectorAll("input, select, textarea").forEach(el => {
            const savedValue = localStorage.getItem(`monev_${el.name}`);
            if (savedValue !== null) {
                el.value = savedValue;
            }
        });

        // tampilkan step awal
        showStep(current);
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const tahunInput = document.getElementById('Tahun');
        if (tahunInput) {
            const currentYear = new Date().getFullYear();
            tahunInput.setAttribute('max', currentYear);
            tahunInput.value = currentYear; 
        }
    });
    </script>

    <script>
        $(document).ready(function() {
            $('#monevForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('data-industri.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            // hapus semua cache form
                            Object.keys(localStorage)
                                .filter(key => key.startsWith("monev_"))
                                .forEach(key => localStorage.removeItem(key));

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                            }).then(function() {
                                window.location.href = "{{ url('/moka/data-laporan') }}";
                            });
                        }
                    },
                    error: function(response) {
                        if (response.status === 400) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.responseJSON.message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat mengirim data.',
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // === Fungsi umum untuk duplikasi ===
        function addFormSection(buttonId, containerClass, templateSelector) {
            const addBtn = document.getElementById(buttonId);
            const stepContainer = addBtn.closest(".step");
            let container = stepContainer.querySelector(`.${containerClass}`);
            
            if (!container) {
                container = document.createElement("div");
                container.classList.add(containerClass, "mt-3");
                stepContainer.appendChild(container);
            }

            const template = stepContainer.querySelector(templateSelector);
            const clone = template.cloneNode(true);
            clone.querySelectorAll("input, select, textarea").forEach(el => {
                el.value = "";
                el.classList.remove("is-invalid");
                el.name = el.name.replace("[]", "") + "[]";
            });

            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "btn btn-danger mt-2";
            removeBtn.textContent = "Hapus";
            removeBtn.addEventListener("click", () => clone.remove());

            clone.appendChild(removeBtn);

            container.appendChild(clone);
        }

        // === Program ===
        document.getElementById("add-program").addEventListener("click", function() {
            addFormSection("add-program", "program-container", ".program-container");
        });

        // === Kegiatan ===
        document.getElementById("add-kegiatan").addEventListener("click", function() {
            addFormSection("add-kegiatan", "kegiatan-container", ".kegiatan-container");
        });

        // === Sub Kegiatan ===
        document.getElementById("add-sub-kegiatan").addEventListener("click", function() {
            addFormSection("add-sub-kegiatan", "subkegiatan-container", ".subkegiatan-container");
        });

        // === Penilaian ===
        document.getElementById("add-penilaian").addEventListener("click", function() {
            addFormSection("add-penilaian", "penilaian-container", ".penilaian-container");
        });

        // === Arahan ===
        document.getElementById("add-arahan").addEventListener("click", function() {
            addFormSection("add-arahan", "arahan-container", ".arahan-container");
        });

        // === Melaporkan ===
        document.getElementById("add-melaporkan").addEventListener("click", function() {
            addFormSection("add-melaporkan", "melaporkan-container", ".melaporkan-container");
        });
        
        // Event delegasi hapus melaporkan
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-item")) {
                e.target.closest(".melaporkan-item").remove();
            }
        });
    });
    </script>
@endsection
