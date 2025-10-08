<x-slot name="page_title">
    {{ __('exam.available_exams') }}
</x-slot>

<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">{{ __('exam.available_exams') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">{{ __('exam.available_exams') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">

                {{-- Header --}}
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <h5 class="mb-0">{{ __('exam.available_exams') }}</h5>
                </div>
                {{-- End Header --}}

                <div class="card-body pt-3">

                    <div class="row justify-content-between">
                        <div class="col-md-auto me-auto ">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <label for="sort" class="col-form-label m-0">{{ __('exam.display') }}</label>
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
                                    <label for="sort" class="col-form-label m-0">{{ __('exam.entries') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto my-auto">
                            <!-- Loading Indicator -->
                            <div wire:loading class="mb-3">
                                <div class="d-flex align-items-center text-primary">
                                    <div class="spinner-border spinner-border-sm me-2" role="status">
                                        <span class="visually-hidden">{{ __('exam.loading') }}</span>
                                    </div>
                                    {{ __('exam.loading') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto ms-auto my-auto">
                            <div
                                class="row align-items-center justify-content-lg-end justify-content-md-end justify-content-xl-end justify-content-xxl-end justify-content-sm-start">
                                <div class="col-auto ps-0">
                                    <x-form.input wire:model.defer="search" placeholder="{{ __('exam.search_placeholder') }}"
                                                  wire:keydown.enter="$set('search', $event.target.value)"
                                                  class="form-control-sm" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th wire:click="sortBy('title')" style="cursor: pointer;">
                                    {{ __('exam.title') }}
                                    @if ($sortColumn == 'title')
                                        <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fas fa-sort"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('description')" style="cursor: pointer;">
                                    {{ __('exam.description') }}
                                    @if ($sortColumn == 'description')
                                        <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fas fa-sort"></i>
                                    @endif
                                </th>
                                <th>{{ __('exam.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($data as $exam)
                                <tr>
                                    <td>{{ $exam->title }}</td>
                                    <td>{{ $exam->description }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" wire:click="confirmClaimExam({{ $exam->id }})">{{ __('exam.claim_exam') }}</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('exam.no_exams_found') }}</td>
                                </tr>
                            @endforelse
                            {{-- TODO: phase 2
                            <tr>
                                <td>Soal Premium</td>
                                <td>ini Soal Premium</td>
                                <td>
                                    <a href="{{ route('pricing') }}" class="btn btn-sm p-2 btn-luxury">Claim Exam</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Soal Premium</td>
                                <td>ini Soal Premium</td>
                                <td>
                                    <a href="{{ route('pricing') }}" class="btn btn-sm p-2 btn-luxury">Claim Exam</a>
                                </td>
                            </tr>--}}
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
