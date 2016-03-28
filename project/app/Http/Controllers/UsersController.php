<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='Ajout utilisateur';
        $roles = array();
        $role = Role::all();

        foreach ($role as $r) {
            $roles[$r->id] = $r->name;
        }
        return view('Users.registerUser',['title'=>$title,'roles'=>$roles]);
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

        $pass=bcrypt($request->password);
        $user= new User();
        $user->name=$request->nom_prenom;
        $user->email=$request->email;
        $user->password=$pass;

        $user->save();
        DB::insert('insert into role_user (user_id,role_id) values (?,?)', [$user->id, $request->role]);

        return redirect()->back();
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
        $pass=bcrypt($request->password);
        //dd($pass);
        $user=User::findOrFail($id);
        if($request->password==$request->confirm_password){

        $user->fill(['password'=>$pass, 'phone'=>$request->phone])->save();
        return redirect()->back();

        }
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

    public function detailUser($id)
    {

        $title='detail User';

        $role = Role::whereHas('users', function($q) use ($id) {
                $q->where('id', $id);
        })->get();

        $user  = User::GetUser($id)->get();

        //dd($role[0]->name);

        //dd($user[0]);
        return view('Users.detail_user',['title'=>$title,'role_name'=>$role[0]->name,'user'=>$user[0]]);
    }

    public function profil()
    {
        $title='Profil';
        $nom_prenom=Controller::User()->name;
        $email=Controller::User()->email;
        $phone=Controller::User()->phone;
        return view('Users.profil',['title'=>$title,'nom_prenom'=>$nom_prenom,'email'=>$email,'phone'=>$phone]);
    }
}
