<x-slot name="page_title">
    Grade Detail
</x-slot>

<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Grade</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Detail Grade</h2>
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
                        <h5 class="mb-1">Academic Performance Overview</h5>
                        <p class="text-muted mb-0 small">Comprehensive analysis of exam performance across subjects</p>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge bg-primary">{{ $this->totalSubjects }} Subjects</span>
                        <span class="badge bg-{{ $this->performanceGrade['class'] }}">{{ $this->averageScore }}% Avg</span>
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
                                            <strong>Overall Performance: {{ $this->performanceGrade['label'] }}</strong><br>
                                            <small>Average score of {{ $this->averageScore }}% across {{ $this->totalSubjects }} subjects</small>
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
                            <h5 class="mt-3 text-muted">No Performance Data Available</h5>
                            <p class="text-muted">Complete some exams to see your performance analysis here.</p>
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
                    <h5 class="mb-1">Exam Performance Overview</h5>
                    <p class="text-muted mb-0 small">List of exams with total attempts and latest session details</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Exam Title</th>
                                    <th>Attempts</th>
                                    <th>Latest Score</th>
                                    <th>Time</th>
                                    <th>Action</th>
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
                                            <i class="ti ti-chart-pie"></i> Analyze
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
                            Completed on {{ $examData['session']->finished_at->format('M d, Y H:i') }} |
                            Score: {{ $examData['session']->percentage_score }}% |
                            Subject: {{ $examData['session']->exam->subjectConfigurations->pluck('subject.name')->join(', ') }}
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
                                <h6 class="mb-3">Detailed Proficiency Breakdown</h6>
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
                            <h5 class="mt-3 text-muted">No Proficiency Data</h5>
                            <p class="text-muted">Complete some exams to see proficiency analysis.</p>
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
    @endpush

    {{--@livewire(\App\Livewire\Employee\UserModal::class)--}}
</div>
