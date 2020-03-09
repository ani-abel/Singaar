<?php
require_once("../PHP_classes/initialize.php");

if( !($session->is_logged_in() || isset($session->user_id, $_SESSION['role'])) || $_SESSION['role'] != "artist"
|| (isset($_SESSION['temp_token']) && $_SESSION['temp_token'] != "payment only") ){
    $session->logout();
    redirect_to("../php/login.php");
}

$artist_info_node = BlogWriter::getBloggerInfo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payments</title>

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
    </style>

</head>
<body class="grey lighten-4">
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>
<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

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
<section class="section section-form-container">
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Payment</span>

                        <form action="" method="post">
                            <div class="input-field blue-text text-darken-3">
                                <input type="text" id="account-name"/>
                                <label for="account-name">Account Name</label>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <input type="text" id="account-number"/>
                                <label for="account-number">Account Number</label>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <select name="">
                                    <option selected disabled>Account Type</option>
                                    <option value="">Savings Account</option>
                                    <option value="">Current Account</option>
                                </select>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <input type="text" id="pin" class="validate"/>
                                <label for="pin"
                                       data-error="Invalid Pattern"
                                       data-success="Valid Pattern">
                                    Pin (Always keep private)
                                </label>
                            </div>
                            <div class="input-field blue-text text-darken-3">
                                <input type="text" id="amount" value="500" readonly/>
                                <label for="amount">Amount</label>
                            </div>
                            <div class="switch">
                                <p class="blue-text text-darken-2">Are you sure all details are valid?</p>
                                <label>
                                    No
                                    <input type="checkbox" id="valid-detail-check" required/>
                                    <span class="lever"></span>
                                    Yes
                                </label>
                            </div>
                            <div class="input-field">
                                <button type="submit" class="btn pay-btn btn-extend blue darken-3 disabled">
                                    <i class="fa fa-send-o"></i> &nbsp;PAY
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-action center flow-text section-error-log green-text">
                        Error occurred: Reset your password
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

            //INIT SIDE-NAV
            $(".button-collapse").sideNav({
                draggable: true
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

            $("#valid-detail-check").on("click", function(){
               var element = document.getElementById("valid-detail-check");
               var pin = document.getElementById("pin").value;
               var amount = document.getElementById("amount").value;
               var account_number = document.getElementById("account-number").value;
               var account_name = document.getElementById("account-name").value;
               if( (element.checked) && !(account_name === "" || account_number === "" || pin === "" || amount === "") )
                    $(".pay-btn").removeClass("disabled");

               else
                   $(".pay-btn").addClass("disabled");
            });

            $(".toggle-side-nav-dropdown").on("click", function(e){
                e.preventDefault();
                $(".dropdown-to-toggle").slideToggle("slow");
            });

        });
    }, 1000);

</script>

</body>
</html>