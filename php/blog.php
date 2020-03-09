<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 12/25/2018
 * Time: 3:01 PM
 */
require_once("../PHP_classes/initialize.php");
$c = @(!empty($_GET["c"] && isset($_GET["c"])) ? base64_decode($_GET["c"]) : 2);
global $db;

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Import Google icon font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icons?family=Material+icons"/>

    <!--Link materialize.css file here-->
    <link rel="stylesheet" href="../css/materialize.min.css" media="screen, projection" />
    <link rel="stylesheet" href="../css/main.css" />

    <!--Link the site icon on the title bar-->
    <link rel="icon" type="image/icon" href="../images/s_only.png"/>

    <!--Link the font-awesome Library-->
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css"/>

    <!--Let the browser know the website is optimised for the web-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Blog | Singaar</title>

</head>
<body>
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>

<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

<header id="top" class="scrollspy">
    <div class="navbar-fixed">
        <nav class="blue darken-1">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="../index.php" class="brand-logo">
                        <img src="../images/logo_small_trans.png"
                             class="hide-on-small-and-down"
                             style="width:220px;height:65px;" alt="singaar logo"/>
                        <img src="../images/s_only.png"
                             class="hide-on-med-and-up"
                             style="width:65px;height:65px;"
                             alt="singaar logo">
                    </a>
                    <a href="#search-modal" class="left hide-on-large-only modal-trigger"><i class="fa fa-search"></i></a>
                    <a href="" class="button-collapse right" data-activates="mobile-nav"><i class="fa fa-bars"></i></a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a href="../index.php">
                                <i class="fa fa-home"></i> Home</a>
                        </li>
                        <li>
                            <a href="./music.php">Music</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-button" data-activates="artists-dropdown">
                                Artists <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-content blue-text" id="artists-dropdown">
                                <li>
                                    <a href="top_artists.php"
                                       class="blue-text text-darken-3 flow-text">TOP ARTISTS</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="artists.php?type=all_artists"
                                       class="blue-text text-darken-3 flow-text">ALL ARTISTS</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a href="" class="dropdown-button" data-activates="blog-dropdown">
                                Blog <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-content" id="blog-dropdown">
                                <li><a href="blog.php?c=<?php echo base64_encode(2) ?>"
                                       class="blue-text text-darken-3 flow-text">NIGERIAN</a></li>
                                <li class="divider"></li>
                                <li><a href="blog.php?c=<?php echo base64_encode(1) ?>"
                                       class="blue-text text-darken-3 flow-text">FOREIGN</a></li>
                            </ul>
                        </li>
                        <li class="orange darken-4 waves-effect"
                            onmouseover="$(this).addClass('darken-2');"
                            onmouseout="$(this).removeClass('darken-2');">
                            <a href="./sign_up.php">Sign up</a>
                        </li>
                        <li>
                            <a href="./login.php">
                                <img src="../images/user_male.png" alt="login icon"
                                     class="circle tooltipped"
                                     data-position="top"
                                     data-tooltip="Login"
                                     style="width:30px;height:30px;margin-top:15px;"/>
                            </a>
                        </li>
                        <li>
                            <a href="#search-modal"
                               data-position="top"
                               data-tooltip="Search"
                               class="modal-trigger tooltipped"><i class="fa fa-search"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <ul class="side-nav" id="mobile-nav">
        <li>
            <a href="../index.php"><i class="fa fa-home"></i> HOME</a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="" class="subheader"><i class="fa fa-music"></i> ARTISTS</a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="./music.php">
                MUSIC</a>
        </li>
        <li>
            <a href="top_artists.php">TOP ARTISTS</a>
        </li>
        <li>
            <a href="artists.php?type=all_artists">ALL ARTISTS</a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="" class="subheader"><i class="fa fa-newspaper-o"></i> BLOG</a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="blog.php?c=<?php echo base64_encode(2) ?>">LOCAL STORIES</a>
        </li>
        <li>
            <a href="blog.php?c=<?php echo base64_encode(1) ?>">FOREIGN STORIES</a>
        </li>

        <li><div class="divider"></div></li>
        <li>
            <a href="" class="subheader"><i class="fa fa-user"></i> USER ACCOUNTS</a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="sign_up.php" class="red-text text-lighten-1">SIGN UP</a>
        </li>
        <li><a href="login.php" class="teal-text text-lighten-1">LOGIN</a></li>
    </ul>
</header>

<!--Section: section-main-blog-post-->
<div class="section section-pg-content">
    <div class="row">
        <!--Section: section-main-content-right-->
        <div class="col s12 m12 l8">
            <?php
                $end_limit = (!isset($_GET["page"]) || $_GET["page"]==1) ? 11 : $_GET["page"] * 11;
                $st_limit = (!isset($_GET["page"]) || $_GET["page"]==1) ? 0 : $end_limit - 10;
                $posts_array = getBlogPostsForBlogPage($c, $st_limit, $end_limit);
                if( (count($posts_array) > 0 || !$posts_array == null) ){
                    $posts_array_first = getFirstArrayValue($posts_array);

            ?>
            <div class="row">
               <div class="col s12">
                   <div class="card large">
                       <div class="card-image">
                           <img src="<?php echo $posts_array_first["post_imgLg"]; ?>"
                                <?php
                                    if( !empty($posts_array_first["post_imgSm"])
                                        && isset($posts_array_first["post_imgSm"]))
                                    echo "srcset={$posts_array_first["post_imgLg"]} 1200w, 
                                    {$posts_array_first["post_imgSm"]} 600w";
                                ?>
                                alt="<?php echo $posts_array_first["post_title"]; ?>"/>
                       </div>
                       <div class="card-content">
                           <span class="card-title text-uppercase blue-text text-darken-2 tooltipped"
                                 data-postion="top"
                                 data-tooltip="<?php echo $posts_array_first["post_title"]; ?>">
                               <?php
                                    $post_title = $posts_array_first["post_title"];
                                    echo (strlen($post_title) > 45) ?
                                        substr($post_title,0 , 45)."..." : $post_title ;
                               ?>
                           </span>
                           <span class="grey-text"><i class="fa fa-calendar"></i>
                               <?php echo $posts_array_first["date_of_entry"]; ?></span><br>
                           <?php if($posts_array_first["no_of_comments"] > 0){ ?>
                           <span class="grey-text"><i class="fa fa-comment-o"></i> &nbsp;
                               <?php
                                    $no_of_comments = $posts_array_first["no_of_comments"];
                                    echo ($no_of_comments > 1) ? "{$no_of_comments} Comments" : "{$no_of_comments} Comment";
                               ?>
                           </span>
                           <?php } ?>
                       </div>
                       <div class="card-action">
                           <a href="./blog_single.php?post=<?php echo base64_encode($posts_array_first["post_id"]); ?>"
                              class="btn blue lighten-2 waves-effect waves-ripple">READ MORE</a>
                       </div>
                   </div>
               </div>
            </div>
            <div class="row">
                <?php
                    foreach($posts_array as $key=>$value){
                        if(!$key == 0){
                ?>
                <!--section: new-widget-->
                <div class="col s12 m6">
                    <div class="card medium">
                        <div class="card-image">
                            <img src="<?php echo $value["post_imgLg"]; ?>"
                                <?php if( !empty($value["post_imgSm"]) && isset($value["post_imgSm"]) )
                                    echo "srcset={$value["post_imgLg"]} 1200w, 
                                    {$value["post_imgSm"]} 600w";
                                ?>
                                 alt="<?php echo $value["post_title"]; ?>"/>
                        </div>
                        <div class="card-content">
                            <span class="card-title text-uppercase blue-text text-darken-2 tooltipped"
                                data-postion="top"
                                data-tooltip="<?php echo $value["post_title"]; ?>">
                                <?php
                                    $post_title = $value["post_title"];
                                    echo (strlen($post_title) > 25) ?
                                        substr($post_title,0 , 25)."..." : $post_title ;
                                ?>
                            </span>
                            <span class="grey-text"><i class="fa fa-calendar"></i>
                                <?php echo $value["date_of_entry"]; ?>
                            </span><br>
                        </div>
                        <div class="card-action">
                            <a href="./blog_single.php?post=<?php echo base64_encode($value["post_id"]); ?>"
                               class="btn blue lighten-2 waves-effect waves-ripple">READ MORE</a>
                        </div>
                    </div>
                </div>
                <?php } } ?>

            </div>

            <ul class="center pagination">
                <?php
                    $rs = $db->query(SEL_ALL." blog_posts WHERE(category_id='{$c}')");
                    $no_of_rows = $db->num_rows($rs);
                    $a = $no_of_rows/11;//set variable back to '10'
                    $a = ceil($a);

                    if(@isset($_GET['page']) && @$_GET['page'] > 1 ){

                    ?>
                    <li class="disabled">
                        <a href="./blog.php?c=<?php echo base64_encode($c) ?>&page=<?php echo @$_GET['page'] - 1; ?>"
                           class="blue-text">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                    </li>
                <?php } $num = 0;
                for($b = 1; $b <= $a; $b++){
                    $num++;
                    ?>
                    <li class="<?php if(@$_GET['page']==$b ||
                        (!isset($_GET['page']) && $b==1)) echo "active blue lighten-2"; ?>">
                        <a href="./blog.php?c=<?php echo base64_encode($c) ?>&page=<?php echo $b; ?>"
                           class="<?php echo(@$_GET['page']==$b ||
                               (!@isset($_GET['page']) && $b==1))?"white-text":"blue-text"; ?>">
                            <?php echo $b; ?>
                        </a>
                    </li>
                <?php } if(@$_GET["page"] < $num){ ?>
                    <li class="waves-effect">
                        <a href="./blog.php?c=<?php echo base64_encode($c) ?>&page=<?php echo @$_GET['page'] + 1; ?>" class="blue-text">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <?php } else{ ?>

            <div class="card-panel center">
                <p class="flow-text red-text">NO POSTS HAVE BEEN MADE</p>
            </div>
            <?php } ?>
        </div>

        <!--Section: section-aside begins here-->
        <aside class="col s12 m12 l4">
            <div class="card-panel no-padding center">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s6">
                                <a href="#tab1" class="blue-text text-darken-2"
                                   style="font-size: 16px !important;">Popular Posts</a>
                            </li>
                            <li class="tab col s6">
                               <a href="#tab2" class="blue-text text-darken-2"
                                  style="font-size: 16px !important;">Older Posts</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12" id="tab1">
                        <div class="row">
                            <table class="striped">
                                <tbody>
                                <?php
                                    $popular_posts = BlogPosts::getSideBarPosts();
                                    if( (count($popular_posts) > 0 || !$popular_posts == null) ){
                                        foreach($popular_posts as $key=>$value){
                                ?>
                                    <tr>
                                        <td width="70">
                                            <img src="<?php echo $value["post_imgLg"]; ?>"
                                                 style="width: 50px;height:50px;margin-left: 10px;"
                                                 alt="Image" class="responsive-img circle"/>
                                        </td>
                                        <td>
                                            <a href="./blog_single.php?post=<?php echo base64_encode($value["post_id"]); ?>">
                                                <p class="text-uppercase blue-text text-darken-2 tooltipped"
                                                   data-position="top"
                                                   data-tooltip="<?php echo $value["post_title"]; ?>"
                                                   style="margin-bottom: 6px !important;font-size: 17px;">
                                                    <?php
                                                    $post_title = $value["post_title"];
                                                    echo (strlen($post_title) > 30) ?
                                                        substr($post_title,0 , 30)."..." : $post_title ;
                                                    ?>
                                                </p>
                                                <span class="grey-text">
                                                <i class="fa fa-calendar"></i> <?php echo $value["date_of_entry"]; ?>
                                            </span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col s12" id="tab2">
                        <div class="row">
                            <table class="striped">
                                <tbody>
                                <?php
                                $older_posts = BlogPosts::getSideBarPosts("oldest");
                                if( (count($older_posts) > 0 || !$older_posts == null) ){
                                    foreach($older_posts as $key=>$value){
                                        ?>
                                        <tr>
                                            <td width="70">
                                                <img src="<?php echo $value["post_imgLg"]; ?>"
                                                     style="width: 50px;height:50px;margin-left: 10px;"
                                                     alt="Image" class="responsive-img circle"/>
                                            </td>
                                            <td>
                                                <a href="./blog_single.php?post=<?php echo base64_encode($value["post_id"]); ?>">
                                                    <p class="text-uppercase blue-text text-darken-2 tooltipped"
                                                       data-position="top"
                                                       data-tooltip="<?php echo $value["post_title"]; ?>"
                                                       style="margin-bottom: 6px !important;font-size: 17px;">
                                                        <?php
                                                        $post_title = $value["post_title"];
                                                        echo (strlen($post_title) > 30) ?
                                                            substr($post_title,0 , 30)."..." : $post_title ;
                                                        ?>
                                                    </p>
                                                    <span class="grey-text">
                                                <i class="fa fa-calendar"></i> <?php echo $value["date_of_entry"]; ?>
                                            </span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </aside>
    </div>
</div>


<!--Footer: section-->
<?php include_once("../css/footer_main.php"); ?>

<!--Pre-Loader begins here-->
<div class="row loader-section">
    <div class="col m10 offset-m1 l6 offset-l3">
        <div class="progress grey lighten-2">
            <div class="indeterminate blue lighten-1"></div>
        </div>
    </div>
</div>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red darken-3 waves-effect tooltipped"
       data-position="top" data-tooltip="Back To Top" href="#top">
        <i class="fa fa-angle-double-up"></i>
    </a>
</div>

<!--Section: Modal-->
<div class="modal modal-fixed-footer" id="search-modal">
    <div class="modal-content white">
        <form action="" id="search-form">
            <div class="input-field">
                <i class="prefix fa fa-search"></i>
                <input type="search" id="search-for"/>
                <label for="search-for">SEARCH</label>
            </div>
        </form>
        <div class="row">
            <div class="col s12">
                <p class="grey-text"><i class="fa fa-pencil"></i>&nbsp; Search for anything</p>
            </div>
        </div>
    </div>
    <div class="modal-footer white">
        <a href="" id="md-close" class="modal-action modal-close btn-flat red-text text-darken-4">CLOSE</a>
    </div>
</div>

<script>
    //hide all initial content
    $("header, .section, footer,.fixed-action-btn").hide();

    setTimeout(function(){
        $(document).ready(function(){
            //display all initial-content after 2secs
            $("header, .section, footer,.fixed-action-btn").fadeIn();
            $(".loader-section").fadeOut();

            //INIT SIDE-NAV
            $(".button-collapse").sideNav({
                draggable: true,
                edge: "left"
            });

            //INIT MODAL-POP_UP
            $(".modal").modal({
                dismissible: false,
                inDuration: 300,
                outDuration: 150
            });

            $("#md-close").on("click", function(e){
                e.preventDefault();
            });

            //INIT SCROLLSPY
            $(".scrollspy").scrollSpy();

            //INIT SWIPEABLE ON TABS
            $("#tabs-swipe-demo").tabs({
                swipeable: true
            });

            //NAVIGATE SEARCH-FORM AFTER SUBMISSION TO THE SEARCH PAGE
            $("#search-form").on("submit", function(e){
                e.preventDefault();
                var search_for = $("#search-for").val();
                if(! (search_for === "") ) location.href = "search.php?q="+search_for;
            });

        });
    }, 2000);

</script>

</body>
</html>
