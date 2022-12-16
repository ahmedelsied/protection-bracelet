@extends('ui::layout.auth.login')
@section('title',__('Login to Administration Panel'))
@section('content')
    <form class="form w-100" id="kt_sign_in_form" action="{{ route('dashboard.auth.login') }}" method="post">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">{{ __('Sign In to Administration Panel') }}</h1>
        </div>
        <div class="fv-row mb-10">
            <label class="form-label required  fs-6 fw-bolder text-dark">{{ __('Phone') }}</label>
            <input class="form-control form-control-lg @error('phone') is-invalid @enderror form-control-solid"
                   name="phone" required
                   autocomplete="off"/>

            @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                <!--end::Label-->
                <!--begin::Link-->
                {{--                <a href="{{ route('tenant.auth.forget-password') }}"--}}
                {{--                   class="link-primary fs-6 fw-bolder">{{ __('Forgot Password ?') }}</a>--}}
                <!--end::Link-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="password" required
                   name="password" autocomplete="off"/>
            <!--end::Input-->
        </div>
        <div class="form-check form-check-custom form-check-solid mb-10">
            <input class="form-check-input" type="checkbox" name="remember" value="1" id="rememberMe"/>
            <label class="form-check-label" for="rememberMe">
                {{ __('Remember Me ?') }}
            </label>
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                <span class="indicator-label">{{ __('Continue') }}</span>
            </button>
        </div>
        <!--end::Actions-->
    </form>
@endsection
