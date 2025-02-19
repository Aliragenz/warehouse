<x-base-layout>
    <x-slot name="content">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Products Data Table</h6>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('products') }}" class="mb-3">
                    <input type="text" id="search-input" name="search" value="{{ request()->input('search') }}"
                        class="form-control" placeholder="Search by Code or Name">
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Stock</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->productCode }}</td>
                                <td>{{ $data->stock ?? 0 }}</td>

                                <td>
                                    <!-- Info Icon -->
                                    <i class="bi bi-info-circle text-primary me-2" style="cursor: pointer;"
                                        data-bs-toggle="modal" data-bs-target="#infoModal{{ $data->id }}"></i>

                                    <!-- Edit Icon -->
                                    <i class="bi bi-pencil-square text-warning me-2" style="cursor: pointer;"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}"></i>

                                    <!-- Delete Icon -->
                                    <i class="bi bi-trash text-danger" style="cursor: pointer;" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $data->id }}"></i>
                                </td>
                            </tr>
                            @include('components.modals.productInfoModal', ['data' => $data])
                            @include('components.modals.productEditModal', ['data' => $data])
                            @include('components.modals.productDeleteModal', ['data' => $data])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{ $products->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
            </ul>
        </nav>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('search-input');
                searchInput.addEventListener('input', function () {
                    const query = searchInput.value;
                    fetch(`/products?search=${query}`)
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
