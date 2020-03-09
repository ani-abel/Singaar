<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 12/25/2018
 * Time: 3:01 PM
 */
include_once("PHP_classes/initialize.php");

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!--Import Google icon font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icons?family=Material+icons"/>

    <!--Link materialize.css file here-->
    <link rel="stylesheet" href="css/materialize.min.css" media="screen, projection" />
    <link rel="stylesheet" href="css/main.css" />
    <!--Link the site icon on the title bar-->
    <link rel="icon" type="image/icon" href="images/s_only.png"/>

    <!--Link the font-awesome Library-->
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css"/>

    <!--Let the browser know the website is optimised for the web-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Singaar | Official Website</title>

    <style>
        body{ overflow-x: hidden !important; }

        /* width */
        ::-webkit-scrollbar {
            width: 10px !important;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey !important;
            border-radius: 10px !important;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #1E88E5 !important;
            border-radius: 10px !important;
        }

        header{ margin-bottom: 60px !important; }

        .nav-bar-lg-top{ padding: 0 60px !important; }

        .no-padding{ padding: 0 !important; margin-bottom: 0 !important; }

        .my-row{ margin-bottom: 0 !important; }

        .nav-bar-lg-top-right{ padding-right: 50px !important; padding-top: 15px !important; }

        .nav-bar-lg-top-right>ul{ vertical-align: bottom !important; }

        .nav-bar-lg-top-right>ul>li{ display: inline; }

        .nav-bottom-left-ul{ margin: 0 !important; }

        .nav-bottom-left-ul>li{ display:inline; padding: 10px 12px; vertical-align: top !important; }

        .nav-bottom-left-ul>li:hover,
        .nav-li-active{ background: rgba(0,0, 0, 0.3); }

        .nav-bar-lg-bottom{ padding: 5px 0 7px 0 !important; }

        .nav-bar-lg-bottom a{ color: #fff; font-size: 17px !important; }

        @media (max-width: 600px) {
            header{margin-bottom: 0 !important; }
        }
    </style>
</head>
<body>
<!--Link j-Query-->
<script src="js/jquery.min.js"></script>

<!--Link materialize.js-->
<script src="js/materialize.min.js"></script>

<!--HEADER SECTION-->
<header class="main-header scrollspy" id="top">
    <div class="primary-overlay z-depth-5">
        <div class="navbar-fixed">
            <nav class="transparent site-default-nav">
                <div class="nav-wrapper">
                    <div class="container">
                        <a href="./index.php" class="brand-logo center">
                            <img src="images/logo_small_trans.png" alt="singaar logo"
                                 class="hide-on-small-and-down"
                                 style="width:300px;height: 80px;">
                            <img src="images/logo_small_trans.png" alt="singaar logo"
                                 class="hide-on-med-and-up"
                                 style="width:205px;height: 65px;">
                        </a>
                    </div>
                </div>
            </nav>
            <nav style="display: none;" class="blue darken-1 my-navbar-lg">
                <div class="nav-wrapper">
                    <div class="container">
                        <a href="../index.php" class="brand-logo">
                            <img src="images/logo_small_trans.png"
                                 class="hide-on-small-and-down"
                                 style="width:220px;height:65px;" alt="singaar logo"/>
                            <img src="images/s_only.png"
                                 class="hide-on-med-and-up"
                                 style="width:65px;height:65px;"
                                 alt="singaar logo">
                        </a>
                        <a href="#search-modal" class="left hide-on-large-only modal-trigger"><i class="fa fa-search"></i></a>
                        <a href="" class="button-collapse right" data-activates="mobile-nav"><i class="fa fa-bars"></i></a>
                        <ul class="right hide-on-med-and-down">
                            <li class="active">
                                <a href="../index.php">
                                    <i class="fa fa-home"></i> Home</a>
                            </li>
                            <li>
                                <a href="php/music.php">Music</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-button" data-activates="artists-dropdown">
                                    Artists <i class="fa fa-chevron-down"></i></a>
                                <ul class="dropdown-content blue-text" id="artists-dropdown">
                                    <li>
                                        <a href="php/top_artists.php"
                                           class="blue-text text-darken-3 flow-text">TOP ARTISTS</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="php/artists.php?type=all_artists"
                                           class="blue-text text-darken-3 flow-text">ALL ARTISTS</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" class="dropdown-button" data-activates="blog-dropdown">
                                    Blog <i class="fa fa-chevron-down"></i></a>
                                <ul class="dropdown-content" id="blog-dropdown">
                                    <li><a href="php/blog.php?c=<?php echo base64_encode(2) ?>"
                                           class="blue-text text-darken-3 flow-text">NIGERIAN</a></li>
                                    <li class="divider"></li>
                                    <li><a href="php/blog.php?c=<?php echo base64_encode(1) ?>"
                                           class="blue-text text-darken-3 flow-text">FOREIGN</a></li>
                                </ul>
                            </li>
                            <li class="orange darken-4 waves-effect"
                                onmouseover="$(this).addClass('darken-2');"
                                onmouseout="$(this).removeClass('darken-2');">
                                <a href="php/sign_up.php">Sign up</a>
                            </li>
                            <li>
                                <a href="php/login.php">
                                    <img src="images/user_male.png" alt="login icon"
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
                <a href="./index.php"><i class="fa fa-home"></i> HOME</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="" class="subheader"><i class="fa fa-music"></i> ARTISTS</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="php/music.php" id="link-one">
                    MUSIC</a>
            </li>
            <li>
                <a href="php/top_artists.php">TOP ARTISTS</a>
            </li>
            <li>
                <a href="php/artists.php">ALL ARTISTS</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="" class="subheader"><i class="fa fa-newspaper-o"></i> BLOG</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="php/blog.php?c=<?php echo base64_encode(2) ?>">LOCAL STORIES</a>
            </li>
            <li>
                <a href="php/blog.php?c=<?php echo base64_encode(1) ?>">FOREIGN STORIES</a>
            </li>

            <li><div class="divider"></div></li>
            <li>
                <a href="" class="subheader"><i class="fa fa-user"></i> USER ACCOUNTS</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="php/sign_up.php" class="red-text text-lighten-1">SIGN UP</a>
            </li>
            <li><a href="php/login.php" class="teal-text text-lighten-1">LOGIN</a></li>
        </ul>
        <div class="showcase container">
            <div class="row">
                <div class="col s12 m10 main-text">
                    <h3 class="text-capitalize">Have control over your music</h3>
                    <p class="flow-text">
                        Join the biggest music collaborations.
                        Discover more about your music. Find your music community.
                    </p>
                    <br><br>
                    <a href="php/sign_up.php"
                       class="btn-large red lighten-1 waves-effect waves-green">Sign up for free</a>&nbsp;&nbsp;
                    <a href="php/login.php"
                       class="btn-large teal lighten-1 waves-effect waves-ripple hide-on-small-only">Login</a>
                </div>
            </div>
        </div>
    </div>
</header>

<!--Section: section-facts-about-singaar-->
<section class="section section facts-about-singaar center">
    <h4 class="center">Why use <span class="blue-text text-darken-3">Singaar</span>?</h4>

    <div class="container">
        <div class="row">
            <div class="col s12 m4">
                <div class="card-panel">
                    <i class="fa fa-group fa-4x blue-text text-darken-3 widget-icon"></i>
                    <h5 class="grey-text">Community</h5>
                    <p class="flow-text">
                        One of the fastest growing artist platforms.
                        <span class="blue-text text-darken-3">singaar</span> gives you access to it's
                        growing user base
                    </p>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card-panel blue darken-3 white-text">
                    <i class="fa fa-bullhorn fa-4x white-text text-darken-3 widget-icon"></i>
                    <h5 class="grey-text text-lighten-3">Voice</h5>
                    <p class="flow-text">
                       You have control over how your music is shared and seen by the world.
                        You control how the world sees you
                    </p>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card-panel">
                    <i class="fa fa-server fa-4x blue-text text-darken-3 widget-icon"></i>
                    <h5 class="grey-text">Storage</h5>
                    <p class="flow-text">
                        <span class="blue-text text-darken-3">singaar</span>
                        let's you store &amp; share your music &amp; video files at almost no cost
                    </p>
                </div>
            </div>


        </div>
    </div>
</section>

<!--Section: section-artist-of-the-month-->
<section class="section section-artist-of-the-month grey lighten-5">
    <h4 class="center no-text-thickness"><span class="blue-text text-darken-3">December's</span> Featured Artist</h4>

    <div class="container">
        <div class="row">
            <div class="col s12 m12 l6">
                <p class="flow-text">
                    <span class="text-capitalize blue-text text-darken-3">Solomon Haynes AKA "Silo"</span>
                    <img src="images/person1.jpg" alt="Person 1" class="responsive-img circle left"
                         style="width:100px;height:100px;margin:0 5px 2px 0;"/>
                    Is a Lagos based artist who specializes in afro hip-hop. His career began in 2016.
                    <span class="blue-text text-darken-3">singaar</span>
                    caught up with him last week. Watch the interview
                    <span class="hide-on-large-only"> below</span>
                    <br>
                    <a href="./artist_account/public_page.php" class="blue-text text-darken-3">
                        VIEW SILO'S PUBLIC PAGE &nbsp;<i class="fa fa-chevron-right"></i>
                    </a>
                </p>
            </div>
            <div class="col s12 m12 l6 card-panel no-padding video-con" style="overflow: hidden !important;">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/cQ5OqpHvIEo"
                            allowfullscreen frameborder="0" width="853" height="450">
                    </iframe>
                </div>
            </div>
            <div class="col s12 center" style="padding-top: 15px;">
                <a href="php/artist_interviews.php" class="btn blue darken-2 waves-effect waves-ripple">
                    ARTIST INTERVIEWS
                </a>
            </div>
        </div>
    </div>
</section>

<!--Section: trending stories-->
<section class="section section-trending-stories center">
    <h4 class="center no-text-thickness">Trending stories</h4>

    <div class="container">
        <div class="row">
            <?php
                $trending_posts = BlogPosts::getLatestPostsForHomePage();
                if( (count($trending_posts) > 0 || !$trending_posts == null) ){
                    foreach($trending_posts as $key=>$value){
            ?>
            <div class="col s12 m4">
                <div class="card medium">
                    <div class="card-image">
                        <img src="images/adult-1851527_640.jpg" alt="blog post image"/>
                    </div>
                    <div class="card-content left-align">
                        <span class="card-title text-uppercase tooltipped"
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
                    <div class="card-action right-align">
                        <a href="php/blog_single.php?post=<?php echo base64_encode($value["post_id"]); ?>"
                           class="btn blue lighten-1 waves-effect waves-ripple">READ MORE</a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
        <a href="php/blog.php" class="center-align btn blue darken-3 waves-effect waves-ripple">MORE STORIES</a>
    </div>
</section>

<!--Section: section-call-to-action-->
<section class="section section-call-to-action">
    <div class="primary-overlay valign-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 left">
                    <p class="flow-text white-text">
                        Now you've gotten to know us, <span class="blue-text text-darken-3">sign up </span>
                        and let's make the world hear your voice
                        <br>
                        <br>
                        <a href="php/sign_up.php" class="btn-large red darken-3 waves-effect waves-green">
                            SIGN UP
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Footer: section-->
<footer class="section blue darken-3 center">
    <p class="flow-text white-text" style="font-size: 20px">
        All rights reserved. &copy; <span class="grey-text text-lighten-1">Singaar</span>
        <?php echo strftime("%Y"); ?>
    </p>
</footer>

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

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red darken-3 waves-effect tooltipped"
       data-position="top" data-tooltip="Back To Top" href="#top">
        <i class="fa fa-angle-double-up"></i>
    </a>
</div>

<!--Pre-Loader begins here-->
<div class="row loader-section">
    <div class="col m10 offset-m1 l6 offset-l3">
        <div class="progress grey lighten-2">
            <div class="indeterminate blue lighten-1"></div>
        </div>
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

            //INIT SCROLLSPY
            $(".scrollspy").scrollSpy();

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

            //INIT SCROLL_FIRE
            const options = [
                {
                    selector: ".navbar-fixed",
                    offset: 1500,
                    callback: function(){
                        $(".site-default-nav").fadeOut();
                        $(".my-navbar-lg").fadeIn();
                    }
                }
            ];
            Materialize.scrollFire(options);

            //NAVIGATE SEARCH-FORM AFTER SUBMISSION TO THE SEARCH PAGE
            $("#search-form").on("submit", function(e){
                e.preventDefault();
                var search_for = $("#search-for").val();
                if(! (search_for === "") ) location.href = "php/search.php?q="+search_for;
            });

        });
    }, 2000);

</script>

</body>
</html>
