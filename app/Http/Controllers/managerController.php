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

class managerController extends Controller
{
    public function managerDashboard()
    {

        return view('manager.dashboard', [
            'customerCount' => customers::count(),
            'stockIn' => stockTransactions::where('type', 'in')->sum('quantity'),
            'stockOut' => stockTransactions::where('type', 'out')->sum('quantity'),
            'suppliersCount' => Supplier::count(),
        ]);
    }

}
