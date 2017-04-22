<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Advertisement;
use App\Http\Requests\CreateAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use Illuminate\Http\Request;



class AdvertisementController extends Controller {

	/**
	 * Display a listing of Advertisement
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $advertisement = Advertisement::all();

		return view('admin.advertisement.index', compact('advertisement'));
	}

	/**
	 * Show the form for creating a new Advertisement
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    $position = ['top'=>'Top','bottom'=>'Bottom'];
	    return view('admin.advertisement.create',compact('position'));
	}

	/**
	 * Store a newly created Advertisement in storage.
	 *
     * @param CreateAdvertisementRequest|Request $request
	 */
	public function store(CreateAdvertisementRequest $request)
	{
	    $request = $this->saveFiles($request);
		Advertisement::create($request->all());

		return redirect()->route(config('quickadmin.route').'.advertisement.index');
	}

	/**
	 * Show the form for editing the specified advertisement.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$advertisement  = Advertisement::find($id);
	    
	    $position = ['top'=>'Top','bottom'=>'Bottom'];
		return view('admin.advertisement.edit', compact('advertisement''position'));
	}

	/**
	 * Update the specified Advertisement in storage.
     * @param UpdateAdvertisementRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, Request $request)
	{
		$Advertisement = Advertisement::findOrFail($id);

        $request = $this->saveFiles($request);
  
		$Advertisement->update($request->all());

		return redirect()->route(config('quickadmin.route').'.advertisement.index');
	}

	/**
	 * Remove the specified Advertisement from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Advertisement::destroy($id);

		return redirect()->route(config('quickadmin.route').'.advertisement.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Advertisement::destroy($toDelete);
        } else {
            Advertisement::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.advertisement.index');
    }

}
