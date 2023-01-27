<?php

namespace Tasmir\LaravelMedia\Http\Helper;

use Illuminate\Support\Str;
use Storage;
use Tasmir\LaravelMedia\Models\Media;

trait MediaFiles
{

    public function mediaFileUploadHelper($file, $path = null)
    {
        if ($file->isValid()) {
            $data = [];
            $file1 = $file->getClientOriginalName();
            $data["name"] = pathinfo($file1,PATHINFO_FILENAME);
//            $data["name"] = $file->getClientOriginalName();
            $data["alt"] = $data["name"];
            $data["extension"] = $file->getClientOriginalExtension();
            $file_name = Media::generateSlug($data["name"]).".".$data["extension"];

            $path = $path ? $path : 'media';
            $file->storeAs('public/'.$path, $file_name);
//            return $path . "/" . $file_name;
            $data['size'] = $this->getFileSize($path."/".$file_name);
            $data['dimension'] = $this->getImageDimension(asset('storage/'.$path."/".$file_name));
            $data["original_path"] = $path."/".$file_name;
            return $data;
        }


    }
    public function getFileSize($img)
    {
        $size = Storage::size("public/".$img);
        if ($size < 1024) {
            return $size . ' bytes';
        } elseif ($size < 1048576) {
            return number_format($size / 1024, 2) . ' KB';
        } else {
            return number_format($size / 1048576, 2) . ' MB';
        }
    }

    public function getImageDimension($img)
    {
        [$width, $height] = getimagesize($img);
        return "$width x $height px";
    }

    function createCustomImageURL($img)
    {
        if ($img) {
        $parts = explode("/", $img);
    $parts[count($parts)-2];
//    echo end($parts);
        return [$parts[count($parts) - 2], end($parts)];
        return route("photos.get", [$parts[count($parts) - 2], end($parts)]);
            $img = str_replace('/', '--', $img);
            return route("media.file", $img);
        } else {
            return config("media.empty_url");
        }
    }
}
