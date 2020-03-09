<?php
require_once("../PHP_classes/initialize.php");

global $session;
if( !($session->is_logged_in() || isset($session->user_id, $_SESSION['role'])) || $_SESSION['role'] != "admin"){
    $session->logout();
    redirect_to("../php/login.php");
}
$blogger_node = BlogWriter::getBloggerInfo();
global $db;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messages | <?php echo ucwords($blogger_node["username"]); ?></title>

    <!--Import Google icon font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icons?family=Material+icons"/>

    <!--Link materialize.css file here-->
    <link rel="stylesheet" href="../css/materialize.min.css" media="screen, projection" />
    <link rel="stylesheet" href="css/main4.css" />
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

        .collection { border-bottom: none !important; border-left: none !important; border-right: none !important; }

        .collection:nth-child(1){ border-top: none !important; }

        .collection li{ padding-bottom: 20px !important; margin-bottom: 15px !important; }

        .collection article>p{ margin-top: 5px; font-size: 17px; }

        .collection article{ margin-bottom: 10px;}
    </style>

</head>
<body class="grey lighten-4">
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>
<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>
<!--Link ck-editor-->
<script src="../js/ckeditor/ckeditor.js"></script>

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
                            <a href="posts.php">Posts</a>
                        </li>
                        <li>
                            <a href="manage_artist.php">Manage Artist</a>
                        </li>
                        <li class="active">
                            <a href="messaging.php">Messaging</a>
                        </li>
                        <li>
                            <a href="../php/logout.php"><i class="fa fa-power-off"></i></a>
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
                    <img src="<?php echo $blogger_node['profile_imgSm']; ?>"
                         alt="<?php echo $blogger_node['username']; ?>" class="circle">
                </a>
                <a href="">
                    <span class="name white-text text-capitalize"><?php echo $blogger_node['username']; ?></span>
                </a>
                <a href=""><span class="email white-text text-lowercase">
                        <?php echo $blogger_node['email']; ?></span>
                </a>
            </div>
        </li>

        <li>
            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="posts.php">Posts</a>
        </li>
        <li>
            <a href="manage_artist.php">Manage Artist</a>
        </li>
        <li>
            <a href="messaging.php">Messaging</a>
        </li>

        <li><div class="divider"></div></li>
        <li><a href="" class="subheader">Manage Content</a></li>

        <li>
            <a href="manage_videos.php">Videos</a>
        </li>
        <li>
            <a href="manage_audios.php">Songs</a>
        </li>
        <li>
            <a href="manage_interviews.php">Interviews</a>
        </li>

        <li><div class="divider"></div></li>

        <li><a href="" class="subheader">Account Controls</a></li>

        <li><a href="../php/logout.php" class="waves-effect"><i class="fa fa-power-off"></i> Logout</a></li>
    </ul>
</header>

<!--Section: Messages from artists-->
<section class="section section-artist-messages">
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <?php
                $limit = getSqlOffsets();
                $complaints_array = Admin::getAllComplaints(true, $limit["st_limit"], $limit["end_limit"]);
                if( (count(Admin::getAllComplaints()) > 0 || !Admin::getAllComplaints()==null) ){
            ?>
            <div class="card">
                <div class="card-content">
                    <span class="card-title">COMPLAINTS</span>
                    <ul class="collection my-collection-2">
                        <?php foreach($complaints_array as $key=>$value){ ?>
                        <li class="collection-item avatar">
                            <img src="<?php echo $value["profile_image"]; ?>"
                                 style="width: 50px;height:50px;"
                                 class="responsive-img circle"
                                 alt="<?php echo $value["msg_from"]; ?>">
                                    <span class="title">
                                        <p class="blue-text text-darken-3 text-capitalize emphais">
                                        <?php echo $value["msg_from"]; ?>
                                        </p>
                                    </span>
                            <p style="text-decoration: underline;" class="blue-text text-darken-2 text-capitalize">
                                <?php echo $value["msg_title"]; ?>
                            </p>
                            <p>
                                <?php echo $value["msg"]; ?>
                            </p>
                            <a href="./message_reply.php?complaint_id=<?php echo base64_encode($value["msg_id"]); ?>"
                               class="btn btn-floating blue lighten-1 tooltipped"
                               data-position="top" data-tooltip="Reply">
                                <i class="fa fa-reply"></i>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>

                </div>
                <div class="card-action">
                    <ul class="pagination">
                        <?php
                        $rs = $db->query(SEL_ALL." customer_care WHERE(no_of_replies < 1)");
                        $no_of_rows = $db->num_rows($rs);
                        $a = $no_of_rows/10;
                        $a = ceil($a);

                        if(@isset($_GET['page']) && @$_GET['page'] > 1 ){

                            ?>
                            <li class="disabled">
                                <a href="./messaging.php?page=<?php echo @$_GET['page'] - 1; ?>" class="blue-text">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                            </li>
                        <?php } $num = 0;
                        for($b = 1; $b <= $a; $b++){
                            $num++;
                            ?>
                            <li class="<?php if(@$_GET['page']==$b ||
                                (!isset($_GET['page']) && $b==1)) echo "active blue lighten-2"; ?>">
                                <a href="./messaging.php?page=<?php echo $b; ?>"
                                   class="<?php echo(@$_GET['page']==$b ||
                                       (!@isset($_GET['page']) && $b==1))?"white-text":"blue-text"; ?>">
                                    <?php echo $b; ?>
                                </a>
                            </li>
                        <?php } if(@$_GET["page"] < $num){ ?>
                            <li class="waves-effect">
                                <a href="./messaging.php?page=<?php echo @$_GET['page'] + 1; ?>" class="blue-text">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php } else { ?>
            <div class="card-panel center default-card">
                <I class="fa fa-question-circle-o fa-3x blue-text text-darken-2"></I>
                <p class="flow-text red-text">NO COMPLAINTS FOUND</p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!--Footer-->
<?php if( (count($complaints_array) > 3 && $complaints_array != null) ){ ?>
    <?php include_once("../blogger_writer/css/footer.php"); ?>
<?php } else $db->close_connection(); ?>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red waves-effect tooltipped" href="./new_post.php"
       data-position="top" data-tooltip="Add a post">
        <i class="fa fa-plus"></i>
    </a>
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

            //INIT CK-EDITOR
            CKEDITOR.replace("body");

        });
    }, 1000);

</script>

</body>
</html>