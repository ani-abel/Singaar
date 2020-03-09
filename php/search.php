<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 12/25/2018
 * Time: 3:01 PM
 */
require_once("../PHP_classes/initialize.php");

?>
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

    <title><?php echo (!empty($_GET['q']))?ucwords($_GET['q']):"Search For"; ?></title>

    <style>
        article>p{ margin-bottom: 8px !important; font-size: 17px; }

        .collection .title{ margin-bottom: 10px; }

        .collection { border-bottom: none !important; border-left: none !important; border-right: none !important; }

        .collection:nth-child(1){ border-top: none !important; }

        .collection li{ padding-bottom: 20px !important; margin-bottom: 15px !important; }

    </style>

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
                        <li>
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
            <a href="./music.php" id="link-one">
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

<!--Section: search-con-->
<section class="section section-search-area">
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <form action="" id="searh-form-main">
                        <div class="input-field blue-text text-darken-2">
                            <i class="fa fa-search prefix"></i>
                            <input type="search" name="" id="search-for"
                                   value="<?php if(!empty($_GET['q']))echo $_GET['q']; ?>"/>
                            <label for="search-for">Search</label>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col s12">
                            <p class="flow-text">Showing 50 search results for:
                                <span class="blue-text text-capitalize">
                                    <?php echo(!empty($_GET['q']))?$_GET['q']:"Jimmy Danton"; ?></span>
                            </p>
                        </div>
                        <div class="col s12 no-padding">
                            <ul class="collection">
                                <li class="collection-item avatar">
                                    <img src="../images/band-2179313_1920.jpg"
                                         class="responsive-img circle" alt="">
                                    <span class="title text-uppercase blue-text text-darken-2">
                                        Blog title goes here
                                    </span>
                                    <article>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, laboriosam.
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab architecto aut dolorem dolores facere impedit iste molestiae nisi quam vitae.</p>
                                    </article>
                                    <a href="./blog_single.php"
                                       class=" btn blue lighten-2 left-align read-text
                                       text-darken-2 waves-effect waves-ripple">
                                        <i class="fa fa-newspaper-o"></i> READ MORE
                                    </a>
                                </li>
                                <li class="collection-item avatar">
                                    <img src="../images/band-2179313_1920.jpg"
                                         class="responsive-img circle" alt="">
                                    <span class="title text-uppercase blue-text text-darken-2">
                                        Blog title goes here
                                    </span>
                                    <article>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, laboriosam.
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab architecto aut dolorem dolores facere impedit iste molestiae nisi quam vitae.</p>
                                    </article>
                                    <a href="./blog_single.php"
                                       class=" btn blue lighten-2 left-align read-text
                                        text-darken-2 waves-effect waves-ripple">
                                        <i class="fa fa-newspaper-o"></i> READ MORE
                                    </a>
                                </li>
                                <li class="collection-item avatar">
                                    <img src="../images/band-2179313_1920.jpg"
                                         class="responsive-img circle" alt="">
                                    <span class="title text-uppercase blue-text text-darken-2">
                                        Post Malone
                                    </span><br>
                                    <span class="grey-text">Artist</span><br>
                                    <a href="../artist_account/public_page.php" style="margin-top: 5px;"
                                       class=" btn blue lighten-2 left-align read-text
                                        text-darken-2 waves-effect waves-ripple">
                                        <i class="fa fa-angle-double-right"></i> View Page
                                    </a>
                                </li>
                                <li class="collection-item avatar">
                                    <img src="../images/band-2179313_1920.jpg"
                                         class="responsive-img circle" alt="">
                                    <span class="title text-uppercase blue-text text-darken-2">
                                        Post Malone - Dilly Dally
                                    </span><br>
                                    <span class="grey-text">Song By
                                        <span class="text-uppercase red-text text-lighten-3">POST MALONE</span>
                                    </span><br>
                                    <a target="_blank"
                                       href="../artist_account/public_page_audio.php?a_id=" style="margin-top: 5px;"
                                       class=" btn blue lighten-2 left-align read-text
                                       text-darken-2 waves-effect waves-ripple">
                                        <i class="fa fa-headphones"></i> Listen
                                    </a>
                                </li>
                                <li class="collection-item avatar">
                                    <img src="../images/band-2179313_1920.jpg"
                                         class="responsive-img circle" alt="">
                                    <span class="title text-uppercase blue-text text-darken-2">
                                        Post Malone - Dilly Dally
                                    </span><br>
                                    <span class="grey-text">Video By
                                        <span class="text-uppercase red-text text-lighten-3">POST MALONE</span>
                                    </span><br>
                                    <a target="_blank"
                                       href="../artist_account/public_page_video.php?v_id=" style="margin-top: 5px;"
                                       class=" btn blue lighten-2 left-align read-text
                                       text-darken-2 waves-effect waves-ripple">
                                        <i class="fa fa-television"></i> Watch
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <ul class="pagination center">
                        <li class="disabled">
                            <a href="" class="blue-text">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </li>
                        <li class="active blue lighten-2">
                            <a href="" class="white-text">1</a>
                        </li>
                        <li class="waves-effect">
                            <a href="" class="blue-text">2</a>
                        </li>
                        <li class="waves-effect">
                            <a href="" class="blue-text">3</a>
                        </li>
                        <li class="waves-effect">
                            <a href="" class="blue-text">4</a>
                        </li>
                        <li class="waves-effect">
                            <a href="" class="blue-text">5</a>
                        </li>
                        <li class="waves-effect">
                            <a href="" class="blue-text">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Footer: section-->
<?php include_once("../css/footer_main.php"); ?>

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

            //INIT SIDE-NAV
            $(".button-collapse").sideNav({
                draggable: true,
                edge: "left"
            });

            //INIT SCROLLSPY
            $(".scrollspy").scrollSpy();

            //NAVIGATE SEARCH-FORM AFTER SUBMISSION TO THE SEARCH PAGE
            $("#search-form-main").on("submit", function(e){
                e.preventDefault();

                //implement ajax here
            });

        });
    }, 2000);

</script>

</body>
</html>
