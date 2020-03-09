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
    <title>Customer Care | <?php echo ucwords($artist_info_node["username"]); ?></title>

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
        body{ overflow-x: hidden; }

        .hold-notifications{ overflow-y: scroll; height: calc(100% - 56px); }

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

        .message-action{ padding-bottom: 5px !important; }

        .message-action input
        {
            background: rgba(63, 57, 77, 0.4);
            padding: 0 2px;
        }

        .message-top img{ width: 50px; height: 50px; display: inline-block; border: 5px solid #1565C0; }

        .message-top .card-title{ display: inline-block !important; vertical-align: top; padding-top: 10px; }
        
        .card-content-middle{ overflow-y: scroll !important; max-height: 800px !important; }

        .tab-holder{ padding: 0 !important; }

        .no-padd{ padding: 0 !important; }

        .chat-selector-widget{ padding: 10px !important; border-bottom: 1px solid #d5d5d5; }

        .chat-widget-img{ height: 50px; width: 50px; border: 5px solid #d5d5d5; }

        .chat-selector-widget span,img{ display: inline-block; vertical-align: top; }

        .chat-selector-widget span{ padding-top: 8px; font-size: 17px !important; }

        .t-area, .complaint-title{ border-bottom-color: white !important; }

        .t-area::selection, .complaint-title::selection{ background: coral !important; }

        .t-area::-moz-selection, .complaint-title::-moz-selection{ background: coral !important; }

        .replies-widget{ padding: 15px !important; border-bottom: 1px solid #ddd !important; }

        .replies-widget-last{ border-bottom: none !important; padding-bottom: 0 !important; }

        @media (max-width: 600px) {
            .chat-widget-con,
            .section-messaging-box,
            .section-messaging-box{ padding: 0 !important; }

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
                    <a href="" class="show-on-large right" id="show-notifications">
                        <i class="fa fa-bell-o"></i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li class="active">
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
            <div class="card z-depth-5">
                <!--Section: card-header(visible on large devices only)-->
                <header class="card-content blue darken-2 white-text message-top">&nbsp;&nbsp;&nbsp;
                    <span class="card-title text-capitalize">
                        CUSTOMER CARE
                    </span>
                </header>
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width blue darken-3">
                        <li class="tab">
                            <a href="#tab1" class="text-darken-2 white-text" style="font-size: 16px;">
                                <i class="fa fa-comments-o"></i> My Inbox
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#tab2" class="text-darken-2 white-text" style="font-size: 16px;">
                                <i class="fa fa-question-circle-o"></i> My Complaints
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-content card-content-middle">
                    <div id="tab1">
                        <div class="row">
                            <div class="col s12 no-padd">
                                <?php
                                    $inbox_messages = Artists::getMessagesFromSingaar();
                                    if( (count($inbox_messages) > 0 || !$inbox_messages == null) ){
                                        foreach($inbox_messages as $key=>$value){
                                ?>
                                <ul class="collapsible" data-collapsible="accordion">
                                    <li>
                                        <div class="collapsible-header white <?php if($key==0) echo "active"; ?>"
                                             style="border-bottom: 1px solid #d5d5d5;">
                                            <i class="fa fa-comments-o"></i>
                                            <p class="truncate text-uppercase tooltipped"
                                               data-position="top"
                                               data-tooltip="<?php echo $value["msg_title"]; ?>">
                                                <?php echo $value["msg_title"]; ?>
                                            </p>
                                        </div>
                                        <div class="collapsible-body no-padding">
                                            <div class="row">
                                                <!--Widgets for replies from singaar team begins here-->
                                                <div class="col s12 replies-widget grey lighten-5">
                                                    <?php echo $value["msg"]; ?>
                                                    <p style="font-size: 14px;margin-top: 10px" class="grey-text">
                                                        <i class="fa fa-calendar"></i> 21/12/2019
                                                    </p>
                                                    <p class="blue-text text-darken-2" style="">
                                                        From: The singaar team
                                                    </p>
                                                </div>

                                                <div class="col s12 no-padding replies-widget replies-widget-last">
                                                    <button class="red darken-2 delete-singaar-msg
                                                     btn waves-effect waves-ripple">
                                                        <input type="hidden"
                                                               class="singaar_msg_id"
                                                               value="<?php echo $value["msg_id"]; ?>"/>
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <?php } } else { ?>
                                <div class="default-reply-msg center" style="padding: 20px;">
                                    <i class="fa fa-trash fa-2x"></i>
                                    <p class="flow-text">
                                        No messages yet...
                                    </p>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div id="tab2">
                        <div class="row">
                            <div class="col s12 no-padd">
                                <?php
                                    $complaints_array = Artists::getAllComplaints();
                                    if( (count($complaints_array) > 0 || !$complaints_array == null) ){
                                        foreach($complaints_array as $key=>$value){
                                ?>
                                <ul class="collapsible" data-collapsible="accordion">
                                    <li>
                                        <div class="collapsible-header white <?php if($key==0) echo "active"; ?>"
                                             style="border-bottom: 1px solid #d5d5d5;">
                                            <i class="fa fa-question-circle-o"></i>
                                            <p class="truncate text-uppercase tooltipped"
                                               data-position="top"
                                               data-tooltip="<?php echo $value["msg_title"]; ?>">
                                                <?php echo $value["msg_title"]; ?>
                                            </p>
                                        </div>
                                        <div class="collapsible-body no-padding">
                                            <div class="row">
                                                <?php if($value["no_of_replies"] > 0){ ?>
                                                <?php
                                                    $replies_array = Artists::getAllRepliesToComplaints($value["msg_id"]);
                                                    foreach($replies_array as $inner_key=>$inner_value){
                                                ?>
                                                <!--Widgets for replies from singaar team begins here-->
                                                <div class="col s12 replies-widget grey lighten-5">
                                                    <?php echo $inner_value["reply"]; ?>
                                                    <p class="blue-text text-darken-2" style="margin-top: 10px">
                                                        From: The singaar team
                                                    </p>
                                                </div>

                                                <div class="col s12 no-padding replies-widget replies-widget-last">
                                                    <button class="red darken-2 delete-complaint
                                                     btn waves-effect waves-ripple">
                                                        <input type="hidden"
                                                               class="complaint_id"
                                                               value="<?php echo $value["msg_id"]; ?>"/>
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                                <?php } } else { ?>
                                                <div class="col s12 default-reply-msg center" style="padding: 20px;">
                                                    <i class="fa fa-trash fa-2x"></i>
                                                    <p class="flow-text">
                                                        No replies yet...
                                                    </p>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <?php } } else { ?>
                                <div class="default-reply-msg center" style="padding: 20px;">
                                    <i class="fa fa-trash fa-2x"></i>
                                    <p class="flow-text">
                                        No complaints...
                                    </p>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!--Section: default-text(displayed if no chat-messages exist between users)-->
                    <div class="row">
                        <div class="col s12 default-text amber-text text-darken-3">
                            <p class="flow-text">
                                <i class="fa fa-bullhorn"></i> Tell us how you feel...
                                <span class="blue-text text-darken-3 text-capitalize">we'll listen</span>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="card-action blue darken-2 white-text center message-action">
                    <form action="" method="post" id="make-a-complaint">
                        <div class="input-field">
                            <i class="prefix fa fa-question-circle-o white-text"></i>
                            <input type="text" required
                                   class="complaint-title"
                                   name="complaint_title"
                                   id="complaint-title"
                                   style="border-bottom-color: #fff;"/>
                            <label for="complaint-title" class="white-text">What is your complaint about?</label>
                        </div>
                        <div class="input-field">
                            <i class="fa fa-pencil prefix white-text"></i>
                            <textarea name="complaint-message"
                                      id="write-msg"
                                      required
                                      class="materialize-textarea t-area"></textarea>
                            <label for="write-msg" class="white-text">Tell us more about your complaint...</label>
                        </div>
                        <div class="input-field center">
                            <button type="submit" class="btn-large btn-floating red darken-2 z-depth-5 tooltipped"
                                    data-position="top"
                                    data-tooltip="Send message">
                                <i class="fa fa-send"></i>
                            </button>
                        </div>
                    </form>
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
    $("header,.section,.fixed-action-btn").hide();

    setTimeout(function(){
        //SHOW SECTIONS
        $("header,.section,.fixed-action-btn").fadeIn();

        //HIDE PRE-LOADER
        $(".loader").fadeOut();

        //INIT SELECT
        $("select").material_select();

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

        $(".delete-singaar-msg").on("click", function(e){
            e.preventDefault();

            var node = $(this).find(".singaar_msg_id");

            $.ajax({
                url: "../ajax_codes/artist_delete_singaar_message.php",
                type: "POST",
                data: { msg_id : node.val() },
                success: function(data){
                    Materialize.toast(data, 10000, "rounded");
                }
            });
        });

        $(".delete-complaint").on("click", function(e){
            e.preventDefault();

            var node = $(this).find(".complaint_id");
            $.ajax({
                url: "../ajax_codes/artist_delete_complaint.php",
                type: "POST",
                data: { complaint_id: node.val() },
                success: function(data){
                    Materialize.toast(data, 10000, "rounded");
                }
            });
        });

        $("#make-a-complaint").on("submit", function(e){
            e.preventDefault();

            $.ajax({
                url: "../ajax_codes/artist_make_a_complaint.php",
                type: "POST",
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
                success: function(data){
                    if(/Complaint made/ig.test(data))
                        $("#make-a-complaint").trigger("reset");

                    Materialize.toast(data, 10000, "rounded");
                }
            });
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

        $("#show-notifications").on("click", function(e){
            e.preventDefault();
            $(".all-notifications").fadeIn();
        });

        $("#close-my-notifications").on("click", function(e){
            e.preventDefault();
            $(".all-notifications").fadeOut();
        });

    }, 1000);

</script>

</body>
</html>