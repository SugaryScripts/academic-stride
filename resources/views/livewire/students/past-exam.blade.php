<x-slot name="page_title">
    {{ __('exam.past_exams') }}
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
                        <li class="breadcrumb-item" aria-current="page">{{ __('exam.past_exams') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">{{ __('exam.past_exams') }}</h2>
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

                {{-- Header --}}
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <h5 class="mb-0">{{ __('exam.exam_list') }}</h5>
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
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                            <tr>
                                <th>{{ __('exam.exam') }}</th>
                                <th>{{ __('exam.started_at') }}</th>
                                <th>{{ __('exam.finished_at') }}</th>
                                <th>{{ __('exam.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->exam->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->started_at)->format('Y-m-d H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->finished_at)->format('Y-m-d H:i') }}</td>
                                    <td>{{ $item->status }}</td>
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

