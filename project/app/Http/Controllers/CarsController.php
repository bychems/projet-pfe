<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Quotation;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Storage;
use Image;

use App\Category;
use App\Car;
use App\Option;
use App\OptionCar;
use Illuminate\Support\Facades\Input;


class CarsController extends Controller {
    
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $opp = array();
        $categories = Category::all();
        $title = "Ajout voiture";
        $options = Option::all();
        foreach ($options as $o) {
            $opp[$o->category_id][$o->id] = $o->name;
        }
        return view('Cars/addCars', ['title' => $title, 'categories' => $categories, 'opp' => $opp]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //--ADD CAR INFOS
        $validator = Validator::make($request->all(),
            [
                'model'=>'required',
                'video'=>'required',
                'basic_price'=>'required|numeric']);
        if ($validator->fails()) {
            //$messages = $validator->messages();
            return redirect(route('carIndex'))->withErrors($validator->errors());
        }

        else {

            if (Input::hasFile('picture')) {
                $i = 0;
                $images = Input::file('picture');
                $imgs = array();
                foreach ($images as $image) {

                    ++$i;
                    $d = new DateTime('NOW');
                    $time = $d->format('Y-m-d_H-i-s') . $i;
                    Storage::put($image->getClientOriginalName(), file_get_contents($image));
                    $ex = $image->getClientOriginalExtension();
                    $filename = $time . '.' . $ex;
                    $image->move('C:\xamppp\htdocs\projet-laravel\project\uploads', $filename);
                    //$path = public_path('profilepics/' . $filename);
                    //Image::make($image->getRealPath())->resize(200, 200)->save($path);
                    $imgs[$i - 1] = $filename;

                }
            }
            $imgs = json_encode($imgs);


            $createCar = new Car();
            $createCar->model = $request->model;
            $createCar->picture = $imgs;
            $createCar->video = $request->video;
            $createCar->basic_price = $request->basic_price;
            $createCar->test_drive = $request->test_drive;
            $createCar->save();

            //$createCar->optionCar()->attach($options);
            $IdCar = $createCar->id;
            //dd($IdCar);
            //--GET OPTIONS LIST
            $ch = $request->tab_option;

            $options = explode('-', $ch);

            //--ADD TO PRICE TABLE
            foreach ($options as $option) {
                if ($option != '0' && is_numeric(intval($option))) {
                    $v = intval($option);
                    $new_price = 'price-' . $option;
                    if (isset($request->$new_price)) {
                        DB::insert('insert into option_cars (car_id,option_id,option_price) values (?,?,?)', [$IdCar, $v, $request->$new_price]);
                    }
                }
            }

        }
        $title = "List des voitures";

        $cars = Car::all();
        return view('Cars/list-cars', ['title' => $title, 'cars' => $cars]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
       //
    }
    
    /**
     * Display list cars.
     *
     */
    public function listcars() {
        $title = "List des voitures";
        
        $cars = Car::all();
        
        return view('Cars/list-cars', ['title' => $title, 'cars' => $cars]);
    }

    public function listcarstestdrive() {
        $title = "List des voitures";

        $cars = Car::ListCarsTestDrive()->get();

        return view('Cars/list-cars-test-drive', ['title' => $title, 'cars' => $cars]);
    }
    
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }
    

    public function affiche($id){
        $title = "voiture";
        $options = $idCategries = array();
        $customers = array();
        $customer = Customer::all();

        foreach ($customer as $c) {
            $customers[$c->id] = $c->name.' '.$c->last_name ;
        }

        if(isset($id) && !empty($id)){
            $car = Car::findOrFail($id);


            $options = current($car->optioncars()->lists('option_id'));

            if(!empty($options)){

            $ids = implode(",", $options); //option ID's

            $prices = OptionCar::whereRaw('option_id  in ('. $ids .' ) and car_id='. $id .' order by option_id' )->get();

            foreach ($prices as $price){
                $prices_car[$price->option_id]= $price->option_price;
            };

            $optionsList = Option::whereRaw('id  in ('. $ids .' ) order by id' )->get();

            foreach($optionsList as $option){
                $el  = $option->category_id;
                if(!in_array($el, $idCategries)){//if not exist in array
                    array_push( $idCategries, $el);
                }
            }
            $idCategries = implode (",", $idCategries);

            $categories = Category::whereRaw('id  in ('. $idCategries .')' )->get();

            foreach($categories as $cat){
                foreach($optionsList as $option){
                    if($option['category_id'] == $cat['id']){
                        $listcategories[$cat->id]['name']=$cat->name_category;
                        $listcategories[$cat->id]['options'][$option->id]['name'] = $option->name;
                        $listcategories[$cat->id]['options'][$option->id]['description'] = $option->description;
                        $listcategories[$cat->id]['options'][$option->id]['price'] = $prices_car[$option->id];

                    }
                }
            }
                return view('Cars/car-details', ['categories'=>$listcategories,'title'=>$title,'car'=>$car,'customers'=>$customers] );

        }
            else{
                return view('Cars/car-details', ['categories'=>null,'car'=>$car,'title'=>$title] );
            }
        }

    }

    public function storeDevis(Request $request,$id_car) {

        //$prix_options=$request->prix_total_option;
        $options = json_decode($request->list_option);
        $customer = Customer::GetCustomer($request->customers)->get();

        $mail_customer=$customer[0]->mail;

        $quotation= new Quotation();
        $quotation->options=$request->list_option;
        $quotation->total_price=$request->prix_total_voiture;
        $quotation->id_car=$id_car;
        $quotation->id_customer=$request->customers;
        $quotation->save();

        Mail::send('Mail.mail_devis',['model'=>$request->model, 'basic_price'=>$request->basic_price, 'tva'=>$request->tva,
                                        'frais_imm'=>$request->frais_imm,'tme'=>$request->tme,
                                        'frais_timbre'=>$request->frais_timbre, 'prix_tot'=>$request->prix_total_voiture,
                                        'options'=>$options,'prix_options'=>$request->prix_options,'name'=>$customer[0]->name,
                                        'last_name'=>$customer[0]->last_name],function($message) use ( $mail_customer)
        {
           $message->to($mail_customer)->cc('byoussefchems@gmail.com')->subject('Devis Audis');
        }
        );



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
            'name'=>$customer[0]->name,
            'last_name'=>$customer[0]->last_name] );
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

}
