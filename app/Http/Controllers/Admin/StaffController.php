<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Staff;
use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Http\Request;



class StaffController extends Controller {

	/**
	 * Display a listing of staff
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $staff = Staff::orderBy('rating', 'DESC')->get();
       // var_dump($staff);exit;
		return view('admin.staff.index', compact('staff'));
	}
    public function chat(Request $request)
    {

        return view('admin.staff.index', compact('staff'));
    }

	/**
	 * Show the form for creating a new staff
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

            $staff = Staff::paginate(4);
	    return view('admin.staff.create', compact('staff'));
	}

	/**
	 * Store a newly created staff in storage.
	 *
     * @param CreateStaffRequest|Request $request
	 */
	public function store(CreateStaffRequest $request)
	{
	    
		Staff::create($request->all());

		return redirect()->route(config('quickadmin.route').'.staff.index');
	}

	/**
	 * Show the form for editing the specified staff.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$staff = Staff::find($id);


		return view('admin.staff.edit', compact('staff'));
	}

	/**
	 * Update the specified staff in storage.
     * @param UpdateStaffRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateStaffRequest $request)
	{
		$staff = Staff::findOrFail($id);

		$request = $this->saveFiles($request);
		$staff->update($request->all());

		return redirect()->route(config('quickadmin.route').'.staff.index');
	}

	/**
	 * Remove the specified staff from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Staff::destroy($id);

		return redirect()->route(config('quickadmin.route').'.staff.index');
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
            Staff::destroy($toDelete);
        } else {
            Staff::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.staff.index');
    }

}
