<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Supplier;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function showProductsTables(Request $request)
    {
        $search = $request->input('search');
        $suppliersData = Supplier::all();
        $customers = $request->all();
        $products = Products::with('stockTransactions')->when($search, function ($query, $search) {
            return $query->where('productCode', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%');
        })->paginate(10);
        return view('others.product', compact('products', 'search'));
    }

    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }
}
