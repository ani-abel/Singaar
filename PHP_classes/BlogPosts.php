<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 11/2/2018
 * Time: 7:20 AM
 */
require_once("initialize.php");

final class BlogPosts
{
    public static function getCommentsForAPost($post_id, $st_limit=0, $end_limit=15){
        return BlogWriter::getCommentsForAPost($post_id, $st_limit, $end_limit);
    }//End of method: getCommentsForAPost()

    public static function getABlogPost($post_id=0){
        global $db;
        $rs_arr = [];
        $query = SEL_ALL." blog_posts WHERE(post_id='{$post_id}') ORDER BY post_id DESC LIMIT 1";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            $rs_arr = $db->fetch_array($rs);
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getABlogPost()

    public static function getNextPost($current_post=0){
        $next_post_id = null;
        $current_index = 0;
        //check the location of $current_post in array
        $all_post_ids = static::getAllPostIds();
        $end_of_id_arr = count($all_post_ids) - 1;
        foreach($all_post_ids as $key=>$value){
            if($value == $current_post){
                $current_index = $key;
                break;
            }
        }
        return ( ($current_index + 1 !== $end_of_id_arr) ? $all_post_ids[$current_index + 1] : null);

    }//End of method: getNextPost()

    public static function getPreviousPost($current_post=0){
        $next_post_id = null;
        $current_index = 0;
        //check the location of $current_post in array
        $all_post_ids = static::getAllPostIds();
        foreach($all_post_ids as $key=>$value){
            if($value == $current_post){
                $current_index = $key;
                break;
            }
        }
        return ( ($current_index - 1 >= 0) ? $all_post_ids[$current_index - 1] : null);
    }//End of method: getPreviousPost()

    public static function getLatestPostsForHomePage(){
        global $db;
        $rs_arr = [];
        $query = SEL_ALL." blog_posts ORDER BY post_id DESC LIMIT 3";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row= $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "post_id"=>$row["post_id"],
                    "post_title"=>$row["post_title"],
                    "post_imgLg"=>$row["post_imgLg"],
                    "post_imgSm"=>$row["post_imgSm"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getLatestPostsForHomePage()

    private static function getAllPostIds(){
        global $db;
        $rs_arr = [];
        $query = "SELECT post_id FROM blog_posts";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) >0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr,  $row["post_id"]);
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }

    /**
     * @param $post_id | int
     * @param $comment | String
     * @param $comment_by | String
     * @param $image | array
     * @return void
     */
    public static function makeComment($post_id, $comment, $comment_by="anonymous", Array $image=null){
        global $db;
        $date_of_entry = time();
        $default_img_path = "";
        if( !($image == null) ){
            $default_image_types = array(
                "image/jpg",
                "image/png",
                "image/gif",
                "image/jpeg",
            );

            $comment_images = Mk_Uploads::uploadImage($image, $default_image_types,
                3000000,200, 100);
            $default_img_path = (!$comment_images == null) ?
                arrayToString($comment_images) : "../images/user_male.png";
        }
        else
            $default_img_path = "../images/user_male.png";

        //escape form values for inout into the DB
        $comment = $db->escape_value($comment);
        $comment_by = $db->escape_value($comment_by);
        $post_id = $db->escape_value($post_id);
        $default_img_path = $db->escape_value($default_img_path);

        $query = INS." blog_comments(cmt_by, cmt_img, cmt_body, post_id, date_of_entry)";
        $query .= "VALUES('{$comment_by}','{$default_img_path}','{$comment}','{$post_id}','{$date_of_entry}')";
        $rs = $db->query($query);
        //get the current total number of comments made
        $no_of_comments = static::getNoOfCommentsForPost($post_id) + 1;//add 1 to the current number
        $query2 = "UPDATE blog_posts SET no_of_comments='{$no_of_comments}' WHERE(post_id='{$post_id}')";//update 'blog_posts'
        $rs2 = $db->query($query2);
        if($rs && $rs2)
            die(
            output_success_message("Comment made")
            );

    }//End of method: makeComment()

    private static function getNoOfCommentsForPost($post_id=0){
        global $db;
        $result = 0;
        $query = "SELECT no_of_comments FROM blog_posts WHERE post_id='{$post_id}' ORDER BY post_id DESC LIMIT 1";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) >0){
            $result = $db->fetch_array($rs)["no_of_comments"];
        }
        return (int)$result;
    }//End of private method: getNoOfCommentsForPost()


    /**
     * @param $display_by
     * @return null | array
     * The parameters are either: 'popular' or 'oldest'
     */
    public static function getSideBarPosts($display_by="popular"){
        global $db;
        $rs_arr = [];
        $query = ($display_by=="popular") ?
            SEL_ALL." blog_posts ORDER BY no_of_comments DESC LIMIT 5":
            SEL_ALL." blog_posts ORDER BY post_id ASC LIMIT 5";
        $rs = $db->query($query);
        if($rs){
            if($db->num_rows($rs) > 0){
                while($row = $db->fetch_array($rs)){
                    array_push($rs_arr, array(
                        "post_id"=>$row["post_id"],
                        "post_title"=>$row["post_title"],
                        "post_imgLg"=>$row["post_imgLg"],
                        "post_imgSm"=>$row["post_imgSm"],
                        "date_of_entry"=>dateToString($row["date_of_entry"])
                    ));
                }
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getSideBarPosts()

    //get all blogPosts()
    public static function getAllPosts($category_id=2, $total_posts=10, $st_limit=0, $end_limit=10){
        global $db;

    }

}