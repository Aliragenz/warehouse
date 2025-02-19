<x-base-layout>
    <x-slot name="content">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaction In Data Table</h6>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addTransactionModal">
                        Add New
                    </button>
                </div>

                <form method="GET" action="{{ route('transaction.in') }}" class="mb-3">
                    <input type="text" id="search-input" name="search" value="{{ request()->input('search') }}"
                        class="form-control" placeholder="Search">
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Transaction Code</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactionsIn as $transaction)
                            <tr>
                                <td>{{ $transaction->transCode }}</td>
                                <td>{{ $transaction->product->name }}</td>
                                <td>{{ $transaction->quantity }}</td>
                                <td>{{ $transaction->purchase->purchase_date }}</td>
                                <td>
                                    <!-- Info Icon -->
                                    <i class="bi bi-info-circle text-primary me-2" style="cursor: pointer;"
                                        data-bs-toggle="modal" data-bs-target="#infoModal{{ $transaction->id }}"></i>
                                </td>
                            </tr>
                            @include('components.modals.transactionInInfoModal', ['data' => $transaction])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{ $transactionsIn->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
            </ul>
        </nav>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('search-input');
                searchInput.addEventListener('input', function () {
                    const query = searchInput.value;
                    fetch(`/transaction/in?search=${query}`)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newTableBody = doc.querySelector('#dataTable tbody');
                            const newPagination = doc.querySelector('.pagination');

                            document.querySelector('#dataTable tbody').innerHTML = newTableBody.innerHTML;
                            document.querySelector('.pagination').innerHTML = newPagination.innerHTML;
                        });
                });
            });
        </script>

    </x-slot>
</x-base-layout>

@include('components.modals.transactionModal')
