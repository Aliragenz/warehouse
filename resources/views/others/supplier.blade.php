<x-base-layout>
    <x-slot name="content">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Suppliers Data Table</h6>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addSupplierModal">
                        Add New
                    </button>
                </div>

                <form method="GET" action="{{ route('suppliers') }}" class="mb-3">
                    <input type="text" id="search-input" name="search" value="{{ request()->input('search') }}"
                        class="form-control" placeholder="Search">
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->contact_info }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{ $suppliers->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
            </ul>
        </nav>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('search-input');
                searchInput.addEventListener('input', function () {
                    const query = searchInput.value;
                    fetch(`/suppliers?search=${query}`)
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

@include('components.modals.supplierModal')
