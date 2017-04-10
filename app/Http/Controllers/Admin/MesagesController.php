<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;

class MesagesController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
    	$mesages = Message::orderBy('id','desc')->get();
		return view('admin.mesages.index',compact('mesages'));
	}

}