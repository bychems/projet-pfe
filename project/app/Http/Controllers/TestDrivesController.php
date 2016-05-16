<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Car;
use App\User;
use DateTime;
use App\TestDriveDay;
use App\TestDriveHour;
use App\Customer;
use App\Modele;
class TestDrivesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        //dd($this->User()->id);
        $cars = array();
        $models=array();
        $car = Car::all();
        $title = "Ajout Disponibilité";
        foreach ($car as $c) {
            $cars[$c->id] = $c->model;
        }
         $model = Modele::all();
         foreach ($model as $m) {
            $models[$m->id] = $m->name;
        }
        $date = \Carbon\Carbon::today();
        $date = $date->format('Y-m-d');
        return view('TestDrives/disponibility-test-drive', ['title' => $title, 'cars' => $cars, 'date' => $date, 'models' => $models]);
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

                $days =  TestDriveDay::firstOrCreate(['date_day'=>$datedebut, 'car_id'=>$car ]);
                $day_id=$days->id;
                //insertion de l'heure non disponible '13' de ce jour
                TestDriveHour::firstOrCreate(['hour'=>13,'state'=>'Active' ,'customer_id'=>1,'day_id'=>$day_id ]);


            }
            $date = strtotime("+1 day", strtotime($d));
            $d = date("Y-m-d", $date);
            $datedebut = new DateTime($d);
        }


        return redirect(route('Calendar',$car));
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
    public function cancelHour($id,$id2) {
        //
        TestDriveHour::where('id',$id2)
            ->update(['state'=>'Inactive']) ;
        return redirect(route('Calendar',$id));
    }


    public function showCalendar($id)
    {
        $title='Calendrier';

        $customers = array();
        $custs = Customer::GetCustomerAsUser(Controller::User()->id)->get();
        foreach ($custs as $c) {
            $customers[$c->id] = $c->last_name." ".$c->name;
        }

        $dateDispo=TestDriveDay::ListDateDispo($id)->get();
        $nondispo = array();
        if(!empty($dateDispo[0]))
        {   $dateBegin= $dateDispo[0]->date_day;
            $dateEnd= $dateDispo[count($dateDispo)-1]->date_day;

            $test=$dateBegin;
            $i=0;
            foreach($dateDispo as $d)
            {
                if($test!=$d->date_day)
                {
                    while($test!=$d->date_day)
                    {  // echo $d->date_day."!=".$test."-----------";
                        array_push($nondispo, $test);
                        $test = strtotime("+1 day", strtotime($test));
                        $test= date("Y-m-d", $test);
                    }
                    $test = strtotime("+1 day", strtotime($test));
                    $test= date("Y-m-d", $test);
                }
                else
                {
                    $test = strtotime("+1 day", strtotime($test));
                    $test= date("Y-m-d", $test);
                }
            }
            $nondispo=str_replace("-","/",json_encode($nondispo));

            return view('TestDrives/calendar-Test-Drive', ['title' => $title,'dateDispo'=>$dateDispo,'dateEnd'=>$dateEnd,
                'dateBegin'=>$dateBegin,'carid'=>$id,'nondispo'=>$nondispo,
                'customers'=>$customers]);
        }
        else
        { return view('TestDrives/calendar-Test-Drive', ['title' => $title,'carid'=>$id,'dateBegin'=>"",
            'dateEnd'=>"",'nondispo'=>"[]",'customers'=>$customers]);
        }
    }

    public function showHours($date,$car)
    {
        $row= TestDriveDay::IdDate($date,$car)->get();
        //dd($row);
        $id=$row[0]->id;

        $hours=TestDriveHour::ListHeureIndispo($id)->get();
        //dd($hours);
        $in = array();
        foreach($hours as $hour){
            $cust= Customer::find($hour->customer_id);
            $in['h'] = $hour->hour;
            if( $hour->customer_id == 1){
                $in['state'] = 'false';
                $in['annuler'] = 'false';
            }
            else {
                $in['state'] = 'true';
                if($cust->commercial_id==Controller::User()->id)
                {
                    $in['annuler'] = 'true';
                    $in['attach_id']=$cust->id;
                    $in['attach_name']=$cust->name;
                    $in['line'] = 'Pour';
                    $in['id_hour']=$hour->id;
                }
                else {
                    $in['annuler'] = 'false';
                    $in['attach_id']=$cust->commercial_id;
                    $in['attach_name']=User::find($cust->commercial_id)->name;
                    $in['line'] = 'Par';
                }

            }
            $in['id']=$id;
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
    public function destroy(Request $request ,$id) {
        $dayid=$request->id_day;

        $hour=TestDriveHour::ListHeureIndispo($dayid)->where('customer_id','!=',1)->get();
        if(!isset($hour[0]))
            {$day=TestDriveDay::find($dayid);
            $day->delete();
            return redirect(route('Calendar',$id));
        }
        else
        {
            $test=1;
            return redirect(route('Calendar',$id));
        }

    }



    public function addHour(Request $request ,$id)
    {
        $hour= new TestDriveHour();
        $hour->hour=$request->heure;
        $hour->state='Active';
        $hour->customer_id=$request->customer;
        $hour->day_id=$request->id_day;
        $hour->save();
        return redirect(route('Calendar',$id));
    }
}