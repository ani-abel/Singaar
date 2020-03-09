<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 3/1/2019
 * Time: 8:13 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $no_of_contacts = (Artists::getContacts() == null ? 0 : number_format(count(Artists::getContacts())));
    $contacts_array = Artists::getContacts();
    $result_string = "";

    if( ($contacts_array == null || count($contacts_array) < 1) ){
        $result_string .= "<div class=\"row\">
                                    <div class=\"col s12 chat-selector-widget center\">
                                        <p class=\"flow-text\">
                                            <i class=\"fa fa-trash\"></i> No contacts found...
                                        </p>
                                    </div>
                                </div>";
    }
    else {
        $result_string .= "<ul class=\"collection no-padding\">";
        foreach($contacts_array as $key=>$value){
            $result_string .= "<li class=\"collection-item avatar\">
                                        <div>
                                            <img src=\"{$value["profile_imgSm"]}\"
                                                 class=\"avatar responsive-img circle\" alt='{$value["username"]}'>
                                            <span class=\"title text-capitalize blue-text text-darken-1\">
                                                {$value["username"]}</span><br>";
            if(!$value["isActive"]){
                $result_string .= "<span class=\"red-text text-darken-1 text-capitalize\">Offline</span><br>";
            }
            else {
                $result_string .= "<span class=\"green-text text-darken-1 text-capitalize\">Online</span><br>";
            }
            if(Artists::isArtistAContact($value["id"])){
                $result_string .= "<a href='' class='blue-text text-darken-3 remove-from-contact-ajax'>
                                                <input data-user_id='{$value["id"]}' type='hidden' class='remove-user_id'
                                                      />
                                                <i class=\"fa fa-times\"></i> Remove from contacts</a>";
            }
            $f_name = getArtistFirstName($value["username"]);
            $result_string .= "<a href='' class='secondary-content btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped choose-chat-buddy-ajax'
                                            data-user_id='{$value["id"]}'
                                            data-user_name='{$value["username"]}'
                                            data-profile_image='{$value["profile_imgSm"]}'
                                            data-user_first_name='{$f_name}'
                                               data-position='top'
                                               data-tooltip='Chat'><i class='fa fa-chevron-right'></i>
                                            </a>
                                        </div>
                                    </li>";
        }
        $result_string .="</ul>";
    }
    echo $result_string;
}