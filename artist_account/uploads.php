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
    <title>Manage Uploads | <?php echo ucwords($artist_info_node["username"]); ?></title>

    <!--Import Google icon font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icons?family=Material+icons"/>

    <!--Link materialize.css file here-->
    <link rel="stylesheet" href="../css/materialize.min.css" media="screen, projection" />
    <link rel="stylesheet" href="css/main5.css" />
    <!--Link the site icon on the title bar-->
    <link rel="icon" type="image/icon" href="../images/s_only.png"/>
    <!--Link the font-awesome Library-->
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css"/>
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

        .tabs .indicator{ background: indianred !important; height: 4px !important; }

        .hold-notifications{ overflow-y: scroll; height: calc(100% - 56px); }

    </style>

</head>
<body class="grey lighten-4">
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>
<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

<!--Include the notifications file-->
<?php include_once("css/notifications_file.php"); ?>

<!--Section: loader <div>-->
<section class="uploader-loader" style="background:rgba(0,0,0,0.8);height:100% !important;top:0left:0;background-size: cover !important;position:fixed;z-index: 99999;text-align: center;color:#fff;width:100%;display:none;">
    <div class="row loader-section">
        <div class="col m10 offset-m1 l6 offset-l3">
            <div class="progress grey lighten-2">
                <div class="indeterminate blue lighten-1"></div>
            </div>
        </div>
    </div>
    <p class="flow-text" style="position: relative">Uploading...</p>
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
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="./customer_care.php">Customer Care</a>
                        </li>
                        <li><a href="./public_page.php">Public Page</a></li>
                        <li>
                        <li class="active">
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

<!--Section: section-form-container-->
<section class="section section-form-container">
    <div class="row">
        <div class="col s12 m10 l8 offset-l2 offset-m1">
            <div class="card blue darken-2 white-text">
                <div class="card-content">
                    <span class="card-title">Manage Uploads</span>
                    <div class="row">
                        <div class="col s12 m6 no-padding">
                            <ul>
                                <li class="text-uppercase grey-text text-lighten-2"><i class="fa fa-chevron-right"></i>
                                    valid file sizes
                                </li>
                                <li >Songs: <span class="grey-text text-lighten-3">3mb</span></li>
                                <li>Videos: <span class="grey-text text-lighten-3">8mb</span></li>
                            </ul>
                        </div>
                        <div class="col s12 m6 no-padding">
                            <ul>
                                <li class="text-uppercase grey-text text-lighten-2"><i class="fa fa-chevron-right"></i>
                                    valid file types
                                </li>
                                <li >Songs: <span class="grey-text text-lighten-3">mp3, ogg</span></li>
                                <li>Videos: <span class="grey-text text-lighten-3">mp4, flv</span></li>
                            </ul>
                        </div>
                    </div>
                    <span>For more info <a href="./policy.php"
                                           class="grey-text text-lighten-3" style="text-decoration: underline">
                            view our policy page</a>
                    </span>
                </div>

                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width blue darken-3">
                        <li class="tab">
                            <a href="#tab1" class="text-darken-2 white-text">
                                <i class="fa fa-film"></i> Upload Videos
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#tab2" class="text-darken-2 white-text">
                                <i class="fa fa-music"></i> Upload Music
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#tab3" class="text-darken-2 white-text">Music gallery</a>
                        </li>
                        <li class="tab">
                            <a href="#tab4" class="text-darken-2 white-text">Video gallery</a>
                        </li>
                    </ul>
                </div>
                <div class="card-content white black-text">
                    <div id="tab1">
                        <div class="row">
                            <div class="col s12 m7">
                                <form method="post" enctype="multipart/form-data" id="upload-video-form">
                                    <div class="file-field input-field">
                                        <div class="btn blue darken-3 waves-effect waves-ripple">
                                            <span><i class="fa fa-film"></i> Select Video</span>
                                            <input type="file" required accept="video/*"
                                                   name="v_file" id="my-file-selector"/>
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input type="text" class="file-path"/>
                                        </div>
                                    </div>
                                    <div class="input-field blue-text text-darken-3">
                                        <input type="text" required name="v_title" id="v-title"/>
                                        <label for="v-title">Video Title</label>
                                    </div>
                                    <div class="input-field blue-text text-darken-3">
                                        <textarea name="v_desc"
                                                  required id="v-description" class="materialize-textarea"></textarea>
                                        <label for="v-description">Video Description</label>
                                    </div>
                                    <div class="input-field">
                                        <button type="submit" class="btn btn-extend blue darken-3">
                                            <i class="fa fa-upload"></i> &nbsp;UPLOAD VIDEO
                                        </button>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col s12 video-error-log" style="display:none;padding:10px 0 0 0;">
                                        <div class="card-panel center red-text text-darken-2 flow-text"
                                             id="msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m5 hide-on-small-only" id="preview-video-con" style="display: none;">
                                <video class="responsive-video"
                                       controls preload="metadata" id="preview-video" style="width:100%;height: 100%;">
                                    <source src="" type="video/mp4"/>
                                </video>
                            </div>
                        </div>
                    </div>
                    <div id="tab2">
                        <div class="row">
                            <div class="col s12 m7">
                                <form method="post" enctype="multipart/form-data" id="upload-music-form">
                                    <div class="file-field input-field">
                                        <div class="btn blue darken-3 waves-effect waves-ripple">
                                            <span><i class="fa fa-music"></i> Select SONG</span>
                                            <input type="file" required accept="audio/*" name="a_file"
                                                   id="my-file-selector-2"/>
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input type="text" class="file-path"/>
                                        </div>
                                    </div>
                                    <div class="input-field blue-text text-darken-3">
                                        <input type="text" required name="a_title" id="v-title"/>
                                        <label for="v-title">Song Title</label>
                                    </div>
                                    <div class="input-field blue-text text-darken-3">
                                        <textarea name="a_desc"
                                                  required
                                                  id="a-description"
                                                  class="materialize-textarea"></textarea>
                                        <label for="v-description">Song Description</label>
                                    </div>
                                    <div class="input-field">
                                        <button type="submit" class="btn btn-extend blue darken-3">
                                            <i class="fa fa-upload"></i> &nbsp;UPLOAD SONG
                                        </button>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col s12 audio-error-log" style="display:none;padding:10px 0 0 0;">
                                        <div class="card-panel center red-text text-darken-2 flow-text msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m5 hide-on-small-only preview-img-sec" style="display:none;">
                                <audio controls preload="metadata" id="preview-audio" style="width:100%;">
                                    <source
                                        src="" type="audio/mp3"/>
                                </audio>
                            </div>
                        </div>
                    </div>
                    <div id="tab3">
                        <div class="row">
                            <!--Section: audio-widget-->
                            <div class="col s12 m6" style="margin-bottom: 10px !important;">
                                <h6 style="font-size:16px;margin-bottom:0 !important;"
                                    data-position="top"
                                    data-tooltip="WizKid - Holla at your boy"
                                    class="blue-text text-darken-4 text-capitalize truncate tooltipped">
                                    1.WizKid - Holla at your boy
                                </h6>
                                <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>&nbsp;&nbsp;&nbsp;
                                <a href="./public_page_audio.php"
                                   class="tooltipped blue-text text-darken-2"
                                   data-position="top"
                                   data-tooltip="Play Song"
                                   style="display: inline;font-size: 19px;"><i class="fa fa-play-circle-o"></i></a>
                                <form action="" style="display: inline">
                                    <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                            data-position="top" data-tooltip="Delete Song">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <!--Section: audio-widget-->
                            <div class="col s12 m6" style="margin-bottom: 10px !important;">
                                <h6 style="font-size:16px;margin-bottom:0 !important;"
                                    data-position="top"
                                    data-tooltip="WizKid - Holla at your boy"
                                    class="blue-text text-darken-4 text-capitalize truncate tooltipped">
                                    1.WizKid - Holla at your boy
                                </h6>
                                <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>&nbsp;&nbsp;&nbsp;
                                <a href="./public_page_audio.php"
                                   class="tooltipped blue-text text-darken-2"
                                   data-position="top"
                                   data-tooltip="Play Song"
                                   style="display: inline;font-size: 19px;"><i class="fa fa-play-circle-o"></i></a>
                                <form action="" style="display: inline">
                                    <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                            data-position="top" data-tooltip="Delete Song">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <!--Section: audio-widget-->
                            <div class="col s12 m6" style="margin-bottom: 10px !important;">
                                <h6 style="font-size:16px;margin-bottom:0 !important;"
                                    data-position="top"
                                    data-tooltip="WizKid - Holla at your boy"
                                    class="blue-text text-darken-4 text-capitalize truncate tooltipped">
                                    1.WizKid - Holla at your boy
                                </h6>
                                <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>&nbsp;&nbsp;&nbsp;
                                <a href="./public_page_audio.php"
                                   class="tooltipped blue-text text-darken-2"
                                   data-position="top"
                                   data-tooltip="Play Song"
                                   style="display: inline;font-size: 19px;"><i class="fa fa-play-circle-o"></i></a>
                                <form action="" style="display: inline">
                                    <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                            data-position="top" data-tooltip="Delete Song">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <!--Section: audio-widget-->
                            <div class="col s12 m6" style="margin-bottom: 10px !important;">
                                <h6 style="font-size:16px;margin-bottom:0 !important;"
                                    data-position="top"
                                    data-tooltip="WizKid - Holla at your boy"
                                    class="blue-text text-darken-4 text-capitalize truncate tooltipped">
                                    1.WizKid - Holla at your boy
                                </h6>
                                <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>&nbsp;&nbsp;&nbsp;
                                <a href="./public_page_audio.php"
                                   class="tooltipped blue-text text-darken-2"
                                   data-position="top"
                                   data-tooltip="Play Song"
                                   style="display: inline;font-size: 19px;"><i class="fa fa-play-circle-o"></i></a>
                                <form action="" style="display: inline">
                                    <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                            data-position="top" data-tooltip="Delete Song">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <!--Section: audio-widget-->
                            <div class="col s12 m6" style="margin-bottom: 10px !important;">
                                <h6 style="font-size:16px;margin-bottom:0 !important;"
                                    data-position="top"
                                    data-tooltip="WizKid - Holla at your boy"
                                    class="blue-text text-darken-4 text-capitalize truncate tooltipped">
                                    1.WizKid - Holla at your boy
                                </h6>
                                <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>&nbsp;&nbsp;&nbsp;
                                <a href="./public_page_audio.php"
                                   class="tooltipped blue-text text-darken-2"
                                   data-position="top"
                                   data-tooltip="Play Song"
                                   style="display: inline;font-size: 19px;"><i class="fa fa-play-circle-o"></i></a>
                                <form action="" style="display: inline">
                                    <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                            data-position="top" data-tooltip="Delete Song">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <!--Section: audio-widget-->
                            <div class="col s12 m6" style="margin-bottom: 10px !important;">
                                <h6 style="font-size:16px;margin-bottom:0 !important;"
                                    data-position="top"
                                    data-tooltip="WizKid - Holla at your boy"
                                    class="blue-text text-darken-4 text-capitalize truncate tooltipped">
                                    1.WizKid - Holla at your boy
                                </h6>
                                <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>&nbsp;&nbsp;&nbsp;
                                <a href="./public_page_audio.php"
                                   class="tooltipped blue-text text-darken-2"
                                   data-position="top"
                                   data-tooltip="Play Song"
                                   style="display: inline;font-size: 19px;"><i class="fa fa-play-circle-o"></i></a>
                                <form action="" style="display: inline">
                                    <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                            data-position="top" data-tooltip="Delete Song">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <!--Section: audio-widget-->
                            <div class="col s12 m6" style="margin-bottom: 10px !important;">
                                <h6 style="font-size:16px;margin-bottom:0 !important;"
                                    data-position="top"
                                    data-tooltip="WizKid - Holla at your boy"
                                    class="blue-text text-darken-4 text-capitalize truncate tooltipped">
                                    1.WizKid - Holla at your boy
                                </h6>
                                <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>&nbsp;&nbsp;&nbsp;
                                <a href="./public_page_audio.php"
                                   class="tooltipped blue-text text-darken-2"
                                   data-position="top"
                                   data-tooltip="Play Song"
                                   style="display: inline;font-size: 19px;"><i class="fa fa-play-circle-o"></i></a>
                                <form action="" style="display: inline">
                                    <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                            data-position="top" data-tooltip="Delete Song">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div id="tab4">
                        <div class="row">
                            <div class="col s12">
                                <div class="row">
                                    <!--Section: Video-widget-->
                                    <div class="col s12 m4" style="margin-bottom: 10px !important;">
                                        <div class="video-container">
                                            <iframe src="https://www.youtube.com/embed/cQ5OqpHvIEo"
                                                    allowfullscreen frameborder="0" width="853" height="450">
                                            </iframe>
                                        </div>
                                        <h6 style="font-size:16px;margin-bottom: 0 !important;"
                                            class="text-capitalize blue-text text-darken-4">
                                            WizKid - Holla at your boy
                                        </h6>
                                        <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>
                                        <form action="" style="display: inline">
                                            <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                            data-position="top" data-tooltip="Delete Video">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!--Section: Video-widget-->
                                    <div class="col s12 m4" style="margin-bottom: 10px !important;">
                                        <div class="video-container">
                                            <iframe src="https://www.youtube.com/embed/cQ5OqpHvIEo"
                                                    allowfullscreen frameborder="0" width="853" height="450">
                                            </iframe>
                                        </div>
                                        <h6 style="font-size:16px;margin-bottom: 0 !important;"
                                            class="text-capitalize blue-text text-darken-4">
                                            WizKid - Holla at your boy
                                        </h6>
                                        <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>
                                        <form action="" style="display: inline">
                                            <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                                    data-position="top" data-tooltip="Delete Video">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <!--Section: Video-widget-->
                                    <div class="col s12 m4" style="margin-bottom: 10px !important;">
                                        <div class="video-container">
                                            <iframe src="https://www.youtube.com/embed/cQ5OqpHvIEo"
                                                    allowfullscreen frameborder="0" width="853" height="450">
                                            </iframe>
                                        </div>
                                        <h6 style="font-size:16px;margin-bottom: 0 !important;"
                                            class="text-capitalize blue-text text-darken-4">
                                            WizKid - Holla at your boy
                                        </h6>
                                        <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>
                                        <form action="" style="display: inline">
                                            <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                                    data-position="top" data-tooltip="Delete Video">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <!--Section: Video-widget-->
                                    <div class="col s12 m4" style="margin-bottom: 10px !important;">
                                        <div class="video-container">
                                            <iframe src="https://www.youtube.com/embed/cQ5OqpHvIEo"
                                                    allowfullscreen frameborder="0" width="853" height="450">
                                            </iframe>
                                        </div>
                                        <h6 style="font-size:16px;margin-bottom: 0 !important;"
                                            class="text-capitalize blue-text text-darken-4">
                                            WizKid - Holla at your boy
                                        </h6>
                                        <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>
                                        <form action="" style="display: inline">
                                            <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                                    data-position="top" data-tooltip="Delete Video">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <!--Section: Video-widget-->
                                    <div class="col s12 m4" style="margin-bottom: 10px !important;">
                                        <div class="video-container">
                                            <iframe src="https://www.youtube.com/embed/cQ5OqpHvIEo"
                                                    allowfullscreen frameborder="0" width="853" height="450">
                                            </iframe>
                                        </div>
                                        <h6 style="font-size:16px;margin-bottom: 0 !important;"
                                            class="text-capitalize blue-text text-darken-4">
                                            WizKid - Holla at your boy
                                        </h6>
                                        <span class="grey-text" style="font-size:13px">
                                            <i class="fa fa-calendar"></i> 12/12/2018
                                        </span>
                                        <form action="" style="display: inline">
                                            <button type="submit" class="btn-flat deep-orange-text
                                             text-lighten-1 tooltipped waves-effect"
                                                    data-position="top" data-tooltip="Delete Video">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
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
    $("header, .section, .fixed-action-btn").hide();

    setTimeout(function(){
        $(document).ready(function(){
            //SHOW SECTIONS
            $("header, .section, .fixed-action-btn").fadeIn();

            //HIDE PRE-LOADER
            $(".loader").fadeOut();

            //INIT SIDE-NAV
            $(".button-collapse").sideNav({
                draggable: true
            });

            $(".approve").on("click", function(e){
                e.preventDefault();
                Materialize.toast("Marked as read", 3000, "rounded");
            });

            $(".deny").on("click", function(e){
                e.preventDefault();
                Materialize.toast("Message deleted", 3000, "rounded");
            });

            //INIT MODAL
            $(".modal").modal({
                dismissible: false
            });

            $(".close-md").on("click", function(e){
                e.preventDefault();
            });

            //INIT SELECT
            $("select").material_select();

            //preview audio
            $(function(){
                $("#my-file-selector-2").on("change",function(){
                    var videoFile = this.files[0];
                    var videoName = videoFile.name;
                    var videoSize = videoFile.size;
                    var videoType = videoFile.type;
                    var error_log = $(".audio-error-log");

                    if(/\.(mp3|wav|aif|midi|mpc|oga|m4a|m4b|flac|iff|mid|ram|ra|snd|wma)$/i.test(videoName)){

                        /**
                         * if the audioSize <= 20mb, then preview to prevent FileReaderOverload
                         */
                        if( videoSize <= 20000000 ){
                            /**
                             * get the JavaScript FileReader for the js file
                             */
                            var fileReader = new FileReader(); //open the js FileReader service here
                            fileReader.onload = videoIsLoaded;
                            fileReader.readAsDataURL( this.files[0] );
                            $(".preview-img-sec").css("display", "block");
                            error_log.css("display", "none");
                        }
                        else{
                            error_log.css("display", "block");
                            $(".preview-img-sec").css("display", "none");
                            $(".audio-error-log>.msg").html("<p>The audio file exceeds the limit of 20mb</p>");
                        }
                    }
                    else{
                        error_log.css("display", "block");
                        $(".preview-img-sec").css("display", "none");
                        $(".audio-error-log>.msg").html("<p>Wrong format, only audio files are accepted...</p>");
                    }
                });
                function videoIsLoaded(e){
                    var audio = $("#preview-audio");
                    $(audio).attr('src', e.target.result);
                }
            });

            //preview video
            $(function(){
                $("#my-file-selector").on("change", function(){
                    var videoFile = this.files[0];
                    var videoName = videoFile.name;
                    var videoSize = videoFile.size;
                    var videoType = videoFile.type;
                    var error_log = $(".video-error-log");

                    if(/\.(mp4|mkv|flv|avi|mpeg|ogv|m4v|divx|xvid|wmv|webm|smil|mov)$/i.test(videoName)){
                        //23924668 = 22.8mb
                        if( videoSize <= 100000000 ){//1million bytes = 100mb

                            if( videoSize <= 80000000 ){//if the videoSize < 80mb, then preview to prevent FileReaderOverload
                                //get the j-query fileReader for the js file
                                var fileReader = new FileReader(); //open the js FileReader service here
                                fileReader.onload = videoIsLoaded;
                                fileReader.readAsDataURL(this.files[0]);
                                $("#preview-video-con").css("display", "block");
                                error_log.css("display", "none");
                            }
                        }
                        else{
                            error_log.css("display", "block");
                            $("#preview-video-con").css("display", "none");
                            $(".video-error-log>#msg").html("<p>The video file exceeds the limit of 100mb</p>");
                        }
                    }
                    else{
                        error_log.css("display", "block");
                        $("#preview-video-con").css("display", "none");
                        $(".video-error-log>#msg").html("<p>Wrong format, only video files are accepted...</p>");
                    }
                });
                function videoIsLoaded(e){
                    var video = $("#preview-video");
                    $(video).attr('src', e.target.result);
                    $(video).attr('type', videoFile.type);
                }
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

            $("#upload-video-form").on("submit", function(e){
                e.preventDefault();
                $(".uploader-loader").fadeIn();

                $.ajax({
                    url: "../ajax_codes/artist_upload_video.php",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function(data){
                        $(".uploader-loader").fadeOut();

                        if(/Upload complete/i.test(data)){
                            $("#preview-video-con").css("display", "none");
                            $("#upload-video-form").trigger("reset");
                        }
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $("#upload-music-form").on("submit", function(e){
                e.preventDefault();
                $(".uploader-loader").fadeIn();

                $.ajax({
                    url: "../ajax_codes/artist_upload_song.php",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function(data){
                        $(".uploader-loader").fadeOut();

                        if(/Upload complete/i.test(data)){
                            $(".preview-img-sec").css("display", "none");
                            $("#upload-music-form").trigger("reset");
                        }
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

            $(".confirm-contact").on("click", function(e){
                e.preventDefault();

                $.ajax({
                    url: "../ajax_codes/artist_confirm_contact.php",
                    data: { n_id : $(".n-id").val(), n_from_user : $(".n-from-id").val() },
                    type: "POST",
                    success: function(data){
                        Materialize.toast(data, 1000, "rounded");
                    }
                });
            });

            $(".decline-invitation").on("click", function(e){
                e.preventDefault();
                var node1 = $(this).find(".n-id");
                var node2 = $(this).find(".n-from-id");

                $.ajax({
                    url: "../ajax_codes/artist_decline_contact.php",
                    data: { n_id : node1.val(), n_from_user : node2.val() },
                    type: "POST",
                    success: function(data){
                        Materialize.toast(data, 1000, "rounded");
                    }
                });
            });

            $(".delete-notification").on("click", function(e){
                e.preventDefault();
                var node = $(this).find(".del_n_id");

                $.ajax({
                    url: "../ajax_codes/artist_delete_notification.php",
                    data: { n_id : node.val() },
                    type: "POST",
                    success: function(data){
                        Materialize.toast(data, 1000, "rounded");
                    }
                });
            });

        });
    }, 1000);

</script>

</body>
</html>