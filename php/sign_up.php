<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 12/25/2018
 * Time: 3:01 PM
 */
//
//require_once("../PHP_classes/initialize.php");

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

    <title>Sign Up | Singaar</title>

    <style>
        .section-form-hold .card{ margin-top: 40px !important; }

    </style>

</head>
<body>
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>

<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

<!--Section: loader <div>-->
<section class="uploader-loader" style="background:rgba(0,0,0,0.8);height:100% !important;top:0left:0;background-size: cover !important;position:fixed;z-index: 99999;text-align: center;color:#fff;width:100%;display:none;">
    <div class="row loader-section-2">
        <div class="col m10 offset-m1 l6 offset-l3">
            <div class="progress grey lighten-2">
                <div class="indeterminate blue lighten-1"></div>
            </div>
        </div>
    </div>
    <p class="flow-text" style="position: relative">Please wait...</p>
</section>

<header>
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

<section class="section section-form-hold">
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center blue-text text-darken-3">Sign Up</span>
                        <form action="" id="sign-in-form" method="post">
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="username" required name="username"/>
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-envelope-o prefix"></i>
                                <input type="text" id="email" required name="email"/>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="password"
                                       required
                                       class="validate"
                                       name="password"
                                       pattern="([a-z]{3,}\d{1,}[A-Z]{2,}|\d{1,}[a-z]{3,}[A-Z]{2,}|[A-Z]{2,}\d{1,}[a-z]{3,})"/>
                                <label for="password" data-error="Password must contain at least 3
                                 lowercase letters,1 number & 2 uppercase letters"
                                       data-success="Strong Password">Password</label>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-music prefix"></i>
                                <select name="musical_style[]" multiple required>
                                    <option value="" selected disabled>MUSICAL STYLE</option>
                                    <option value="gospel">GOSPEL</option>
                                    <option value="rap">RAP</option>
                                    <option value="regae">REGAE</option>
                                    <option value="soul">SOUL</option>
                                    <option value="rnb">RnB</option>
                                    <option value="country">COUNTRY</option>
                                    <option value="edm">EDM</option>
                                </select>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-calendar prefix"></i>
                                <input type="text" id="active-since" class="datepicker" name="active_since" required>
                                <label for="active-since">Active Since</label>
                            </div>
                            <div class="input-field">
                                <button type="submit"
                                        class="btn btn-extend blue darken-3 waves-effect waves-ripple">
                                    <i class="fa fa-send-o"></i> &nbsp;SIGN UP
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-action center flow-text section-error-log"
                         style="display: none !important;word-break:break-all;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Footer: section-->
<footer class="section blue darken-3 center">
    <p class="flow-text white-text">&copy; <?php echo date("Y"); ?> Singaar. All rights reserved</p>
</footer>

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
    $("header, .section, footer").hide();

    setTimeout(function(){
        $(document).ready(function(){
            //display all initial-content after 2secs
            $("header, .section, footer").fadeIn();
            $(".loader-section").fadeOut();

            //INIT SIDE-NAV
            $(".button-collapse").sideNav({
                draggable: true,
                edge: "left"
            });

            $("#sign-in-form").on("submit", function(e){
                e.preventDefault();
                $(".uploader-loader").fadeIn();

                //set colors for error & success
                var color = {
                  "error": "#EF5350",
                  "success": "#4CAF50"
                };
                var error_log = $(".section-error-log");
                error_log.empty();
                $.ajax({
                    url:"../ajax_codes/sign_up_source.php",
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data){
                        $(".uploader-loader").fadeOut();
                        error_log.fadeIn();
                        error_log.html(data);
                        //set error-log to visible
                        if( (/Welcome to singaar.Check your email for your activation code/ig.test(data)) ){
                            error_log.css("color", color.success);
                            $("#sign-in-form").trigger("reset");
                        }
                        else{
                            error_log.css("color", color.error);
                        }
                    }
                });
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

            //INIT THE DATE-PICKER
            $(".datepicker").pickadate({
                selectMonths: true,
                selectYears: 50,
                closeOnSelect: true,
                today: "Today"
            });

            //INIT SELECT
            $("select").material_select();

            //NAVIGATE SEARCH-FORM AFTER SUBMISSION TO THE SEARCH PAGE
            $("#search-form").on("submit", function(e){
                e.preventDefault();
                var search_for = $("#search-for").val();
                if(! (search_for === "") ) location.href = "search.php?q="+search_for.toLowerCase();
            });

        });
    }, 2000);

</script>

</body>
</html>
