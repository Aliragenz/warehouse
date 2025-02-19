<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-supplier-form" method="POST" action="{{ route('suppliers.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="supplier-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="supplier-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier-contact" class="form-label">Contact Info</label>
                        <input type="text" class="form-control" id="supplier-contact" name="contact_info" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Supplier</button>
                </form>
            </div>
        </div>
    </div>
</div>

