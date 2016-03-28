<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="Ajout commercial";

        return view('Customers/add_customer', ['title'=>$title]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //--ADD NEW CUSTOMER
        // $user::Auth

        $validator = Validator::make($request->all(),
            ['cin'=> 'required|unique:customers|numeric|min:8',
            'name'=>'required',
            'last_name'=>'required',
            'mail'=>'required',
            'adress'=>'required',
            'function'=>'required',
            'phone'=>'required|numeric',
            'car'=>'required']);
        if ($validator->fails()) {
            //$messages = $validator->messages();
            return redirect(route('addcustomerIndex'))->withErrors($validator->errors());
        }

        else {
            $customer= new Customer();
            $customer->name=$request->name;
            $customer->last_name=$request->last_name;
            $customer->cin=$request->cin;
            $customer->mail=$request->mail;
            $customer->adress=$request->adress;
            $customer->function=$request->function;
            $customer->phone=$request->phone;
            $customer->car=$request->car;
            $customer->commercial_id=  Controller::User()->id;

            $customer->save();

        }
        //$newCustomer =
        // attacher client au commercial courant
        //$newCustomer->attachUser($user);
        return redirect(route('addcustomerIndex'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title="edit commercial";

        $customer= Customer::findOrFail($id);
        return view('Customers/edit_customer', ['title'=>$title])->withCustomer($customer);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer=Customer::findOrFail($id);
        $input=$request->all();
        $customer->fill($input)->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listcustomers() {
        $title = "List des clients";

        $customers = Customer::GetCustomerAsUser(Controller::User()->id)->get();

        return view('Customers/list-customers', ['title' => $title, 'customers' => $customers]);
    }

    public function affiche($id)
    {
        $idCategries = array();

        if (isset($id) && !empty($id)) {
            $customer = Customer::findOrFail($id);

            $title = "Affich Client";
            return view('Customers/customer-details', ['customer' => $customer, 'title' => $title]);
        }
    }
}
