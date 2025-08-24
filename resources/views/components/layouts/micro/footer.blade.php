
<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
<footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
        <div class="row">
            <div class="col my-1">
                <p class="m-0"
                >Academic Stride &#9829; crafted by Ma Chung University</p
                >
            </div>
            <div class="col-auto my-1">
                <ul class="list-inline footer-link mb-0">
                    @if(auth()->user()->hasAnyRole('Educator','Analyser'))
                        <li class="list-inline-item"><a href="{{ route('homes') }}">Home</a></li>
                    @elseif(auth()->user()->hasRole('Student'))
                        <li class="list-inline-item"><a href="{{ route('active-exam') }}">Home</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>
