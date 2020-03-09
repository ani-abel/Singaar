<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/27/2019
 * Time: 7:07 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $msg_to = $_POST["msg_to"];
    $username = Admin::getUserName($msg_to);
    $user_f_name = getArtistFirstName($username);
    $result_string = "";

    if( isset($msg_to) ){
        $messages_array = Artists::getArtistChats($msg_to);

        if( ($messages_array == null || count($messages_array) < 1) ){
            $result_string .= "<!--Section: default-text(displayed if no chat-messages exist between users)-->
                    <div class=\"col s12 default-text grey-text center text-darken-1\">
                        <i class=\"fa fa-comments-o blue-text text-darken-2 fa-5x\"></i>
                        <p class=\"flow-text\">No messages with <span class=\"blue-text\">
                                                            {$user_f_name}
                                                        </span></p>
                    </div>";
        }
        else{
            foreach($messages_array as $key=>$value){
                $msg = (preg_match("/\. /i", $value["msg"]))
                    ?ucwords($value["msg"], ". "):ucwords($value["msg"], ".");

                if(!$value["isMessageFromMe"]){
                    $msg = ucwords($value["msg"],".");
                    $result_string .= "                            <div class=\"col s12 chat-widget-con\">
                            <span class=\"left deep-orange white-text darken-2 chat-widget\">
                                {$msg}
                                <br>
                                <span class=\"grey-text text-lighten-2 inner-span\">
                                    <span class=\"grey-text text-lighten-3 text-capitalize\">
                                        {$username}
                                    </span>: {$value["date_of_entry"]}
                                </span>
                            </span>
                            </div>";
                }
                else{
                    $result_string .= "<div class=\"col s12 chat-widget-con\">
                            <span class=\"right blue darken-2 white-text chat-widget\">
                                {$msg}
                                <br>
                                <span class=\"grey-text text-lighten-2 inner-span\">
                                    <span class=\"grey-text text-lighten-3\">Me</span> : {$value["date_of_entry"]}
                                </span>
                            </span>
                            </div>";
                }
            }
        }

    }
    echo $result_string;
}