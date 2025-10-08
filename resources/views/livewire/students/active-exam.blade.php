<x-slot name="page_title">
    {{ __('exam.active_exams') }}
</x-slot>

<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">{{ __('exam.active_exams') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">{{ __('exam.active_exams') }}</h2>
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
                    <h5 class="mb-0">{{ __('exam.active_exams') }}</h5>
                </div>
                {{-- End Header --}}

                <div class="card-body pt-3">

                    <div class="row justify-content-between">
                        @if(session()->has('message'))
                            <div class="col-md-8">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                        @endif

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
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                            <tr>
                                <th>{{ __('exam.exam') }}</th>
                                <th>{{ __('exam.started_at') }}</th>
                                <th>{{ __('exam.finished_at') }}</th>
                                <th>{{ __('exam.status') }}</th>
                                <th>{{ __('exam.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->exam->title }}</td>
                                    <td>{{ $item->started_at ? \Carbon\Carbon::parse($item->started_at)->format('Y-m-d H:i') : '-' }}</td>
                                    <td>{{ $item->finished_at ? \Carbon\Carbon::parse($item->finished_at)->format('Y-m-d H:i') : '-' }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        @if($item->status == 'OPEN')
                                            <button type="button" wire:click="onClickStart({{ $item->id }})"
                                                    class="btn btn-shadow btn-primary">
                                                {{ __('exam.start') }}
                                            </button>
                                        @elseif($item->status == 'IN_PROGRESS')
                                            <button type="button" wire:click="onClickStart({{ $item->id }})"
                                                    class="btn btn-shadow btn-primary">
                                                {{ __('exam.continue') }}
                                            </button>
                                        @endif
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
