<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Staff;
use App\Statistical;
use App\Message;
use Illuminate\Http\Request;
use App\Genre;
use App\ImageGenre;

class HomeController extends Controller
{
    /**
     * Show QuickAdmin dashboard page
     *
     * @return Response
     */
    public function indexGenre()
    {
        $genres = Genre::all();
        return view('genre',compact('genres'));
    }

    public function ranking()
    {
        $genres = Genre::all();
        return view('ranking',compact('genres'));
    }

    public function rankingDetail($id)
    {
        if($id==1){
            $images = Staff::orderBy('rating','desc')->take(10)->get();
        }else{
            $images = ImageGenre::where('genre_id', $id)->orderBy('rating','desc')->take(10)->get();
        }
        
        return view('ranking_detail',compact('images'));
    }

    public function index($id=1)
    {
        // get date now
        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');

        $statistical = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->first();

        // check first view
        $view =1;
        if($statistical == null){
            Statistical::where('genre_id', $id)->insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>0,'numberright'=>0,'views'=>1]);
        }else{
            $view = $statistical->views + 1;
            Statistical::where('genre_id', $id)->where('day',$day)->where('month',$month)->where('year',$year)->update(['views' => $view]); 
        }
        $staff = [];
        if($id == 1){
            $staffs = Staff::inRandomOrder()->select('id','image')->take(2)->get()->toArray();
            $staff[0] = [
                'image'=>$staffs[0]['image'],
                'id'=>  $staffs[0]['id']
            ];
            $staff[1] = [
                'image'=>$staffs[1]['image'],
                'id'=>  $staffs[1]['id']
            ];
        }else{
            $staffs = ImageGenre::select('id','image','genre_id')->where('genre_id', $id)->inRandomOrder()->take(2)->get()->toArray();

            if(isset($staffs[0])){
                $staff[0] = [
                    'image'=>$staffs[0]['image'],
                    'id'=>  $staffs[0]['id']
                ];
            }

            if(isset($staffs[1])){
                $staff[1] = [
                    'image'=>$staffs[1]['image'],
                    'id'=>  $staffs[1]['id']
                ];
            }
        }
    
        $tests = Message::limit(100)->get();
        return view('welcome', compact('staff','view','tests','id'));
    }
   
   public function getRandom()
   {

		$id = $_GET['id'];
		$choose = $_GET['choose'];
        $genre_id = $_GET['genre_id'];
        if ($genre_id ==1) {
            $a = Staff::where('id', $id)->first();
            $number = $a->rating + 1;
            $a->update(['rating' => $number]);    
        }else{
            $a = ImageGenre::where('id', $id)->first();
            $number = $a->rating + 1;
            $a->update(['rating' => $number]);
        }
                            

        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');

        $statistical = Statistical::where('genre_id', $genre_id)->where('day',$day)->where('day',$day)->where('month',$month)->where('year',$year)->first();
        if($statistical == null){
            if($choose=='left'){
                Statistical::where('genre_id', $genre_id)->where('day',$day)->insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>1,'numberright'=>0,'views'=>1,'genre_id'=>$genre_id]);
            }elseif($choose=='right'){
                Statistical::where('genre_id', $genre_id)->where('day',$day)->insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>0,'numberright'=>1,'views'=>1,'genre_id'=>$genre_id]);
            }                                               
        }else{
            if($choose=='left'){
                $left = $statistical->numberleft + 1;
                Statistical::where('genre_id', $genre_id)->where('day',$day)->where('day',$day)->where('month',$month)->where('year',$year)->update(['numberleft' => $left]);
            }elseif($choose=='right'){
                $right = $statistical->numberright + 1;
                Statistical::where('genre_id', $genre_id)->where('day',$day)->where('day',$day)->where('month',$month)->where('year',$year)->update(['numberright' => $right]);
            }
        }
        if($genre_id== 1){
            $staffs = Staff::inRandomOrder()->select('id','image')->take(2)->get()->toArray();
        
            $staff[0] = [
                'image'=>$staffs[0]['image'],
                'id'=>  $staffs[0]['id'],
                'genre_id' =>$id
            ];
            $staff[1] = [
                'image'=>$staffs[1]['image'],
                'id'=>  $staffs[1]['id'],
                'genre_id' =>$id
            ];
        }else{
            $staffs = ImageGenre::where('genre_id', $genre_id)->inRandomOrder()->take(2)->get()->toArray();

            $staff[0] = [
                'image'=>$staffs[0]['image'],
                'id'=>  $staffs[0]['id'],
                'genre_id' =>$genre_id
            ];
            $staff[1] = [
                'image'=>$staffs[1]['image'],
                'id'=>  $staffs[1]['id'],
                'genre_id' =>$genre_id
            ];
        }
    	return $staff;

		
   }

   public function getTime(){

        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');

        $time = $_GET['time'];
        $numberClick = $_GET['numberClick'];

        $statistical = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->first();

        if($statistical != null){
                $timeNew = $statistical->timespent + $time;
                Statistical::where('day',$day)->where('month',$month)->where('year',$year)->update(['timespent' => $timeNew]);
                if($numberClick > 0){
                    $viewClick = $statistical->viewClick + 1;
                    Statistical::where('day',$day)->where('month',$month)->where('year',$year)->update(['viewClick' => $viewClick]);
                }
        }
   }

   public function statistical()
        {
            $date = Date('Y-m-d');
            $day = (int)date('d');
            $month = (int)date('m');
            $year = (int)date('Y');

            $total = (int)(Statistical::sum('views'));            

            $viewClick = (int)(Statistical::sum('viewClick'));

            $percentClick = ($viewClick/$total)*100;

            $percentClick = round($percentClick);

            $time = (double)(Statistical::sum('timespent'));

            $timeAvg = round(($time/(double)$total),2);

            $left = (int)(Statistical::sum('numberleft'));
            $right  = (int)(Statistical::sum('numberright'));

            $totalClick = $left + $right;

            $left = ($left/$totalClick)*100;

            $left = round($left);

            $right = 100 - $left;


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
            return view('admin.statistical.statistical', compact('totalClick','onday','left','right','timeAvg','percentClick','date','total','ondayView'));
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