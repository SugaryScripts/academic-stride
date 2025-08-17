<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- When there is no desire, all things are at peace. - Laozi -->
<!-- [Head] start -->

<head>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="description"
        content="Exam App built by Ma Chung University"
    />
    <meta
        name="keywords"
        content="Ujian"
    />
    <meta name="author" content="Ma Chung University" />

    <title>{{ $page_title }}</title>

    <x-layouts.core.style />


</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-5" data-pc-sidebar-caption="true"
      data-pc-layout="vertical" data-pc-direction="ltr"
      data-pc-theme_contrast="true" data-pc-theme="dark">

<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Sidebar Menu ] start -->
<x-layouts.micro.sidebar />
<!-- [ Sidebar Menu ] end -->
<!-- [ Header Topbar ] start -->
<x-layouts.micro.header />
<!-- [ Header ] end -->



<!-- [ Main Content ] start -->
<div class="pc-container">
    <!-- [ Main Content ] start -->
{{ $slot }}
<!-- [ Main Content ] end -->
</div>
<!-- [ Main Content ] end -->

<x-layouts.micro.footer />
<script>
    window.baseUrl = "{{ asset('') }}";
</script>
<x-layouts.core.script />


</body>
<!-- [Body] end -->
</html>
