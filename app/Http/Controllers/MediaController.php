<?php

namespace App\Http\Controllers;

use App\Media;
use App\ClinicGallery;
use App\ModelQueries\MediaQuery;
use App\ModelQueries\ClinicGalleryQuery;
use App\Http\Requests\MediaUploadRequest;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('media/index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaUploadRequest $request)
    {
        $validated = $request->validated();

        $model = new MediaQuery;

        $model->upload($request->file('files'));

        return redirect()->route('media');
    }

    /**
     * Get all Services.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        return response()
            ->json(Media::orderBy('created_at', 'desc')->with(['user', 'clinic', 'galleryImages'])->get());
    }

    public function galleryUpdate(Request $request)
    {
        $media = Media::where(
                ['id', '=', (int) $request->input('id')],
                ['clinic_id', '=', \Auth::user()->clinic->id]
            )->get();

        if(!$media)
            return redirect()->route('media');

        $mediaGallery = Media::where(
            ['gallery', '=', 1],
            ['clinic_id', '=', Auth::user()->clinic->id]
        )->get();

        if($mediaGallery && count($mediaGallery) >= 5)
                    return response()->json([
                    'media'        => $media,
                    'messageTitle' => 'Alert',
                    'messageText'  => 'You can only have 5 images in the gallery at one time',
                    'class'        => 'error'
            ], 200);

        $media->gallery = !$media->gallery;

        if($request->input('action') === 'remove')
            ClinicGallery::where(
                ['media_id', '=', (int) $media->id],
                ['clinic_id', '=', (int) $media->clinic_id]
            )->delete();

        if($request->input('action') === 'put')
                ClinicGallery::create([
                    'media_id' => (int) $media->id,
                    'clinic_id' => (int) \Auth::user()->clinic->id,
                ]);

        if($media->save())
            return response()->json([
                    'media'        => $media,
                    'messageTitle' => 'Gallery Update',
                    'messageText'  => $media->gallery ? 'Image added to gallery' : 'Image removed from gallery',
                    'class'        => 'success'
            ], 200);

        return response()->json([
                'media'        => $media,
                'messageTitle' => 'Alert',
                'messageText'  => 'Something went wrong. Please try again a bit later',
                'class'        => 'error'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $model = new MediaQuery;

        if($model->destroyFile($id))
            return response()->json([
                    'messageTitle' => 'File Deleted',
                    'messageText'  => 'The file has been deleted',
                    'class'        => 'success'
                ]);

        return response()->json([
                'messageTitle' => 'Alert',
                'messageText'  => 'Something went wrong. Please try again a bit later',
                'class'        => 'error'
            ]);
    }
}
