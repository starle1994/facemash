<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Staff;

class HomeController extends Controller
{
    /**
     * Show QuickAdmin dashboard page
     *
     * @return Response
     */
    public function index()
    {
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
}