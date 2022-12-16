<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" direction="{{ app()->getLocale() === 'ar'? 'rtl':'ltr' }}"
      dir="{{ app()->getLocale() === 'ar'? 'rtl':'ltr' }}"
      style="direction: {{ app()->getLocale() === 'ar'? 'rtl':'ltr' }}">
<!--begin::Head-->
@include('ui::layout.head')
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        <x-ui::sidebar :modules="$sidebarRoutes"/>
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            @include('ui::layout.header')
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Toolbar-->
                @include('ui::layout.toolbar')
                <!--end::Toolbar-->
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        @yield('content')
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                          fill="currentColor"/>
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                          fill="currentColor"/>
				</svg>
			</span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--begin::Javascript-->
<script>var hostUrl = "vendor/hsmfawaz/ui/metronic/assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('vendor/hsmfawaz/ui/metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('vendor/hsmfawaz/ui/metronic/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
@include('sweetalert::alert',['cdn'=>'//cdn.jsdelivr.net/npm/sweetalert2@11'])
<script src="//unpkg.com/alpinejs" defer></script>
<!-- /core JS files -->
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
    });
</script>
@stack('scripts')
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>