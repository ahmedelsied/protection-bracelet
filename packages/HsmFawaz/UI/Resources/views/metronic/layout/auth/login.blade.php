<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" direction="{{ app()->getLocale() === 'ar'? 'rtl':'ltr' }}"
      dir="{{ app()->getLocale() === 'ar'? 'rtl':'ltr' }}"
      style="direction: {{ app()->getLocale() === 'ar'? 'rtl':'ltr' }}">
<!--begin::Head-->
@include('ui::layout.head')
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
             style="background-color: #131313">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <!--begin::Content-->
                <div class="d-flex text-white flex-row-fluid flex-column text-center p-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="/" class="py-9 mb-5">
                        <img alt="Logo" src="{{ asset('templates/diets/v2/img/logo_white.png') }}" class="h-60px"/>
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder text-white fs-2qx "
                    >{{ __('Welcome to SST System') }}</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="fw-bold fs-2">{{ __('Make your clients happy') }}</p>
                    <!--end::Description-->
                </div>
                <!--end::Content-->
                <!--begin::Illustration-->
                <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                     style="background-image: url(vendor/hsmfawaz/ui/metronic/assets/media/illustrations/sketchy-1/13.png"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    @yield('content')
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>var hostUrl = "vendor/hsmfawaz/ui/metronic/assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('vendor/hsmfawaz/ui/metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('vendor/hsmfawaz/ui/metronic/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>