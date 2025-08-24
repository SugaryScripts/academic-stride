<?php

use function Livewire\Volt\{state, mount};

state(['proficiencyData', 'examTitle']);

mount(function ($proficiencyData, $examTitle = null) {
    $this->proficiencyData = $proficiencyData;
    $this->examTitle = $examTitle;
});

?>

<div class="row">
    @foreach($proficiencyData as $proficiency)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 border-{{ $proficiency['score'] == 100 ? 'success' : ($proficiency['score'] >= 80 ? 'info' : ($proficiency['score'] >= 60 ? 'warning' : 'danger')) }}">
            <div class="card-header bg-{{ $proficiency['score'] == 100 ? 'success' : ($proficiency['score'] >= 80 ? 'info' : ($proficiency['score'] >= 60 ? 'warning' : 'danger')) }} text-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-0 text-white">Proficiency {{ $proficiency['no'] }}</h6>
                        <small class="opacity-75">{{ $examTitle ?? 'Unknown Exam' }}</small>
                    </div>
                    <span class="badge bg-white text-{{ $proficiency['score'] == 100 ? 'success' : ($proficiency['score'] >= 80 ? 'info' : ($proficiency['score'] >= 60 ? 'warning' : 'danger')) }}">
                        {{ $proficiency['score'] }}%
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-{{ $proficiency['score'] == 100 ? 'success' : ($proficiency['score'] >= 80 ? 'info' : ($proficiency['score'] >= 60 ? 'warning' : 'danger')) }}"
                             style="width: {{ $proficiency['score'] }}%"></div>
                    </div>
                </div>
                <p class="text-muted small mb-2">
                    {{ $proficiency['parameter'] }}
                </p>
                <div class="d-flex justify-content-between text-sm">
                    <span class="text-success">{{ $proficiency['correct'] }} correct</span>
                    <span class="text-muted">{{ $proficiency['total'] }} total</span>
                </div>
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    @if($proficiency['score'] == 100)
                        <i class="ti ti-crown text-success"></i> Perfect mastery
                    @elseif($proficiency['score'] >= 80)
                        <i class="ti ti-check-circle text-info"></i> Good mastery
                    @elseif($proficiency['score'] >= 60)
                        <i class="ti ti-alert-circle text-warning"></i> Needs improvement
                    @else
                        <i class="ti ti-x-circle text-danger"></i> Requires attention
                    @endif
                </small>
            </div>
        </div>
    </div>
    @endforeach
</div>
