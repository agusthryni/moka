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
                        @csrf
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
            
            // Reinitialize Select2 and percentage calculations for the visible step after a short delay
            setTimeout(function() {
                const currentStep = steps[index];
                // Check if jQuery is available before using it
                if (typeof jQuery !== 'undefined' && currentStep && typeof window.autoFillJabatan === 'function') {
                    jQuery(currentStep).find('.select2-pegawai').each(function() {
                        const $select = jQuery(this);
                        if (!$select.hasClass('select2-hidden-accessible')) {
                            $select.select2({
                                width: '100%'
                            });
                            
                            // Bind change events
                            $select.off('change.select2-pegawai').on('change.select2-pegawai', function() {
                                window.autoFillJabatan(this);
                            });
                            
                            $select.off('select2:select.select2-pegawai').on('select2:select.select2-pegawai', function() {
                                window.autoFillJabatan(this);
                            });
                        } else {
                            // If already initialized, just trigger change if there's a value
                            if ($select.val()) {
                                window.autoFillJabatan(this);
                            }
                        }
                    });
                    
                    // Recalculate percentages for the visible step
                    if (typeof window.initPercentageCalculations === 'function') {
                        window.initPercentageCalculations(currentStep);
                    }
                }
            }, 100);
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
            console.log('Next button clicked, current step:', current);
            // panggil fungsi validasi
            if (!validateStep(current)) {
                console.log('Validation failed for step:', current);
                return;
            }

            // pindah step
            if (current < steps.length - 1) {
                current++;
                showStep(current);
            } else {
                console.log('Final step reached, validating all steps');
                // Final step - validate all steps before submission
                let allValid = true;
                for (let i = 0; i < steps.length; i++) {
                    if (!validateStep(i)) {
                        allValid = false;
                        // Show the step with errors
                        showStep(i);
                        break;
                    }
                }
                
                if (allValid) {
                    console.log('All steps valid, submitting form');
                    // All steps valid, call the submission function directly
                    if (typeof window.submitMonevForm === 'function') {
                        console.log('Calling submitMonevForm function');
                        window.submitMonevForm();
                    } else {
                        console.log('submitMonevForm not available yet, trying jQuery trigger');
                        // Fallback: try jQuery trigger
                        const form = document.getElementById("monevForm");
                        if (typeof jQuery !== 'undefined') {
                            jQuery(form).trigger('submit');
                        } else {
                            // Last resort: wait a bit and try again
                            setTimeout(function() {
                                if (typeof window.submitMonevForm === 'function') {
                                    window.submitMonevForm();
                                } else {
                                    console.error('Form submission handler not available');
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Form submission handler belum siap. Silakan refresh halaman dan coba lagi.'
                                    });
                                }
                            }, 500);
                        }
                    }
                } else {
                    console.log('Some steps are invalid, not submitting');
                }
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

@endsection

@push('scripts')
    <script>
        // Wait for jQuery to be available
        (function() {
            function initFormSubmission() {
                if (typeof jQuery === 'undefined') {
                    setTimeout(initFormSubmission, 100);
                    return;
                }
                
                jQuery(document).ready(function($) {
                    console.log('Form submission handler initialized');
                    
                    // Make submit function globally accessible
                    window.submitMonevForm = function() {
                        console.log('submitMonevForm called');
                        const form = $('#monevForm');
                        
                        // Disable submit button to prevent double submission
                        const submitBtn = document.getElementById('nextBtn');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                        
                        // Show loading
                        Swal.fire({
                            title: 'Menyimpan Data',
                            text: 'Mohon tunggu, sedang menyimpan data...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        const formData = form.serialize();
                        console.log('Form data:', formData);
                        
                $.ajax({
                    url: "{{ route('data-industri.store') }}",
                    method: "POST",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
                            },
                    success: function(response) {
                                console.log('Success response:', response);
                                Swal.close();
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalText;
                                
                        if (response.status === 'success') {
                            // hapus semua cache form
                            Object.keys(localStorage)
                                .filter(key => key.startsWith("monev_"))
                                .forEach(key => localStorage.removeItem(key));

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                        confirmButtonText: 'OK'
                            }).then(function() {
                                        window.location.href = "{{ route('data-industri') }}";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Peringatan',
                                        text: response.message || 'Response tidak dikenali',
                            });
                        }
                    },
                            error: function(xhr) {
                                console.log('Error response:', xhr);
                                Swal.close();
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalText;
                                
                                let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                                
                                if (xhr.status === 422) {
                                    // Validation errors
                                    const errors = xhr.responseJSON.errors || {};
                                    const errorMessages = Object.values(errors).flat();
                                    errorMessage = errorMessages.length > 0 
                                        ? 'Validasi gagal:\n' + errorMessages.join('\n')
                                        : xhr.responseJSON.message || 'Validasi gagal.';
                                } else if (xhr.status === 400) {
                                    errorMessage = xhr.responseJSON.message || 'Data tidak valid.';
                                } else if (xhr.status === 500) {
                                    errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan server. Semua perubahan telah dibatalkan.';
                                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                
                            Swal.fire({
                                icon: 'error',
                                    title: 'Gagal Menyimpan',
                                    html: errorMessage.replace(/\n/g, '<br>'),
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    };
                    
                    // Also attach to form submit event
                    $('#monevForm').on('submit', function(e) {
                        e.preventDefault();
                        console.log('Form submit event triggered');
                        window.submitMonevForm();
                    });
                });
            }
            initFormSubmission();
        })();
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
                // Ensure array notation for all fields
                if (!el.name.endsWith("[]") && el.name !== "bidang" && el.name !== "tahun" && el.name !== "triwulan") {
                    el.name = el.name + "[]";
                }
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
            addFormSection("add-program", "program-container", ".program-item");
        });

        // === Kegiatan ===
        document.getElementById("add-kegiatan").addEventListener("click", function() {
            addFormSection("add-kegiatan", "kegiatan-container", ".kegiatan-item");
        });

        // === Sub Kegiatan ===
        document.getElementById("add-sub-kegiatan").addEventListener("click", function() {
            addFormSection("add-sub-kegiatan", "kegiatan-container", ".kegiatan-item");
        });

        // === Penilaian ===
        document.getElementById("add-penilaian").addEventListener("click", function() {
            addFormSection("add-penilaian", "penilaian-container", ".penilaian-item");
        });

        // === Arahan ===
        document.getElementById("add-arahan").addEventListener("click", function() {
            addFormSection("add-arahan", "arahan-container", ".arahan-item");
        });

        // === Melaporkan ===
        document.getElementById("add-melaporkan").addEventListener("click", function() {
            addFormSection("add-melaporkan", "melaporkan-container", ".melaporkan-item");
        });
        
        // Event delegasi hapus melaporkan
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-item")) {
                e.target.closest(".melaporkan-item").remove();
            }
        });
    });
    </script>

    <script>
    // Make autoFillJabatan globally accessible - wait for jQuery
    (function() {
        function initAutoFill() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initAutoFill, 100);
                return;
            }
            
            window.autoFillJabatan = function(selectElement) {
                const $select = jQuery(selectElement);
                const selectedValue = $select.val();
                
                if (!selectedValue) {
                    return; // No selection, clear jabatan
                }
                
                // Get jabatan from the selected option's data attribute
                const selectedOption = $select.find('option[value="' + selectedValue + '"]');
                const jabatan = selectedOption.attr('data-jabatan') || selectedOption.data('jabatan');
                const selectId = $select.attr('id');
                const selectName = $select.attr('name');
                
                console.log('Auto-filling jabatan:', { selectId, selectName, selectedValue, jabatan }); // Debug
                
                // Find the step container (closest .step)
                const $step = $select.closest('.step');
                
                // Find corresponding jabatan field within the same step
                if (selectId === 'id_pegawai_pelapor') {
                    $step.find('#jabatan_pelapor').val(jabatan || '');
                } else if (selectId === 'id_pimpinan_monev' || selectId === 'id_pegawai_monev') {
                    $step.find('#jabatan_pimpinan_monev').val(jabatan || '');
                } else if (selectName === 'id_pegawai[]') {
                    // For melaporkan step - find the jabatan input in the same item
                    $select.closest('.melaporkan-item').find('input[name="jabatan[]"]').val(jabatan || '');
                }
            };

            jQuery(document).ready(function($) {
                // Initialize Select2 for pegawai dropdowns and bind events
                $('.select2-pegawai').each(function() {
                    const $select = $(this);
                    $select.select2({
                        width: '100%'
                    });
                    
                    // Bind change event - this works with Select2
                    $select.on('change', function() {
                        window.autoFillJabatan(this);
                    });
                    
                    // Also bind select2:select event as backup
                    $select.on('select2:select', function(e) {
                        window.autoFillJabatan(this);
                    });
                });

                // Auto-fill jabatan when pegawai is selected (delegated event for dynamically added items)
                $(document).on('change', '.select2-pegawai', function() {
                    window.autoFillJabatan(this);
                });
                
                // Also handle Select2's select event for dynamically added items
                $(document).on('select2:select', '.select2-pegawai', function() {
                    window.autoFillJabatan(this);
                });

                // Initialize Select2 for dynamically added items
                function initSelect2ForNewItems(container) {
                    $(container).find('.select2-pegawai').each(function() {
                        const $select = $(this);
                        if (!$select.hasClass('select2-hidden-accessible')) {
                            $select.select2({
                                width: '100%'
                            });
                            
                            // Bind change events for new items
                            $select.on('change', function() {
                                window.autoFillJabatan(this);
                            });
                            
                            $select.on('select2:select', function() {
                                window.autoFillJabatan(this);
                            });
                        }
                    });
                }

                // Override addFormSection to initialize Select2 for new items
                const originalAddFormSection = window.addFormSection;
                if (originalAddFormSection) {
                    window.addFormSection = function(buttonId, containerClass, templateSelector) {
                        originalAddFormSection(buttonId, containerClass, templateSelector);
                        const container = document.querySelector('.' + containerClass);
                        if (container) {
                            setTimeout(function() {
                                initSelect2ForNewItems(container);
                                // Initialize percentage calculations for new items
                                if (typeof window.initPercentageCalculations === 'function') {
                                    window.initPercentageCalculations(container);
                                }
                            }, 100);
                        }
                    };
                }

                // Function to calculate percentage
                function calculatePercentage(realisasi, target) {
                    if (!target || target == 0) return 0;
                    return ((realisasi / target) * 100).toFixed(2);
                }

                // Function to calculate percentage for a specific item
                function calculateItemPercentages($item) {
                    // Calculate % Kinerja
                    const target = parseFloat($item.find('input[name*="target"]').val()) || 0;
                    let realisasiKinerja = 0;
                    
                    // Try different realisasi kinerja field names (in order of priority)
                    const realisasiKinerjaField = $item.find('input[name*="program_realisasi_kinerja"], input[name*="kegiatan_realisasi_kinerja"], input[name*="subkegiatan_realisasi_kinerja"]').first();
                    if (realisasiKinerjaField.length > 0) {
                        realisasiKinerja = parseFloat(realisasiKinerjaField.val()) || 0;
                    }
                    
                    const persenKinerja = calculatePercentage(realisasiKinerja, target);
                    $item.find('.persen-kinerja').val(persenKinerja);
                    
                    // Calculate % Keuangan
                    const pagu = parseFloat($item.find('input[name*="pagu"]').val()) || 0;
                    let realisasiKeuangan = 0;
                    
                    // Try different realisasi keuangan field names (kegiatan uses program_realisasi_keuangan)
                    const realisasiKeuanganField = $item.find('input[name*="program_realisasi_keuangan"], input[name*="subkegiatan_realisasi_keuangan"]').first();
                    if (realisasiKeuanganField.length > 0) {
                        realisasiKeuangan = parseFloat(realisasiKeuanganField.val()) || 0;
                    }
                    
                    const persenKeuangan = calculatePercentage(realisasiKeuangan, pagu);
                    $item.find('.persen-keuangan').val(persenKeuangan);
                }

                // Function to initialize percentage calculations for a container (make it globally accessible)
                window.initPercentageCalculations = function(container) {
                    const $container = $(container || document);
                    
                    // Remove existing event handlers to avoid duplicates
                    $container.find('input[name*="target"], input[name*="realisasi_kinerja"], input[name*="pagu"], input[name*="realisasi_keuangan"]').off('input.percentage change.percentage');
                    
                    // Calculate % Kinerja and % Keuangan when any relevant field changes
                    $container.on('input.percentage change.percentage', 'input[name*="target"], input[name*="program_realisasi_kinerja"], input[name*="kegiatan_realisasi_kinerja"], input[name*="subkegiatan_realisasi_kinerja"], input[name*="pagu"], input[name*="program_realisasi_keuangan"], input[name*="kegiatan_realisasi_keuangan"], input[name*="subkegiatan_realisasi_keuangan"]', function() {
                        const $item = $(this).closest('.program-item, .kegiatan-item');
                        if ($item.length > 0) {
                            calculateItemPercentages($item);
                        }
                    });
                    
                    // Calculate percentages for existing items
                    $container.find('.program-item, .kegiatan-item').each(function() {
                        calculateItemPercentages($(this));
                    });
                };

                // Initialize percentage calculations for existing items
                window.initPercentageCalculations();
            });
        }
        initAutoFill();
    })();
    </script>
@endpush
