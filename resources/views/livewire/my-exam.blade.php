<x-slot name="page_title">
    My Exam
</x-slot>

<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        {{--<li class="breadcrumb-item"><a href="javascript: void(0)">Employee</a></li>--}}
                        <li class="breadcrumb-item" aria-current="page">My Exam</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">My Exam</h2>
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
                    <h5 class="mb-0">Exam</h5>
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
                                <th>Exam</th>
                                <th>Started At</th>
                                <th>Finished At</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                                Start
                                            </button>
                                        @elseif($item->status == 'IN_PROGRESS')
                                            <button type="button" wire:click="onClickStart({{ $item->id }})"
                                                    class="btn btn-shadow btn-primary">
                                                Continue
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
