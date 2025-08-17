<x-slot name="page_title">
    Exam
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
                        <li class="breadcrumb-item" aria-current="page">Exam</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Exam</h2>
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
                    <h5>Filter Exam</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_title" class="form-label">Title</label>
                                <x-form.input wire:model.live="filter_title" placeholder="Filter by Title" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_total_question" class="form-label">Total Question</label>
                                <x-form.input wire:model.live="filter_total_question" placeholder="Filter by Total Question" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_duration" class="form-label">Duration (min)</label>
                                <x-form.input wire:model.live="filter_duration" placeholder="Filter by Duration" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_education" class="form-label">Education</label>
                                <x-form.input wire:model.live="filter_education" placeholder="Filter by Education" class="form-control-sm" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="filter_created_by" class="form-label">Created By</label>
                                <x-form.input wire:model.live="filter_created_by" placeholder="Filter by Created By" class="form-control-sm" />
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
                    <h5 class="mb-0">Exam List</h5>
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
                                <th wire:click="sort('title')" style="cursor:pointer;">
                                    Title
                                    @if ($sortColumn == 'title')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('total_questions')" style="cursor:pointer;">
                                    Total Question
                                    @if ($sortColumn == 'total_questions')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('duration_minutes')" style="cursor:pointer;">
                                    Duration (min)
                                    @if ($sortColumn == 'duration_minutes')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th wire:click="sort('ref_education_code')" style="cursor:pointer;">
                                    Education
                                    @if ($sortColumn == 'ref_education_code')
                                        @if ($sortDirection == 'asc')
                                            <i class="ti ti-arrow-up"></i>
                                        @else
                                            <i class="ti ti-arrow-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th>Subject(s)</th>
                                <th wire:click="sort('creator.name')" style="cursor:pointer;">
                                    Created By
                                    @if ($sortColumn == 'creator.name')
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
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->total_questions }}</td>
                                    <td>{{ $item->duration_minutes }}</td>
                                    <td>{{ $item->ref_education_code }}</td>
                                    <td>{{ $item->subjectConfigurations->pluck('subject.name')->join(', ') }}</td>
                                    <td>{{ $item->creator->name }}</td>
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

