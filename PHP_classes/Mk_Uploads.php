<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/27/2019
 * Time: 12:34 PM
 */
require_once("initialize.php");

final class Mk_Uploads
{
    private static function validateFile(Array $image, Array $validFileTypes, $default_size=5000000){
        $rs = false;
        if( !($image == null || empty($image["name"])) ){
            if($image["error"] == 0){
                if(in_array($image["type"], $validFileTypes)){
                    if($image["size"] <= $default_size)
                        $rs = true;
                    else
                        throw new Exception(
                            output_err_message("File exceeds the required size of: ".(($default_size/100)/100)."mb" )
                        );
                }
                else
                    throw new Exception(
                        output_err_message("Invalid file type. Valid types are: ".arrayToString($validFileTypes))
                    );
            }
            else
                throw new Exception(
                    output_err_message("An error occurred")
                );
        }
        return $rs;
    }//End of method: validateFile()

    public static function uploadImage(Array $image, Array $validFileTypes, $default_size=5000000,
                                       $thumbnail_height=0, $thumbnail_width=0, $copies=false){
        $paths = [];
        try{
            if( !($image == null || empty($image["name"])) ){
                if(static::validateFile($image, $validFileTypes, $default_size)){
                    $image_type = $image["type"];
                    $image_tmp_path = $image["tmp_name"];
                    static::make__DIR__($image_type);//make the '../uploads' __DIR__ if it doesn't exist
                    $base_file_path = "../uploads/images/";
                    //make a unique name for the uploaded image
                    $video_ext = strtolower(end(explode("/", $image_type)));
                    $new_img_name = strtolower("image__".time());
                    $new_path = basename("{$new_img_name}.{$video_ext}");
                    $cmp_base_file_path = "{$base_file_path}".basename($new_path);

                    //move the uploaded file to the permanent __DIR__
                    move_uploaded_file($image_tmp_path, $cmp_base_file_path);

                    //add the file path to the 'paths' array
                    if(!in_array( $cmp_base_file_path, $paths ) )
                        array_push($paths, $cmp_base_file_path);

                    if( ($thumbnail_width > 0 && $thumbnail_height > 0) ){
                        $imageObject = new imageLib($cmp_base_file_path);
                        $imageObject->resizeImage($thumbnail_width, $thumbnail_height);
                        $imageObject->saveImage($cmp_base_file_path, 100);

                        if($copies){
                            $mini_path = "../uploads/images/medium";
                            if(!file_exists($mini_path))
                                mkdir($mini_path);

                            //divide the thumbnail width when necessary (when the dimensions are greater than 100)
                            $thumbnail_height = ($thumbnail_height > 100 ? $thumbnail_height /2 : $thumbnail_height);
                            $thumbnail_width = ($thumbnail_width > 100 ? $thumbnail_width /2 : $thumbnail_width);

                            $full_path= "{$mini_path}/".basename($cmp_base_file_path);
                            $imageObject2 = clone $imageObject;
                            if($thumbnail_width > 100 || $thumbnail_height > 100)
                                $imageObject2->resizeImage($thumbnail_width, $thumbnail_height);
                            $imageObject2->saveImage($full_path, 100);

                            if(!in_array( $full_path, $paths ) )
                                array_push($paths, $full_path);
                        }
                    }

                }
            }
        }
        catch(Exception $exception){
            die(
                $exception->getMessage()
            );
        }
        finally{
            return ($paths == null ? null : $paths);
        }
    }//End of method: uploadImage()

    /**
     * @param $audio_file | Array
     * @param $valid_file_types | Array
     * @param $default_file_size | int
     * @return String | null
     * Default size for a song is 3mb
    */
    public static function uploadAudio(Array $audio_file, Array $valid_file_types, $default_file_size=3000000){
        try{
            $final_file_path = "";
            if( !($audio_file == null || empty($audio_file["name"])) ){
                if(static::validateFile($audio_file, $valid_file_types, $default_file_size)){
                    $audio_type = $audio_file["type"];
                    $audio_tmp_path = $audio_file["tmp_name"];
                    static::make__DIR__($audio_type);//make the '../uploads' __DIR__ if it doesn't exist
                    $base_file_path = "../uploads/audios/";
                    //make a unique name for the uploaded image
                    $audio_ext = strtolower(end(explode("/", $audio_type)));
                    $new_audio_name = strtolower("audio__".time());
                    $new_path = basename("{$new_audio_name}.{$audio_ext}");
                    $final_file_path = "{$base_file_path}".basename($new_path);
                    //move the uploaded file to the permanent __DIR__
                    move_uploaded_file($audio_tmp_path, $final_file_path);
                }
            }
        }
        catch(Exception $exception){
            die(
                $exception->getMessage()
            );
        }
        finally{
            return (!empty($final_file_path) ? (String)$final_file_path : null);
        }

    }//End of method: uploadAudio()

    /**
     * @param $video_file | Array
     * @param $valid_file_types | Array
     * @param $default_file_size | int
     * @return String | null
     * default video size is: 8mb
    */
    public static function uploadVideo(Array $video_file, Array $valid_file_types, $default_file_size=8000000){
        try{
            $final_file_path = "";
            if( !($video_file == null || empty($video_file["name"])) ){
                if(static::validateFile($video_file, $valid_file_types, $default_file_size)){
                    $video_type = $video_file["type"];
                    $video_tmp_path = $video_file["tmp_name"];
                    static::make__DIR__($video_type);//make the '../uploads' __DIR__ if it doesn't exist
                    $base_file_path = "../uploads/videos/";
                    //make a unique name for the uploaded image
                    $audio_ext = strtolower(end(explode("/", $video_type)));
                    $new_video_name = strtolower("video__".time());
                    $new_path = basename("{$new_video_name}.{$audio_ext}");
                    $final_file_path = "{$base_file_path}".basename($new_path);
                    //move the uploaded file to the permanent __DIR__
                    move_uploaded_file($video_tmp_path, $final_file_path);
                }
            }
        }
        catch(Exception $exception){
            die(
            $exception->getMessage()
            );
        }
        finally{
            return (!empty($final_file_path) ? (String)$final_file_path : null);
        }
    }//End of method: uploadVideo()

    private static function make__DIR__( $fileType="" ){
        if(!file_exists("../uploads")){
            mkdir("../uploads");
        }
        if(preg_match("/^audio/i", $fileType)){
            if(!file_exists("../uploads/audio")){
                mkdir("../uploads/audio");
            }
        }
        else if(preg_match("/^video/i", $fileType)){
            if(!file_exists("../uploads/video")){
                mkdir("../uploads/audio");
            }
        }
        else if(preg_match("/^image/i", $fileType)){
            if(!file_exists("../uploads/images")){
                mkdir("../uploads/images");
            }
        }
    }//End of Method make__DIR__()

}//End of class: Mk_Uploads