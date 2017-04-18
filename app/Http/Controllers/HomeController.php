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
        $genre = Genre::where('id',$id)->first();
        $ge_name =$genre->name;
        $ge_url  = $genre->url;
        
        $statistical = Statistical::where('genre_id',$id)->where('day',$day)->where('month',$month)->where('year',$year)->first();

        // check first view
        if($statistical == null){
            $view =1;
            Statistical::insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>0,'numberright'=>0,'views'=>1,'genre_id'=>$id]);
        }else{
            $view = $statistical->views + 1;
            Statistical::where('genre_id', $id)->where('day',$day)->where('month',$month)->where('year',$year)->update(['views' => $view]); 
        }
        $staff = [];
        if($id == 1){
            $staffs = Staff::inRandomOrder()->select('id','image','name','url')->take(2)->get()->toArray();

        }else{
            $staffs = ImageGenre::select('id','image','genre_id','name','url')->where('genre_id', $id)->inRandomOrder()->take(2)->get()->toArray();

        }
        $sff = ($staffs[0]['name'] == null) ? 'No Name' : $staffs[0]['name'];
        $staff[0] = [
            'image'=>$staffs[0]['image'],
            'id'=>  $staffs[0]['id'],
            'name'=>  $sff,
            'url'=>  $staffs[0]['url'],
        ];
        $sff = ($staffs[1]['name'] == null) ? 'No Name' : $staffs[1]['name'];
        $staff[1] = [
            'image'=>$staffs[1]['image'],
            'id'=>  $staffs[1]['id'],
            'name'=> $sff,
            'url'=>  $staffs[1]['url'],
        ];
        $messages = Message::where('genre_id',$id)->limit(100)->get();

        return view('welcome', compact('staff','view','messages','id','ge_name','ge_url'));
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

        // $statistical = Statistical::where('genre_id', $genre_id)->where('day',$day)->where('day',$day)->where('month',$month)->where('year',$year)->first();
        // if($statistical == null){
        //     if($choose=='left'){
        //         Statistical::where('genre_id', $genre_id)->where('day',$day)->insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>1,'numberright'=>0,'views'=>1,'genre_id'=>$genre_id]);
        //     }elseif($choose=='right'){
        //         Statistical::where('genre_id', $genre_id)->where('day',$day)->insert(['day'=>$day,'month'=>$month,'year'=>$year,'numberleft'=>0,'numberright'=>1,'views'=>1,'genre_id'=>$genre_id]);
        //     }                                               
        // }else{
        //     if($choose=='left'){
        //         $left = $statistical->numberleft + 1;
        //         Statistical::where('genre_id', $genre_id)->where('day',$day)->where('day',$day)->where('month',$month)->where('year',$year)->update(['numberleft' => $left]);
        //     }elseif($choose=='right'){
        //         $right = $statistical->numberright + 1;
        //         Statistical::where('genre_id', $genre_id)->where('day',$day)->where('day',$day)->where('month',$month)->where('year',$year)->update(['numberright' => $right]);
        //     }
        // }
        if($genre_id== 1){
            $staffs = Staff::inRandomOrder()->select('id','image','name','url')->take(2)->get()->toArray();
        
        }else{
            $staffs = ImageGenre::select('id','image','genre_id','name','url')->where('genre_id', $genre_id)->inRandomOrder()->take(2)->get()->toArray();
        }

        $sff = ($staffs[0]['name'] == null) ? 'No Name' : $staffs[0]['name'];
        $staff[0] = [
            'image'=>$staffs[0]['image'],
            'id'=>  $staffs[0]['id'],
            'name'=>  $sff,
            'url'=>  $staffs[0]['url'],
            'genre_id'=>  $genre_id,
        ];
        $sff = ($staffs[1]['name'] == null) ? 'No Name' : $staffs[1]['name'];
        $staff[1] = [
            'image'=>$staffs[1]['image'],
            'id'=>  $staffs[1]['id'],
            'name'=> $sff,
            'url'=>  $staffs[1]['url'],
            'genre_id'=>  $genre_id,
        ];
    	return $staff;

		
   }

   public function getTime(){

        $day = (int)date('d');
        $month = (int)date('m');
        $year = (int)date('Y');

        $time = $_GET['time'];
        $numberClick = $_GET['numberClick'];
        $genre_id = $_GET['genre_id'];
        $statistical = Statistical::where('day',$day)->where('genre_id',$genre_id)->where('month',$month)->where('year',$year)->first();

        if($statistical != null){
                $timeNew = $statistical->timespent + $time;
                Statistical::where('day',$day)->where('genre_id',$genre_id)->where('month',$month)->where('year',$year)->update(['timespent' => $timeNew]);
                if($numberClick > 0){
                    $viewClick = $statistical->viewClick + 1;
                    Statistical::where('day',$day)->where('genre_id',$genre_id)->where('month',$month)->where('year',$year)->update(['viewClick' => $viewClick]);
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
        $add->genre_id = $request->input('id');
        $add->save();
    }   

    public function ajax(Request $request){
        ini_set('max_execution_time',7200);

        $time = $request->input('timePre');
        $id = $request->input('id');

        if($time == null){
            $time = Date('Y-m-d H:i:s');
        }
        while(Message::where('genre_id',$id)->where('created_at','>',$time)->count() < 1 ){
            usleep(1000);
        }
        if(Message::where('genre_id',$id)->where('created_at','>',$time)->count() > 0){
            $data = Message::where('genre_id',$id)->where('created_at','>',$time)->get();
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