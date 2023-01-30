<?php

namespace Tasmir\LaravelMedia\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tasmir\LaravelMedia\Http\Helper\MediaFiles;
use Tasmir\LaravelMedia\Models\Media;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Storage;


class LaravelMediaController extends Controller
{
    use MediaFiles;
    public function getAllMedia() {
        $data = [];
        $all_medias = Media::latest('id')->get();
        foreach ($all_medias as $key => $media) {
            $media["image"] = asset('storage/media/'.$media->original_path);
            $media["public_path"] = route("media.file", $media->slug);
            $media["updated"] = date("Y-m-d h:i a", strtotime($media->updated_at));
            $data[] = $media;
//            $media["updated_at"] = date("Y-m-d h:i", strtotime($media->updated_at));
        }
        return json_encode($data, true);
    }


    public function store(Request $request) {
        try {
            $data = array();
            if ($request->file('file')) {

                $file = $request->file('file');
                $media_data_array = $this->mediaFileUploadHelper($file);

                $media_data = Media::create($media_data_array);
                $media_data["image"] = asset('storage/media/'.$media_data->original_path);
                $media_data["public_path"] =route("media.file", $media_data->slug);
                $media_data["updated"] = date("Y-m-d h:i a", strtotime($media_data->updated_at));

                // Response
                $data['success'] = 1;
                $data['message'] = 'Uploaded Successfully!';
                /*
                $data['data'] = [
                    'id' => 99,
                    'image' => "",
//                    'image' => asset('public/storage/'.$path),
                    "name" => "",
                    "updated_at" => "",
                    "size" => "",
//                    "size" => $this->getFileSize($path),
                    "original_path" => "",
//                    "original_path" => $path,
                    "public_path" => "",
                    "dimension" => "",
//                    "dimension" => $this->getImageDimension(asset('public/storage/'.$path)),
                    "m" => $media_data
                ];
                */
                $data["data"] = $media_data;


            } else {
                // Response
                $data['success'] = 0;
                $data['message'] = 'File not uploaded.';
            }

        } catch (\Exception $exception) {
            $data['success'] = 0;
            $data['message'] = $exception->getMessage();
        }
        return response()->json($data);
    }


    public function media_url($media)
    {
        try {
            if($file = Media::whereSlug($media)->first()){
                if (Storage::exists("public/".$file->original_path)) {
                    $imageContent = file_get_contents(asset('public/storage/'.$file->original_path));
                } else {
                    $imageContent = file_get_contents(config("media.empty_url"));
                }
            }else {
                $imageContent = file_get_contents(config("media.empty_url"));
            }
//            $file = str_replace('--', '/', $file);

            header("Content-type: image/png");
            echo $imageContent;
        } catch (FileNotFoundException $exception) {
            header("Content-type: image/png");
            $imageContent = file_get_contents(config("media.empty_url"));
            echo $imageContent;
        }

    }

    public function index() {
        $data = [];
        $all_medias = Media::latest('id')->get();
        foreach ($all_medias as $key => $media) {
            $media["updated"] = date("Y-m-d", strtotime($media->updated_at));
            $data[] = $media;
        }
        return $data;
    }

}
