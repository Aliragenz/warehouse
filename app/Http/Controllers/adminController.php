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

class adminController extends Controller
{
    public function adminDashboard()
    {

        return view('admin.dashboard', [
            'customerCount' => customers::count(),
            'stockIn' => stockTransactions::where('type', 'in')->sum('quantity'),
            'stockOut' => stockTransactions::where('type', 'out')->sum('quantity'),
            'suppliersCount' => Supplier::count(),
        ]);
    }

    public function showCreateAccountForm()
    {

        return view('admin.create-account');
    }

    public function storeAccount(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'accountName' => ['required', 'string', 'lowercase', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,manager',
        ]);

        User::create([
            'name' => $request->name,
            'accountName' => $request->accountName,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Account has been Created!');
    }

}
