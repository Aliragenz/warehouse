<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\Products;
use App\Models\purchases;
use App\Models\stockTransactions;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class transactionController extends Controller
{
    function generateUniqueTransCode() {
        do {
            $transCode = 'TRX-' . strtoupper(Str::random(6)) . rand(100, 999);
        } while (stockTransactions::where('transCode', $transCode)->exists());

        return $transCode;
    }

    function generateUniqueProductCode() {
        do {
            $productCode = 'PRD-' . strtoupper(Str::random(4)) . rand(1000, 9999);
        } while (Products::where('productCode', $productCode)->exists());

        return $productCode;
    }

    public function transactionStore(Request $request)
    {
        // Validation
        $request->validate([
            'supplier_id' => 'nullable|exists:suppliers,id',
            'new_supplier_name' => 'nullable|string',
            'new_supplier_contact' => 'nullable|string',
            'product_id' => 'nullable|exists:products,id',
            'new_product_name' => 'nullable|string',
            'new_product_code' => 'nullable|string|unique:products,productCode',
            'new_product_description' => 'nullable|string',
            'new_product_price' => 'nullable|numeric',
            'new_product_stock' => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'customer_id' => 'nullable|exists:customers,id',
            'new_customer_name' => 'nullable|string',
            'new_customer_phone' => 'nullable|string',
            'transCode' => 'nullable|string|unique:stock_transactions,transCode',
            'quantity' => 'nullable|numeric',
            'type' => 'required|in:in,out',
        ]);

        // Handle Supplier
        $supplierId = $request->supplier_id;
        if (!$supplierId && $request->new_supplier_name) {
            $supplier = Supplier::create([
                'name' => $request->new_supplier_name,
                'contact_info' => $request->new_supplier_contact,
            ]);
            $supplierId = $supplier->id;
        }

        // Handle Product
        $productId = $request->product_id;
        if (!$productId && $request->new_product_name) {
            $productCode = $this->generateUniqueProductCode();
            $product = Products::create([
                'name' => $request->new_product_name,
                'description' => $request->new_product_description,
                'productCode' => $productCode,
                'price' => $request->new_product_price,
                'supplier_id' => $supplierId,
            ]);
            $productId = $product->id;
        }

        // Check if stock goes negative when "out"
        if ($request->type === 'out') {
            $currentStock = stockTransactions::where('product_id', $productId)
                ->selectRaw("SUM(CASE WHEN type = 'in' THEN quantity ELSE 0 END) - SUM(CASE WHEN type = 'out' THEN quantity ELSE 0 END) as stock_balance")
                ->first()
                ->stock_balance ?? 0;

            if ($currentStock < $request->quantity) {
                return redirect()->back()->withErrors(['stock' => 'Not enough stock available!']);
            }
        }

        // Handle Customer
        $customerId = $request->customer_id;
        if (!$customerId && $request->new_customer_name) {
            $customer = customers::create([
                'name' => $request->new_customer_name,
                'phone' => $request->new_customer_phone,
            ]);
            $customerId = $customer->id;
        }

        // Handle Stock Transaction
        $transCode = $this->generateUniqueTransCode();
        $stockTransaction = stockTransactions::create([
            'transCode' => $transCode,
            'product_id' => $productId,
            'quantity' => $request->quantity,
            'type' => $request->type,
            'customer_id' => $customerId,
        ]);

        // Handle Purchase
        $purchase = purchases::create([
            'purchase_date' => $request->purchase_date,
            'stock_transaction_id' => $stockTransaction->id,
        ]);


        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function transactionIn(Request $request)
    {
        $search = $request->input('search');
        $suppliers = Supplier::all();
        $products = Products::all();
        $purchases = purchases::all();
        $transactionsIn = stockTransactions::where('type', 'in')
            ->when($search, function ($query, $search) {
                return $query->where('transCode', 'like', "%{$search}%")
                    ->orWhereHas('product', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->with('product') // Eager load the product relationship
            ->paginate(10);

        return view('others.transactions.transactionIn', compact('transactionsIn', 'suppliers', 'products', 'purchases'));
    }

    public function transactionOut(Request $request)
    {
        $search = $request->input('search');
        $suppliers = Supplier::all();
        $purchases = purchases::all();
        $customers = customers::all();
        $products = Products::all();
        $transactionsOut = stockTransactions::where('type', 'out')
            ->when($search, function ($query, $search) {
                return $query->where('transCode', 'like', "%{$search}%")
                    ->orWhereHas('product', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->with('product') // Eager load the product relationship
            ->paginate(10);

        return view('others.transactions.transactionOut', compact('transactionsOut', 'suppliers', 'customers', 'products', 'purchases'));
    }
}
