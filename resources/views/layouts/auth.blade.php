<!doctype html>
<html lang="en">
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

    <title>{{ $page_title ?? config('app.name') }}</title>

    <x-layouts.portal.style />
    <script>
        window.baseUrl = "{{ asset('') }}";
    </script>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-5" data-pc-sidebar-caption="true"
      data-pc-layout="vertical" data-pc-direction="ltr"
      data-pc-theme_contrast="" data-pc-theme="light">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->

{{ $slot }}
<!-- [ Main Content ] end -->

<!-- Required Js -->
<x-layouts.portal.script />

</body>
<!-- [Body] end -->
</html>
