<?php

namespace App\Http\Controllers;

use App\Car;
use App\Option;
use App\Category;
use App\OptionCar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Storage;
use Image;



class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $names =  array();
        $options=Option::all();
        foreach($options as $option){
            $names[$option->category_id][$option->id]= $option->name_option;
        }
        //dd($names);


        $categories=Category::all() ;
        $title="Ajout voiture";
        return view('add_cars',['title'=> $title,'categories'=>$categories,'options'=>$names]);
    }

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
       /* if(Input::hasFile('picture'))
        {
            $image=Input::file('picture');
            $image->move('..\public\uploads',$image->getClientOriginalName());
            dd($image->getClientOriginalName());
        }
        else
        {
            dd("!!");
        }
*/

        //--ADD NEW CAR
        $createCar=Car::create($request->only(['model'=>'model','picture'=>'picture','video'=>'video','basic_price'=>'basic_price','test_drive'=>'test_drive']));

        //--File


        //--GET ID CAR ADDED
        $lastCarId = $createCar->id;

        //--GET OPTIONS LIST
        $ch = $request->tab_option;

        $options = explode('-', $ch);
        //dd($ch);
        //--ADD TO PRICE TABLE
        foreach ($options as $option) {
            if ($option != '0' && is_numeric(intval($option))) {
                $v = intval($option);
                $new_price = 'price-' . $option;
                if(isset($request->$new_price)){
                    DB::insert('insert into option_cars (car_id,option_id,option_price) values (?,?,?)', [$lastCarId, $v, $request->$new_price]);
                }
            }
        }

       return redirect(route('listCars'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $title = "voiture";

        $categories = array();

        if(isset($id) && !empty($id)){
            $car = Car::findOrFail($id);

            //--GET IDS OPTIONS FROM 'OPTION CARS TABLE'
            $option_ids = OptionCar::where('car_id', $car->id)->get();
            //dd($option_ids);

            //--GET CAR OPTIONS (NAME - DESC - ID CATEGORY)

            if(!empty($option_ids)){
                foreach ($option_ids as $id){
                    $options[$id['option_id']] = Option::findOrFail($id['option_id']);
                }
            }


            if(!empty($options[$id['option_id']])){
                //--GET LIST CATEGORIES NAME
                foreach($options as $option){

                    $categories[$option['category_id']]['name'] = Category::findOrFail($option['category_id']);
                    $categories[$option['category_id']][$option['id']]['options-name'] = $option['name'];
                    $categories[$option['category_id']][$option['id']]['price'] =$option_ids[$id['option_id']]['option_price'];

                }
            }
            //dd($categories);
            return view('car-details',[
                'title' => $title,
                'car' => $car,
                'categories'=>$categories,
                'options'=>$options,
                'prices'=>$option_ids,

            ]);
        }
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
    public function destroy($id)
    {
        //
    }


    /**
     * Display list cars.
     *
     */
    public function listcars() {
        $title = "List des voitures";

        $cars = Car::all();

        return view('list-cars', ['title' => $title, 'cars' => $cars]);
    }

    public function affiche($id){
        $title = "voiture";
        $options = $idCategries = array();

        if(isset($id) && !empty($id)){
            $car = Car::findOrFail($id);
            $options = current($car->optioncars()->lists('option_id'));

            $ids = implode(",", $options);

            $optionsList = Option::whereRaw('id  in ('. $ids .' ) order by category_id' )->get();

            foreach($optionsList as $option){
                $el  = $option->category_id;

                if(!in_array($el, $idCategries)){
                    array_push( $idCategries, $el);
                }
            }
            $idCategries = implode (",", $idCategries);


            $categories = Category::whereRaw('id  in ('. $idCategries .')' )->get();
            foreach($categories as $cat){
                foreach($optionsList as $option){
                    if($option['category_id'] == $cat['id']){
                        $listcategories[$cat->id]['name']=$cat->name_category;
                        $listcategories[$cat->id]['options'][$option->id] = $option;
                    }
                }
            }
            //dd($listcategories);
            $title="Affich voiture";
            return view('car-details', ['optionsList'=>$optionsList, 'categories'=>$listcategories,'title'=> $title] );

           // return view('car-details', ['optionsList'=>$optionsList, 'categories'=>$listcategories, 'title'=> $title,'car'=>$car] );
        }

    }
}
