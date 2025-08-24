<!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            @if(auth()->user()->hasAnyRole('Educator','Analyser','Admin'))
                <a href="{{ route('homes') }}" class="b-brand text-primary">
                    <img src="{{ asset('logo/'.config('app.logo_dark')) }}" class="img-fluid logo-lg" alt="logo"/>
                    <span class="badge bg-light-success rounded-pill ms-2 theme-version">v0.0.1</span>
                </a>
            @elseif(auth()->user()->hasAnyRole('Student','Admin'))
                <a href="{{ route('my-exam') }}" class="b-brand text-primary">
                    <img src="{{ asset('logo/'.config('app.logo_dark')) }}" class="img-fluid logo-lg" alt="logo"/>
                    <span class="badge bg-light-success rounded-pill ms-2 theme-version">v0.0.1</span>
                </a>
            @endif
        </div>
        <div class="navbar-content pb-5">

            <ul class="pc-navbar">

                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>

                @if(auth()->user()->hasAnyRole('Educator','Analyser','Admin'))
                    <li class="pc-item {{ (request()->is('homes')) ? 'active' : '' }}">
                        <a href="{{ route('homes') }}" class="pc-link">
                            <span class="pc-micon">
                              <svg class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                              </svg>
                            </span>
                            <span class="pc-mtext">Home</span>
                        </a>
                    </li>
                @elseif(auth()->user()->hasRole('Student'))
                    <li class="pc-item {{ (request()->is('my-exam')) ? 'active' : '' }}">
                        <a href="{{ route('my-exam') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-status-up"></use>
                          </svg>
                        </span>
                            <span class="pc-mtext">My Exam</span>
                        </a>
                    </li>
                @endif


                {{--@if(auth()->user()->hasAnyRole('Analyser','Admin'))

                <li class="pc-item {{ ( request()->routeIs('report.exam') ) ? 'pc-trigger active' : '' }}">
                    <a href="{{ route('report.exam') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-presentation-chart"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Exam Report</span>
                    </a>
                </li>

                <li class="pc-item {{ ( request()->routeIs('report.student') ) ? 'pc-trigger active' : '' }}">
                    <a href="{{ route('report.student') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-story"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Student Report</span>
                    </a>
                </li>

                @endif--}}


                @if(auth()->user()->hasAnyRole('Educator','Admin'))

                <li class="pc-item {{ ( request()->routeIs('exam') ) ? 'pc-trigger active' : '' }}">
                    <a href="{{ route('exam') }}" class="pc-link">
                        <span class="pc-micon">
                          <i class="fas fa-file-export"></i>
                        </span>
                        <span class="pc-mtext">Exam</span>
                    </a>
                </li>


                <li class="pc-item {{ ( request()->routeIs('subject') ) ? 'pc-trigger active' : '' }}">
                    <a href="{{ route('subject') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="fas fa-wallet"></i>
                        </span>

                        <span class="pc-mtext">Subject</span>
                    </a>
                </li>

                <li class="pc-item {{ ( request()->routeIs('quiz') ) ? 'pc-trigger active' : '' }}">
                    <a href="{{ route('quiz') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-building-hospital"></i>
                        </span>
                        <span class="pc-mtext">Question Bank</span>
                    </a>
                </li>

                @endif



                @if(auth()->user()->hasAnyRole('Educator','Analyser','Admin'))

                <li class="pc-item {{ ( request()->routeIs('student') ) ? 'pc-trigger active' : '' }}">
                    <a href="{{ route('student') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                            <use xlink:href="#custom-user"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Student</span>
                    </a>
                </li>
                <li class="pc-item {{ ( request()->routeIs('session.exam') ) ? 'pc-trigger active' : '' }}">
                    <a href="{{ route('session.exam') }}" class="pc-link">
                    <span class="pc-micon">
                      <svg class="pc-icon">
                        <use xlink:href="#custom-document"></use>
                      </svg>
                    </span>
                        <span class="pc-mtext">Exam Session</span>
                    </a>
                </li>

                <li class="pc-item {{ ( request()->routeIs('grade') ) ? 'pc-trigger active' : '' }}">
                    <a href="{{ route('grade') }}" class="pc-link">
                <span class="pc-micon">
                  <svg class="pc-icon">
                    <use xlink:href="#custom-document"></use>
                  </svg>
                </span>
                        <span class="pc-mtext">Grade</span>
                    </a>
                </li>

                @else
                    <li class="pc-item {{ ( request()->routeIs('recent-exam') ) ? 'pc-trigger active' : '' }}">
                        <a href="{{ route('recent-exam') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-document"></use>
                          </svg>
                        </span>
                            <span class="pc-mtext">Recent Exam</span>
                        </a>
                    </li>
                    <li class="pc-item {{ ( request()->routeIs('grade.detail') ) ? 'pc-trigger active' : '' }}">
                        <a href="{{ route('grade.detail', ['id'=>Auth::user()->id]) }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-document"></use>
                          </svg>
                        </span>
                            <span class="pc-mtext">Grade Overall</span>
                        </a>
                    </li>
                @endif

                <li class="pc-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="pc-link btn btn-link-secondary">
                        <span class="pc-micon">
                          <i class="fas fa-globe"></i>
                        </span>
                            <span class="pc-mtext">Log Out</span>
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
