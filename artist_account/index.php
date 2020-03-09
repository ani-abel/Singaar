<?php
require_once("../PHP_classes/initialize.php");

global $session;
if( !($session->is_logged_in() || isset($session->user_id, $_SESSION['role'])) || $_SESSION['role'] != "artist"){
    $session->logout();
    redirect_to("../php/login.php");
}

if( (isset($_SESSION['temp_token']) && $_SESSION['temp_token'] == "payment only") )
    redirect_to("payments.php");

$artist_info_node = BlogWriter::getBloggerInfo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Singaar | <?php echo ucwords($artist_info_node["username"]); ?></title>

    <!--Import Google icon font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icons?family=Material+icons"/>

    <!--Link materialize.css file here-->
    <link rel="stylesheet" href="../css/materialize.min.css" media="screen, projection" />
    <link rel="stylesheet" href="css/main5.css" />
    <!--Link the font-awesome Library-->
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css"/>
    <!--Link the site icon on the title bar-->
    <link rel="icon" type="image/icon" href="../images/s_only.png"/>
    <!--Let the browser know the website is optimised for the web-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
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

        .btn-extend{ display: block !important; width: 100% !important; }

        .my-collection-2
        {
            padding-bottom: 12px;
            border-top: none !important;
            border-right: none !important;
            border-left: none !important;
        }

        .my-collection-2:nth-child(2){ border-bottom: none !important; padding-bottom: 0 !important; }

        .my-collection .collection-item{ font-size: 19px; padding: 15px !important; }

        .emphais{ font-size: 18px !important; }

        .inline-form{ display: inline-block !important;  vertical-align: top !important; margin-top: 10px; }
    </style>

</head>
<body class="grey lighten-4">
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>
<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

<!--Section: section-my-modal-overlay-->
<section class="section-my-modal-overlay all-notifications"
         style="height: 100%;width:100%;background:rgba(0,0,0,0.3);position: fixed;z-index: 99999999999;top:0;display:none;">
    <div class="row">
        <div class="col s12 m8 offset-m2 l4 offset-l4 white darken-1 z-depth-5 no-padding "
             style="margin-top:1% !important;margin-bottom:1% !important;padding-top:0;position:relative">
            <div class="row" style="margin-bottom: 0 !important;">
                <div class="col s12 blue darken-3 center white-text">
                    <p class="flow-text">
                        <i class="fa fa-bell-o"></i> NOTIFICATIONS
                    </p>
                </div>
                <div class="col s12 no-padding hold-notifications">
                    <ul class="collection no-padding">
                        <li class="collection-item avatar">
                            <img src="../images/singer-579923_640.jpg"
                                 class="circle responsive-img"
                                 style="width:50px;height: 50px;"
                                 alt="username"/>
                            <p>
                                <span class="red-text text-lighten-2">@jimfolley</span> added you to their contact list.
                                Add to see their messages.
                            </p>
                            <button class="btn blue darken-3 waves-effect waves-ripple">
                                Add
                            </button>
                            <button class="btn btn-floating red darken-2 waves-effect waves-ripple form-inline tooltipped"
                                    data-position="top"
                                    data-tooltip="Delete notification">
                                <i class="fa fa-trash"></i>
                            </button>
                        </li>
                        <li class="collection-item avatar">
                            <img src="../images/singer-579923_640.jpg"
                                 class="circle responsive-img"
                                 style="width:50px;height: 50px;"
                                 alt="username"/>
                            <p>
                                <span class="red-text text-lighten-2">@jimfolley</span>
                                accepted your invitation to be your contact.
                            </p>
                            <button class="btn btn-floating red darken-2 waves-effect waves-ripple form-inline tooltipped"
                                    data-position="top"
                                    data-tooltip="Delete notification">
                                <i class="fa fa-trash"></i>
                            </button>
                        </li>
                        <li class="collection-item avatar">
                            <img src="../images/singer-579923_640.jpg"
                                 class="circle responsive-img"
                                 style="width:50px;height: 50px;"
                                 alt="username"/>
                            <p>
                                You have <span class="red-text text-lighten-2">6 unreplied</span> fan mail messages
                            </p>
                            <button class="btn blue darken-3 waves-effect waves-ripple">
                                Read
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="col s12 z-depth-5" style="padding: 10px 5px;">
                    <button class="btn btn-extend red darken-2 waves-effect waves-ripple" id="close-my-notifications">
                        CLOSE
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<header>
    <div class="navbar-fixed">
        <nav class="blue darken-1">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="index.php" class="brand-logo">
                        <img src="../images/logo_small_trans.png"
                             class="responsive-img"
                             alt="singaar logo"
                             style="width: 200px;height:65px;">
                    </a>
                    <a href="" class="button-collapse right show-on-large" data-activates="side-nav">
                        <i class="fa fa-bars"></i>
                    </a>
                    <a href="" class="show-on-large right show-notifications">
                        <i class="fa fa-bell-o"></i>
                    </a>

                    <ul class="right hide-on-med-and-down">
                        <li class="active">
                            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="./customer_care.php">Customer Care</a>
                        </li>
                        <li><a href="./public_page.php">Public Page</a></li>
                        <li>
                        <li>
                            <a href="./uploads.php">Uploads</a>
                        </li>
                        <li>
                            <a href="../php/logout.php" class="tooltipped"
                               data-position="top" data-tooltip="Logout"><i class="fa fa-power-off"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--Side-nav-->
    <ul class="side-nav" id="side-nav">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="img/ocean.jpg" alt="Background Image"/>
                </div>
                <a href="#" >
                    <img src="<?php echo $artist_info_node["profile_imgSm"]; ?>"
                         alt="<?php echo $artist_info_node["username"]; ?>" class="circle">
                </a>
                <a href="">
                    <span class="name white-text text-capitalize"><?php echo $artist_info_node["username"]; ?></span>
                </a>
                <a href=""><span class="email white-text"><?php echo $artist_info_node["email"]; ?></span></a>
            </div>
        </li>

        <li>
            <a href="index.php" class="waves-effect"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="" class="waves-effect">Manage Uploads</a>
        </li>
        <li>
            <a href="" class="waves-effect">Public Page</a>
        </li>
        <li>
            <a href="./payments.php" class="waves-effect">Payments</a>
        </li>
        <li>
            <a href="./customer_care.php" class="waves-effect">Customer Care</a>
        </li>
        <li>
            <a href="" class="waves-effect toggle-side-nav-dropdown">Messaging <i class="fa fa-chevron-down"></i></a>
        </li>
        <li style="display: none;" class="dropdown-to-toggle">
            <ul>
                <li><a href="./messaging.php">Artists</a></li>
                <li><a href="./contact_messages.php">Fan Mail</a></li>
            </ul>
        </li>

        <li><div class="divider"></div></li>

        <li><a href="" class="subheader">Account Controls</a></li>

        <li><a href="./policy.php" class="waves-effect"><i class="fa fa-file-text-o"></i> Policy</a></li>

        <li><a href="../php/logout.php" class="waves-effect"><i class="fa fa-power-off"></i> Logout</a></li>
    </ul>
</header>

<!--Section: section-profile-area-->
<section class="section section-profile-area">
    <div class="row">
        <div class="col s12 l5">
            <div class="row">
                <div class="col s12">
                    <div class="card blue darken-3">
                        <div class="card-content center">
                            <img src="<?php echo $artist_info_node["profile_imgSm"]; ?>"
                                 alt="<?php echo $artist_info_node["username"]; ?>"
                                 class="responsive-img circle blue darken-1"
                                 style="width:50%;height:50%;border:7px solid #1976D2;"/>
                        </div>
                    </div>
                </div>
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Profile</span>
                            <ul class="collection my-collection">
                                <li class="collection-item">
                            <span class="blue-text text-darken-3">
                                <i class="fa fa-user"></i> Username:</span> <?php echo $artist_info_node["username"]; ?>
                                </li>
                                <li class="collection-item">
                            <span class="blue-text text-darken-3">
                                <i class="fa fa-envelope-o"></i> Email:</span> <?php echo $artist_info_node["email"]; ?>
                                </li>
                                <li class="collection-item">
                            <span class="blue-text text-darken-3">
                                <i class="fa fa-calendar"></i> Active Since:</span> <?php
                                    echo $artist_info_node["active_since"]; ?>
                                </li>
                                <li class="collection-item">
                            <span class="blue-text text-darken-3">
                                <i class="fa fa-music"></i> Music Styles:</span> <?php
                                    echo ucwords($artist_info_node["musical_style"],","); ?>
                                </li>
                            </ul>
                        </div>
                        <div class="card-action">
                            <a href="#edit-profile" class="btn-large btn-floating blue darken-2 tooltipped modal-trigger"
                               data-position="top" data-tooltip="Edit Profile">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col s12 l7">
            <div class="row">
                <div class="col s12 m6">
                    <div class="card-panel center" >
                        <i class="fa fa-music medium"></i>
                        <h5>Songs</h5>
                        <h5 class="count"><?php echo Artists::countAllArtistAudios(); ?></h5>
                        <div class="progress grey lighten-1">
                            <div class="determinate blue lighten-1" style="width:10%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card-panel center blue lighten-1 white-text" >
                        <i class="fa fa-film medium"></i>
                        <h5>Videos</h5>
                        <h5 class="count"><?php echo Artists::countAllArtistVideos(); ?></h5>
                        <div class="progress grey lighten-1">
                            <div class="determinate white" style="width:40%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">FAN MAIL</span>
                            <ul class="collection my-collection-2">
                                <li class="collection-item avatar">
                                    <img src="img/person2.jpg"
                                         class="responsive-img circle" alt="image">
                                    <span class="title">
                                        <a href="" class="blue-text text-darken-3 text-capitalize emphais">
                                        John Adakole
                                    </a>
                                    </span>
                                   <p>
                                       Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, provident?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, quae.
                                   </p>
                                    <form action="" class="inline-form">
                                        <button type="submit" class="btn btn-floating red lighten-1 tooltipped deny"
                                                data-position="top" data-tooltip="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </li>
                                <li class="collection-item avatar">
                                    <img src="img/person2.jpg"
                                         class="responsive-img circle" alt="image">
                                    <span class="title">
                                        <a href="" class="blue-text text-darken-3 text-capitalize emphais">
                                        John Adakole
                                    </a>
                                    </span>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, provident?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, quae.
                                    </p>
                                    <form action="" class="inline-form">
                                        <button type="submit" class="btn btn-floating red lighten-1 tooltipped deny"
                                                data-position="top" data-tooltip="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </li>
                                <li class="collection-item avatar">
                                    <img src="img/person2.jpg"
                                         class="responsive-img circle" alt="image">
                                    <span class="title">
                                        <a href="" class="blue-text text-darken-3 text-capitalize emphais">
                                        John Adakole
                                    </a>
                                    </span>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, provident?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, quae.
                                    </p>
                                    <form action="" class="inline-form">
                                        <button type="submit" class="btn btn-floating red lighten-1 tooltipped deny"
                                                data-position="top" data-tooltip="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </li>
                            </ul>

                        </div>
                        <div class="card-action">
                            <a href="./contact_messages.php"
                               class="btn btn-extend blue darken-2 waves-effect waves-ripple">
                                MORE
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red waves-effect tooltipped"
       data-position="top" data-tooltip="Options">
        <i class="fa fa-plus"></i>
    </a>
    <ul>
        <li>
            <a href="#edit-profile" class="btn-floating deep-purple category-modal modal-trigger tooltipped"
            data-position="top" data-tooltip="Edit account">
                <i class="fa fa-pencil"></i>
            </a>
        </li>
        <li>
            <a href="#manage-public-page" class="btn-floating deep-orange category-modal modal-trigger tooltipped"
               data-position="top" data-tooltip="Manage public page">
                <i class="fa fa-cog"></i>
            </a>
        </li>
    </ul>
</div>

<?php include_once("css/modal_edit_profile_and_p_profile.php"); ?>

<!--Footer-->
<?php include_once("css/footer.php");?>

<!--PRE-LOADER-->
<div class="preloader-wrapper big active loader">
    <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
            <div class="circle"></div>
        </div>

        <div class="gap-patch">
            <div class="circle"></div>
        </div>

        <div class="circle-clipper right">
            <div class="circle"></div>
        </div>
    </div>
</div>

<script>
    //HIDE CONTENT INITIALLY, ONLY SHOWING THE PRE-LOADER
    $("header, nav, .section, .fixed-action-btn").hide();

    setTimeout(function(){
        $(document).ready(function(){
            //SHOW SECTIONS
            $("header, nav, .section, .fixed-action-btn").fadeIn();

            //HIDE PRE-LOADER
            $(".loader").fadeOut();

            //INIT SIDE-NAV
            $(".button-collapse").sideNav({
                draggable: true
            });

            //COUNTER
            $(".count").each(function(){
                $(this).prop("Counter", 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 1000,
                    easing: "swing",
                    step: function(now){
                        $(this).text(Math.ceil(now));
                    }
                });
            });

            $(".approve").on("click", function(e){
                e.preventDefault();
                Materialize.toast("Marked as read", 3000, "rounded");
            });

            $(".deny").on("click", function(e){
                e.preventDefault();
                Materialize.toast("Message deleted", 3000, "rounded");
            });

            //INIT SELECT
            $("select").material_select();

            //INIT MODAL
            $(".modal").modal({
                dismissible: false
            });

            $(".close-md").on("click", function(e){
                e.preventDefault();
            });

            $(".toggle-side-nav-dropdown").on("click", function(e){
                e.preventDefault();
                $(".dropdown-to-toggle").slideToggle("slow");
            });

            $("#update-profile").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url: "../ajax_codes/artist_edit_profile.php",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $("#public-page-settings").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url: "../ajax_codes/artist_update_public_page.php",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }

                });
            });

            $("#close-my-notifications").on("click", function(e){
                e.preventDefault();
                $(".all-notifications").fadeOut();
            });

            $(".show-notifications").on("click", function(e){
                e.preventDefault();
                $(".all-notifications").fadeIn();
            });

        });
    }, 1000);

</script>

</body>
</html>