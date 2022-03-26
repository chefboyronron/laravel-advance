<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Company;

class CustomersController extends Controller
{
    public function index() 
    {
        $activeCustomers = Customer::active('created_at', 'desc')->paginate(3, ['*'], 'active');
        $inctiveCustomers = Customer::inactive('created_at', 'desc')->paginate(3, ['*'], 'inactive');
        $companies = Company::all();
        $customers = Customer::orderBy('created_at', 'desc')->paginate(5);

        return view('customers.index', compact(
            'activeCustomers',
            'inctiveCustomers',
            'companies',
            'customers'
        ));
    }

    public function create()
    {
        $companies = Company::all();
        return view('customers.create', compact('companies'));
    }

    public function store()
    {
        /**
         * fields validation rules
         */
        $data = request()->validate([
            'name' => 'required|min:3|max:50|unique:customers',
            'email' => 'required|email|unique:customers',
            'status' => 'required',
            'company_id' => 'required'
        ]);

        /** Laravel procedural insert  */
        // $customer = new Customer;
        // $customer->name = request('name');
        // $customer->email = request('email');
        // $customer->status = request('status');
        // $customer->save();

        /**
         * Field protected method using guarded and fillable property
         * */ 
        $customer = Customer::create($data);

        return redirect('customers');
    }
}
