@extends('vendor.adminlte.auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('Sistem Informasi Industri Balikpapan'))

@section('auth_body')
    @if ($errors->any())
        <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <>{{ $error }}</>
                @endforeach
        </div>
    @endif

    <form action="{{ url('/siiba/login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" value="" placeholder="{{ __('Email') }}" required
                autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}"
                required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                <div class="input-group-text">
                    <button type="button" id="togglePassword" style="border: none; background: none;">
                        <span class="fas fa-eye"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
            </div>
        </div>
    </form>
@endsection

@section('auth_footer')
    <p class="my-0">
        <a href="">{{ __('I forgot my password') }}</a>
    </p>
@endsection

@section('js')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const passwordInput = document.getElementById('password');
            const passwordIcon = this.querySelector('.fas');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        });
    </script>
@endsection
