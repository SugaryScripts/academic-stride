
<!-- It is never too late to be what you might have been. - George Eliot -->
{{--<x-layout.customizer />--}}

<!-- Required Js -->
<script>
    window.Laravel = {
        logoWhite: "{{ config('app.logo_dark') }}",
        logoDark: "{{ config('app.logo_light') }}"
    };
</script>

<script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

<script src="{{ asset('vendor/sweetalert2-11.22.3/sweetalert2.all.min.js') }}"></script>
{{--<script src="{{ asset('js/sweet-alert.js') }}"></script>--}}
{{--@livewireScripts--}}

{{--<script src="{{ asset('js/app.js') }}"></script>--}}
@stack('scripts')

{{--<x-layout.preset-theme />--}}
