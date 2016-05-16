<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct() {
     //   $this->middleware('auth');
    }

    protected function User(){
        $user = \Auth::user();
        return $user;
    }

    static function getextention($file, $ext=array()){
        $e = explode(".", $file);
        if(in_array($e[count($e)-1], $ext)){
            return true;
        }
        else {
            return false;
        }
    }
    static function getImages($dir){
        $dir = base_path($dir);
        $list = array();
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false ){
                    if($file!="." && $file!=".."){
                        if(Controller::getextention($file, ['jpg', 'png', 'jpeg', 'gif'])){
                            array_push($list, "uploads/".$file);
                        }

                    }
                }
                closedir($dh);
            }
        }
        return $list;
    }
}
