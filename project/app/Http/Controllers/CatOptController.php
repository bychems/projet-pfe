<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatOptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all() ;
        foreach($categories as $categories){
            $names[]= $categories->id;
        }
        $title="Ajout categorie option";
        return view('add_option_category',['title'=> $title,'categories'=>$categories,'options'=>$names]);
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
        dd($request);
        Category::create($request->only(['name_category'=>'nom_cat']));
        Option::create($request->only(['name_option'=>'nom_option','description_option'=>'desc_option','id_category'=>1]));
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

    public function addOpCat(Request $request)
    {


        $n=  intval($request->nb_option);

        for($i=0;$i<$n;$i++)
        {
            $name = "name-option-".$i;
            $desc = "description-option-".$i;
            $option = new Option();
            $option->name = $request->$name;
            $option->description = $request->$desc;
            $option->category_id = $request->category_id;
            $option->save();

        }

        //$option->attachCategory($request->category_id);
    }
}
