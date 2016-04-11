<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Option;
use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Creer Devis";
        $opp = array();

        $categories = Category::all();
        $options = Option::all();

        foreach ($options as $o) {
            $opp[$o->category_id][$o->id] = $o->name;
        }

        return view('Quotations/quotation', ['title' => $title, 'categories' => $categories, 'opp' => $opp]);
    }

    public function storeDevis(Request $request) {
        //dd($request);
        //$prix_options=$request->prix_total_option;
        $options = json_decode($request->list_option);
        if($request->chk_new_customer=='1'){

            $customer=$this->addcustomerfirst($request->name,$request->last_name,$request->cin,$request->mail,$request->adress,$request->function,$request->phone,$request->car);
            $mail_customer=$request->mail;
            $quotation= new Quotation();
            $quotation->options=$request->list_option;
            $quotation->total_price=$request->prix_total_voiture;
            $quotation->id_car=$request->id_car;
            $quotation->id_customer=$customer->id;
            $res = $quotation->save();




        }else{


            //dd($options);
            $customers = Customer::GetCustomer($request->id_customers)->get();
            $customer = $customers[0];
            $mail_customer=$customer->mail;

            //dd($request->list_option);
            $quotation= new Quotation();
            $quotation->options=$request->list_option;
            $quotation->total_price=$request->prix_total_voiture;
            $quotation->id_car=$request->id_car;
            $quotation->id_customer=$request->id_customers;
            $res = $quotation->save();
        }

        $this->SendMail($request->model,$request->basic_price,$request->tva,$request->frais_imm,$request->tme,$request->frais_timbre,$request->prix_total_voiture,$options,$request->prix_options, $customer->name, $customer->last_name, $customer->mail);

        /* Mail::send('Mail.mail_devis',['model'=>$request->model, 'basic_price'=>$request->basic_price, 'tva'=>$request->tva,
                                         'frais_imm'=>$request->frais_imm,'tme'=>$request->tme,
                                         'frais_timbre'=>$request->frais_timbre, 'prix_tot'=>$request->prix_total_voiture,
                                         'options'=>$options,'prix_options'=>$request->prix_options,'name'=>$customer->name,
                                         'last_name'=>$customer->last_name],function($message) use ( $mail_customer)
         {
            $message->to($mail_customer)->cc('byoussefchems@gmail.com')->subject('Devis Audis');
         }
         );
 */


        return view('Mail/mail_devis',[
            'model'=>$request->model,
            'basic_price'=>$request->basic_price,
            'tva'=>$request->tva,
            'frais_imm'=>$request->frais_imm,
            'tme'=>$request->tme,
            'frais_timbre'=>$request->frais_timbre,
            'prix_tot'=>$request->prix_total_voiture,
            'options'=>$options,
            'prix_options'=>$request->prix_options,
            'name'=>$customer->name,
            'last_name'=>$customer->last_name] );




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $car = Car::find($id);
        $car->delete();
        return redirect(route('carList'));
    }

    public function addcustomerfirst($name,$last_name,$cin, $mail,$adress, $function,$phone, $car) {

        $customer= new Customer();
        $customer->name=$name;
        $customer->last_name=$last_name;
        $customer->cin=$cin;
        $customer->mail=$mail;
        $customer->adress=$adress;
        $customer->function=$function;
        $customer->phone=$phone;
        $customer->car=$car;
        $customer->commercial_id=  Controller::User()->id;

        $customer->save();
        return $customer;
    }

    public function OfflineQuotationIndex() {
        $title="Nouveaux devis";

        return view('Offline/quotation_offline', ['title'=>$title]);
    }

    public function storeQuotationOffline(Request $request) {

        if(isset($request->hidden_quotation)) {

            $quot = json_decode($request->hidden_quotation, false);

            $options = json_encode($quot->list_option);

            $customers = Customer::GetCustomer($quot->id_customers)->get();
            $customer = $customers[0];
            $mail_customer = $customer->mail;

            //dd($request->list_option);

            $quotation = new Quotation();
            $quotation->options = $options;
            $quotation->total_price = $quot->prix_total_voiture;
            $quotation->id_car = $quot->id_car;
            $quotation->id_customer = $quot->id_customers;
            $res = $quotation->save();

            $this->SendMail($quot->car_model,$quot->basic_price,$quot->tva,$quot->frais_imm,$quot->tme,$quot->frais_timbre,$quot->prix_total_voiture,$quot->list_option,$quot->prix_options, $customer->name, $customer->last_name, $customer->mail);
            return 'Devis ajouté';
        }
        else{

            $quot = json_decode($request->hidden_quotation_customer, false);

            $customer=$this->addcustomerfirst($quot->clients->name,$quot->clients->last_name,$quot->clients->cin,$quot->clients->mail,$quot->clients->adress,$quot->clients->function,$quot->clients->phone,$quot->clients->car);

            $quotation= new Quotation();
            $quotation->options=json_encode($quot->devis->list_option);
            $quotation->total_price=$quot->devis->prix_total_voiture;
            $quotation->id_car=$quot->devis->id_car;
            $quotation->id_customer=$customer->id;

            $res = $quotation->save();

            $this->SendMail($quot->devis->car_model,$quot->devis->basic_price,$quot->devis->tva,$quot->devis->frais_imm,$quot->devis->tme,$quot->devis->frais_timbre,$quot->devis->prix_total_voiture,$quot->devis->list_option,$quot->devis->prix_options, $quot->clients->name, $quot->clients->last_name, $quot->clients->mail);
            return 'Devis et client ajouté';
        }
    }



    public function SendMail($model,$basic_price,$tva,$frais_imm,$tme,$frais_timbre,$prix_total_voiture,$list_option,$prix_options,$name,$last_name,$mail) {

        Mail::send('Mail.mail_devis',['model'=>$model, 'basic_price'=>$basic_price, 'tva'=>$tva,
            'frais_imm'=>$frais_imm,'tme'=>$tme,
            'frais_timbre'=>$frais_timbre, 'prix_tot'=>$prix_total_voiture,
            'options'=>$list_option,'prix_options'=>$prix_options,'name'=>$name,
            'last_name'=>$last_name],function($message) use ($mail)
        {
            $message->to($mail)->cc('byoussefchems@gmail.com')->subject('Devis Audi');
        }
        );
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
