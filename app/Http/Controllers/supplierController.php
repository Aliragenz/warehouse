<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class supplierController extends Controller
{
    public function showSuppliers(Request $request)
    {
        $search = $request->input('search');
        $suppliers = Supplier::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('contact_info', 'like', '%' . $search . '%');
        })->paginate(6);
        return view('others.supplier', compact('suppliers', 'search'));
    }


    public function supplierStore(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name',
            'contact_info' => 'required|string|max:255',
        ], [
            'name.unique' => 'This supplier name already exists. Please choose a different name.'
        ]);

        // Create a new supplier
        Supplier::create([
            'name' => $request->input('name'),
            'contact_info' => $request->input('contact_info'),
        ]);

        // Redirect back with a success message
        return redirect()->route('suppliers')->with('success', 'Supplier added successfully!');
    }
}
