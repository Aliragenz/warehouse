<x-base-layout>
    <x-slot name="content">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customers Data Table</h6>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('customers') }}" class="mb-3">
                    <input type="text" id="search-input" name="search" value="{{ request()->input('search') }}"
                        class="form-control" placeholder="Search by Code or Name">
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer Name</th>
                                <th>Phone Number</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->phone }}</td>

                                <td>
                                    <!-- Edit Icon -->
                                    <i class="bi bi-pencil-square text-warning me-2" style="cursor: pointer;"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}"></i>
                                </td>
                            </tr>
                            @include('components.modals.customers.customerEditModal', ['data' => $data])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{ $customers->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
            </ul>
        </nav>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('search-input');
                searchInput.addEventListener('input', function () {
                    const query = searchInput.value;
                    fetch(`/customers?search=${query}`)
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
