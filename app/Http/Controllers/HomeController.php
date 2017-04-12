<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Staff;
use App\Statistical;
use App\Message;
use Illuminate\Http\Request;

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
        $hour = (int)date('H');
        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');


        $statistical = Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->first();

        // check first view
        if($statistical == null){
            $view = 1;
            Statistical::insert(['hour'=>$hour,'day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>0,'numberright'=>0,'views'=>1]);
        }else{
            $view = $statistical->views + 1;
            Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->increment('views'); 
        }

    	$staffs = Staff::get()->toArray();
   
        shuffle($staffs);

    		$staff[0] = [
    			'image'=>$staffs[0]['image'],
    			'id'=>  $staffs[0]['id']
    		];
    		$staff[1] = [
                'image'=>$staffs[1]['image'],
                'id'=>  $staffs[1]['id']
            ];
    	
        $tests = Message::limit(100)->get();
        return view('welcome', compact('staff','view','tests'));
    }
   
   public function getRandom()
   {   		
		$id = $_GET['id'];
        $choose = $_GET['choose'];

        Staff::where('id', $id)->increment('rating');                      
        $hour = (int)date('H');
        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');

        $statistical = Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->first();

        if($statistical == null){
            if($choose=='left'){
                Statistical::insert(['hour'=>$hour,'day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>1,'numberright'=>0,'views'=>1]);
            }elseif($choose=='right'){
                Statistical::insert(['hour'=>$hour,'day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>0,'numberright'=>1,'views'=>1]);
                        }                                               
            }else{
            if($choose=='left'){
                Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->increment('numberleft');
            }elseif($choose=='right'){
                Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->increment('numberright');
            }
        }
        $staffs = Staff::get()->toArray();
		shuffle($staffs);
        $staff[0] = [
            'image'=>$staffs[0]['image'],
            'id'=>  $staffs[0]['id']
            ];
        $staff[1] = [
            'image'=>$staffs[1]['image'],
            'id'=>  $staffs[1]['id']
            ];
		return $staff;
   }

   public function getTime(){

        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');

        $time = $_GET['time'];
        $numberClick = $_GET['numberClick'];

        $statistical = Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->first();

        if($statistical != null){
                $timeNew = $statistical->timespent + $time;
                Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->update(['timespent' => $timeNew]);
                if($numberClick > 0){
                    $viewClick = $statistical->viewClick + 1;
                    Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->update(['viewClick' => $viewClick]);
                }
        }
   }

   public function statistical()
        {
            $date = Date('Y-m-d');
            $hour = (int)date('H');
            $day = (int)date('d');
            $month = (int)date('m');
            $year = (int)date('Y');

            $total = (int)(Statistical::sum('views'));            

            $viewClick = (int)(Statistical::sum('viewClick'));

            if($total > 0){
                $percentClick = ($viewClick/$total)*100;
                $percentClick = round($percentClick);
                $time = (double)(Statistical::sum('timespent'));
                $timeAvg = round(($time/(double)$total),2);
            }else{
                $percentClick = 0;
                $timeAvg = 0;
            }
            
            $left = (int)(Statistical::sum('numberleft'));
            $right  = (int)(Statistical::sum('numberright'));

            $totalClick = $left + $right;

            if($totalClick > 0){
                $left = ($left/$totalClick)*100;

                $left = round($left);

                $right = 100 - $left;
            }else{
                $left = 0;
                $right = 0;
            }

            $statistical = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->first();
            if($statistical != null){
                $ondayleft = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->sum('numberleft');
                $ondayright = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->sum('numberright');
                $onday = $ondayleft + $ondayright;
                $ondayView = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->sum('views');
            }else{
                $onday = 0;
                $ondayView = 0;
            }
            $thisHourModal = Statistical::where('hour',$hour)->where('day',$day)->where('month',$month)->where('year',$year)->first();
            if($thisHourModal!=null){
                $thisHour = $thisHourModal->views;
            }else{
                $thisHour = 0;
            }
            dd($thisHour);
            return view('admin.statistical.statistical', compact('totalClick','onday','left','right','timeAvg','percentClick','date','total','ondayView','thisHour'));
        }   

    public function store(Request $request){
        $add = new Message;
        $add->msg = $request->input('msg');
        $add->name = $request->input('name');
        $add->view = $request->input('view');
        $add->save();
    }   

    public function ajax(Request $request){
        ini_set('max_execution_time',7200);

        $time = $request->input('timePre');
        if($time == null){
            $time = Date('Y-m-d H:i:s');
        }
        while(Message::where('created_at','>',$time)->count() < 1 ){
            usleep(1000);
        }
        if(Message::where('created_at','>',$time)->count() > 0){
            $data = Message::where('created_at','>',$time)->get();
            $arrMsg = array();
            $i= 0;
            foreach ($data as $item) {
                $arrMsg[$i] = [
                            'msg'=>$item->msg,
                            'name'=>$item->name,
                            'view'=>$item->view,
                            'created_at'=>$item->created_at->format('Y-m-d H:i:s')
                        ];
                $i++;
            }
            return response()->json($arrMsg);      
        }

    }
}