<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Genre;
use App\Http\Requests\CreateGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Http\Request;



class GenreController extends Controller {

	/**
	 * Display a listing of genre
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $genre = Genre::all();

		return view('admin.genre.index', compact('genre'));
	}

	/**
	 * Show the form for creating a new genre
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.genre.create');
	}

	/**
	 * Store a newly created genre in storage.
	 *
     * @param CreateGenreRequest|Request $request
	 */
	public function store(CreateGenreRequest $request)
	{

	    $image = $this->uploadAvatarAgent($request->image, $request['image-data']);
	    	
		Genre::create([
			'name'  =>$request->name,
			'image' =>$image['url'],
			]);

		return redirect()->route(config('quickadmin.route').'.genre.index');
	}

	public function uploadAvatarAgent($file,$content)
	{
	
	//Check request Avata
		$explode[1] = null;
		$explode = explode('.', $file->getClientOriginalName());
		$arr_ext = array('jpg', 'jpeg', 'png', 'PNG', 'JPG');
		$result['status'] = 0; 

		if(!empty($explode) && in_array($explode[1], $arr_ext)) {
		list($type, $content) = explode(';', $content);
		list(, $data) = explode(',', $content);
		$data = base64_decode($data);
		$setNewFileName = time() . "_" . rand(000000, 999999).'.'.$explode[1];
		$fileUrl = public_path() . '/uploads/' . $setNewFileName;
		file_put_contents($fileUrl, $data);
		$result['status'] = 1;
		$result['url'] = $setNewFileName; 
		} else{
		$result['status'] = 0;
		$result['url'] = '';
		}
		return $result;
	}

	/**
	 * Show the form for editing the specified genre.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$genre = Genre::find($id);
	    
	    
		return view('admin.genre.edit', compact('genre'));
	}

	/**
	 * Update the specified genre in storage.
     * @param UpdateGenreRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateGenreRequest $request)
	{
		$genre = Genre::findOrFail($id);

        

		$genre->update($request->all());

		return redirect()->route(config('quickadmin.route').'.genre.index');
	}

	/**
	 * Remove the specified genre from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Genre::destroy($id);

		return redirect()->route(config('quickadmin.route').'.genre.index');
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
            Genre::destroy($toDelete);
        } else {
            Genre::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.genre.index');
    }

}
