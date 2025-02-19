<div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
                <p><strong>Name:</strong> {{ $data->name }}</p>
                <p><strong>Code:</strong> {{ $data->productCode }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('products.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
