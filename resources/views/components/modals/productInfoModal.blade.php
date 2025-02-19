<div class="modal fade" id="infoModal{{ $data->id }}" tabindex="-1"
    aria-labelledby="infoModalLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel{{ $data->id }}">Product Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> {{ $data->name }}</p>
                <p><strong>Code:</strong> {{ $data->productCode }}</p>
                <p><strong>Stock:</strong> {{ $data->stock }}</p>
                <p><strong>Description:</strong> {{ $data->description }}</p>
                <p><strong>Price:</strong> {{ $data->price }}</p>
                <p><strong>Supplier:</strong> {{ $data->supplier->name }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
