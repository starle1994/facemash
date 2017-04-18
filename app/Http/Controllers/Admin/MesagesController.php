<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\Genre;

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
    	$mesages = Message::where('genre_id', 1)->orderBy('id','desc')->get();
    	$genres = Genre::all();
        $id = 1;
		return view('admin.mesages.index',compact('mesages', 'genres','id'));
	}

	public function getMessage($id)
    {
        $mesages = Message::where('genre_id',$id)->paginate(20);
        $genres = Genre::all();
		return view('admin.mesages.index', compact('mesages','genres','id'));
	}

	public function destroy($id)
	{
		Message::destroy($id);

		return redirect()->route(config('quickadmin.route').'.mesages.index');
	}


}