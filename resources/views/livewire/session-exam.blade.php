<x-slot name="page_title">
    Session Exam
</x-slot>
{{-- The best athlete wants his opponent at his best. --}}

<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        {{--<li class="breadcrumb-item"><a href="javascript: void(0)">Employee</a></li>--}}
                        <li class="breadcrumb-item" aria-current="page">Session Exam</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Session Exam</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->


    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Filter Session Exam</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_exam_title" class="form-label">Exam Title</label>
                                <x-form.input wire:model.live="filter_exam_title" placeholder="Filter by Exam Title" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_user_name" class="form-label">User Name</label>
                                <x-form.input wire:model.live="filter_user_name" placeholder="Filter by User Name" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_started_at_from" class="form-label">Started At (From)</label>
                                <x-form.input type="date" wire:model.live="filter_started_at_from" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_started_at_to" class="form-label">Started At (To)</label>
                                <x-form.input type="date" wire:model.live="filter_started_at_to" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_finished_at_from" class="form-label">Finished At (From)</label>
                                <x-form.input type="date" wire:model.live="filter_finished_at_from" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_finished_at_to" class="form-label">Finished At (To)</label>
                                <x-form.input type="date" wire:model.live="filter_finished_at_to" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_status" class="form-label">Status</label>
                                <x-form.select wire:model.live="filter_status">
                                    @foreach(\App\Constants\SessionExamStatusConstant::allCodes() as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <button class="btn btn-primary" wire:click="applyFilter">
                                <i class="bx bx-search bx-sm me-sm-2"></i>
                                <span class="d-none d-sm-inline-block">Search</span>
                            </button>
                            <button class="btn btn-secondary" wire:click="resetFilter">
                                <i class="bx bx-refresh bx-sm me-sm-2"></i>
                                <span class="d-none d-sm-inline-block">Reset</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                {{-- Header --}}
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <h5 class="mb-0">Session List</h5>
                    <div class="d-flex flex-column flex-md-row pt-3 pt-md-0">
                        <div class="btn-group flex-wrap">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user_modal">
                                <i class="bx bx-plus bx-sm me-sm-2"></i>
                                <span class="d-none d-sm-inline-block">
                                     Add New Record
                                 </span>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- End Header --}}

                <div class="card-body pt-3">
                    <div class="row justify-content-between">
                        <div class="col-md-auto me-auto ">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <label for="sort" class="col-form-label m-0">Display</label>
                                </div>
                                <div class="col-auto p-0">
                                    <select name="sort" id="sort"
                                            class="form-select form-select-sm" wire:model.live="paginate_item">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label for="sort" class="col-form-label m-0">entries</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto my-auto">
                            <!-- Loading Indicator -->
                            <div wire:loading class="mb-3">
                                <div class="d-flex align-items-center text-primary">
                                    <div class="spinner-border spinner-border-sm me-2" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    Loading...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                            <tr>
                                <th wire:click="sort('exam.title')" style="cursor:pointer;">
                                    Exam
                                    @if ($sortColumn == 'exam.title')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('user.name')" style="cursor:pointer;">
                                    User
                                    @if ($sortColumn == 'user.name')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('started_at')" style="cursor:pointer;">
                                    Started At
                                    @if ($sortColumn == 'started_at')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('finished_at')" style="cursor:pointer;">
                                    Finished At
                                    @if ($sortColumn == 'finished_at')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('correct_answers')" style="cursor:pointer;">
                                    Correct Answer
                                    @if ($sortColumn == 'correct_answers')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('percentage_score')" style="cursor:pointer;">
                                    Score
                                    @if ($sortColumn == 'percentage_score')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('status')" style="cursor:pointer;">
                                    Status
                                    @if ($sortColumn == 'status')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->exam->title }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->started_at ? \Carbon\Carbon::parse($item->started_at)->format('Y-m-d H:i') : '-' }}</td>
                                    <td>{{ $item->finished_at ? \Carbon\Carbon::parse($item->finished_at)->format('Y-m-d H:i') : '-' }}</td>
                                    <td>{{ $item->correct_answers }} / {{ $item->total_questions }}</td>
                                    <td>{{ $item->percentage_score }}% | {{ $item->total_score }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        {{--<a href="" onclick="event.preventDefault()"
                                           wire:click="selectItem('{{ $item->hashed }}')"
                                           class="avtar avtar-xs btn-link-secondary">
                                            <i class="ti ti-eye f-20"></i>
                                        </a>--}}
                                        <a href="" onclick="event.preventDefault()"
                                           wire:click="selectItem('{{ $item->id }}')"
                                           class="avtar avtar-xs btn-link-secondary">
                                            <i class="ti ti-edit f-20"></i>
                                        </a>
                                        <a href="" class="avtar avtar-xs btn-link-secondary"
                                           onclick="event.preventDefault()"
                                           wire:click="deleteConfirm('{{ $item->id }}')"
                                        >
                                            <i class="ti ti-trash f-20"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mx-2 mt-3">
                        {{ $data->links(data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    {{--@livewire(\App\Livewire\Employee\UserModal::class)--}}
</div>

