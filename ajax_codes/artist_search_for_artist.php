<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/25/2019
 * Time: 3:35 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $search_for = strtolower($_POST["search_for"]);

    if( isset($search_for) ){
        $result_array = Artists::searchForArtist($search_for);
        $no_of_search_results = count($result_array);
        $result_string = "";

        if($result_array == null || $no_of_search_results < 1){
            $result_string .= " <div class='collapsible-header active white'
                                 style='border-bottom: 1px solid #d5d5d5;'>
                                Search Results(0)
                            </div>
                            <div class='collapsible-body'>
                                <!--Default div if no results are found-->
                                <div class='row'>
                                    <div class='col s12 chat-selector-widget center' style='border-bottom:none;'>
                                        <p class='flow-text'>
                                            <i class='fa fa-trash'></i> No search results found...
                                        </p>
                                    </div>
                                </div></div>";
        }
        else{
            $result_string .= "<div class='collapsible-header active white'
                                 style='border-bottom: 1px solid #d5d5d5;'>
                                Search Results({$no_of_search_results})
                            </div>
                            <div class='collapsible-body'><ul class='collection no-padding'>";
            foreach($result_array as $key=>$value){
                $result_string .= "<li class='collection-item avatar'>
                                        <div>
                                            <img src='{$value["profile_image"]}'
                                                 class='avatar responsive-img circle' alt='{$value["username"]}'>
                                            <span class='title text-capitalize blue-text text-darken-1'>
                                                {$value["username"]}</span><br>";
                if(!Artists::isArtistAContact($value["user_id"])){
                    $result_string .= "<a href='' 
class='text-darken-3 blue-text add-to-contact-ajax' data-user_id='{$value["user_id"]}'>
                                                <i class='fa fa-plus'></i> Add to contacts</a>";
                }
                $result_string .= "</div>";
            }
            $result_string .= "</ul></div>";
        }
        echo $result_string;
    }
}