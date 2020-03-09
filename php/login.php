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

    <title>Login | Singaar</title>

    <style>
        .section-form-hold .card{ margin-top: 40px !important; }

        .post-img-con{ height: 350px !important; }

        .post-img-con>img{ height: 100% !important; }

        .blog-article{ margin-top: 20px !important; font-size: 17px !important; }

        .blog-article p{ margin-bottom: 8px !important; }
    </style>


</head>
<body>
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>

<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

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
                <div class="form-1 card">
                    <div class="card-content">
                        <span class="card-title center blue-text text-darken-3">Login</span>
                        <form action="" method="post" id="login-form">
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="username" name="username" required autocomplete="off"
                                value="<?php echo (isset($_COOKIE['singaar_uName'])?
                                    base64_decode($_COOKIE['singaar_uName']):""); ?>" />
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="password" id="password" required autocomplete="off"
                                value="<?php echo (isset($_COOKIE['singaar_uPass'])?
                                    Login::clearUpPassword($_COOKIE['singaar_uPass']):""); ?>"/>
                                <label for="password">Password:</label>
                            </div>
                            <div class="switch" style="display: inline-block;">
                                <p class="grey-text">Remember me</p>
                                <label>
                                    No
                                    <input type="checkbox" checked id="valid-detail-check" name="remember_me"/>
                                    <span class="lever"></span>
                                    Yes
                                </label>
                            </div>
                            <p class="grey-text show-forgot-password right"
                               style="display:inline-block;cursor: pointer;">
                                Forgot Password?
                            </p>
                            <div class="input-field">
                                <button type="submit" class="btn btn-extend blue darken-3 waves-effect waves-ripple">
                                    <i class="fa fa-sign-in"></i> &nbsp;LOGIN
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-action center flow-text section-error-log"
                         style="<?php echo (isset($_GET['msg']))?"display:block !important;":
                             "display:none !important;"  ?> word-break: break-all;">
                        <?php echo (isset($_GET['msg']))?base64_decode($_GET['msg']):""; ?>
                    </div>
                </div>
                <div class="form-2 card" style="display: none;">
                    <div class="card-content">
                        <span class="card-title center blue-text text-darken-3">Forgot Password?</span>
                        <form action="" method="post" id="forgot-password-form">
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-envelope-o prefix"></i>
                                <input type="email" id="email" required class="validate"/>
                                <label for="email" data-error="Invalid Email"
                                       data-success="Valid Email">Email</label>
                            </div>
                            <p class="grey-text close-forgot-password"
                               style="display:inline-block;cursor: pointer;">
                                <i class="fa fa-angle-double-left"></i> Back To Login
                            </p>
                            <div class="input-field">
                                <button type="submit" class="btn btn-extend blue darken-3 waves-effect waves-ripple">
                                    <i class="fa fa-send-o"></i> &nbsp;Send My Password
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-action center flow-text section-error-log-2"
                         style="display: none !important;word-break: break-all;">
                        Error occurred: Reset your password
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//    $username = "megaline";
//    $email = "abelanico6@gmail.com";
//    $password = "magERR20";
//    $password =  Login::encryptPassword($password);
//    $binHex = bin2hex(openssl_random_pseudo_bytes(32));
//    $role = 3;
//    $date_of_entry = time();
//    $isBlocked = 1;
//    echo "Username:{$username}<br>Email: {$email}<br>Role: {$role}<br>
//isBlocked: {$isBlocked}<br>Password:{$password}<br>BinHex: {$binHex}<br>Date of entry: {$date_of_entry}";

//    $username = "chris brown";
//    $email = "chrisB@yahoo.com";
//    $password = "chrisBROWN44";
//    $password =  Login::encryptPassword($password);
//    $binHex = bin2hex(openssl_random_pseudo_bytes(32));
//    $musical_style = "rap,soul,rnb";
//    $active_since = "27 February, 2019";
//    $role = 1;
//    $date_of_entry = time();
//    $trial_starts = time();
//    $trial_ends = strtotime("+3 months", time());
//    $isBlocked = 1;
//    echo "Username:{$username}<br>Email: {$email}<br>Role: {$role}<br>
//isBlocked: {$isBlocked}<br>Password:{$password}<br>BinHex: {$binHex}<br>
//Date of entry: {$date_of_entry}<br>Active Since: {$active_since}
//<br>Musical Style: {$musical_style}<br>Trial Begins: {$trial_starts}<br>Trial Ends: {$trial_ends}";

?>
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
    $("header, .section").hide();

    setTimeout(function(){
        $(document).ready(function(){
            //display all initial-content after 2secs
            $("header, .section").fadeIn();
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

            //NAVIGATE SEARCH-FORM AFTER SUBMISSION TO THE SEARCH PAGE
            $("#search-form").on("submit", function(e){
                e.preventDefault();
                var search_for = $("#search-for").val();
                if(! (search_for === "") ) location.href = "search.php?q="+search_for.toLowerCase();
            });

            //Code For toggling LOGIN & FORGOT PASSWORD FORMS
            $(".show-forgot-password").on("click", function(){
                $(".form-1").fadeOut(100);
                $(".form-2").fadeIn(2000);
                $("title").html("Forgot Password? | Singaar");
            });

            //Code For toggling LOGIN & FORGOT PASSWORD FORMS
            $(".close-forgot-password").on("click", function(){
                $(".form-1").fadeIn(2000);
                $(".form-2").fadeOut(100);
                $("title").html("Login | Singaar");
            });

            //LOGIN-FORM
            $("#login-form").on("submit", function(e){
                e.preventDefault();

                //set colors for error & success
                var color = {
                    "error": "#EF5350",
                    "success": "#4CAF50"
                };
                var error_log = $(".section-error-log");
                error_log.empty();

                $.ajax({
                    url: "../ajax_codes/login_source.php",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    type: "POST",
                    success: function(data){

                        switch(data){
                            case "admin user":
                                error_log.fadeOut();
                                //navigate to the admin's index page
                                location.href = "../admin/index.php";
                                break;

                            case "blogger user":
                                error_log.fadeOut();
                                location.href = "../blogger_writer/index.php";
                                break;

                            case "artist user":
                                error_log.fadeOut();
                                //navigate to the artist's index page
                                location.href = "../artist_account/index.php";
                                break;

                            case "payment only":
                                error_log.fadeOut();
                                //navigate to the payment page
                                location.href = "../artist_account/payments.php";
                                break;

                            default:
                                error_log.fadeIn();
                                error_log.html(data);
                                error_log.css("color", color.error);
                                break;
                        }
                    }
                });
            });

            //Forgot-password-form
            $("#forgot-password-form").on("submit", function(e){
                e.preventDefault();

                //set colors for error & success
                var color = {
                    "error": "#EF5350",
                    "success": "#4CAF50"
                };
                var error_log = $(".section-error-log-2");
                error_log.empty();
                //set error-log to visible
                error_log.html("Sample error from log");
                error_log.fadeIn();
                error_log.css("color", color.success);
            });

        });
    }, 2000);

</script>

</body>
</html>
