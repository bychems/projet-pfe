<?php

namespace App\Http\Controllers;

use App\Category;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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

        $categories = Category::all();
        $title = "Categories-Option";
        $options = Option::all();
        foreach ($options as $o) {
            $opp[$o->category_id][$o->id]['nom'] = $o->name_option;
            $opp[$o->category_id][$o->id]['desc'] = $o->description_option;
            $opp[$o->category_id][$o->id]['id'] = $o->category_id;

        }

        return view('add_option_category', ['title' => $title, 'categories' => $categories, 'opp' => $opp]);
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
        //--ADD NEW CATEGORY
        $createCategory=Category::create($request->only(['name_category'=>'name_category']));

        //--GET ID CATEGORY ADDED
        $lastCatId = $createCategory->id;
        //dd($request);

        $nb_op=intval($request->tab_option);

        for($i=0;$i<$nb_op;$i++){
            $x='name-option-'.$i;
            $y='description-option-'.$i;
            $option=new Option();
            $option->name_option=$request->$x;
            $option->description_option=$request->$y;
            $option->category_id=$lastCatId;
            $option->save();
        }

        return redirect('categories');
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
    public function destroy($id)
    {
        //
    }

    public function addOptionInCategory(){

    }
}
