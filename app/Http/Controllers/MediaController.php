<?php

namespace App\Http\Controllers;

use App\Media;
use App\ModelQueries\MediaQuery;
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
        return view('media/index', [
            'files' => Media::paginate(30),
        ]);
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

        var_dump('<pre>', \File::makeDirectory(public_path('/media/logo/'), 0644), '</pre>');die;

        dd($validated['files']);
    }

    /**
     * Get all Services.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        return response()
            ->json(Media::orderBy('created_at', 'desc')->with('user')->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
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
