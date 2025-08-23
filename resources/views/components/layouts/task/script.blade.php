
<script>
    window.Laravel = {
        logoWhite: "{{ env('APP_LOGO_WHITE') }}",
        logoDark: "{{ env('APP_LOGO_DARK') }}"
    };
</script>

<script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
<!-- Required Js -->
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

<script src="{{ asset('vendor/sweetalert2-11.14.5/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/sweet-alert.js') }}"></script>

<!-- [Page Specific JS] start -->
<script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('assets/js/plugins/Jarallax.js') }}"></script>
<script>
    // Start [ Menu hide/show on scroll ]
    let ost = 0;
    document.addEventListener('scroll', function () {
        let cOst = document.documentElement.scrollTop;
        if (cOst == 0) {
            document.querySelector('.navbar').classList.add('top-nav-collapse');
        } else if (cOst > ost) {
            document.querySelector('.navbar').classList.add('top-nav-collapse');
            document.querySelector('.navbar').classList.remove('default');
        } else {
            document.querySelector('.navbar').classList.add('default');
            document.querySelector('.navbar').classList.remove('top-nav-collapse');
        }
        ost = cOst;
    });
    // End [ Menu hide/show on scroll ]
    //
    new SimpleBar(document.querySelector('.scrollble-tech-block'));
    var wow = new WOW({
        animateClass: 'animated'
    });
    wow.init();

    // slider start
    $('.screen-slide').owlCarousel({
        loop: true,
        margin: 30,
        center: true,
        nav: false,
        dotsContainer: '.app_dotsContainer',
        URLhashListener: true,
        items: 1
    });
    $('.workspace-slider').owlCarousel({
        loop: true,
        margin: 30,
        center: true,
        nav: false,
        dotsContainer: '.workspace-card-block',
        URLhashListener: true,
        items: 1.5
    });
    // slider end
    // marquee start
    $('.marquee').marquee({
        duration: 500000,
        pauseOnHover: true,
        startVisible: true,
        duplicated: true
    });
    $('.marquee-1').marquee({
        duration: 500000,
        pauseOnHover: true,
        startVisible: true,
        duplicated: true,
        direction: 'right'
    });
    // marquee end
</script>
