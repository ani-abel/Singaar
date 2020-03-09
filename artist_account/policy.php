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
    <title>Policy | Singaar</title>

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

        .policy-widget{ margin-bottom: 20px !important; }

        .policy-widget i{ font-size: 35px !important; }

        .policy-widget p{ font-size: 17px; }

        @media (max-width: 600px) {
            .policy-widget:nth-child(2){ margin-bottom: 0 !important; }

            .policy-widget .flow-text{ font-size: 19px !important; }

            .policy-widget p{ font-size: 15px !important; }
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

<!--Section: section-central-content-->
<section class="section section-central-content">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Policy</span>
                        <div class="row">
                            <!--Section: section-payment-widget-->
                            <div class="col s12 m6 policy-widget center">
                                <i class="fa fa-money  grey-text text-darken-1"></i>
                                <h5 class="flow-text widget-text grey-text text-darken-1">Payment</h5>
                                <p>
                                    <span class="blue-text text-darken-2">Singaar</span> accepts a fee of #500
                                     bi-annually. Accepted modes of payment include:
                                    <span class="blue-text text-darken-2">mastercard</span>,
                                    <span class="blue-text text-darken-2">Vista card</span>.
                                    This site is not
                                    liable for any payments lost while your account is suspended.
                                </p>
                            </div>

                            <!--Section: section-privacy-widget-->
                            <div class="col s12 m6 policy-widget center">
                                <i class="fa fa-address-book-o grey-text text-darken-1"></i>
                                <h5 class="flow-text widget-text grey-text text-darken-1">Content</h5>
                                <p>
                                    <span class="blue-text text-darken-2">Singaar</span>
                                    has a strict policy against pornographic content.
                                    Anyone found wanting might have their account
                                    <span class="blue-text text-darken-2">blocked</span>.
                                    This site is not liable for any loses
                                    of content within this period.
                                </p>
                            </div>

                            <!--Section: section-privacy-widget-->
                            <div class="col s12 offset-l0 m6 offset-m3 policy-widget center">
                                <i class="fa fa-lock grey-text text-darken-1"></i>
                                <h5 class="flow-text widget-text grey-text text-darken-1">Privacy</h5>
                                <p>
                                    <span class="blue-text text-darken-2">Singaar</span>
                                    does not use any of your personal details for commercial purposes.
                                    This site also does not store your ATM details.
                                    <span class="blue-text text-darken-2">
                                        Always keep your ATM details private.
                                    </span>
                                </p>
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

            //INIT SELECT
            $("select").material_select();

            //INIT SIDE-NAV
            $(".button-collapse").sideNav({
                draggable: true
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