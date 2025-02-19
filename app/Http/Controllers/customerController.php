<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\stockTransactions;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class customerController extends Controller
{
    public function showCustomers(Request $request)
    {
        $search = $request->input('search');
        $customers = customers::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
        })->paginate(6);
        return view('others.customer', compact('customers', 'search'));
    }

    public function update(Request $request, $id)
    {
        $customers = customers::findOrFail($id);
        $customers->update($request->all());
        return redirect()->route('customers')->with('success', 'customers updated successfully!');
    }

    public function destroy($id)
    {
        $customers = customers::findOrFail($id);
        $customers->delete();
        return redirect()->route('customers')->with('success', 'Customer deleted successfully!');
    }

}
