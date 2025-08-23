<!doctype html>
<html lang="en">
<head>
    <title>Exam</title>
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

    @vite('resources/css/app.css')
    <x-layouts.task.style />
</head>

<body
    data-pc-preset="preset-5"
    data-pc-sidebar-caption="true"
    data-pc-direction="ltr"
    data-pc-theme_contrast=""
    data-pc-theme="light"
    class="landing-page"
>
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->

<!-- [ Header ] start -->
<x-layouts.micro.exam-header />
<!-- [ Header ] End -->

<!-- [ Technologies ] start -->
{{ $slot }}
<!-- [ Technologies ] End -->

<!-- [ footer apps ] start -->
<x-layouts.micro.exam-footer />
<!-- [ footer apps ] End -->

<!-- [ Main Content ] end -->
<x-layouts.task.script />

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Initial render for the first question
            MathJax.typesetPromise();

            // Listen for Livewire updates to render new content
            Livewire.hook('morph.updated', ({ el, component }) => {
                // Check if the updated element is the question card
                if (el.classList.contains('card')) {
                    MathJax.typesetPromise([el]);
                }
            });

            // Re-render when navigating with Livewire
            Livewire.hook('navigated', () => {
                MathJax.typesetPromise();
            });
        });
    </script>
@endpush
</body>
</html>
