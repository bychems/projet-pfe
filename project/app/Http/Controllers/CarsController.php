<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Manifest;
use App\Modele;
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
        $tab_model = array();
        $categories = Category::all();
        $title = "Ajout voiture";
        $options = Option::all();
        foreach ($options as $o) {
            $opp[$o->category_id][$o->id] = $o->name;
        }
        $models = Modele::all();
        foreach ($models as $m) {
            $tab_model[$m->id]= $m->name;
        }


        return view('Cars/addCars', ['title' => $title, 'categories' => $categories, 'opp' => $opp,'tab_model' => $tab_model]);
    }


    public function UpdateManfiest($version, $files){
        $monfichier = fopen(base_path('offline.manifest'), 'r+');
        $arrayFile = file(base_path('offline.manifest'));
       // dd($arrayFile);


        $l=0;
        //liste des images dans le dossier uploads

        $new_file = implode("\r\n",$files);

        while ($l<30){
            $buffer = fgets($monfichier);
            $assets[$l]  = $buffer;
            $l++;
        }
        unset( $assets[0],  $assets[1]);

        //old content in manifest
        //array_diff($arrayFile,["\r\n"]); a - b
        //$old = implode("", $arrayFile);

        $old = implode("", $assets);

        file_put_contents(base_path('offline.manifest'), 'CACHE MANIFEST'."\r\n".'#Version '.$version."\r\n" .$old."\r\n".$new_file);

        fclose($monfichier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request,$imgs, $finition_icone) {
        if (isset($request->model)) {
            $id_model=$request->model;
        }else {
            $new_model= new Modele();
            $new_model->name=$request->new_model_name;
            $new_model->save();
            $id_model= $new_model->id;
        }
        $car = new Car();

        $car->description = $request->description;
        $car->finition = $request->finition;
        $car->icon_finition = $finition_icone;
        $car->consommation = $request->consommation;
        $car->picture = $imgs;
        $car->video = $request->video;
        $car->basic_price = $request->basic_price;
        $car->test_drive = $request->test_drive;
        $car->modele_id = $id_model;
        $car->save();
        return $car;
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
                'video'=>'required',
                'basic_price'=>'required|numeric']);
        if ($validator->fails()) {
            //$messages = $validator->messages();
            return redirect(route('carIndex'))->withErrors($validator->errors());
        }
        else {


            if (Input::hasFile('picture')) {
                $imges = Input::file('picture');
                $imgs=json_encode($this->getNewImg($imges));
                }

            if (Input::hasFile('icon_finition')) {
                //dd('yes');

                $rep=base_path('uploads');
                $images = Input::file('icon_finition');

                $d = new DateTime('NOW');
                $time = $d->format('Y-m-d_H-i-s');
                Storage::put($images->getClientOriginalName(), file_get_contents($images));
                $ex = $images->getClientOriginalExtension();
                $filename = $time . '.' . $ex;
                $images->move($rep, $filename);
            }

            $newCar=$this->create($request,$imgs,$filename);
            //Get last version of manifest
            $manifest=Manifest::GetVersions()->first();
            $vers=$manifest->version;

            //version ++
            $vers++;
            $img_uploads=Controller::getImages('uploads');
            $this->UpdateManfiest($vers,$img_uploads);
            Manifest::where('id',1)->update(['version'=>$vers]) ;

            $IdCar =$newCar->id;
            //--GET OPTIONS LIST
            $ch = $request->tab_option;
            $options = explode('-', $ch);

            //--ADD TO PRICE TABLE
            foreach ($options as $option) {
                if ($option != '0' && is_numeric(intval($option))) {
                    $v = intval($option);
                    $new_price = 'price-' . $option;
                    if (isset($request->$new_price)) {
                        $optionCar= new OptionCar();
                        $optionCar->car_id=$IdCar;
                        $optionCar->option_id=$v;
                        $optionCar->option_price=$request->$new_price;
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
        $title = "voiture";

        $all_options = Option::all();
        foreach ($all_options as $o) {
            $opp[$o->category_id][$o->id] = $o->name;
        }

        // dd($opp);
        $listAllcategories=  $this->all_Category();
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

               // $listAllcategories=  $this->all_Category();

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


                return view('Cars/updateCar', ['categories'=>$listcategories,'title'=>$title,'car'=>$car,'listAllcategories'=>$listAllcategories] );

            }
            else{
                return view('Cars/updateCar', ['categories'=>null,'car'=>$car,'title'=>$title,'listAllcategories'=>$listAllcategories] );
            }
        }

    }

    public function all_Category()
    {   
        $listAllcategories=array();
        $all_options = Option::all();
        $all_categories = Category::all();
        foreach ($all_categories as $category) {
            foreach ($all_options as $opt) {
                if($opt['category_id'] == $category['id']){
                    $listAllcategories[$category->id]['name']=$category->name_category;
                    $listAllcategories[$category->id]['options'][$opt->id]['name'] = $opt->name;
                    $listAllcategories[$category->id]['options'][$opt->id]['description'] = $opt->description;
                }
            }
        }
        return $listAllcategories;
    }


    public function update(Request $request, $id) {
        //

        $car= Car::find($id);
        $imgs=$car->picture;
        $icone=$car->icon_finition;
        if (Input::hasFile('picture')) { 
            $tab=  json_decode($imgs);
            foreach ($tab as $t)
            {
                unlink(base_path("uploads/".$t));
            }
            $images = Input::file('picture');
            $imgs=json_encode($this->getNewImg($images));
            $this->updateManifest(); 
        }
         if (Input::hasFile('icon_finition')) {
         
            unlink(base_path("uploads/".$icone));
            $images = Input::file('icon_finition');
            $imgs=json_encode($this->getNewImg($images));
            $this->updateManifest(); 
        }
        
        Car::where('id',$id)->update([
            'finition'=>$request->finition,
            'icon_finition'=>$icone,
            'description'=>$request->description,
            'consommation'=>$request->consommation,
            'picture'=>$imgs,
            'video'=>$request->video,
            'basic_price'=>$request->basic_price,
            'test_drive'=>$request->test_drive]) ;
        $tab_new_options = $request->tab_option;
        $tab_old_options = $request->tab_old_option;
        if(!empty($tab_new_options)){
            $options = explode('-', $tab_new_options);
            //--ADD TO PRICE TABLE
            foreach ($options as $option) {
                if ($option != '0' && is_numeric(intval($option))) {
                    $v = intval($option);
                    $new_price = 'price-' . $option;
                    if(isset($request->$new_price)){
                        DB::insert('insert into option_cars (car_id,option_id,option_price) values (?,?,?)', [$id, $v, $request->$new_price]);
                    }
                }
            }
        }
        if(!empty($tab_old_options)){
            $options = explode('-', $tab_old_options);
            //--ADD TO PRICE TABLE
            foreach ($options as $option) {
                if ($option != '0' && is_numeric(intval($option))) {
                    $v = intval($option);

                    $new_price = 'price-' . $option;

                    if(isset($request->$new_price)){
                        OptionCar::where('car_id',$id)->where('option_id',$option)
                            ->update(['option_price'=>$request->$new_price]) ;
                    }
                }
            }
        }

        return redirect(route('carEdit',$id));
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
                $prices_car[$price->option_id]['price']= $price->option_price;
                $prices_car[$price->option_id]['id']=$price->id;
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
                        $listcategories[$cat->id]['options'][$option->id]['price'] = $prices_car[$option->id]['price'];
                        $listcategories[$cat->id]['options'][$option->id]['id'] = $prices_car[$option->id]['id'];

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

    public function getNewImg($images)
    { $i=0;
        $imgs = array();
        $rep=base_path('uploads');
        foreach ($images as $image) {

            ++$i;
            $d = new DateTime('NOW');
            $time = $d->format('Y-m-d_H-i-s') . $i;
            Storage::put($image->getClientOriginalName(), file_get_contents($image));
            $ex = $image->getClientOriginalExtension();
            $filename = $time . '.' . $ex;
            $image->move($rep, $filename);
            $imgs[$i - 1] = $filename;
        }
        return $imgs;
    }

    public function destroy($id){
        $car = Car::find($id);
        $car->delete();
        return redirect(route('carList'));
    }
    
    public function updateManifest()
    {
            //Get last version of manifest
            $manifest=Manifest::GetVersions()->first();
            $vers=$manifest->version;

            //version ++
            $vers++;
            $img_uploads=Controller::getImages('uploads');
            $this->UpdateManfiest($vers,$img_uploads);
            Manifest::where('id',1)->update(['version'=>$vers]) ;
    }
    
    public function getFinition($id)
    {   
        $list_car=array();
        $cars=array();
        $model=Modele::findOrFail($id);
        
        $list_car=$model->cars()->get();
       
        foreach ($list_car as $car)
        {
          $cars[$car->id]=$car->finition;
        }
        
        return json_encode($cars);
    }

}
