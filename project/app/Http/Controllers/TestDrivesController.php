<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Car;
use DateTime;
use App\TestDriveDay;
use App\TestDriveHour;


class TestDrivesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //

        $cars = array();
        $car = Car::ListCarsTestDrive()->get();
        $title = "Ajout Disponibilité";
        foreach ($car as $c) {
            $cars[$c->id] = $c->model;
        }

        $date = \Carbon\Carbon::today();

        $date = $date->format('Y-m-d');
        return view('TestDrives/disponibility-test-drive', ['title' => $title, 'cars' => $cars, 'date' => $date]);
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

        $car=$request->cars;
        $d = $request->date_debut;
        $f = $request->date_fin;
        $datedebut = new DateTime($d);
        $datefin = new DateTime($f);
        $interval = $datedebut->diff($datefin);
        $dif = $interval->format('%a');
        for ($i = 0; $i <= $dif; $i++) {
            $day = date('l', strtotime($d));
            if ($day != 'Sunday') {

                //insertion de jour disponible
                $days= new TestDriveDay();
                $days->date=$datedebut;
                $days->car_id=$car;
                $days->save();
                $day_id=$days->id;

                //insertion de l'heure non disponible '13' de ce jour
                $hour=new TestDriveHour();
                $hour->hour=13;
                $hour->customer_id=2;
                $hour->day_id=$day_id;
                $hour->save();



            }
            $date = strtotime("+1 day", strtotime($d));
            $d = date("Y-m-d", $date);
            $datedebut = new DateTime($d);
        }
        //get day name
        /* $date = '2016/03/03'; 
          $day = date('l', strtotime($date));
          echo $day; */

        // incriment of day 
        /* $date = strtotime("+1 day", strtotime("2020-02-28"));
          echo date("Y-m-d", $date); */
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
    public function showCalendar($id)
    {
        $title='Calendrier';
        $dispo = array();

        $dateDispo=TestDriveDay::ListDateDispo($id)->get();



        return view('TestDrives/calendar-Test-Drive', ['title' => $title,'dateDispo'=>$dateDispo,'dispo'=>$dispo]);
    }

    public function showHours($id)
    {
        $hours=TestDriveHour::ListHeureIndispo($id)->get();
        //dd($hours);
        $in = array();
        foreach($hours as $hour){
            $in['h'] = $hour->hour;
            if( $hour->customer_id == 1){
                $in['state'] = 'false';
            }
            else {
                $in['state'] = 'true';
            }

            $re[$hour->id] = $in;

        }
        $re = json_encode($re);
        return $re;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}