<x-slot name="page_title">
    Available Exams
</x-slot>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>Available Exams</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <input type="text" class="form-control" placeholder="Search exams..." wire:model.live.debounce.300ms="search">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th wire:click="sortBy('title')" style="cursor: pointer;">
                                    Title
                                    @if ($sortColumn == 'title')
                                        <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fas fa-sort"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('description')" style="cursor: pointer;">
                                    Description
                                    @if ($sortColumn == 'description')
                                        <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fas fa-sort"></i>
                                    @endif
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $exam)
                                <tr>
                                    <td>{{ $exam->title }}</td>
                                    <td>{{ $exam->description }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" wire:click="confirmClaimExam({{ $exam->id }})">Claim Exam</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No available exams found.</td>
                                </tr>
                            @endforelse
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
                                </tr>
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
