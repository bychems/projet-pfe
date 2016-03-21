<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;

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
       //dd($request);
       /*if(Input::hasFile('picture'))
       {    
           
           $images=Input::file('picture');
           foreach($images as $image){
               Storage::put($image->getClientOriginalName(), file_get_contents($image) );
               $image->move('..\public\uploads',$image->getClientOriginalName());
                
                $filename  = time() . '.' . $image->getClientOriginalExtension();

                $path = public_path('profilepics/' . $filename);

                Image::make($image->getRealPath())->resize(200, 200)->save($path);
                $user->image = $filename;
                $user->save();
           }
           
           dd($images);
       }
       else
       {
           dd(":(");
       }*/
       // $ch = $request->tab_option;
       // $options = explode('-', $ch);
        
        $createCar=Car::create($request->only([
                'model'=>'model',
                'picture'=>  json_encode($request->file('picture')),
                'video' => 'video',
                'basic_price'=>'basic_price',
                'test_drive'=>'test_drive'
                ]));
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
                if(isset($request->$new_price)){
                    DB::insert('insert into option_cars (car_id,option_id,option_price) values (?,?,?)', [$IdCar, $v, $request->$new_price]);
                }
            }
        }
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
                return view('Cars/car-details', ['categories'=>$listcategories,'title'=>$title,'car'=>$car] );

        }
            else{
                return view('Cars/car-details', ['categories'=>null,'car'=>$car,'title'=>$title] );
            }
        }

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
