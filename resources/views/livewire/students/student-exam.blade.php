<div
    x-data="{
        questionUpdatedKey: @entangle('questionUpdatedKey').live,
    }"
    x-init="
        MathJax.typesetPromise(); // Initial render

        $watch('questionUpdatedKey', () => {
             // Re-render MathJax when questionUpdatedKey changes
            setTimeout(() => {
                MathJax.typesetPromise();
            }, 0);
        });
    "
>
    <section id="exam">
        <div class="container">
            <!-- Exam Header -->
            <div class="row justify-content-center text-center mb-4">
                <div class="col-md-10 col-xl-8">
                    <h2 class="mb-3">{{ $examSession->exam->title }}</h2>
                    {{--<span class="math text-gray-100">$$ E = mc^2 $$</span>--}}
                    {{--<p class="mb-0 text-muted">Test your understanding of user interface and user experience design principles.</p>--}}
                </div>
            </div>

            <!-- Exam Progress -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted fw-medium">{{ __('exam.question_of', ['current' => $currentQuestion, 'total' => $totalQuestions]) }}</span>
                                <span class="badge bg-primary fs-6 px-3 py-2" id="timer">{{ $timeRemaining }}</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar"
                                     style="width: {{ ($currentQuestion / $totalQuestions) * 100 }}%"
                                     aria-valuenow="{{ ($currentQuestion / $totalQuestions) * 100 }}"
                                     aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Question Section -->
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-8">
                    @if($question)
                        <div class="card shadow">
                            <div class="card-body p-4 p-md-5">
                                <!-- Question Text -->
                                <div class="d-flex align-items-start gap-4 mb-4">
                                    <div class="text-muted h4 font-weight-bold">{{ $currentQuestion }}.</div>
                                    <div class="h4">{!! $question->question_text !!}</div>
                                </div>


                                <!-- Answer Options -->
                                <div class="mb-0">
                                    <div class="row">
                                        @foreach($question->answerTextOptions as $index => $answer)
                                            <div class="col-12 mb-3">
                                                <div class="form-check d-flex align-items-center">
                                                    <input type="radio"
                                                           class="form-check-input mt-0"
                                                           name="selected_answer"
                                                           id="answer{{ $answer->id }}"
                                                           value="{{ $answer->id }}"
                                                           wire:model="selectedAnswer"
                                                           wire:loading.attr="disabled"
                                                           wire:key="answer-{{ $currentQuestion }}-{{ $answer->id }}"
                                                        {{ $selectedAnswer == $answer->id ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-4 w-100 {{ 'wire-loading-disabled' }}"
                                                           for="answer{{ $answer->id }}"
                                                           wire:click="selectAnswer({{ $answer->id }})"
                                                           wire:loading.attr="disabled">
                                                        <div class="card mb-0 border-2 {{ $selectedAnswer == $answer->id ? 'border-primary bg-primary bg-opacity-10' : 'border-light' }} h-100">
                                                            <div class="card-body p-3 p-md-4">
                                                                <div class="d-flex align-items-center">
                                                                <span class="badge {{ $selectedAnswer == $answer->id ? 'bg-primary' : 'bg-light text-dark' }} me-3 flex-shrink-0 fs-6">
                                                                    {{ chr(65 + $index) }}
                                                                </span>
                                                                <span class="flex-grow-1 {{ $selectedAnswer == $answer->id ? 'text-primary fw-medium' : '' }}">{{ $answer->answer }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="card shadow-sm mt-4">
                            <div class="card-body">
                                <!-- Loading Indicator -->
                                <div wire:loading wire:target="nextQuestion,previousQuestion,goToQuestion" class="text-center mb-3">
                                    <div class="d-flex align-items-center justify-content-center text-primary">
                                        <div class="spinner-border spinner-border-sm me-2" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        Loading...
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- Previous Button --}}
                                    <div>
                                        @if($currentQuestion > 1)
                                            <button wire:click="previousQuestion" class="btn btn-outline-secondary" wire:loading.attr="disabled" wire:navigate>
                                                <i class="bi bi-arrow-left me-2"></i>{{ __('exam.previous') }}
                                            </button>
                                        @endif
                                    </div>

                                    {{-- Question Number Buttons (Scrollable Section) --}}
                                    {{-- Using Bootstrap classes for horizontal scrolling:
                                         d-flex: Enables flexbox.
                                         flex-nowrap: Prevents items from wrapping.
                                         overflow-auto: Enables horizontal scrolling if content overflows.
                                         flex-grow-1: Allows this container to take up available space.
                                         mx-3: Adds horizontal margin for spacing.
                                         pb-1: Adds padding-bottom to prevent scrollbar overlap. --}}
                                    <div class="d-flex gap-2 flex-nowrap overflow-auto flex-grow-1 mx-3 pb-1">
                                        @for($i = 1; $i <= $totalQuestions; $i++)
                                            @php
                                                $isAnswered = isset($userAnswers[$i]);
                                                $buttonClass = 'btn btn-sm rounded-circle flex-shrink-0 ';
                                                if ($i == $currentQuestion) {
                                                    $buttonClass .= 'btn-primary'; // Current question - blue
                                                } elseif ($isAnswered) {
                                                    $buttonClass .= 'btn-success'; // Answered - green
                                                } elseif ($i < $currentQuestion) {
                                                    $buttonClass .= 'btn-warning'; // Passed but not answered - yellow
                                                } else {
                                                    $buttonClass .= 'btn-outline-secondary'; // Not yet reached - no background
                                                }
                                            @endphp
                                            <button wire:click="goToQuestion({{ $i }})"
                                                    class="{{ $buttonClass }}"
                                                    style="width: 40px; height: 40px;"
                                                    wire:loading.attr="disabled"
                                                    wire:navigate
                                                    id="question-btn-{{ $i }}"> {{-- Fixed width/height for circular buttons --}}
                                                {{ $i }}
                                            </button>
                                        @endfor
                                    </div>

                                    {{-- Next/Review Button --}}
                                    <div>
                                        @if($currentQuestion < $totalQuestions)
                                            <button wire:click="nextQuestion" class="btn btn-primary" wire:loading.attr="disabled" wire:navigate>
                                                {{ __('exam.next') }}<i class="bi bi-arrow-right ms-2"></i>
                                            </button>
                                        @else
                                            <button type="button"
                                                    class="btn btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#reviewQuestionsModal"
                                                    wire:loading.attr="disabled">
                                                <i class="bi bi-list-check me-2"></i>{{ __('exam.review_questions') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card shadow">
                            <div class="card-body p-4 p-md-5 text-center">
                                <div class="mb-4">
                                    <i class="bi bi-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                                </div>
                                <h5 class="fw-bold">{{ __('exam.no_questions_available') }}</h5>
                                <p class="text-muted">{{ __('exam.contact_instructor') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Question Overview (Mobile) -->
            <div class="row justify-content-center mt-4 d-md-none">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="mb-3 fw-bold">{{ __('exam.question_overview') }}</h6>
                            <div class="row g-2">
                                @for($i = 1; $i <= $totalQuestions; $i++)
                                    @php
                                        $isAnswered = isset($userAnswers[$i]);
                                        $buttonClass = 'btn btn-sm w-100 ';
                                        if ($i == $currentQuestion) {
                                            $buttonClass .= 'btn-primary'; // Current question - blue
                                        } elseif ($isAnswered) {
                                            $buttonClass .= 'btn-success'; // Answered - green
                                        } elseif ($i < $currentQuestion) {
                                            $buttonClass .= 'btn-warning'; // Passed but not answered - yellow
                                        } else {
                                            $buttonClass .= 'btn-outline-secondary'; // Not yet reached - no background
                                        }
                                    @endphp
                                    <div class="col-3 col-sm-2">
                                        <button wire:click="goToQuestion({{ $i }})"
                                                class="{{ $buttonClass }}"
                                                wire:navigate>
                                            {{ $i }}
                                        </button>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Review Questions Modal -->
    <div class="modal fade" id="reviewQuestionsModal" tabindex="-1" aria-labelledby="reviewQuestionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="reviewQuestionsModalLabel">{{ __('exam.review_questions') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <p class="text-muted mb-3">
                            {!! __('exam.answered_count', ['answered' => '<strong class="text-success">' . $answeredQuestions . '</strong>', 'total' => '<strong>' . $totalQuestions . '</strong>']) !!}
                        </p>
                        <div class="d-flex gap-3 mb-3">
                            <small><span class="badge bg-success me-1"></span>{{ __('exam.answered') }}</small>
                            <small><span class="badge bg-warning me-1"></span>{{ __('exam.not_answered') }}</small>
                            <small><span class="badge bg-primary me-1"></span>{{ __('exam.current') }}</small>
                        </div>
                    </div>
                    <div class="row g-2">
                        @for($i = 1; $i <= $totalQuestions; $i++)
                            @php
                                $isAnswered = isset($userAnswers[$i]);
                                $buttonClass = 'btn btn-sm ';
                                if ($i == $currentQuestion) {
                                    $buttonClass .= 'btn-primary';
                                } elseif ($isAnswered) {
                                    $buttonClass .= 'btn-success';
                                } else {
                                    $buttonClass .= 'btn-warning';
                                }
                            @endphp
                            <div class="col-2 col-sm-1">
                                <button wire:click="goToQuestion({{ $i }})"
                                        class="{{ $buttonClass }} w-100"
                                        data-bs-dismiss="modal"
                                        wire:navigate>
                                    {{ $i }}
                                </button>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('exam.continue_exam') }}
                    </button>
                    <button type="button"
                            class="btn btn-success"
                            data-bs-dismiss="modal"
                            data-bs-toggle="modal"
                            data-bs-target="#submitExamModal">
                        <i class="bi bi-check2 me-2"></i>{{ __('exam.submit_exam') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Exam Modal -->
    <div class="modal fade" id="submitExamModal" tabindex="-1" aria-labelledby="submitExamModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="submitExamModalLabel">{{ __('exam.submit_exam') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-4">
                        <i class="bi bi-question-circle text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h6 class="mb-3 fw-bold">{{ __('exam.submit_confirmation') }}</h6>
                    <p class="text-muted mb-4">
                        {!! __('exam.answered_count', ['answered' => '<strong class="text-primary">' . $answeredQuestions . '</strong>', 'total' => '<strong class="text-primary">' . $totalQuestions . '</strong>']) !!}
                        <br><small class="text-danger">{{ __('exam.submit_warning') }}</small>
                    </p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('exam.continue_exam') }}
                    </button>
                    <button wire:click="submitExam" class="btn btn-success" data-bs-dismiss="modal">
                        <i class="bi bi-check2 me-2"></i>{{ __('exam.submit_final_answer') }}
                    </button>
                </div>
            </div>
        </div>
    </div>



    @push('styles')
        <style>
            [disabled] {
                pointer-events: none;
                opacity: 0.6;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Timer functionality
                let timeRemaining = {{ $timeRemainingSeconds }}; // Initialize with server-provided time

                function updateTimer() {
                    if (timeRemaining < 0) {
                        timeRemaining = 0; // Prevent negative display
                    }

                    const minutes = Math.floor(timeRemaining / 60);
                    const seconds = timeRemaining % 60;
                    const timerElement = document.getElementById('timer');

                    if (timerElement) {
                        timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }

                    if (timeRemaining <= 0) {
                        // Auto-submit when time runs out
                        @this.call('submitExam');
                        clearInterval(timerInterval); // Stop the timer
                        return;
                    }

                    timeRemaining--;
                }

                // Update timer every second
                const timerInterval = setInterval(updateTimer, 1000);

                // No longer preventing accidental page refresh client-side; relying on server for persistence.
                let examSubmitted = false; // Keep for Livewire event handling


                // Clear timer and remove page leave warning when exam is submitted
                window.addEventListener('examSubmitted', function() {
                    examSubmitted = true;
                    clearInterval(timerInterval);
                });

                // Listen for Livewire event
                Livewire.on('examSubmitted', function() {
                    examSubmitted = true;
                    clearInterval(timerInterval);
                });

                // Auto-scroll current question into view
                function scrollToCurrentQuestion() {
                    const currentBtn = document.querySelector('.btn-primary[wire\\:click*="goToQuestion"]');
                    if (currentBtn) {
                        currentBtn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    }
                }

                // Scroll on page load and after updates
                setTimeout(scrollToCurrentQuestion, 100);
                document.addEventListener('livewire:navigated', scrollToCurrentQuestion);
                Livewire.hook('morph.updated', scrollToCurrentQuestion);
            });
        </script>

    @endpush
</div>

