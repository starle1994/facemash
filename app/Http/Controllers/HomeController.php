<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Staff;
use App\Statistical;

class HomeController extends Controller
{
    /**
     * Show QuickAdmin dashboard page
     *
     * @return Response
     */
    public function index()
    {
        // get date now
        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');

        $statistical = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->first();

        // check first view
        if($statistical == null){
            Statistical::insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>0,'numberright'=>0,'views'=>1]);
        }else{
            $view = $statistical->views + 1;
            Statistical::where('day',$day)->where('month',$month)->where('year',$year)->update(['views' => $view]); 
        }

    	$staffs = Staff::all()->random(2);
    	$staff =[];
    	$i= 0;
    	foreach ($staffs as $value) {
    		$staff[$i] = [
    			'image'=>$value->image,
    			'id'=>  $value->id
    		];
    		$i++;
    	}
        return view('welcome', compact('staff'));
    }

   public function getRandom()
   {
   		if(isset($_GET['func']) && !empty($_GET['func'])){
			switch($_GET['func']){
				case 'getRandom':
					$id = $_GET['id'];
					$choose = $_GET['choose'];					
                    $a = Staff::where('id', $id)->first();
                    $number = $a->rating + 1;
                    $a->update(['rating' => $number]);                         

                    $day = (int)date('d');
                    $month = (int)date('m');
                    $year = (int)date('Y');

                    $statistical = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->first();
                    if($statistical == null){
                        if($choose=='left'){
                            Statistical::insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>1,'numberright'=>0,'views'=>1]);
                        }elseif($choose=='right'){
                            Statistical::insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>0,'numberright'=>1,'views'=>1]);
                        }                                               
                    }else{
                        if($choose=='left'){
                            $left = $statistical->numberleft + 1;
                            Statistical::where('day',$day)->where('month',$month)->where('year',$year)->update(['numberleft' => $left]);
                        }elseif($choose=='right'){
                            $right = $statistical->numberright + 1;
                            Statistical::where('day',$day)->where('month',$month)->where('year',$year)->update(['numberright' => $right]);
                        }
                    }

					$staffs = Staff::all()->random(2);
			    	$staff =[];
			    	$i= 0;
			    	foreach ($staffs as  $value) {
			    		$staff[$i] = [
			    			'image'=>$value->image,
			    			'id'=>  $value->id
			    		];
			    		$i++;
			    	}

					return $staff;
			}
		}

   }

   public function getTime(){

        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');

        $time = $_GET['time'];

        $statistical = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->first();

        if($statistical != null){
                $timeNew = $statistical->timespent + $time;
                Statistical::where('day',$day)->where('month',$month)->where('year',$year)->update(['timespent' => $timeNew]);
        }
   }

   public function statistical()
        {
            $day = (int)date('d');
            $month = (int)date('m');
            $year = (int)date('Y');

            $total = (int)(Statistical::sum('views'));

            $time = (double)(Statistical::sum('timespent'));

            $timeAvg = round(($time/(double)$total),2);

            $left = (int)(Statistical::sum('numberleft'));
            $right  = (int)(Statistical::sum('numberright'));

            $left = ($left/($left + $right))*100;
            $left = round($left);
            $right = 100 - $left;

            $statistical = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->first();
            if($statistical != null){
                $onday = $statistical->views;
            }else{
                $onday = 0;
            }
            return view('statistical', compact('total','onday','left','right','timeAvg'));
        }           
}