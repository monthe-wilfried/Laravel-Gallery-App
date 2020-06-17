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
        $albums = Album::latest()->get();
        return view('home', compact('albums'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function photosStore(Request $request)
    {
        $inputs = array();
        $path = 'public/images/';

        //
        if ($file = $request->file('file')){
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalName();
            Image::make($file)->save($path.$filename);
            $inputs['path'] = $path.$filename;
            $inputs['album_id'] = $request->album_id;
            Photo::create($inputs);

            $notification = array(
                'message' => 'Photos successfully uploaded.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Photos were not successfully uploaded.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
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
        $photos = Photo::where('album_id', $album->id)->paginate(20);
        return view('gallery', compact('album', 'photos'));
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
        $notification = array(
            'message' => 'Photo successfully deleted.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function album(){
        $albums = Album::latest()->paginate(20);
        return view('welcome', compact('albums'));
    }

    public function albumStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:albums|min:3|max:50',
            'cover_image' => 'required'
        ]);

        $inputs = $request->all();
        $path = 'public/images/cover/';

        //
        if ($file = $request->file('cover_image')) {
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalName();
            Image::make($file)->save($path . $filename);
            $inputs['cover_image'] = $path . $filename;
            Album::create($inputs);

            $notification = array(
                'message' => 'Album successfully created.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function albumDelete($id)
    {

        $album = Album::findOrFail($id);
        $photos = Photo::where('album_id', $id)->get();
        if ($album->cover_image){
            unlink($album->cover_image);
        }
        $album->delete();
        foreach ($photos as $photo){
            $photo->delete();
            unlink($photo->path);
        }

        $notification = array(
            'message' => 'Album successfully deleted.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function albumEdit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
        ]);

        $inputs = $request->except('id');
        $album = Album::findOrFail($request->id);
        $path = 'public/images/cover/';

        if ($file = $request->file('cover_image')) {
            unlink($album->cover_image);
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalName();
            Image::make($file)->save($path . $filename);
            $inputs['cover_image'] = $path . $filename;

            $album->update($inputs);

            $notification = array(
                'message' => 'Album successfully updated.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $album->update(['name'=>$request->name]);

            $notification = array(
                'message' => 'Album successfully updated.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function albumShow($id){
        $album = Album::findOrFail($id);
        $photos = Photo::where('album_id', $album->id)->paginate(20);
        return view('show', compact('album', 'photos'));
    }


}
