<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 11/1/2018
 * Time: 7:11 AM
 */
final class Audio extends YoutubeOps
{
    /**
     * This class uses the methods from the
     * @class YoutubeOps class, to:
     * 1. get the uploaded audio from youtube(Catches and handles the data stream from youtube)
     * 2. have its own methods for displaying the audio to the html page
     * 3. have methods to count the total audio from youtube
     * 4. save the video details to our mySql DB
    */

    /*
     *This field holds an object of the MySQLDatabase class for carrying out DB related operations
    */
    private $db;

    public function __construct()
    {
        $db = new MySQLDatabase();//instantiate MySQLDatabase class
    }


}