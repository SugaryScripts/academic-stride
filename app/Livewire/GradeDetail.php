<?php

namespace App\Livewire;

use App\Models\Attempt\SessionExam;
use Livewire\Component;
use Livewire\Attributes\Computed;

class GradeDetail extends Component
{
    public $selected_id;
    public $chartLabels = [];
    public $chartData = [];
    public $examSessions = [];
    public $examProficiencyData = [];

    public function mount($id)
    {
        $this->selected_id = $id;
        $this->loadChartData();
        $this->loadExamProficiencyData();
    }

    public function loadChartData()
    {
        $completedSessions = SessionExam::where('user_id', $this->selected_id)
            ->where('status', \App\Constants\SessionExamStatusConstant::COMPLETED)
            ->with(['exam.subjectConfigurations.subject', 'exam.education'])
            ->orderBy('finished_at', 'desc')
            ->get();

        $subjectScores = [];
        $subjectSessions = [];

        foreach ($completedSessions as $session) {
            if ($session->exam && $session->exam->education && $session->percentage_score !== null) {
                foreach ($session->exam->subjectConfigurations as $config) {
                    if ($config->subject) {
                        $key = $config->subject->name . ' (' . $session->exam->education->code . ')';

                        if (!isset($subjectScores[$key])) {
                            $subjectScores[$key] = round($session->percentage_score, 1);
                        }

                        if (!isset($subjectSessions[$key])) {
                            $subjectSessions[$key] = [];
                        }
                        $subjectSessions[$key][] = $session;
                    }
                }
            }
        }

        // Process exam sessions for table
        $this->examSessions = [];
        foreach ($subjectSessions as $subjectKey => $sessions) {
            $firstSession = collect($sessions)->sortBy('finished_at')->first();
            $latestSession = collect($sessions)->sortByDesc('finished_at')->first();

            $this->examSessions[] = [
                'subject' => $subjectKey,
                'first_session' => $firstSession,
                'latest_session' => $latestSession,
                'total_attempts' => count($sessions)
            ];
        }

        arsort($subjectScores);

        $this->chartLabels = array_keys($subjectScores);
        $this->chartData = array_values($subjectScores);
    }

    #[Computed]
    public function averageScore()
    {
        return count($this->chartData) > 0 ? round(array_sum($this->chartData) / count($this->chartData), 1) : 0;
    }

    #[Computed]
    public function totalSubjects()
    {
        return count($this->chartData);
    }

    #[Computed]
    public function performanceGrade()
    {
        $avg = $this->averageScore();
        if ($avg >= 90) return ['grade' => 'A', 'label' => 'Excellent', 'class' => 'info'];
        if ($avg >= 80) return ['grade' => 'B', 'label' => 'Good', 'class' => 'success'];
        if ($avg >= 70) return ['grade' => 'C', 'label' => 'Average', 'class' => 'warning'];
        if ($avg >= 60) return ['grade' => 'D', 'label' => 'Below Average', 'class' => 'warning'];
        return ['grade' => 'F', 'label' => 'Poor', 'class' => 'danger'];
    }

    public function scrollToExam($examId)
    {
        $this->dispatch('scroll-to-exam', examId: $examId);
    }



    private function loadExamProficiencyData()
    {
        $allSessions = SessionExam::where('user_id', $this->selected_id)
            ->where('status', \App\Constants\SessionExamStatusConstant::COMPLETED)
            ->with([
                'exam.subjectConfigurations.subject',
                'sessionQuestions.question.proficiencyDetail.header',
                'sessionQuestions.userAnswerTextOption'
            ])
            ->get();

        $this->examProficiencyData = [];

        foreach ($allSessions as $session) {
            $proficiencyScores = [];

            foreach ($session->sessionQuestions as $sessionQuestion) {
                if ($sessionQuestion->question &&
                    $sessionQuestion->question->proficiencyDetail &&
                    $sessionQuestion->question->proficiencyDetail->header) {

                    $proficiencyHeader = $sessionQuestion->question->proficiencyDetail->header;
                    $proficiencyNo = $proficiencyHeader->no;

                    if (!isset($proficiencyScores[$proficiencyNo])) {
                        $proficiencyScores[$proficiencyNo] = [
                            'correct' => 0,
                            'total' => 0,
                            'parameter' => $proficiencyHeader->parameter
                        ];
                    }

                    $proficiencyScores[$proficiencyNo]['total']++;
                    if ($sessionQuestion->userAnswerTextOption && $sessionQuestion->userAnswerTextOption->is_correct) {
                        $proficiencyScores[$proficiencyNo]['correct']++;
                    }
                }
            }

            $proficiencyData = collect($proficiencyScores)
                ->map(function ($data, $no) {
                    return [
                        'no' => $no,
                        'parameter' => $data['parameter'],
                        'score' => $data['total'] > 0 ? round(($data['correct'] / $data['total']) * 100, 1) : 0,
                        'correct' => $data['correct'],
                        'total' => $data['total']
                    ];
                })
                ->sortBy('no')
                ->values()
                ->toArray();

            if (!empty($proficiencyData)) {
                $this->examProficiencyData[] = [
                    'session' => $session,
                    'proficiencyData' => $proficiencyData
                ];
            }
        }
    }

    private function getScoreClass($score)
    {
        if ($score >= 90) return 'info';
        if ($score >= 80) return 'success';
        if ($score >= 70) return 'warning';
        if ($score >= 60) return 'warning';
        return 'danger';
    }

    public function render()
    {
        return view('livewire.grade-detail');
    }
}
