<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/25/2019
 * Time: 6:02 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $search_for = strtolower($_POST["search_for"]);

    if( isset($search_for) ){
        $result_string = "";
        $result_array = Artists::searchForContact($search_for);
        $no_of_search_results = count($result_array);

        if( ($result_array == null || $no_of_search_results < 1) ){
            $result_string .= "<div class=\"collapsible-header active white\"
                                 style=\"border-bottom: 1px solid #d5d5d5;\">
                                Search Results(0)
                            </div>
                            <div class=\"collapsible-body\">
                                <!--Default div if no results are found-->
                                <div class=\"row\">
                                    <div class=\"col s12 chat-selector-widget center\" style='border-bottom: none;'>
                                        <p class=\"flow-text\">
                                            <i class=\"fa fa-trash\"></i> No search results found...
                                        </p>
                                    </div>
                                </div></div>";
        }
        else{
            $result_string .= "<div class=\"collapsible-header active white\"
                                 style=\"border-bottom: 1px solid #d5d5d5;\">
                                Search Results({$no_of_search_results})
                            </div>
                            <div class=\"collapsible-body\"><ul class=\"collection no-padding\">";

            foreach($result_array as $key=>$value){
                $result_string .= "<li class=\"collection-item avatar\">
                                        <div>
                                            <img src=\"{$value["profile_image"]}\"
                                                 class=\"avatar responsive-img circle\" alt=\"{$value["username"]}\">
                                            <span class=\"title text-capitalize blue-text text-darken-1\">
                                                {$value["username"]}</span><br>";
                if($value["isActive"]){
                    $result_string .= "<span class=\"green-text text-darken-1 text-capitalize\">Online</span><br>";
                }
                else {
                    $result_string .= "<span class=\"red-text text-darken-1 text-capitalize\">Offline</span><br>";
                }

                if(Artists::isArtistAContact($value["user_id"])){
                    $result_string .= "<a href='' class='blue-text text-darken-3 remove-from-contact-ajax' data-user_id='{$value["user_id"]}'>
                                                <i class='fa fa-times'></i> Remove from contacts</a>";
                }
                $f_name = getArtistFirstName($value["username"]);
                $result_string .= "<a href='' class='secondary-content choose-chat-buddy-ajax btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped'
                                               data-position='top'
                                               data-tooltip='Chat'
                                               data-user_id='{$value["user_id"]}'
                                               data-profile_image='{$value["profile_image"]}'
                                               data-first_name='{$f_name}'
                                               data-user_name='{$value["username"]}'>
                                                <i class='fa fa-chevron-right'></i>
                                            </a></div></li>";
            }
            $result_string .= "</ul></div>";
        }

        echo $result_string;
    }
}