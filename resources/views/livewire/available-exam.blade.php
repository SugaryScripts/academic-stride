<x-slot name="page_title">
    Available Exams
</x-slot>
<style>
    .btn-luxury {
            background-image: linear-gradient(135deg, #a37c4f 0%, #d4af37 50%, #a37c4f 100%);
            border: none;
            color: white;
            transition: all 0.3s ease-in-out;
        }

        /* Hover effect for the button */
        .btn-luxury:hover {
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.6);
            transform: scale(1.05) translateY(-2px);
        }

        /* Active (click) effect for the button */
        .btn-luxury:active {
            transform: scale(1.0) translateY(0);
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.4);
        }
</style>
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
                                        <a href="{{ route('payment') }}" class="btn btn-sm p-2 btn-luxury">Claim Exam</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Soal Premium</td>
                                    <td>ini Soal Premium</td>
                                    <td>
                                        <a href="{{ route('payment') }}" class="btn btn-sm p-2 btn-luxury">Claim Exam</a>
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
