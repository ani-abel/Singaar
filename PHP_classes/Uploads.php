<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 11/2/2018
 * Time: 7:19 AM
 */
abstract class Uploads
{
    /**
     * @var integer
     * This field holds the total number of files uploaded at a time
    */
    private $totalFilesToUpload = 0;

    /**
     * @var boolean
     * This field holds the valid | not valid state of the last attempted upload
    */
    private $isFileValid = false;


    /**
     * @param $file
     * @param $validImageTypes
     * @param $defaultSize
     * @param $copies
     * @param $imageHeight
     * @param $imageWidth
     * @param $writeTo
     * @return String[]
    */
    protected function uploadSingleImage( Array $file, Array $validImageTypes=null,
                                          $defaultSize = 0, $writeTo="",$copies=false,$imageWidth=0, $imageHeight=0 ){
        $writeTo = $this->reWritePath($writeTo);
        $fileName= $file["name"];
        $fileType = $file["type"];
        $this->make__DIR__( $fileType );//make the necessary __DIR__
        $result = [];
        try{
            if( $this->validateFile($file, $validImageTypes, $defaultSize) ){//check to see if the image file is active
                if(file_exists("../uploads/images/".$fileName))
                    throw new Exception(
                        output_err_message("This file already exists in the requested Directory.<br>Hint: Try renaming the file") );
                else{
                    $filePath = $writeTo.basename($fileName);
                    move_uploaded_file($file["tmp_name"], $filePath);
                    ++$this->totalFilesToUpload;
                    if( !in_array($filePath, $result) ) array_push($result, $filePath);

                    if(isset($imageHeight, $imageWidth) && ($imageHeight >0 && $imageWidth >0)){
                        $imageObject = new imageLib($filePath);
                        $imageObject->resizeImage($imageWidth, $imageHeight);
                        $imageObject->saveImage($filePath, 100);

                        if( $copies ){
                            $miniPath = "../uploads/images/medium/";
                            $full_path= $miniPath.basename($filePath);
                            if( !file_exists( $miniPath ) )
                                mkdir( $miniPath );
                            $imageObject2 = clone $imageObject;
                            $imageObject2->resizeImage($imageWidth/2, $imageHeight/2);
                            $imageObject2->saveImage($full_path, 100);
                            if(!in_array( $miniPath, $result ) )array_push($result, $full_path);
                        }
                    }
                }
            }
            else throw new Exception(
                output_err_message("Image could not be validated")
            );
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
        return (Array)$result;
    }//End of method uploadSingleImage()


    /**
     * @param $multiFile
     * @param $validImageTypes
     * @param $defaultSize
     * @param $writeTo
     * @param $copies
     * @param $imageWidth
     * @param $imageHeight
     * @throws Exception
     * @return String[]
    */
    protected function uploadMultipleImages( Array $multiFile, Array $validImageTypes=null,
                                            $defaultSize = 0, $writeTo="", $copies=false, $imageWidth=0, $imageHeight=0 ){
        $multiDimensionalArr = [];
        try{
            $writeTo = $this->reWritePath( $writeTo );
            for( $i=0; $i < count($multiFile); $i++ ){
                if($this->validateFile($multiFile[$i], $validImageTypes, $defaultSize)){
                    //upload each of the files to their respective __DIR__
                    $res = $this->uploadSingleImage($multiFile[$i], $validImageTypes,
                        $defaultSize, $writeTo, $copies, $imageWidth, $imageHeight);
                    if(!in_array( $res, $multiDimensionalArr ) ) array_push( $multiDimensionalArr, $res );
                }
                else{
                    throw new Exception(
                        output_err_message("File: ".$multiFile[$i]["name"]." is Invalid")
                    );
                    break;
                }
            }
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
        return (Array)$multiDimensionalArr;
    }//End of method uploadMultipleImages()

    /**
     * This method is used to upload pdf file online,
     * returns the write able path to be entered in the DB
     * @param $file
     * @param $writeTo
     * @param $validPdfTypes
     * @param $defaultSize
     * @return String
     * @throws Exception
    */
    protected function uploadPdfAudioVideo( Array $file, Array $validPdfTypes, $defaultSize, $writeTo ){
        $writeTo = $this->reWritePath($writeTo);//make sure writeTo has the required '/' DIRECTORY_SEPARATOR
        $result = "";
        $this->make__DIR__( $file["type"] );//make the necessary __DIR__
       try{
           if($this->validateFile($file, $validPdfTypes, $defaultSize)){//if file is validated: Continue
               $fileName = $file["name"];
               $tmpPath = $file["tmp_name"];

               if(file_exists($writeTo.$fileName))//check to see if the file already exists in the requested writeTo __DIR__
                   throw new Exception(
                       output_err_message("This file already exists in the requested Directory.<br>Hint: Try renaming the file"));
               else{//Continue with upload operations
                   $filePath = $writeTo.basename($fileName);
                   $result = $filePath;
                   ++$this->totalFilesToUpload;//add '1' to the total number of file to upload
                   move_uploaded_file($tmpPath, $filePath);//move the file from temp_path to a new Destination __DIR__
               }
           }
       }
       catch(Exception $exception){
           echo $exception->getMessage();
        }
       /**
        * @TODO: make sure that the writeTo Path is correct 'relative' to the file you are working on
       */
        return (String)$result;//returns the path the user entered in the first place
    }//End of method uploadPdf()

    /**
     * This method is used to upload pdf file online,
     * returns the write able path to be entered in the DB
     * @param $file
     * @param $writeTo
     * @param $validPdfTypes
     * @param $defaultSize
     * @return String[]
     * @throws Exception
     */
    protected function uploadMultiplePdfAudioVideo( Array $file, Array $validPdfTypes, $defaultSize, $writeTo ){
        $resultArr = [];
        try{
            for($i = 0; $i < count($file); $i++){
                $this->make__DIR__( $file[$i]["type"] );//make the necessary __DIR__

                //validate the files individually first; Else break loop;
                if($this->validateFile($file[$i], $validPdfTypes, $defaultSize)){
                    //if This the current File is valid, it runs the method that uploads the file to the folder
                    $currentPath = $this->uploadPdfAudioVideo($file[$i], $validPdfTypes, $defaultSize, $writeTo);
                    //push the $paths returned by method: uploadPdfAudioVideo() into the $resultArr[]
                    if( !in_array($currentPath, $resultArr) ) array_push( $resultArr, $currentPath );
                }
                else{
                    throw new Exception( output_err_message("File: ".$file[$i]["name"]." is Invalid") );
                    break;
                }
            }
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
        return (Array)$resultArr;
    }//End of method uploadMultiplePdfAudioVideo()

    /**
     * @param $file
     * @param $validTypes
     * @param $defaultSize:This parameter must be in bytes E.g 50000
     * @throws Exception
     * @return boolean
     * This method makes sure that the uploaded file is valid & matches all the criteria on:
     * 1. Specified file type
     * 2. Default file size
    */
    protected function validateFile(Array $file, Array $validTypes, $defaultSize){
        try{
            if(!($file==null)){
                if($file["error"] == 0){//make sure the file does not have an error

                    if( in_array(strtolower($file["type"]), $validTypes) ){//check to see if the file type is valid
                        if( !($file["size"] > $defaultSize) )
                            $this->isFileValid = true;//return the boolean which states that the file is valid
                        else{
                            throw new Exception(
                                output_err_message("This file exceeds the specified limit of ".round($defaultSize/1024)."KB") );
                        }
                    }
                    else {
                        $stringifyArr = "";
                        foreach( $validTypes as $key=>$value ){
                            $type = explode("/", $value)[1];//get the last value in fileType. E.g from image/png, get 'png'
                            $stringifyArr .= "<br>&raquo; ".$type."<br>";
                        }
                        throw new Exception(
                            output_err_message("Invalid file type.<br>Accepted file types include: ".$stringifyArr));
                    }
                }
                else throw new Exception(
                    output_err_message("An error occurred while uploading file<br>HINT: Try uploading another file"));
            }
        }
        catch (Exception $exception){
            echo $exception->getMessage();
        }
        return (boolean)$this->isFileValid;
    }//End of method validateFile()

    /**
     * @param $path
     * @return String
     * This method makes sure the file Path has a DIRECTORY_SEPARATOR appended to it
    */
    protected function reWritePath($path){
        return (preg_match("/\/$/i", $path)) ? $path : $path."/";
    }//End of method reWritePath()

    protected function getTotalFilesToUpload(){
        return (int)$this->totalFilesToUpload;
    }//End of method getTotalFilesToUpload

    protected function getIsFileValid(){
        return $this->isFileValid;
    }//End of method getIsFileValid()

    /**
     * @param $fileType
    */
    private function make__DIR__( $fileType="" ){
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

}//End of abstract class Uploads