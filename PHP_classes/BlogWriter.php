<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/13/2019
 * Time: 9:26 PM
 */
require_once("initialize.php");

final class BlogWriter extends DatabaseObject
{

    /**
     * @param $post_title | String
     * @param $post_category | int (must be either 1 or 2)
     * @param $post_body | String
     * @param $featured_img | Array
     * This method adds a post to the DB
    */
    public static function addBlogPost($post_title, $post_category=2, $post_body,Array $featured_img=null){
        try{
            global $db;
            global $session;
            $uploaded_by = $session->user_id;//uploaded by
            //$date_of_entry = strip_zero_from_date(strftime("*%d-*%m-%Y, %H:%I:%S", time()));
            $upload_timestamp = time();

            //make sure similar post does not exist
            $query1 = SEL_ALL." blog_posts WHERE(post_title='{$post_title}') ORDER BY post_id DESC";
            $rs = $db->query($query1);
            if($db->num_rows($rs) > 0){
                throw new Exception(
                  output_err_message("Similar Post already exists")
                );
            }
            else{
                $image_string = "";
                if(!$featured_img == null) {
                    //upload the featured image(add image url | upload an image)
                    $default_image_types = array(
                        "image/jpg",
                        "image/png",
                        "image/gif",
                        "image/jpeg",
                    );
                    //method for uploading an image
                    $post_images = Mk_Uploads::uploadImage($featured_img, $default_image_types,
                        3000000,500, 1000,true);
                    $image_string = (!$post_images == null) ? $image_string = arrayToString($post_images):
                        "../images/microphone-1102739_1920.jpg";
                }
                else
                    //if no featured image exists, set a default image
                    $image_string = "../images/microphone-1102739_1920.jpg";

                //exit($image_string);
                //send the received data to the DB
                $img_string_Arr = explode(",", $image_string);
                $img_string_lg = $img_string_Arr[0];
                $img_string_sm = @($img_string_Arr[1] == null ? " " : $img_string_Arr[1]);

                //sanitize values for insertion to the DB
                $post_body = $db->escape_value($post_body);
                $post_title = $db->escape_value($post_title);
                $img_string_sm = $db->escape_value($img_string_sm);
                $img_string_lg = $db->escape_value($img_string_lg);
                $post_category = $db->escape_value($post_category);

                $query = INS." blog_posts(post_title, post_body, post_imgLg, post_imgSm, date_of_entry,";
                $query .= "written_by, category_id)";
                $query .= "VALUES('{$post_title}', '{$post_body}', '{$img_string_lg}','{$img_string_sm}',";
                $query .= "'{$upload_timestamp}','{$uploaded_by}','{$post_category}')";

                $rs = $db->query($query);
                if($rs)
                    die(
                        output_success_message("Post added successfully")
                    );
            }
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
    }//End of method: addBlogPost()


    /**
     * @param $blogTitle | String
     * @param $postCategory | int (must be either 1 or 2)
     * @param $post | String
     * @param $post_id | int
     * This method adds a post to the DB
     */
    public static function updateBlogPost($blogTitle, $postCategory=2, $post, $post_id=0){
        try{
            global $db;
            $date_of_entry = strip_zero_from_date(strftime("*%d-*%m-%Y, %H:%I:%S", time()));
            $upload_timestamp = time();

        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
        finally{

        }

    }//End of method: updateBlogPost()

    public static function addArtistInterview(Array $interviewVideo, $artistName, $month, $intro_text=""){
        try{
            global $session;
            global $db;
            $date_of_entry = time();
            $yr = strftime("%Y");

            //make sure that artist, blogger adds name exists
            if( static::verifyIfUserExists($artistName) ){
                $id = static::getUserIdBasedOnUsername($artistName);
                if( !($id == null) ){
                    $artist_id = static::getUserIdBasedOnUsername($artistName);//$user_id to be inserted into the DB
                    //set the link to the artist's public page after the artist is verified as an active user
                    $public_pgLink = "http://{$_SERVER['HTTP_HOST']}/singaar.com/artist_account/public_page.php?";
                    $public_pgLink .= "artist=".base64_encode($artist_id);
                    /**
                     * make sure that the user only uploads an interview
                     * for a month that has not been added else warn them
                    */
                    if(!static::verifyIfInterviewForMonthAlreadyExists($month)){
                        if(static::verifyIfUserIsAnArtist($id)){
                            $video_link = static::uploadVideo($interviewVideo, $month);
                            //clean up values b/4 DB insertion
                            $intro_text = $db->escape_value($intro_text);
                            $public_pgLink = $db->escape_value($public_pgLink);
                            $video_link = $db->escape_value($video_link);

                            $query = INS." interviews(month_of, year, video_link, video_text, date_of_entry,";
                            $query .= "artist_id, uploaded_by, public_page_url)";
                            $query .= "VALUES('{$month}','{$yr}','{$video_link}','{$intro_text}',";
                            $query .= "'{$date_of_entry}','{$artist_id}','{$session->user_id}', '{$public_pgLink}')";
                            $rs = $db->query($query);

                            if($rs)
                                die(
                                output_success_message("Interview for '{$month}' added successfully")
                                );
                        }
                        else throw new Exception(
                            output_err_message("'{$artistName}' is either blocked or is not an artist")
                        );
                    }
                    else throw new Exception(
                        output_err_message("Interview for '{$month}' already exists.Select another month")
                    );
                }
            }
            else throw new Exception(
                output_err_message("'{$artistName}' is either incorrect, isn't registered or blocked")
            );
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }

    }//End of method: addArtistInterview()


    /**
     * @param $user | int | String
     * @return boolean
    */
    public static function verifyIfUserExists($user){
        $query1= SEL_ALL." users WHERE(id='{$user}' AND isBlocked=1) LIMIT 1";
        $query2 = SEL_ALL." users WHERE(username='{$user}' AND isBlocked=1) LIMIT 1";
        $sql = ( is_int($user) ? $query1 : $query2);
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }//End of method: verifyIfUserExists()

    /**
     * @param $month | String
     * @return boolean
    */
    public static function verifyIfInterviewForMonthAlreadyExists($month=""){
        $yr = strftime("%Y");
        $sql = SEL_ALL." interviews WHERE(month_of='{$month}' AND year='{$yr}')";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }//End of method: verifyIfInterviewForMonthAlreadyExists()

    private static function verifyIfUserIsAnArtist($user_id=0){
        $sql = SEL_ALL." users WHERE(id='{$user_id}' AND isBlocked='1' AND role=1)";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    /**
     * @param $username
     * @return int
    */
    public static function getUserIdBasedOnUsername($username=""){
        global $db;
        $id = 0;
        $query = "SELECT id,username FROM users WHERE(username='{$username}') LIMIT 1";
        $rs = $db->query($query);
        if($rs){
            $row = $db->fetch_array($rs);
            $id = $row['id'];
        }
        return (($id == 0) ? null : $id);
    }//End of method: getUserIdBasedOnUsername()

    /**
     * @param $username | String
     * @param $password | String
     * @param $email | String
     * @throws Exception
    */
    public static function editProfile($username="", $password="",$email=""){
        try{
            global $db; global $session;
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){//check to see if the email is valid
                //check password pattern to see if it matches
                if(preg_match(PASSWORD_PATTERN, $password)){
                    $password = Login::encryptPassword($password);
                    //clean-up values oe DB input
                    $username = $db->escape_value($username);
                    $password = $db->escape_value($password);
                    $email = $db->escape_value($email);
                    //construct sql query
                    $query = "UPDATE users SET username='{$username}', password='{$password}',";
                    $query .= "email='{$email}' WHERE(id='{$session->user_id}')";
                    $rs = $db->query($query);
                    if($rs)
                        die(
                            output_success_message("Profile info has been changed")
                        );
                }
                else throw new Exception(
                    output_err_message("Password must contain at least 3
                               lowercase letters,1 number & 2 uppercase letters")
                );
            }
            else throw new Exception(
                output_err_message("Invalid email address")
            );
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
    }//End of method editProfile()

    /**
     * @return array
     * This method gets the user details from the DB, it can be manipulated or just outputted
     *
    */
    public static function getBloggerInfo(){
        global $session;
        return User::getAllUserDetails($session->user_id)[0];
    }//End of method: getBloggerInfo()

    /**
     * @return int
    */
    public static function getNumberOfAllArtists(){
        global $db;
        $result = 0;
        $query = SEL_ALL." users WHERE(role=1 AND isBlocked=1) ORDER BY id DESC";
        $rs = $db->query($query);
        if($rs)
            $result = $db->num_rows($rs);
        return (int)number_format($result);
    }//End of method: getNumberOfAllArtists()

    /**
     * @return int
     */
    public static function getNumberOfAllComments(){
        global $db;
        global $session;
        $result = 0;
        //get all the post_id of posts made by the currently logged-in blog writer
        $query = "SELECT post_id FROM blog_posts WHERE(written_by='{$session->user_id}')";
        $rs = $db->query($query);
        if($rs){
            $post_id_arrays = [];
            while($row = $db->fetch_array($rs)){
                $post_id = $row['post_id'];
                if(!in_array($post_id, $post_id_arrays))
                    array_push($post_id_arrays, $post_id);
            }//End while-loop

            //loop through & count the comments for each-post made by this user
            foreach($post_id_arrays as $key=>$value){
                $query = SEL_ALL." blog_comments WHERE(post_id='{$value}')";
                $rs = $db->query($query);
                if($rs){
                    $result += $db->num_rows($rs);
                }
            }
        }
        return (int)number_format($result);
    }//End of method: getNumberOfAllComments()

    /**
     * @return int
     */
    public static function getNumberOfPostsMade(){
        global $db;
        global $session;
        $result = 0;
        $query = SEL_ALL." blog_posts WHERE(written_by='{$session->user_id}') ORDER BY post_id DESC";
        $rs = $db->query($query);
        if($rs){
            $result = $db->num_rows($rs);
        }
        return (int)number_format($result);
    }//End of method: getNumberOfPostsMade()


    /**
     * @param $videoFile | array
     * @param $month_of | String
     * @throws Exception
     * @return String
    */
    public static function uploadVideo(Array $videoFile, $month_of=""){
        try{
            $path = "";
            //get the video properties
            $video_name = $videoFile["name"];
            $videoType = $videoFile["type"];
            $videoTmpPath = $videoFile["tmp_name"];
            $videoSize = $videoFile["size"];

            //check for any errors
            if($videoFile["error"] == 0){
                //check for video size
                if($videoSize < DEFAULT_VIDEO_SIZE){
                    //check for video type validity
                    if(preg_match(VALID_VIDEO_TYPES_PATTERN, $video_name)){
                        //make a _DIR_ for the interviews uploaded
                        $interviewVideoDir = "../uploads/interviews";
                        if(!file_exists($interviewVideoDir))
                            mkdir($interviewVideoDir);

                        //format a new video name for the file. E.G: december__2019.mp4
                        $yr = strftime("%Y");
                        $video_ext = strtolower(end(explode("/", $videoType)));
                        $month_of = strtolower("{$month_of}_".rand(8, 20));
                        $new_path = basename("{$month_of}__{$yr}.{$video_ext}");
                        $full_videoPath = "{$interviewVideoDir}/{$new_path}";

                        //move from tmp_path to new path
                        if(move_uploaded_file($videoTmpPath, $full_videoPath))
                            $path = $full_videoPath;

                        else throw new Exception(
                            output_err_message("An error occurred while uploading the file")
                        );
                    }
                    else throw new Exception(
                        output_err_message("Invalid video type. valid types include: "
                            .serializedArrayToString(VALID_VIDEO_TYPES))
                    );
                }
                else throw new Exception(
                    output_err_message("The video is larger than ".((DEFAULT_VIDEO_SIZE/1000)/1000)."mb")
                );
            }
            else throw new Exception(
                output_err_message("An unknown error occurred while uploading file")
            );
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
        return $path;
    }//End of method: uploadVideo()

    /**
     * @param $get_all
     * @return array
    */
    public static function getAllPostsByThisWriter($get_all=true){
        global $db;
        global $session;
        $user_id = $session->user_id;//get the id of the currently logged in blog writer
        $rs_array = [];
        $query = "SELECT *, blog_categories.category FROM blog_posts INNER JOIN blog_categories USING(category_id) ";
        $query .= "WHERE(blog_posts.written_by='{$user_id}') ORDER BY blog_posts.post_id DESC";
        $query .= ($get_all) ? "" : " LIMIT 5";
        $rs = $db->query($query);
        if($rs){
            if($db->num_rows($rs) > 0){
                while($row = $db->fetch_array($rs)){
                    array_push($rs_array, array(
                        "post_id" => $row['post_id'],
                        "feature_imgLg" => $row['post_imgLg'],
                        "feature_imgSm" => $row['post_imgSm'],
                        "post_title" => $row['post_title'],
                        "post_body" => $row['post_body'],
                        "category" => $row['category'],
                        "date_of_entry" => $row['date_of_entry'],
                        "no_of_comments" => $row['no_of_comments'],
                        "written_by" => $row['written_by']
                    ));
                }
            }
        }
        return (array)$rs_array;
    }//End of method getAllPostsByThisWriter()

    public static function getAPost($post_id=0){
        global $db;
        $row = [];
        $query = SEL_ALL." blog_posts WHERE(post_id='{$post_id}') ORDER BY post_id DESC LIMIT 1";
        $rs = $db->query($query);
        if($rs){
            if($db->num_rows($rs) > 0){
                $row = $db->fetch_array($rs);
            }
        }
        return $row;
    }

    public static function deleteAPost($post_id){
        global $db;
        $query = "DELETE FROM blog_posts WHERE(post_id='{$post_id}')";
        $query2 = "DELETE FROM blog_comments WHERE(post_id='{$post_id}')";

        $rs1 = $db->query($query);
        $rs2 = $db->query($query2);
        if($rs1 && $rs2){
            die(
                output_success_message("Post Deleted")
            );
        }
    }//End of method: deleteAPost()

    public static function updateAPost($post_title, $post_body, $post_category, $post_id){
        global $db;
        //escape values b/4 inputting them in the DB
        $post_title = $db->escape_value($post_title);
        $post_body = $db->escape_value($post_body);
        $post_category = $db->escape_value($post_category);
        $post_id = $db->escape_value($post_id);

        $query = "UPDATE blog_posts SET post_title='{$post_title}', ";
        $query .= "post_body='{$post_body}', category_id='{$post_category}' WHERE(post_id='{$post_id}')";
        $rs = $db->query($query);
        if($rs)
            die(
                output_success_message("Post updated")
            );
    }//End of method: updateAPost()

    public static function getCommentsForAPost($post_id, $st_limit=0, $end_limit=10){
        global $db;
        $rs_arr = [];
        $query = "SELECT * FROM blog_comments WHERE(post_id='{$post_id}') ORDER BY comment_id ";
        $query .= "DESC LIMIT {$st_limit}, {$end_limit}";
        $rs = $db->query($query);
        if($rs){
            if($db->num_rows($rs) > 0){
                while($row = $db->fetch_array($rs)){
                    array_push($rs_arr, array(
                        "comment_id"=>$row["comment_id"],
                        "comment_by"=>(empty($row["cmt_by"]) ? "anonymous" : $row["cmt_by"]),
                        "comment_body"=>$row["cmt_body"],
                        "comment_image"=>$row["cmt_img"],
                        "date_of_entry"=>dateToString($row["date_of_entry"])
                        )
                    );
                }
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getCommentsForAPost()

    public static function getBlogPosts($st_limit=0, $end_limit=7, $category_id=2){
        global $db;
        $rs_arr = [];
        $query = "SELECT * FROM blog_posts WHERE(category_id='{$category_id}') ";
        $query .= "ORDER_BY post_id DESC LIMIT {$st_limit}, {$end_limit}";
        $rs = $db->query($query);
        if($db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "post_id"=>$row["post_id"],
                    "post_title"=>$row["post_title"],
                    "post_body"=>$row["post_body"],
                    "post_imgLg"=>$row["post_imgLg"],
                    "post_imgSm"=>$row["post_imgSm"],
                    "no_of_comments"=>$row["no_of_comments"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getBlogPosts()

    //use this method to generate the pagination buttons
    public static function getNumberOfPostsForThisCategory($category_id=2){
        global $db;
        $result = 0;
        $query = "SELECT * FROM blog_posts WHERE(category_id='{$category_id}')";
        $rs = $db->query($query);
        if($rs){
            $result = (int)$db->num_rows($rs);
        }
        return (int)$result;
    }//End of method:getNumberOfPostsForThisCategory()

    //get all blogPosts()
    public static function getAllPosts($st_limit=0, $end_limit=10){
        global $db;
        global $session;
        $rs_arr = [];
        $query = "SELECT *, blog_categories.category FROM blog_posts ";
        $query .= "INNER JOIN blog_categories USING(category_id) ";
        $query .= "WHERE(blog_posts.written_by='{$session->user_id}') ";
        $query .= "ORDER BY blog_posts.post_id DESC LIMIT {$st_limit}, {$end_limit}";
        $rs = $db->query($query);

        if($db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "post_id"=>$row["post_id"],
                    "post_title"=>$row["post_title"],
                    "post_body"=>$row["post_body"],
                    "post_imgLg"=>$row["post_imgLg"],
                    "post_imgSm"=>$row["post_imgSm"],
                    "no_of_comments"=>$row["no_of_comments"],
                    "category"=>$row["category"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getAllPosts()

}//End of class: BlogWriter