<?php

namespace App\ModelQueries;

use Illuminate\Database\Eloquent\Model;

use App\Media;
use App\Helpers\XSS;

use Carbon\Carbon;

class MediaQuery extends Media
{
    protected $table = 'media';

    private $_uploadDirectory;
    private $_uploadDirectoryThumbs;
    private $_suportedImageExtensions = [
        'jpg', 'jpeg', 'png', 'gif', 'webp'
    ];

    public function __construct()
    {
        $directory = \Auth::user()->hasRole('super_admin') ?
            'general' : strtolower(str_replace(' ', '_', \Auth::user()->clinic->name));

        $this->_uploadDirectory       = public_path('/media/' . $directory);
        $this->_uploadDirectoryThumbs = $this->_uploadDirectory . "/thumbs";

        \File::makeDirectory($this->_uploadDirectoryThumbs, 0755, true, true);
    }

    public function upload($files)
    {
        $data = [];

        $userID   = \Auth::user()->id;
        $clinicID = \Auth::user()->clinic->id ?? null;
        $now      = Carbon::now('utc')->toDateTimeString();

        foreach ($files as $file) {

            if(!in_array($file->getClientOriginalExtension(), $this->_suportedImageExtensions)){
                $result = $this->uploadFile($file);
            } else {
                $result = $this->uploadImage($file);
            }

            $data[] = [
                'name'        => $result['name'],
                'extension'   => $result['extension'],
                'user_id'     => $userID,
                'clinic_id'   => $clinicID,
                'super_admin' =>  \Auth::user()->hasRole('super_admin') ? 1 : 0,
                'created_at'  => $now,
                'updated_at'  => $now,
            ];

        }

        if($this->insert($data))
            return true;

        return false;
    }

    public function destroyFile(int $id)
    {
        $file = $this->find($id);

        if(\Auth::user()->hasRole('super_admin')
            || \Auth::user()->id === $file->user_id
            || \Auth::user()->clinic->id === $file->clinic_id){

                \File::delete($this->_uploadDirectory . "/" . $file->name);

                if(in_array($file->extension, $this->_suportedImageExtensions))
                    \File::delete($this->_uploadDirectoryThumbs . "/" . $file->name);

                if($file->delete())
                    return true;

                return false;
            }

        return false;
    }

    private function uploadFile($file)
    {
        $result = $this->fileName($file);

        $file->move($this->_uploadDirectory, $result['name']);

        return $result;
    }

    private function uploadImage($image)
    {
        $img    = \Image::make($image->getPathName());
        $result = $this->fileName($image);

        // Resize image if they are bigger than 1920px
        if($img->width() > 1920){
            $img->fit(1920, 1080);
        }

        $img->save($this->_uploadDirectory  . "/" . $result['name']);

        // Make thumbs
        $img->fit(64, 64);
        $img->save($this->_uploadDirectoryThumbs  . "/" . $result['name']);

        return $result;
    }

    private function fileName($file)
    {
        $i         = 1;
        $fullName  = strtolower(str_replace(' ', '_', XSS::clean($file->getClientOriginalName())));

        $name      = pathinfo($fullName, PATHINFO_FILENAME);
        $extension = pathinfo($fullName, PATHINFO_EXTENSION);

        $uploadName = $name . ".{$extension}";

        while(file_exists($this->_uploadDirectory . "/{$uploadName}")){
            $uploadName = $name . $i . ".{$extension}";
            $i++;
        }

        return ['name' => $uploadName, 'extension' => $extension];
    }
}
