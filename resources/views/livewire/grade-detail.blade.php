<x-slot name="page_title">
    {{ __('exam.my_grades') }}
</x-slot>

<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0)">{{ __('exam.grade') }}</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('exam.my_grades') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">{{ __('exam.my_grades') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->


    <!-- [ Main Content ] start -->
    {{--  content chart --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div>
                        <h5 class="mb-1">{{ __('exam.academic_performance_overview') }}</h5>
                        <p class="text-muted mb-0 small">{{ __('exam.comprehensive_analysis') }}</p>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge bg-primary">{{ $this->totalSubjects }} {{ __('exam.subjects') }}</span>
                        <span class="badge bg-{{ $this->performanceGrade['class'] }}">{{ $this->averageScore }}% {{ __('exam.avg') }}</span>
                        <span class="badge bg-light text-dark">Grade {{ $this->performanceGrade['grade'] }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($chartData) > 0)
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="alert alert-{{ $this->performanceGrade['class'] }} alert-dismissible" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-info-circle me-2"></i>
                                        <div>
                                            <strong>{{ __('exam.overall_performance') }}: {{ $this->performanceGrade['label'] }}</strong><br>
                                            <small>{{ __('exam.average_score_across', ['score' => $this->averageScore, 'subjects' => $this->totalSubjects]) }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative overflow-x-auto">
                            @livewire('charts.performance-chart', ['chartData' => $chartData, 'chartLabels' => $chartLabels])
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="ti ti-chart-bar text-muted" style="font-size: 4rem;"></i>
                            <h5 class="mt-3 text-muted">{{ __('exam.no_performance_data') }}</h5>
                            <p class="text-muted">{{ __('exam.complete_exams_message') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- [ Exam Sessions Table ] start -->
    @if(count($examSessions) > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-1">{{ __('exam.exam_performance_overview') }}</h5>
                    <p class="text-muted mb-0 small">{{ __('exam.exam_attempts_details') }}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('exam.exam_title') }}</th>
                                    <th>{{ __('exam.attempts') }}</th>
                                    <th>{{ __('exam.latest_score') }}</th>
                                    <th>{{ __('exam.time') }}</th>
                                    <th>{{ __('exam.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($examSessions as $examSession)
                                <tr>
                                    <td>
                                        <strong>{{ $examSession['exam_title'] }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $examSession['total_attempts'] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $this->getScoreClass($examSession['latest_session_score']) }} mb-1">
                                            {{ $examSession['latest_session_score'] }}%
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $examSession['latest_session_finished_at']->format('M d, Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"
                                                wire:click="scrollToExam({{ $examSession['latest_session_id'] }})"
                                                onclick="document.getElementById('exam-{{ $examSession['latest_session_id'] }}').scrollIntoView({behavior: 'smooth'})">
                                            <i class="ti ti-chart-pie"></i> {{ __('exam.analyze') }}
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- [ Exam Sessions Table ] end -->

    <!-- [ Individual Exam Proficiency Analysis ] start -->
    @if(count($examProficiencyData) > 0)
        @foreach($examProficiencyData as $examData)
        <div class="row mb-4" id="exam-{{ $examData['session']->id }}">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-1">{{ $examData['session']->exam->title }}</h5>
                        <p class="text-muted mb-0 small">
                            {{ __('exam.completed_on') }} {{ $examData['session']->finished_at->format('M d, Y H:i') }} |
                            {{ __('exam.score') }}: {{ $examData['session']->percentage_score }}% |
                            {{ __('exam.subject') }}: {{ $examData['session']->exam->subjectConfigurations->pluck('subject.name')->join(', ') }}
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12">
                                @livewire('charts.proficiency-chart', ['proficiencyData' => $examData['proficiencyData']], key('chart-'.$examData['session']->id))
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="mb-3">{{ __('exam.detailed_proficiency_breakdown') }}</h6>
                                @livewire('charts.proficiency-breakdown', [
                                    'proficiencyData' => $examData['proficiencyData'],
                                    'examTitle' => $examData['session']->exam->title
                                ], key('breakdown-'.$examData['session']->id))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center py-5">
                            <i class="ti ti-chart-pie text-muted" style="font-size: 4rem;"></i>
                            <h5 class="mt-3 text-muted">{{ __('exam.no_proficiency_data') }}</h5>
                            <p class="text-muted">{{ __('exam.complete_exams_proficiency') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- [ Individual Exam Proficiency Analysis ] end -->

    <!-- [ Main Content ] end -->

    @push('scripts')
        <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>

        <!-- Floating Scroll-to-Top Button -->
        <div class="floting-button">
            <a href="javascript:void(0);" id="scroll-to-top-btn" class="btn btn-primary d-inline-flex align-items-center gap-2" data-bs-toggle="tooltip" title="Scroll to Top" style="display: none;">
                <i class="ph-duotone ph-arrow-up"></i>
                <span>{{ __('exam.back_to_top') }}</span>
            </a>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const scrollToTopBtn = document.getElementById('scroll-to-top-btn');
                const examSessionsTable = document.querySelector('.table-responsive');

                console.log('Scroll to Top Button (element):', scrollToTopBtn);
                console.log('Exam Sessions Table Element (element):', examSessionsTable);

                let tableOffsetTop = 500; // Default threshold

                if (examSessionsTable) {
                    tableOffsetTop = examSessionsTable.getBoundingClientRect().top + window.pageYOffset;
                    console.log('Calculated tableOffsetTop:', tableOffsetTop);
                } else {
                    console.log('Exam Sessions Table element not found. Using default tableOffsetTop:', tableOffsetTop);
                }

                scrollToTopBtn.addEventListener('click', function() {
                    console.log('Scroll to Top button clicked!');
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });

                // Initial check in case the page loads scrolled down
                if (scrollToTopBtn) { // Add safety check for button existence
                    if (window.scrollY > tableOffsetTop) {
                        scrollToTopBtn.style.setProperty('display', 'flex', 'important');
                        console.log('Button display set to flex !important (initial check)');
                    } else {
                        scrollToTopBtn.style.setProperty('display', 'none', 'important');
                        console.log('Button display set to none !important (initial check)');
                    }
                } else {
                    console.log('Scroll to Top Button not found on DOMContentLoaded');
                }


                window.onscroll = function() {
                    if (scrollToTopBtn) { // Add safety check for button existence
                        if (window.scrollY > tableOffsetTop) {
                            scrollToTopBtn.style.setProperty('display', 'flex', 'important');
                        } else {
                            scrollToTopBtn.style.setProperty('display', 'none', 'important');
                        }
                    }
                };
            });

        </script>
    @endpush


    {{--@livewire(\App\Livewire\Employee\UserModal::class)--}}
</div>
