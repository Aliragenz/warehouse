<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTransactionModalLabel">
                    @if(!request()->routeIs('transaction.in'))
                    Add New Transaction Out
                    @endif
                    @if(!request()->routeIs('transaction.out'))
                    Add New Transaction in
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-product-form" method="POST" action="{{ route('transaction.store') }}">
                    @csrf

                    <!-- Supplier Section -->
                    <fieldset class="mb-4 p-4 border rounded">
                        <legend class="w-auto px-2">Supplier Details</legend>
                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Select Supplier:</label>
                            <select id="supplier_id" name="supplier_id" class="form-select" required>
                                <option value="">-- Select Supplier --</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(!request()->routeIs('transaction.out'))
                        <div class="mb-3">
                            <label class="form-label">Or Add New Supplier:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="new_supplier_name" name="new_supplier_name"
                                        class="form-control" placeholder="Supplier Name">
                                </div>
                                <div class="col">
                                    <input type="text" id="new_supplier_contact" name="new_supplier_contact"
                                        class="form-control" placeholder="Contact Info">
                                </div>
                            </div>
                        </div>
                        @endif
                    </fieldset>

                    <!-- Product Section -->
                    <fieldset class="mb-4 p-4 border rounded">
                        <legend class="w-auto px-2">Product Details</legend>
                        @if(!request()->routeIs('transaction.in'))
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Select Product:</label>
                            <select id="product_id" name="product_id" class="form-select">
                                <option value="">-- Select Product --</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->productCode }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if(!request()->routeIs('transaction.out'))
                        <div class="mb-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" id="new_product_name" name="new_product_name"
                                        class="form-control" placeholder="Product Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" id="new_product_price" name="new_product_price"
                                        class="form-control" placeholder="Price">
                                </div>
                                <div class="col-12">
                                    <textarea id="new_product_description" name="new_product_description"
                                        class="form-control" placeholder="Description" style="resize: none"></textarea>
                                </div>
                            </div>
                        </div>
                        @endif
                    </fieldset>

                    <!-- Purchase Section -->
                    <fieldset class="mb-4 p-4 border rounded">
                        <legend class="w-auto px-2">Purchase Details</legend>
                        <div class="mb-3">
                            <label for="purchase_date" class="form-label">Purchase Date:</label>
                            <input type="date" id="purchase_date" name="purchase_date" class="form-control" required>
                        </div>
                    </fieldset>

                    <!-- Customer Section -->
                    @if(request()->routeIs('transaction.out'))
                    <fieldset class="mb-4 p-4 border rounded">
                        <legend class="w-auto px-2">Customer Details</legend>
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Select Customer:</label>
                            <select id="customer_id" name="customer_id" class="form-select">
                                <option value="">-- Select Customer --</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Or Add New Customer:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="new_customer_name" name="new_customer_name"
                                        class="form-control" placeholder="Customer Name">
                                </div>
                                <div class="col">
                                    <input type="text" id="new_customer_phone" name="new_customer_phone"
                                        class="form-control" placeholder="Phone">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    @endif

                    <!-- Stock Transaction Section -->
                    <fieldset class="mb-4 p-4 border rounded">
                        <legend class="w-auto px-2">Stock Transaction Details</legend>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Transaction Type:</label>
                            <select id="type" name="type" class="form-select" required>
                                <option value="in" @if(request()->routeIs('transaction.in')) selected @endif>
                                    Stock In
                                </option>
                                <option value="out" @if(request()->routeIs('transaction.out')) selected @endif>
                                    Stock Out
                                </option>
                            </select>
                        </div>

                    </fieldset>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
