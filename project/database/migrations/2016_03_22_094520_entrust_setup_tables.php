<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        \App\Role::create(['name'=>'Commercial','display_name'=>'Commercial','description'=>'Commercial']);
        \App\Role::create(['name'=>'DirecteurCommercial','display_name'=>' Directeur Commercial','description'=>' Directeur Commercial']);
        \App\Role::create(['name'=>'CommercialParking','display_name'=>'Commercial Parking','description'=>'Commercial Parking']);
        \App\Role::create(['name'=>'SuperAdmin','display_name'=>'Super Admin','description'=>'Super Admin']);

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });


        //------------- Permission CARS --------------------//
        \App\Permission::create(['name'=>'carIndex','display_name'=>'Index nouvelle voiture','description'=>'carIndex']);
        \App\Permission::create(['name'=>'carStore','display_name'=>'Ajout voiture','description'=>'carStore']);
        \App\Permission::create(['name'=>'carEdit','display_name'=>'Modif. voiture','description'=>'carEdit']);
        \App\Permission::create(['name'=>'carList','display_name'=>'Liste voitures','description'=>'carList']);
        \App\Permission::create(['name'=>'carListTestDrive','display_name'=>'Liste voiture test-drive','description'=>'carListTestDrive']);
        \App\Permission::create(['name'=>'carDelete','display_name'=>'Supp. voiture','description'=>'carDelete']);
        \App\Permission::create(['name'=>'carAffiche','display_name'=>'D&eacute;tail voiture','description'=>'carAffiche']);
        \App\Permission::create(['name'=>'devisStore','display_name'=>'Ajout devis','description'=>'devisStore']);
        \App\Permission::create(['name'=>'OfflineQuotationIndex','display_name'=>'Liste demandes devis','description'=>'OfflineQuotationIndex']);
        \App\Permission::create(['name'=>'addQuotationOffline','display_name'=>'Ajout demande devis','description'=>'addQuotationOffline']);

        //------------- Permission CATEGORIES --------------------//
        \App\Permission::create(['name'=>'categoryIndex','display_name'=>'Index cat&eacute;gorie','description'=>'categoryIndex']);
        \App\Permission::create(['name'=>'categoryStore','display_name'=>'Ajout cat&eacute;gorie','description'=>'categoryStore']);
        \App\Permission::create(['name'=>'addoption','display_name'=>'Ajout option','description'=>'addoption']);
        \App\Permission::create(['name'=>'destroyCat','display_name'=>'Supp. cat&eacute;gorie','description'=>'destroyCat']);
        \App\Permission::create(['name'=>'destroyOpt','display_name'=>'Supp. option','description'=>'destroyOpt']);


        //------------- Permission TEST DRIVE --------------------//
        \App\Permission::create(['name'=>'testDriveIndex','display_name'=>'Index disponibilit&eacute; test-drive','description'=>'testDriveIndex']);
        \App\Permission::create(['name'=>'adddisp','display_name'=>'Ajout disponibilit&eacute; test-drive','description'=>'adddisp']);
        \App\Permission::create(['name'=>'Calendar','display_name'=>'Affichage calendrier','description'=>'Calendar']);
        \App\Permission::create(['name'=>'hours','display_name'=>'Affichage heures calendrier','description'=>'hours']);
        \App\Permission::create(['name'=>'supp-day','display_name'=>'Supp. jour','description'=>'supp-day']);
        \App\Permission::create(['name'=>'add-hour','display_name'=>'Ajout heure','description'=>'add-hour']);
        \App\Permission::create(['name'=>'cancel-hour','display_name'=>'Annuler heure','description'=>'cancel-hour']);


        //------------- Permission CUSTOMERS --------------------//
        \App\Permission::create(['name'=>'addcustomerIndex','display_name'=>'Index nouveau client','description'=>'addcustomerIndex']);
        \App\Permission::create(['name'=>'addcustomer','display_name'=>'Ajout client','description'=>'addcustomer']);
        \App\Permission::create(['name'=>'listCustomers','display_name'=>'Liste clients','description'=>'listCustomers']);
        \App\Permission::create(['name'=>'afficheCustomer','display_name'=>'Info. client','description'=>'afficheCustomer']);
        \App\Permission::create(['name'=>'editcustomer','display_name'=>'Index modif. client','description'=>'editcustomer']);
        \App\Permission::create(['name'=>'updatecustomer','display_name'=>'Modif. client','description'=>'updatecustomer']);
        \App\Permission::create(['name'=>'OfflineCustomerIndex','display_name'=>'Index demandes client','description'=>'OfflineCustomerIndex']);
        \App\Permission::create(['name'=>'addcustomerOffline','display_name'=>'Ajout demandes client','description'=>'addcustomerOffline']);


        //------------- Permission USERS --------------------//
        \App\Permission::create(['name'=>'addUser','display_name'=>'Index ajout utilisateur','description'=>'addUser']);
        \App\Permission::create(['name'=>'storeUser','display_name'=>'Ajout utilisateur','description'=>'storeUser']);
        \App\Permission::create(['name'=>'profilUser','display_name'=>'Profil utilisateur','description'=>'profilUser']);
        \App\Permission::create(['name'=>'detailUser','display_name'=>'D&eacute;tail utilisateur','description'=>'detailUser']);
        \App\Permission::create(['name'=>'updateUser','display_name'=>'Modif. utilisateur','description'=>'updateUser']);
        \App\Permission::create(['name'=>'addRolePermission','display_name'=>'Index ajout permission','description'=>'addRolePermission']);
        \App\Permission::create(['name'=>'storeRolePermission','display_name'=>'Ajout permission role','description'=>'storeRolePermission']);
        \App\Permission::create(['name'=>'storePermission','display_name'=>'Ajout permission','description'=>'storeRolePermission']);
        \App\Permission::create(['name'=>'storeRole','display_name'=>'Ajout role','description'=>'storeRolePermission']);
        \App\Permission::create(['name'=>'parametresUtilisateur','display_name'=>'parametres Utilisateur','description'=>'parametres User']);
        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        //------------- Permission Role --------------------//
        DB::insert('insert into permission_role (role_id,permission_id) values (1,4)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,5)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,7)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,8)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,18)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,19)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,21)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,22)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,23)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,24)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,25)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,26)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,27)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,28)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,33)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,34)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,35)');
        DB::insert('insert into permission_role (role_id,permission_id) values (1,40)');

        DB::insert('insert into permission_role (role_id,permission_id) values (2,4)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,5)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,7)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,8)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,18)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,19)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,21)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,22)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,23)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,24)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,25)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,26)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,27)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,28)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,33)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,34)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,35)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,1)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,2)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,3)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,6)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,11)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,12)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,13)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,14)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,15)');
        DB::insert('insert into permission_role (role_id,permission_id) values (2,40)');



        DB::insert('insert into permission_role (role_id,permission_id) values (3,5)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,16)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,17)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,18)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,19)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,20)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,33)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,34)');
        DB::insert('insert into permission_role (role_id,permission_id) values (3,40)');

        DB::insert('insert into permission_role (role_id,permission_id) values (4,1)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,2)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,3)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,4)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,5)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,6)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,7)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,8)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,9)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,10)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,11)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,12)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,13)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,14)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,15)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,16)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,17)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,18)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,19)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,20)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,21)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,22)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,23)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,24)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,25)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,26)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,27)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,28)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,29)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,30)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,31)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,32)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,33)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,34)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,35)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,36)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,37)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,38)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,39)');
        DB::insert('insert into permission_role (role_id,permission_id) values (4,40)');


    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}