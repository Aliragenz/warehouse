<div class="modal fade" id="infoModal{{ $transaction->id }}" tabindex="-1"
    aria-labelledby="infoModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel{{ $transaction->id }}">Product Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Product Name:</strong> {{ $transaction->product->name }}</p>
                <p><strong>Customer Name:</strong> {{ $transaction->customer->name}}</p>
                <p><strong>Phone Number:</strong> {{ $transaction->customer->phone}}</p>
                <p><strong>Product Code:</strong> {{ $transaction->product->productCode }}</p>
                <p><strong>Transaction Code:</strong> {{ $transaction->transCode }}</p>
                <p><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
