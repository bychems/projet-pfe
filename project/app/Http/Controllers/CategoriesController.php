<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Option;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $opp = array();
       
        $categories = Category::orderBy('id', 'DESC')->get();
        $title = "Catégories";
        $options = Option::all();
        foreach ($options as $o) {
            $opp[$o->category_id][$o->id] = $o;
        }
      
        return view('Categories/categories', ['title' => $title, 'categories' => $categories, 'opp' => $opp]);
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
        
         //   dd($request);

        $validator = Validator::make($request->all(),
            [
                'name_category'=>'required']);
        if ($validator->fails()) {
            //$messages = $validator->messages();
            return redirect(route('categoryIndex'))->withErrors($validator->errors());
        }

        else {
            $createCategorie = Category::create($request->only(['name_category']));
            $IdCategorie = $createCategorie->id;
            $nb_op = intval($request->tab_option);

            for ($i = 0; $i < $nb_op; $i++) {

                $x = 'name_option_' . $i;
                $y = 'description_option_' . $i;
                $option = new Option();
                $option->name = $request->$x;
                $option->description = $request->$y;
                $option->category_id = $IdCategorie;
                $option->save();
                // Option::create($request->only(['name'=>'name-option-'.$i, 'description'=>'description-option-'.$i]))->attach($IdCategorie);

            }
        }
        //dd($option);
        return redirect(route('categoryIndex'));
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
    
    public function addOpCat(Request $request)
    {


        $n=  intval($request->nb_option);

        for($i=0;$i<$n;$i++)
         {
            $name = "name_option_".$i;
            $desc = "description_option_".$i;
            $option = new Option();
            $option->name = $request->$name;
            $option->description = $request->$desc;
            $option->category_id = $request->category_id;
            $option->save();

         }

        //$option->attachCategory($request->category_id);
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
    public function destroyCat($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect(route('categoryIndex'));
    }

    public function destroyOpt($id)
    {
        $option = Option::find($id);
        $option->delete();
        return redirect(route('categoryIndex'));
    }
}
