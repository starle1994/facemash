<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Statistical;

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
            }else{
                $onday = 0;
            }
            return view('admin.statistical.statistical', compact('totalClick','onday','left','right','timeAvg','percentClick'));
	}

}