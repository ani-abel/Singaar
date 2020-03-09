<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/12/2019
 * Time: 3:43 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $search_text = sanitizeLowercase($_POST["search_text"]);
    if(isset($search_text)){
        $search_results = Admin::getSearchedArtists($search_text);
        $result = "";

        if( !(empty($search_results) && $search_results==null) ){
            $no_of_results = count($search_results);
            $caption = ($no_of_results > 1 ? "{$no_of_results} search results" : "{$no_of_results} search result");
            $search_text = ucwords($search_text);
            $result .= "<p class=\"flow-text search-result-caption\">Showing {$caption} for:
                            <span class=\"blue-text text-darken-2\">{$search_text}</span>
                        </p>";
            $result .= "<table class=\"striped responsive-table\">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th></th>
                                    <th>Artist</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
            foreach($search_results as $key=>$value){
                $result .= "<tr>
                                    <td class='blue-text text-darken-3'>{$value["rank"]}</td>
                                    <td width='70'>
                                        <img src='{$value["profile_image"]}'
                                             style='width:40px;height:40px;margin-left:10px;'
                                             alt='{$value["username"]}' class='responsive-img circle'/>
                                    </td>
                                    <td class='text-capitalize'>{$value["username"]}</td>
                                    <td>
                                        <a href='#message-modal' class='btn blue lighten-2 open-msg-modal modal-trigger'>
                                            <input type='hidden' class='user-id' value='{$value["id"]}'>
                                            <i class=\"fa fa-comments-o\"></i>
                                            <span class=\"hide-on-small-only\">
                                                        Message
                                                    </span>
                                        </a>
                                    </td> <td>";

                if($value["isBlocked"]==1){
                    $result .= "<button type='submit' 
                                                data-user_id='{$value["id"]}'
                                                data-position='top'
                                                data-tooltip='Block'
                                                class='btn red darken-3 btn-floating tooltipped
                                                 waves-effect waves-ripple s-btn-submit ajax-block-user'>
                                            <i class='fa fa-lock'></i>
                                        </button>";
                }
                else{
                    $result .= "<button type='submit'
                                                    data-user_id='{$value["id"]}'
                                                    data-position='top'
                                                    data-tooltip='Unblock'
                                                    class='btn btn-floating tooltipped teal darken-1
                                                    waves-effect waves-ripple ajax-unblock-user'>
                                                <i class='fa fa-unlock'></i>
                                            </button>";
                }
                $result .= "</td></tr>";
            }
            $result .= "</tbody>
                        </table>";
        }
        else{
            echo "<div class=\"row\">
                            <div class=\"col s12 darken-2 center\">
                                <i class=\"fa fa-search fa-2x center-block\"></i>
                                <p class=\"flow-text\">
                                    NO SEARCH RESULTS WERE FOUND
                                </p>
                            </div>
                        </div>";
        }
        die($result);
    }
}