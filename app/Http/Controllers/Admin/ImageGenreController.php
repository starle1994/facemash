<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\ImageGenre;
use App\Http\Requests\CreateImageGenreRequest;
use App\Http\Requests\UpdateImageGenreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Genre;
use Image;

class ImageGenreController extends Controller {

	/**
	 * Display a listing of imagegenre
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $imagegenre = ImageGenre::with("genre")->where('genre_id',1)->paginate(2);
        $genres = Genre::all();
		return view('admin.imagegenre.index', compact('imagegenre','genres'));
	}

	public function getImage($id)
    {
        $imagegenre = ImageGenre::with("genre")->where('genre_id',$id)->paginate(2);
        $genres = Genre::all();
		return view('admin.imagegenre.index', compact('imagegenre',compact('genres')));
	}

	/**
	 * Show the form for creating a new imagegenre
	 *
     * @return \Illuminate\View\View
	 */
	public function create($id)
	{
	    $genre = Genre::where('id',$id)->first();

	    
	    return view('admin.imagegenre.create', compact("genre"));
	}

	/**
	 * Store a newly created imagegenre in storage.
	 *
     * @param CreateImageGenreRequest|Request $request
	 */
	public function store(Request $request)
	{
	    $length =3;
		$image = $request->file('file');
        $genre_id = $request->get('genre_id');

        $name = $request->get('name');
        $chars = 'ABCDEFGHJKMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
	    $chars_length = (strlen($chars) - 1);
	    $string = $chars{rand(0, $chars_length)};

	    for ($i = 1; $i < $length; $i = strlen($string))
	    {
	        $r = $chars{rand(0, $chars_length)};
	        if ($r != $string{$i - 1}) $string .=  $r;
	    }
        $input['imagename'] = time().'-'.$string.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/thumb');
        $img = Image::make($image->getRealPath());
        $img->resize(50, 50, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);

        $destinationPath = public_path('uploads');
            $image->move($destinationPath, $input['imagename']);

		ImageGenre::create(['genre_id'=>$genre_id,
						'image'=>$input['imagename']]);

		return redirect()->route(config('quickadmin.route').'.imagegenre.index');
	}

	/**
	 * Show the form for editing the specified imagegenre.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$imagegenre = ImageGenre::find($id);
	    $genre = Genre::pluck("name", "id")->prepend('Please select', null);

	    
		return view('admin.imagegenre.edit', compact('imagegenre', "genre"));
	}

	/**
	 * Update the specified imagegenre in storage.
     * @param UpdateImageGenreRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateImageGenreRequest $request)
	{
		$imagegenre = ImageGenre::findOrFail($id);

        $request = $this->saveFiles($request);

		$imagegenre->update($request->all());

		return redirect()->route(config('quickadmin.route').'.imagegenre.index');
	}

	/**
	 * Remove the specified imagegenre from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		ImageGenre::destroy($id);

		return redirect()->route(config('quickadmin.route').'.imagegenre.index');
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
            ImageGenre::destroy($toDelete);
        } else {
            ImageGenre::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.imagegenre.index');
    }

}
