<?php
require_once("../PHP_classes/initialize.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Malone's Public Page</title>

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

        .public-profile-img-section img{ width:200px; height: 200px; border: 5px solid #1565C0; }

        .public-profile-info-section{ padding-top: 10px !important; }

        .public-profile-info-section p{ margin-bottom: 10px !important; }

        .form-inline{ display: inline-block !important; vertical-align: top !important; }

        .cl-title-text{ font-size: 20px !important; }

        .related-artists-widget-1{ border-right: 1px solid #ccc !important; }

        .my-collection { border-top: none !important; border-left: none !important; border-right: none !important; }

        .my-collection:nth-child(3){ border-bottom: none !important; }


        @media (max-width: 950px) and (min-width: 799px) {
            .public-profile-img-section img{ height: 160px; }

            .related-artists-widget-1{ border-right: none !important; }
        }

        @media (max-width: 800px) and (min-width: 599px) {
            .public-profile-img-section img{ width:220px; height: 140px; }

            .cl-title-text{ font-size: 17px !important; }

            .related-artists-widget-1{ border-right: none !important; }
        }

        @media (max-width: 600px) {
            .public-profile-img-section img{ width:150px; height: 150px; }

            .public-profile-info-section{ text-align: center !important; }

            .cl-title-text{ font-size: 15px !important; }

            .related-artists-widget-1{ border-right: none !important; }
        }
    </style>

</head>
<body class="grey lighten-4">
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>
<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

<header>
    <div class="navbar-fixed">
        <nav class="blue darken-2">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="<?php echo (isset($_SERVER["HTTP_REFERER"]) 
                        ? $_SERVER["HTTP_REFERER"] : "../index.php"); ?>">
                        <i class="fa fa-arrow-left white-text tooltipped fa fa-"
                                                   data-position="top" data-tooltip="Back"></i></a>
                </div>
            </div>
        </nav>
    </div>
</header>

<!--Section: section-form-container-->
<section class="section section-form-container">
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <!--SECTION: TO BE DISPLAYED IF THE ARTIST'S PUBLIC PAGE IS TURNED OFF-->
            <section class="card-panel z-depth-5 no-padding">
                <div class="row">
                    <div class="col s12 blue darken-2 center white-text" style="padding: 80px 10px;">
                        <i class="fa fa-signal fa-5x"></i>
                        <p class="flow-text">
                            <span class="grey-text text-lighten-1 text-capitalize">Chris Hemsworth's</span>
                            page is currently offline</p>
                    </div>
                    <!--Section:holds all the related artists-->
                    <div class="col s12">
                        <div class="row">
                            <div class="col s12 grey-text center" style="border-bottom: 1px solid #ccc;">
                                <p class="flow-text">RELATED ARTISTS</p>
                            </div>
                            <div class="col s12 l6 related-artists-widget-1">
                                <ul class="collection my-collection">
                                    <li class="collection-item avatar">
                                        <div>
                                            <img src="../images/singer-579923_640.jpg"
                                                 class="avatar responsive-img circle" alt="">
                                            <span class="title text-uppercase blue-text text-darken-1">Jimmy Mclean</span><br>
                                            <span class="grey-text text-darken-1 text-capitalize">soul,rnb,rap</span><br>
                                            <span><i class="fa fa-envelope-o"></i> jd@gmail.com</span>
                                            <a href="" class="secondary-content btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped"
                                               data-position="top"
                                               data-tooltip="View page">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="collection-item avatar default-collection-item">
                                        <div>
                                            <img src="../images/singer-579923_640.jpg"
                                                 class="avatar responsive-img circle" alt="">
                                            <span class="title text-uppercase blue-text text-darken-1">Jimmy Mclean</span><br>
                                            <span class="grey-text text-darken-1 text-capitalize">soul,rnb,rap</span><br>
                                            <span><i class="fa fa-envelope-o"></i> jd@gmail.com</span>
                                            <a href="" class="secondary-content btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped"
                                               data-position="top"
                                               data-tooltip="View page">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="collection-item avatar default-collection-item">
                                        <div>
                                            <img src="../images/singer-579923_640.jpg"
                                                 class="avatar responsive-img circle" alt="">
                                            <span class="title text-uppercase blue-text text-darken-1">Jimmy Mclean</span><br>
                                            <span class="grey-text text-darken-1 text-capitalize">soul,rnb,rap</span><br>
                                            <span><i class="fa fa-envelope-o"></i> jd@gmail.com</span>
                                            <a href="" class="secondary-content btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped"
                                               data-position="top"
                                               data-tooltip="View page">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col hide-on-med-and-down l6">
                                <ul class="collection my-collection">
                                    <li class="collection-item avatar">
                                        <div>
                                            <img src="../images/singer-579923_640.jpg"
                                                 class="avatar responsive-img circle" alt="">
                                            <span class="title text-uppercase blue-text text-darken-1">Jimmy Mclean</span><br>
                                            <span class="grey-text text-darken-1 text-capitalize">soul,rnb,rap</span><br>
                                            <span><i class="fa fa-envelope-o"></i> jd@gmail.com</span>
                                            <a href="" class="secondary-content btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped"
                                               data-position="top"
                                               data-tooltip="View page">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="collection-item avatar default-collection-item">
                                        <div>
                                            <img src="../images/singer-579923_640.jpg"
                                                 class="avatar responsive-img circle" alt="">
                                            <span class="title text-uppercase blue-text text-darken-1">Jimmy Mclean</span><br>
                                            <span class="grey-text text-darken-1 text-capitalize">soul,rnb,rap</span><br>
                                            <span><i class="fa fa-envelope-o"></i> jd@gmail.com</span>
                                            <a href="" class="secondary-content btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped"
                                               data-position="top"
                                               data-tooltip="View page">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="collection-item avatar default-collection-item">
                                        <div>
                                            <img src="../images/singer-579923_640.jpg"
                                                 class="avatar responsive-img circle" alt="">
                                            <span class="title text-uppercase blue-text text-darken-1">Jimmy Mclean</span><br>
                                            <span class="grey-text text-darken-1 text-capitalize">soul,rnb,rap</span><br>
                                            <span><i class="fa fa-envelope-o"></i> jd@gmail.com</span>
                                            <a href="" class="secondary-content btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped"
                                               data-position="top"
                                               data-tooltip="View page">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="card blue darken-2 white-text">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m3 center public-profile-img-section">
                            <img src="img/person2.jpg" class="responsive-img circle"
                                 alt="profile image"/>
                        </div>
                        <div class="col s12 m9 public-profile-info-section">
                            <span class="card-title text-capitalize">
                                Jimmy Hendrix
                                <span class="hide-on-small-only">
<!--                                    [Position: 1 <i class="fa fa-caret-up green-text text-lighten-2"></i>]-->
                                    [Position: 2 <i class="fa fa-caret-down red-text text-lighten-2"></i>]
                                </span>
                            </span>
                            <p>
                                <span>
                                <i class="fa fa-calendar"></i> Active Since: December, 2018
                                </span>
                            </p>
                            <p>
                                <span>
                                <i class="fa fa-music"></i> Rap, RnB, Soul
                                </span>
                            </p>
                            <p>
                                <span>
                                <i class="fa fa-pencil"></i>
                                    A self-proclaimed king of rock-n-roll. None before has been better.
                                </span>
                            </p>
                        </div>
                    </div>

                </div>

                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width blue darken-3">
                        <li class="tab">
                            <a href="#tab1" class="text-darken-2 white-text">
                                <i class="fa fa-film"></i> Videos
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#tab2" class="text-darken-2 white-text">
                                <i class="fa fa-music"></i> Music
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#tab3" class="text-darken-2 white-text">
                                <i class="fa fa-fax"></i> Contact Info</a>
                        </li>
                    </ul>
                </div>
                <div class="card-content white black-text">
                    <div id="tab1">
                        <div class="row">
                            <div class="col s12 m4">
                                <div class="card-panel center blue lighten-1 white-text" >
                                    <i class="fa fa-film medium"></i>
                                    <h5>Videos</h5>
                                    <h5 class="count">230000</h5>
                                    <div class="progress grey lighten-1">
                                        <div class="determinate white" style="width:40%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m8">
                                <ul class="collection with-header">
                                    <li class="collection-header flow-text center">
                                        Videos
                                    </li>
                                    <li class="collection-item">
                                        <span class="title blue-text text-darken-3 flow-text
                                         text-uppercase cl-title-text">
                                            Jimmy Danton and the spurs
                                        </span><br>
                                        <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                                        <div class="row">
                                            <div class="col s12" style="margin-top: 10px;">
                                                <a href=""
                                                   download=""
                                                   class="btn teal darken-2 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Download"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-download"></i>
                                                    <span class="hide-on-small-only">Download</span>
                                                </a>
                                                <a href="./public_page_video.php"
                                                   class="btn amber darken-4 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Play"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-play-circle-o"></i>
                                                    <span class="hide-on-small-only">Play</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="collection-item">
                                        <span class="title blue-text text-darken-3 flow-text
                                         text-uppercase cl-title-text">
                                            Jimmy Danton and the spurs
                                        </span><br>
                                        <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                                        <div class="row">
                                            <div class="col s12" style="margin-top: 10px;">
                                                <a href=""
                                                   download=""
                                                   class="btn teal darken-2 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Download"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-download"></i>
                                                    <span class="hide-on-small-only">Download</span>
                                                </a>
                                                <a href="./public_page_video.php"
                                                   class="btn amber darken-4 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Play"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-play-circle-o"></i>
                                                    <span class="hide-on-small-only">Play</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="collection-item">
                                        <span class="title blue-text text-darken-3 flow-text
                                         text-uppercase cl-title-text">
                                            Jimmy Danton and the spurs
                                        </span><br>
                                        <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                                        <div class="row">
                                            <div class="col s12" style="margin-top: 10px;">
                                                <a href=""
                                                   download=""
                                                   class="btn teal darken-2 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Download"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-download"></i>
                                                    <span class="hide-on-small-only">Download</span>
                                                </a>
                                                <a href="./public_page_video.php"
                                                   class="btn amber darken-4 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Play"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-play-circle-o"></i>
                                                    <span class="hide-on-small-only">Play</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="collection-item">
                                        <span class="title blue-text text-darken-3 flow-text
                                         text-uppercase cl-title-text">
                                            Jimmy Danton and the spurs
                                        </span><br>
                                        <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                                        <div class="row">
                                            <div class="col s12" style="margin-top: 10px;">
                                                <a href=""
                                                   download=""
                                                   class="btn teal darken-2 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Download"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-download"></i>
                                                    <span class="hide-on-small-only">Download</span>
                                                </a>
                                                <a href="./public_page_video.php"
                                                   class="btn amber darken-4 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Play"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-play-circle-o"></i>
                                                    <span class="hide-on-small-only">Play</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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
                    <div id="tab2">
                        <div class="row">
                            <div class="col s12 m4">
                                <div class="card-panel center blue lighten-1 white-text" >
                                    <i class="fa fa-music medium"></i>
                                    <h5>Songs</h5>
                                    <h5 class="count">230000</h5>
                                    <div class="progress grey lighten-1">
                                        <div class="determinate white" style="width:40%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m8">
                                <ul class="collection with-header">
                                    <li class="collection-header flow-text center">
                                        Songs
                                    </li>
                                    <li class="collection-item">
                                        <span class="title blue-text text-darken-3 flow-text
                                         text-uppercase cl-title-text">
                                            Jimmy Danton and the spurs
                                        </span><br>
                                        <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                                        <div class="row">
                                            <div class="col s12" style="margin-top: 10px;">
                                                <a href=""
                                                   download=""
                                                   class="btn teal darken-2 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Download"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-download"></i>
                                                    <span class="hide-on-small-only">Download</span>
                                                </a>
                                                <a href="./public_page_audio.php"
                                                   class="btn amber darken-4 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Play"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-play-circle-o"></i>
                                                    <span class="hide-on-small-only">Play</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="collection-item">
                                        <span class="title blue-text text-darken-3 flow-text
                                         text-uppercase cl-title-text">
                                            Jimmy Danton and the spurs
                                        </span><br>
                                        <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                                        <div class="row">
                                            <div class="col s12" style="margin-top: 10px;">
                                                <a href=""
                                                   download=""
                                                   class="btn teal darken-2 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Download"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-download"></i>
                                                    <span class="hide-on-small-only">Download</span>
                                                </a>
                                                <a href="./public_page_audio.php"
                                                   class="btn amber darken-4 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Play"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-play-circle-o"></i>
                                                    <span class="hide-on-small-only">Play</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="collection-item">
                                        <span class="title blue-text text-darken-3 flow-text
                                         text-uppercase cl-title-text">
                                            Jimmy Danton and the spurs
                                        </span><br>
                                        <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                                        <div class="row">
                                            <div class="col s12" style="margin-top: 10px;">
                                                <a href=""
                                                   download=""
                                                   class="btn teal darken-2 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Download"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-download"></i>
                                                    <span class="hide-on-small-only">Download</span>
                                                </a>
                                                <a href="./public_page_audio.php"
                                                   class="btn amber darken-4 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Play"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-play-circle-o"></i>
                                                    <span class="hide-on-small-only">Play</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="collection-item">
                                        <span class="title blue-text text-darken-3 flow-text
                                         text-uppercase cl-title-text">
                                            Jimmy Danton and the spurs
                                        </span><br>
                                        <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                                        <div class="row">
                                            <div class="col s12" style="margin-top: 10px;">
                                                <a href=""
                                                   download=""
                                                   class="btn teal darken-2 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Download"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-download"></i>
                                                    <span class="hide-on-small-only">Download</span>
                                                </a>
                                                <a href="./public_page_audio.php"
                                                   class="btn amber darken-4 form-inline
                                                   waves-effect waves-ripple tooltipped"
                                                   data-position="top"
                                                   data-tooltip="Play"
                                                   style="margin-bottom: 7px !important;">
                                                    <i class="fa fa-play-circle-o"></i>
                                                    <span class="hide-on-small-only">Play</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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
                    <div id="tab3">
                        <div class="row">
                            <div class="col s12 m4">
                                <ul class="collection with-header">
                                    <li class="collection-header">
                                        <h5 class="flow-text blue-text text-darken-3">
                                            Catch me on social media
                                        </h5>
                                    </li>
                                    <li class="collection-item">
                                        <a href="https://www.facebook.com" target="_blank" class="black-text">
                                            <span class="flow-text tooltipped"
                                                  data-position="top" data-tooltip="Facebook Account">
                                            <i class="fa fa-facebook-square"></i>
                                             Facebook
                                        </span>
                                        </a>
                                    </li>
                                    <li class="collection-item">
                                        <a href="http://www.instagram.com" target="_blank" class="black-text">
                                            <span class="flow-text tooltipped"
                                                  data-position="top" data-tooltip="Instagram Account">
                                            <i class="fa fa-instagram"></i>
                                             Instagram
                                        </span>
                                        </a>
                                    </li>
                                    <li class="collection-item">
                                        <a href="http://www.twitter.com" target="_blank" class="black-text">
                                            <span class="flow-text tooltipped"
                                                  data-position="top" data-tooltip="Twitter Account">
                                            <i class="fa fa-twitter"></i>
                                             Twitter
                                        </span>
                                        </a>
                                    </li>
                                    <li class="collection-item">
                                        <a href="http://www.google.com" target="_blank" class="black-text">
                                            <span class="flow-text tooltipped"
                                                  data-position="top" data-tooltip="Google-plus Account">
                                            <i class="fa fa-google-plus"></i>
                                             Google Plus
                                        </span>
                                        </a>
                                    </li>
                                    <li class="collection-item">
                                        <span class="flow-text tooltipped"
                                              data-position="top" data-tooltip="Whatsapp Number">
                                            <i class="fa fa-whatsapp"></i>
                                             +2349021334546
                                        </span>
                                    </li>
                                    <li class="collection-item">
                                        <span class="flow-text tooltipped"
                                              data-position="top" data-tooltip="Email Address">
                                            <i class="fa fa-envelope-o"></i>
                                              jd@gmail.com
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col s12 m7 offset-m1">
                               <h5 class="flow-text center blue-text text-darken-3">Contact me directly</h5>
                                <form action="" method="post">
                                    <div class="input-field blue-text text-darken-3">
                                        <i class="fa fa-user prefix"></i>
                                        <input type="text" id="username"/>
                                        <label for="username">Name</label>
                                    </div>
                                    <div class="input-field blue-text text-darken-3">
                                        <i class="fa fa-envelope-o prefix"></i>
                                        <input type="email" id="email" class="validate"/>
                                        <label for="email"
                                               data-success="Valid Email"
                                               data-error="Invalid Email">Email</label>
                                    </div>
                                    <div class="input-field blue-text text-darken-3">
                                        <i class="fa fa-map-marker prefix"></i>
                                        <textarea name="" id="address" class="materialize-textarea"></textarea>
                                        <label for="address">Address (optional)</label>
                                    </div>

                                    <div class="input-field blue-text text-darken-3">
                                        <i class="fa fa-pencil prefix"></i>
                                        <textarea name="" id="message" class="materialize-textarea"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                    <div class="input-field">
                                        <button type="submit" class="btn btn-extend blue darken-3">
                                            <i class="fa fa-send-o"></i> &nbsp;SEND
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

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

        });
    }, 1000);

</script>

</body>
</html>