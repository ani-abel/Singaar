<?php
require_once("../PHP_classes/initialize.php");

global $session, $db, $first_user, $user_id_first, $select_from;

if( !($session->is_logged_in() || isset($session->user_id, $_SESSION['role'])) || $_SESSION['role'] != "artist"){
    $session->logout();
    redirect_to("../php/login.php");
}

if( (isset($_SESSION['temp_token']) && $_SESSION['temp_token'] == "payment only") )
    redirect_to("payments.php");

$artist_info_node = BlogWriter::getBloggerInfo();

$first_user = 0;
$select_from = "";
$user_id_first = null;

if( !getFirstUserIdFromList() == 0){
    $first_user = getFirstUserIdFromList();
    $arr = explode(":", $first_user);
    $select_from = @$arr[0];
    $user_id_first = @$arr[1];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messaging | <?php echo ucwords($artist_info_node["username"]); ?></title>

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
        .hold-notifications{ overflow-y: scroll; height: calc(100% - 56px); }

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #1E88E5;
            border-radius: 10px;
        }

        .btn-extend{ display: block !important; width: 100% !important; }

        .message-action{ padding-bottom: 5px !important; }

        .message-action input
        {
            background: rgba(63, 57, 77, 0.4);
            padding: 0 2px;
        }

        .message-top img{ width: 50px; height: 50px; display: inline-block; border: 5px solid #1565C0; }

        .message-top .card-title{ display: inline-block !important; vertical-align: top; padding-top: 10px; }

        .card-content .chat-widget{ padding: 10px; margin-top: 25px; border-radius: 0 15px; }

        .chat-widget .inner-span{ font-size: 13px !important; }

        .card-content-middle{ overflow-y: scroll !important; max-height: 600px !important; }

        .tab-holder{ padding: 0 !important; }

        .no-padd{ padding: 0 !important; }

        .chat-selector-widget{ padding: 10px !important; border-bottom: 1px solid #d5d5d5; }

        .add-to-contact{ border-bottom: 1px solid #d5d5d5; }

        .chat-widget-img{ height: 50px; width: 50px; border: 5px solid #d5d5d5; }

        .chat-selector-widget span,img{ display: inline-block; vertical-align: top; }

        .chat-selector-widget span{ padding-top: 8px; font-size: 17px !important; }

        .t-area{ border-bottom-color: white !important; }

        .t-area::selection{ background: coral !important; }

        .t-area::-moz-selection{ background: coral !important; }

        @media (max-width: 600px) {
            .chat-widget-con,
            .section-messaging-box,
            .section-messaging-box{ padding: 0 !important; }

            .chat-widget-img{ height: 40px; width: 40px; }

            .chat-selector-widget span{ font-size: 15px !important; }

            .message-top img{  width: 55px; height: 55px; }

            .message-top .card-title{ padding-top: 5px !important; }
        }
    </style>

</head>
<body class="grey lighten-4">
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>
<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

<?php include_once("css/notifications_file.php"); ?>

<!--Section: section-my-modal-overlay-->
<section class="section-my-modal-overlay all-my-contacts"
         style="height: 100%;width:100%;background:rgba(0,0,0,0.3);position: fixed;z-index: 99999999999;top:0;display:none;">
    <div class="row">
        <div class="col s12 m8 offset-m2 l4 offset-l4 white darken-1 z-depth-5 no-padding"
             style="margin-top:1% !important;margin-bottom:1% !important;padding-top:0;position:relative">
            <div class="row" style="margin-bottom: 0 !important;">
                <div class="col s12 blue darken-3 center white-text">
                    <p class="flow-text">
                        <i class="fa fa-book"></i> CONTACTS
                    </p>
                </div>
                <div class="col s12">
                    <form action="" id="search-all-contacts">
                        <div class="input-field">
                            <i class="prefix fa fa-search"></i>
                            <input type="search"
                                   name="search_for"
                                   class="text-lowercase"
                                   id="search-for-contact"/>
                            <label for="search-for-contact">Search for contact</label>
                        </div>
                    </form>
                </div>
                <div class="col s12" style="overflow-y: scroll;height: 390px;height: calc(100% - 56px);">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li id="search-contact-results">

                        </li>
                        <li class="">
                            <div class="collapsible-header active white"
                                 style="border-bottom: 1px solid #d5d5d5;">
                                Your contacts(<?php echo (Artists::getContacts() == null ? 0 :
                                    number_format(count(Artists::getContacts()))); ?>)
                            </div>
                            <div class="collapsible-body load-contacts-async">
                                <?php
                                    $contacts_array = Artists::getContacts();
                                    if( ($contacts_array == null || count($contacts_array) < 1) ){
                                ?>
                                <!--Default div if no results are found-->
                                <div class="row">
                                    <div class="col s12 chat-selector-widget center">
                                        <p class="flow-text">
                                            <i class="fa fa-trash"></i> No contacts found...
                                        </p>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <ul class="collection no-padding">
                                    <?php foreach ($contacts_array as $key=>$value){ ?>
                                    <li class="collection-item avatar">
                                        <div>
                                            <img src="<?php echo $value["profile_imgSm"]; ?>"
                                                 class="avatar responsive-img circle" alt="">
                                            <span class="title text-capitalize blue-text text-darken-1">
                                                <?php echo $value["username"]; ?></span><br>
                                            <?php if(!$value["isActive"]){ ?>
                                            <span class="red-text text-darken-1 text-capitalize">Offline</span><br>
                                            <?php } else { ?>
                                            <span class="green-text text-darken-1 text-capitalize">Online</span><br>
                                            <?php } ?>
                                            <?php if(Artists::isArtistAContact($value["id"])){ ?>
                                            <a href="" class="blue-text text-darken-3 remove-from-contact">
                                                <input type="hidden" class="remove-user_id"
                                                       value="<?php echo $value["id"]; ?>"/>
                                                <i class="fa fa-times"></i> Remove from contacts</a>
                                            <?php } ?>
                                            <a href="" class="secondary-content btn btn-floating
                                            red darken-3 waves-effect waves-ripple tooltipped choose-chat-buddy"
                                               data-position="top"
                                               data-tooltip="Chat">
                                                <input type="hidden" class="msg-to-id"
                                                       value="<?php echo $value["id"] ?>"/>
                                                <input type="hidden" class="msg-to-username"
                                                       value="<?php echo $value["username"] ?>"/>
                                                <input type="hidden" class="msg-to-user-profile-image"
                                                       value="<?php echo $value["profile_imgSm"] ?>"/>
                                                <input type="hidden" class="msg-to-first-name"
                                                       value="<?php echo getArtistFirstName($value["username"]); ?>"/>
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col s12 z-depth-5" style="padding: 10px 5px;">
                    <button class="btn btn-extend red darken-2 waves-effect waves-ripple close-contacts">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Section: section-my-modal-overlay-->
<section class="section-my-modal-overlay all-artists"
         style="height: 100%;width:100%;background:rgba(0,0,0,0.3);position: fixed;z-index: 99999999999;top:0;display:none;">
    <div class="row">
        <div class="col s12 m8 offset-m2 l4 offset-l4 white darken-1 z-depth-5 no-padding"
             style="margin-top:1% !important;margin-bottom:1% !important;padding-top:0;
             padding-bottom: 0 !important;position: relative">
            <div class="row" style="margin-bottom: 0 !important;">
                <div class="col s12 blue darken-3 center white-text">
                    <p class="flow-text">
                        <i class="fa fa-user"></i> FELLOW ARTISTS
                    </p>
                </div>
                <div class="col s12">
                    <form action="" id="search-for-artist">
                        <div class="input-field">
                            <i class="prefix fa fa-search"></i>
                            <input type="search" name="search_for" class="text-lowercase" id="search-all-artist"/>
                            <label for="search-all-artist">Search for artist</label>
                        </div>
                    </form>
                </div>
                <div class="col s12" style="overflow-y: scroll;height: 390px;height: calc(100% - 56px)">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li id="artist-search-results">

                        </li>
                        <li>
                            <div class="collapsible-header active white"
                                 style="border-bottom: 1px solid #d5d5d5;">
                                Artists
                            </div>
                            <div class="collapsible-body">
                                <?php
                                    $artists_array = getAllArtistsInfo();
                                    if($artists_array == null || count($artists_array) < 1){
                                ?>
                                <!--Default div if no results are found-->
                                <div class="row">
                                    <div class="col s12 chat-selector-widget center">
                                        <p class="flow-text">
                                            <i class="fa fa-trash"></i> No artists found...
                                        </p>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <ul class="collection no-padding">
                                    <?php foreach($artists_array as $key=>$value){ ?>
                                    <li class="collection-item avatar">
                                        <div>
                                            <img src="<?php echo $value["profile_image"]; ?>"
                                                 class="avatar responsive-img circle" alt="">
                                            <span class="title text-capitalize blue-text text-darken-1">
                                                <?php echo $value["username"]; ?></span><br>
                                            <?php if(!Artists::isArtistAContact($value["user_id"])){ ?>
                                            <a href="" class="text-darken-3 blue-text add-to-contact"
                                               style="text-decoration: none;">
                                                <input type="hidden"
                                                       name="user_id"
                                                       value="<?php echo $value["user_id"]; ?>"
                                                       class="artist_user_id"/>
                                                <i class="fa fa-plus"></i> Add to contacts
                                            </a>
                                            <?php } ?>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col s12 z-depth-5" style="padding: 10px 5px;">
                    <button class="btn btn-extend red darken-2 waves-effect waves-ripple close-all-artist">CLOSE</button>
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
                        <li>
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

<!--Section: section-messaging-box-->
<section class="section section-messaging-box">
    <div class="row">
        <div class="col s12 offset-s0 m10 offset-m1 l8 offset-l2">
            <?php if( !($first_user == 0 && $first_user == null) ) { ?>
                <div class="card z-depth-5">
                    <!--Section: card-header(visible on large devices only)-->
                    <header class="card-content blue darken-2 white-text hide-on-small-only message-top">
                        <img src="<?php echo Admin::getProfileImageFromDb($user_id_first); ?>"
                             class="responsive-img circle msg-to-image"
                             alt="<?php echo Admin::getUserName($user_id_first); ?>"/>
                        &nbsp;&nbsp;&nbsp;
                        <span class="card-title text-capitalize show-username">
                        <?php echo Admin::getUserName($user_id_first); ?>
                    </span>
                    </header>

                    <!--Section: card-header(visible on small devices only)-->
                    <header class="card-content blue darken-2 white-text hide-on-med-and-up message-top">
                        <div class="row">
                            <div class="col s12 center-on-small-only">
                                <img src="<?php echo Admin::getProfileImageFromDb($user_id_first); ?>"
                                     class="responsive-img circle msg-to-image"
                                     alt="<?php echo Admin::getUserName($user_id_first); ?>"/>
                            </div>
                            <div class="col s12 center-on-small-only">
                            <span class="card-title text-capitalize show-username">
                                <?php echo Admin::getUserName($user_id_first); ?>
                            </span>
                            </div>
                        </div>
                    </header>
                    <div class="card-content card-content-middle">
                        <div class="row display-chats-in">
                            <!--Section: default-text(displayed if messages are not loaded)-->
                            <div class="col s12 default-text grey-text center text-darken-1 no-msg-id-nav"
                                 style="display: none !important;">
                                <i class="fa fa-signal blue-text text-darken-2 fa-5x"></i>
                                <p class="flow-text">Oops...something went wrong.<span class="blue-text">
                                        Try refreshing the page
                                    </span></p>
                            </div>
                            <?php
                                $messages_array = Artists::getArtistChats($user_id_first);
                                if( ($messages_array == null || count($messages_array) < 1) ){
                            ?>
                            <!--Section: default-text(displayed if no chat-messages exist between users)-->
                            <div class="col s12 default-text grey-text center text-darken-1">
                                <i class="fa fa-comments-o blue-text text-darken-2 fa-5x"></i>
                                <p class="flow-text">No messages with <span class="blue-text">
                                        <?php echo getArtistFirstName(Admin::getUserName($user_id_first)); ?>
                                    </span></p>
                            </div>
                            <?php } else {  ?>
                            <?php foreach($messages_array as $key=>$value){ if(!$value["isMessageFromMe"]){ ?>
                            <div class="col s12 chat-widget-con">
                            <span class="left deep-orange white-text darken-2 chat-widget">
                                <?php echo (preg_match("/\. /i", $value["msg"]))
                                    ?ucwords($value["msg"], ". "):ucwords($value["msg"], "."); ?>
                                <br>
                                <span class="grey-text text-lighten-2 inner-span">
                                    <span class="grey-text text-lighten-3 text-capitalize">
                                        <?php echo $value["msg_from"]; ?>
                                    </span>: <?php echo $value["date_of_entry"]; ?>
                                </span>
                            </span>
                            </div>
                            <?php } else { ?>
                            <div class="col s12 chat-widget-con">
                            <span class="right blue darken-2 white-text chat-widget">
                                <?php echo (preg_match("/\. /i", $value["msg"]))
                                    ?ucwords($value["msg"], ". "):ucwords($value["msg"], "."); ?>
                                <br>
                                <span class="grey-text text-lighten-2 inner-span">
                                    <span class="grey-text text-lighten-3">Me</span> : <?php echo $value["date_of_entry"]; ?>
                                </span>
                            </span>
                            </div>
                            <?php } } } ?>
                        </div>
                    </div>

                    <div class="card-action blue darken-2 white-text center message-action">
                        <form action="" method="post" class="add-chat-message">
                            <div class="input-field">
                                <input type="hidden"
                                       name="msg_to"
                                       id="input_msg_to"
                                       value="<?php echo $user_id_first; ?>"/>
                                <i class="fa fa-pencil prefix white-text"></i>
                                <textarea name="write_msg"
                                          id="write-msg"
                                          required
                                          class="materialize-textarea t-area"></textarea>
                                <label for="write-msg" class="white-text">Say something<span
                                            id="span-say-f-name">
                                        <?php echo "to ".ucwords(getArtistFirstName(Admin::getUserName($user_id_first))); ?>
                                    </span>...</label>
                            </div>
                            <div class="input-field center">
                                <button type="submit" class="btn-large btn-floating red darken-2 z-depth-5 tooltipped"
                                        data-position="top"
                                        data-tooltip="Send message">
                                    <i class="fa fa-send"></i>
                                </button>
                            </div>
                            <div id="embed-audio-tag" style="display: none;"></div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="card-panel z-depth-5 blue darken-2 default-chat-div center white-text"
                     style="padding: 120px;">
                    <i class="fa fa-comments-o fa-5x"></i>
                    <p class="flow-text">Hi,<span class="grey-text text-lighten-1">
                            <?php echo getArtistFirstName(Admin::getUserName($session->user_id)); ?></span>...add some
                        persons to your <span class="grey-text text-lighten-1">contacts</span></p>
                    <button class="btn-large red darken-2 waves-effect waves-ripple open-all-artists">
                        <i class="fa fa-plus"></i> Add contacts
                    </button>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<!--<div class="section">-->
<!--    <div class="card-panel">-->
<!--        <div class="row">-->
<!--            <div class="col s12 c-s-w" data-index="0" style="cursor: pointer;">-->
<!--                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illo laudantium non nostrum optio perspiciatis quaerat quas quis quos ullam!-->
<!--            </div>-->
<!--            <div class="col s12 c-s-w" data-index="1" style="cursor: pointer;">-->
<!--                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illo laudantium non nostrum optio perspiciatis quaerat quas quis quos ullam!-->
<!--            </div>-->
<!--            <div class="col s12 c-s-w" data-index="2" style="cursor: pointer;">-->
<!--                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illo laudantium non nostrum optio perspiciatis quaerat quas quis quos ullam!-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--Footer-->
<?php if( !$first_user == 0 ){ ?>
    <?php include_once("css/footer.php"); ?>
<?php } else $db->close_connection(); ?>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red waves-effect tooltipped pulse"
       data-position="top" data-tooltip="Options">
        <i class="fa fa-plus"></i>
    </a>
    <ul>
        <li>
            <button class="btn-floating deep-orange category-modal modal-trigger open-contacts tooltipped"
                    data-position="top" data-tooltip="Your contacts">
                <i class="fa fa-book"></i>
            </button>
        </li>
        <li>
            <button class="btn-floating deep-purple category-modal modal-trigger open-all-artists tooltipped"
                    data-position="top" data-tooltip="Fellow artists">
                <i class="fa fa-user"></i>
            </button>
        </li>
    </ul>
</div>


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
    $("header,.section,.fixed-action-btn").hide();

    setTimeout(function(){
        $(document).ready(function(){
            //SHOW SECTIONS
            $("header,.section,.fixed-action-btn").fadeIn();

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

            $(".toggle-side-nav-dropdown").on("click", function(e){
                e.preventDefault();
                $(".dropdown-to-toggle").slideToggle("slow");
            });

            $("#search-for-artist").on("submit", function(e){
                e.preventDefault();

                if( ($("#search-all-artists").val() !== "") ){
                    $.ajax({
                        url: "../ajax_codes/artist_search_for_artist.php",
                        type: "POST",
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: new FormData(this),
                        success: function(data){
                            $("#artist-search-results").html(data);
                        }
                    });
                }
            });

            $(".add-to-contact").on("click", function(e){
                e.preventDefault();
                var user_id_node = $(this).find(".artist_user_id");
                var user_id = user_id_node.val();

                $.ajax({
                    url: "../ajax_codes/artist_add_artist_contact.php",
                    type: "POST",
                    data: { user_id : user_id },
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(document).on("click", ".add-to-contact-ajax", function(e){
                e.preventDefault();
                var data_payload = $(this).data("user_id");

                $.ajax({
                    url: "../ajax_codes/artist_add_artist_contact.php",
                    type: "POST",
                    data: { user_id : data_payload },
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(".remove-from-contact").on("click", function(e){
                e.preventDefault();
                var user_id_node = $(this).find(".remove-user_id");
                var user_id = user_id_node.val();

                $.ajax({
                    url: "../ajax_codes/artist_remove_artist_contact.php",
                    type: "POST",
                    data: { user_id : user_id },
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(document).on("click", ".remove-from-contact-ajax",function(e){
                e.preventDefault();
                var user_id = $(this).data("user_id");

                $.ajax({
                    url: "../ajax_codes/artist_remove_artist_contact.php",
                    type: "POST",
                    data: { user_id : user_id },
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(document).on("click", ".remove-from-contact-ajax", function(e){
                e.preventDefault();
                var user_id = $(this).data("user_id");

                $.ajax({
                    url: "../ajax_codes/artist_remove_artist_contact.php",
                    type: "POST",
                    data: { user_id : user_id },
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(".c-s-w").on("click", function(e){
                e.preventDefault();
                var c = $(this).find(".c-s-w");
                var index = $(this).data("index");
                c = c.index(index);

                var list_item = $(".c-s-w");
                var my_index = list_item.index($(this));

                $(".c-s-w").css("background", "#fff");
                $(".c-s-w:eq("+my_index+")").css("background", "red");

                Materialize.toast($(".c-s-w").index(), 10000, "rounded");
            });

            //$(".c-s-w:eq(2)").css("color", "red");

            $("#search-all-contacts").on("submit", function(e){
                e.preventDefault();

                if( $("#search-for-contact").val() !== ""){
                    $.ajax({
                        url: "../ajax_codes/artist_search_for_contact.php",
                        type: "POST",
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: new FormData(this),
                        success: function(data){
                            $("#search-contact-results").html(data);
                        }
                    });
                }
            });

            $(".add-chat-message").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url: "../ajax_codes/artist_send_chats.php",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function(data){
                        if(/\/uploads\/audios\/definite\.mp3/i.test(data)){
                            $("#embed-audio-tag").html(data);
                            $(".add-chat-message").trigger("reset");
                        }
                        else Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            function loadMessagesAsync(){
                if( !isNaN($("#input_msg_to").val()) ) {
                    $.ajax({
                        url: "../ajax_codes/artist_load_chats_async.php",
                        type: "POST",
                        data: { msg_to: $("#input_msg_to").val() },
                        success: function (data) {
                            $(".display-chats-in").html(data);
                        }
                    });
                }
                else $(".no-msg-id-nav").fadeIn();
            }

            setInterval(loadMessagesAsync, 1000);//load chat...async

            $(".choose-chat-buddy").on("click", function(e){
                e.preventDefault();
                var msg_to_node = $(this).find(".msg-to-id");
                var msg_to_username_node = $(this).find(".msg-to-username");
                var msg_to_user_profile_image = $(this).find(".msg-to-user-profile-image");
                var msg_to_f_name = $(this).find(".msg-to-first-name");

                //set the chat-input fields
                $("#input_msg_to").val(msg_to_node.val());
                $(".show-username").html(msg_to_username_node.val());
                $(".msg-to-image").attr("src", msg_to_user_profile_image.val());
                $(".msg-to-image").attr("alt", msg_to_username_node.val());
                $("#span-say-f-name").html(" to "+msg_to_f_name.val());

                $(".all-my-contacts").fadeOut();
            });

            $(document).on("click", ".choose-chat-buddy-ajax", function(e){
                e.preventDefault();

                var msg_to_node = $(this).data("user_id");
                var msg_to_username_node = $(this).data("user_name");
                var msg_to_user_profile_image = $(this).data("profile_image");
                var msg_to_f_name = $(this).data("first_name");

                //set the chat-input fields
                $("#input_msg_to").val(msg_to_node);
                $(".show-username").html(msg_to_username_node);
                $(".msg-to-image").attr("src", msg_to_user_profile_image);
                $(".msg-to-image").attr("alt", msg_to_username_node);
                $("#span-say-f-name").html(" to "+msg_to_f_name);

                $(".all-my-contacts").fadeOut();
            });

            setInterval(function(){
                $.ajax({
                    url: "../ajax_codes/artists_load_contacts_asnyc.php",
                    type: "POST",
                    success: function(data){
                        $(".load-contacts-async").html(data);
                    }
                });
            }, 20000);

            $(".open-contacts").on("click", function(e){
                e.preventDefault();
                $(".all-my-contacts").fadeIn();
            });

            $(".open-all-artists").on("click", function(e){
                e.preventDefault();
                $(".all-artists").fadeIn();
            });

            $(".close-contacts").on("click", function(e){
                e.preventDefault();
                $(".all-my-contacts").fadeOut();
            });

            $(".close-all-artist").on("click", function(e){
                e.preventDefault();
                $(".all-artists").fadeOut();
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