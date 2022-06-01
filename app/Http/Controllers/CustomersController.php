<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Events\NewCustomerHasRegisteredEvent;
use App\Customer;
use App\Company;

class CustomersController extends Controller
{

    public function __construct()
    {

        // except([] = list of resfull controller methods) 
        $this->middleware('auth')->except(['index']);
    }

    public function index() 
    {
        $activeCustomers = Customer::active('created_at', 'desc')->paginate(3, ['*'], 'active');
        $inctiveCustomers = Customer::inactive('created_at', 'desc')->paginate(3, ['*'], 'inactive');
        $companies = Company::with('customers')->get();
        // $customers = Customer::orderBy('created_at', 'desc')->paginate(5);
        $customers = Customer::with('company')->orderBy('created_at', 'desc')->paginate(5);

        return view('customers.index', compact(
            'activeCustomers',
            'inctiveCustomers',
            'companies',
            'customers'
        ));
    }

    public function create()
    {
        $customer = new Customer();
        $companies = Company::all();
        return view('customers.create', compact('companies', 'customer'));
    }

    public function store()
    {
        /**
         * fields validation rules
         */
        // $data = request()->validate([
        //     'name' => 'required|min:3|max:50|unique:customers,name',
        //     'email' => 'required|email|unique:customers,email',
        //     'status' => 'required',
        //     'company_id' => 'required'
        // ]);

        /** Laravel procedural insert  */
        // $customer = new Customer;
        // $customer->name = request('name');
        // $customer->email = request('email');
        // $customer->status = request('status');
        // $customer->save();

        /**
         * Field protected method using guarded and fillable property
         * */ 
        $customer = Customer::create($this->validateRequest());

        $this->storeImage($customer);

        // Events and Listener
        event(new NewCustomerHasRegisteredEvent($customer));
        
        return redirect('customers');
    }

    public function storeImage($customer)
    {
        // Create a symbolic link from "public/storage" to "storage/app/public"
        // Artisan Command: php artisan storage:link
        // Image URL: http://localhost:8000/storage/uploads/Lj7TVfN3fGbEBoM5fPGIFwzczJImKEc86nSeSPsW.png
        if( request()->has('image') ) {
            $customer->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);

            // Image cropping and resizing
            // https://image.intervention.io/v2/api/fit
            $image = Image::make(public_path('storage/' . $customer->image))->fit(300, 300, null, 'center');
            $image->save();
        }
    }

    /** Option 2
     * @description - Route model binding
     * @param ( Customer $customer )
     * Customer - Model
     * $customer - Route variable
     *  - should same with the route wildcard {variable}
     */
    public function show( $customer )
    {
        // Option 1
        // if record exists show details else throw 404 not found
        $customer = Customer::where('id', $customer)->firstOrFail();
        return view('customers.show', compact('customer'));
    }

    public function edit( Customer $customer )
    {
        $companies = Company::all();
        return view('customers.edit', compact('customer', 'companies'));
    }

    public function update(Customer $customer)
    {
        $customer->update($this->validateRequest($customer->id));

        $this->storeImage($customer);

        return redirect('customers/' . $customer->id);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('customers');
    }

    public function validateRequest($customer_id = '')
    {
        // return tap(request()->validate([
        //     'name' => 'required|min:3|max:50|unique:customers,name,' . $customer_id,
        //     'email' => 'required|email|unique:customers,email,' . $customer_id,
        //     'status' => 'required',
        //     'company_id' => 'required'

        // ]), function(){

        //     if( request()->hasFile('image') ) {
        //         request()->validate([
        //             'image' => 'file|image|max:5000'
        //         ]);
        //     }

        // });

        return request()->validate([
            'name' => 'required|min:3|max:50|unique:customers,name,' . $customer_id,
            'email' => 'required|email|unique:customers,email,' . $customer_id,
            'status' => 'required',
            'company_id' => 'required',
            'image' => 'sometimes|file|image|max:5000',
        ]);
    }

}
