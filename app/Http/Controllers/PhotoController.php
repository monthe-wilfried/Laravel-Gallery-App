<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $photos = Photo::all();
        return view('home', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:albums|min:3|max:50'
        ]);

        $inputs = array();
        $path = 'public/images/';

        //
        if ($request->hasFile('path')){
            $album = Album::create(['name'=>$request->name]);
            foreach ($request->file('path') as $file){
                $filename = hexdec(uniqid()).'.'.$file->getClientOriginalName();
                Image::make($file)->resize(640, 427)->save($path.$filename);
                $inputs['path'] = $path.$filename;
                $inputs['album_id'] = $album->id;
                Photo::create($inputs);
            }

            return redirect()->back()->with('success', 'Album Successfully Created.');
        }
        else{
            return redirect()->back()->with('error', 'Make sure to select some pictures.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $album = Album::findOrFail($id);
        return view('gallery', compact('album'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $photo = Photo::whereId($id)->first();
        unlink($photo->path);
        $photo->delete();
        return redirect()->back()->with('success', 'Photo deleted successfully');
    }


    public function album(){
        $albums = Album::with('photos')->get();
        return view('welcome', compact('albums'));
    }

    public function addPhoto(Request $request){
        $inputs = array();
        $path = 'public/images/';

        //
        if ($request->hasFile('path')){
            foreach ($request->file('path') as $file){
                $filename = hexdec(uniqid()).'.'.$file->getClientOriginalName();
                Image::make($file)->resize(640, 427)->save($path.$filename);
                $inputs['path'] = $path.$filename;
                $inputs['album_id'] = $request->album_id;
                Photo::create($inputs);
            }

            return redirect()->back()->with('success', 'Album Successfully Created.');
        }
        else{
            return redirect()->back()->with('error', 'Make sure to select some pictures.');
        }
    }

    public function albumCover(Request $request){
        $album = Album::findOrFail($request->id);
        $path = 'public/images/cover/';

        if ($request->hasFile('cover_image')){
            $filename = hexdec(uniqid()).'.'.$request->cover_image->getClientOriginalName();
            Image::make($request->cover_image)->resize(640, 427)->save($path.$filename);
            if ($album->cover_image){
                unlink($album->cover_image);
            }
            $album->update(['cover_image'=>$path.$filename]);
            return redirect()->back()->with('success', 'Cover image updated successfully.');
        }
        else{
            return redirect()->back()->with('error', 'Make sure to select a cover image.');
        }
    }


}
