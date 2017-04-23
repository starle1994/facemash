<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Content;
use App\Http\Requests\CreateContentRequest;
use App\Http\Requests\UpdateContentRequest;
use Illuminate\Http\Request;
class ContentController extends Controller {
	/**
	 * Display a listing of content
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $content = Content::all();
        
		return view('admin.content.index', compact('content'));
	}
	/**
	 * Show the form for creating a new content
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    return view('admin.content.create');
	}
	/**
	 * Store a newly created content in storage.
	 *
     * @param CreatecontentRequest|Request $request
	 */
	public function store(CreateContentRequest $request)
	{
	    $image = $this->uploadAvatarAgent($request->image, $request['image-data']);
	    $data['name'] = $request->name;
        if($request['image-data'] != null){
        	$image = $this->uploadAvatarAgent($request->image, $request['image-data']);
        	$data['image'] = $image['url'];
        }
		$data['url'] = $request->url;	
		Content::create($data);
		return redirect()->route(config('quickadmin.route').'.content.index');
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
	 * Show the form for editing the specified content.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$content = Content::find($id);
	    
	    
		return view('admin.content.edit', compact('content'));
	}
	/**
	 * Update the specified content in storage.
     * @param UpdatecontentRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, Request $request)
	{
		$content = Content::findOrFail($id);
		$data['name'] = $request->name;
        if($request['image-data'] != null){
        	$image = $this->uploadAvatarAgent($request->image, $request['image-data']);
        	$data['image'] = $image['url'];
        }
		$data['url'] = $request->url;
		$content->update($data); 
		return redirect()->route(config('quickadmin.route').'.content.index');
	}
	/**
	 * Remove the specified content from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Content::destroy($id);
		return redirect()->route(config('quickadmin.route').'.content.index');
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
            Content::destroy($toDelete);
        } else {
            Content::whereNotNull('id')->delete();
        }
        return redirect()->route(config('quickadmin.route').'.content.index');
    }
}