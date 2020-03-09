<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 12/25/2018
 * Time: 3:01 PM
 */
require_once("../PHP_classes/initialize.php");

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

    <title>Artist Interviews | Singaar</title>

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
                        <li class="active">
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
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Artist Interviews</span>
                            <table class="striped responsive-table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Artist</th>
                                    <th>Month</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 40px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>Post Malone</td>
                                    <td>December, 2017</td>
                                    <td>
                                        <a href="artist_interview_detail.php" target="_blank"
                                           class="btn blue lighten-2">
                                            <i class="fa fa-television"></i>
                                            <span class="hide-on-small-only">
                                                Watch
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 40px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>Post Malone</td>
                                    <td>December, 2017</td>
                                    <td>
                                        <a href="artist_interview_detail.php" target="_blank"
                                           class="btn blue lighten-2">
                                            <i class="fa fa-television"></i>
                                            <span class="hide-on-small-only">
                                                Watch
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 40px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>Post Malone</td>
                                    <td>December, 2017</td>
                                    <td>
                                        <a href="artist_interview_detail.php" target="_blank"
                                           class="btn blue lighten-2">
                                            <i class="fa fa-television"></i>
                                            <span class="hide-on-small-only">
                                                Watch
                                            </span>
                                        </a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
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
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col s12" id="tab2">
                        <div class="row">
                            <table class="striped">
                                <tbody>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70">
                                        <img src="../images/person1.jpg"
                                             style="width: 50px;margin-left: 10px;"
                                             alt="Image" class="responsive-img circle"/>
                                    </td>
                                    <td>
                                        <a href="./blog_single.php">
                                            <p class="text-uppercase blue-text text-darken-2"
                                               style="margin-bottom: 6px !important;font-size: 17px;">
                                                BLOG TITLE here BLOG TITLE here
                                            </p>
                                            <span class="grey-text">
                                                <i class="fa fa-calendar"></i> 12/12/2018
                                            </span>
                                        </a>
                                    </td>
                                </tr>
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

            //INIT SCROLLSPy
            $(".scrollspy").scrollSpy();

            //INIT MODAL-POP_UP
            $(".modal").modal({
                dismissible: false,
                inDuration: 300,
                outDuration: 150
            });

            $("#md-close").on("click", function(e){
                e.preventDefault();
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
