@if (config('sweetalert.alwaysLoadJS') === true && config('sweetalert.neverLoadJS') === false )
    <script
        src="{{ $cdn ?? asset('admin/global_assets/js/plugins/notifications/sweet_alert.min.js')  }}"></script>
@endif
<script>
    Swal = Swal.mixin(JSON.parse('{!! app('alert')->buildConfig() !!}'));
</script>
@if (Session::has('alert.config'))
    @if(config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    @if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
        <script
            src="{{ $cdn ?? asset('admin/global_assets/js/plugins/notifications/sweet_alert.min.js')  }}"></script>
    @endif
    <script>
        Swal.fire({!! Session::pull('alert.config') !!});
    </script>
@endif
