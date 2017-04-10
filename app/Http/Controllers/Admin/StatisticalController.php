<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Statistical;
use DateTime;

class StatisticalController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
		$day = (int)date('d');
            $month = (int)date('m');
            $year = (int)date('Y');
            $viewClick =0;
            $percentClick = 0;
            $timeAvg = 0;
            $left =0;
            $right=0;
            $totalClick=0;
            $total = (int)(Statistical::sum('views'));
            if ($total !=0) {
                $viewClick = (int)(Statistical::sum('viewClick'));

                $percentClick = ($viewClick/$total)*100;

                $percentClick = round($percentClick);

                $time = (double)(Statistical::sum('timespent'));

                $timeAvg = round(($time/(double)$total),2);

                $left = (int)(Statistical::sum('numberleft'));
                $right  = (int)(Statistical::sum('numberright'));

                $totalClick = $left + $right;
                if ($totalClick !=0) {
                    $left = ($left/$totalClick)*100;
                }
                

                $left = round($left);

                $right = 100 - $left;
            }
            


            $statistical = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->first();
            if($statistical != null){
                $ondayleft = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->sum('numberleft');
                $ondayright = Statistical::where('day',$day)->where('month',$month)->where('year',$year)->sum('numberright');
                $onday = $ondayleft + $ondayright;

            }else{
                $onday = 0;
            }
            $now = new DateTime();
            $prevDateTime = $now->modify("last day of this month");
            $days = $prevDateTime->format('d');
            $month = $prevDateTime->format('m');

            $statistical = Statistical::where('month',$month)->where('year',$year)->get();
            $date =[];
            $aaa = [];
            
            for ($i=1; $i <= $days ; $i++) { 
                $date[$i] =0;
                $aaa[$i] = $i.'/'.$month;
            }
           
            foreach ($date as $key => $value) {
                foreach ($statistical as $sta) {
                    if($key == $sta->day){
                        $date[$key]= $sta->numberleft  + $sta->numberright;
                    }
                }
            }
          
            return view('admin.statistical.statistical', compact('totalClick','onday','left','right','timeAvg','percentClick','date','aaa'));
	}

}