<?php

namespace App\Http\Controllers;

use App\Car;
use App\Category;
use App\Modele;
use App\Option;
use App\OptionCar;
use App\Permission;
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
            $roles[$r->id] = $r->display_name;
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




    public function rolePermissionIndex()
    {
        $title='Role-Permission';

        $roles = array();
        $role = Role::all();
        foreach ($role as $r) {
            $roles[$r->id] = $r->display_name;
        }

       // $permissions = array();
        $permissions = Permission::all();
       /* foreach ($permission as $p) {
            $permissions[$p->id] = $p->name;
        }*/
        return view('Users.role_permission',['title'=>$title,'roles'=>$roles,'permissions'=>$permissions]);
    }


    public function rolePermissionStore(Request $request)
    {

        $role_id=$request->roles;
        $permissions=$request->chk_permission;
        $role=Role::find($role_id);
        $role->permissions()->detach();
        $role->permissions()->attach($permissions);
        return redirect()->back();
    }

    public function roleStore(Request $request)
    {
        $rol=Role::getDisplayNameRole($request->role)->get();
        $name=str_replace(' ','',$request->role);
        if(!isset($rol[0])) {
            $role=new Role();
            $role->name=$name;
            $role->display_name=$request->role;
            $role->description=$request->role;
            $role->save();
            return redirect()->back();
        }else{
            dd('existe');
        }
    }

    public function permissionStore(Request $request)
    {
        $perm=Permission::getDisplayNamePermission($request->permission)->get();
        $name=str_replace(' ','',$request->permission);
        if(!isset($perm[0])) {
            $permission=new Permission();
            $permission->name=$name;
            $permission->display_name=$request->permission;
            $permission->description=$request->permission;
            $permission->save();
            return redirect()->back();
        }else{
            dd('existe');
        }

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

    public function parametres()
    {
        $title='Para&eacute;tres g&eacute;n&eacute;raux du compte';
        $nom_prenom=Controller::User()->name;
        $email=Controller::User()->email;
        $phone=Controller::User()->phone;
        return view('Users.parametres',['title'=>$title,'nom_prenom'=>$nom_prenom,'email'=>$email,'phone'=>$phone]);
    }

    public function getRolePermission($id_role){

        $role=Role::find($id_role);

        $rolePermission=$role->permissions()->lists('id');
        return json_encode($rolePermission);

            /*foreach($rolePermission as $rolePerm){
                return $rolePerm;

                /*
                if($rolePerm==$id_permission){
                    return 'true';
                }else{
                    return 'false';
                }

            }*/

        //return $rolePermission[0]->pivot->permission_id;
    }

    public function homepageIndex()
    {
        $title='Accueil';
       // $cars=array();
        $modele=Modele::all();

       /* dd($car);
        foreach ($car as $c) {
            $cars[$c->id] = $c->model;

        }
*/

        return view('Front.homepage',['title'=>$title,'modele'=>$modele]);
    }

    public function getCategoriesFront($id_car){

        //$car=Car::where('id',$id_car)->get();
        $idCategries = array();
        $car = Car::findOrFail($id_car);


        $options = current($car->optioncars()->lists('option_id'));

        if(!empty($options)){

            $ids = implode(",", $options); //option ID's

            $prices = OptionCar::whereRaw('option_id  in ('. $ids .' ) and car_id='. $id_car .' order by option_id' )->get();

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
                        $listcategories[$cat->id]['icone']=$cat->icon;
                        $listcategories[$cat->id]['options'][$option->id]['name'] = $option->name;
                        $listcategories[$cat->id]['options'][$option->id]['description'] = $option->description;
                        $listcategories[$cat->id]['options'][$option->id]['price'] = $prices_car[$option->id]['price'];
                        $listcategories[$cat->id]['options'][$option->id]['id'] = $prices_car[$option->id]['id'];

                    }
                }
            }
            return $listcategories;
    }}


    public function frontIndex()
    {
        $title='Audi front';
        // $cars=array();
        $modele=Modele::all();

        /* dd($car);
         foreach ($car as $c) {
             $cars[$c->id] = $c->model;

         }
 */

        return view('Front.front',['title'=>$title,'modele'=>$modele]);
    }

    public function list_users()
    {
        $title='Liste des utilisateurs';
        $users=User::all();
        return view('Users.list-users',['title'=>$title,'users'=>$users]);
    }


}
