<?php
require_once("../PHP_classes/initialize.php");

global $session;
if( !($session->is_logged_in() || isset($session->user_id, $_SESSION['role'])) || $_SESSION['role'] != "admin"){
    $session->logout();
    redirect_to("../php/login.php");
}

global $db;
$blogger_node = BlogWriter::getBloggerInfo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Videos | <?php echo ucwords($blogger_node["username"]); ?></title>

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
                            <a href="posts.php">Posts</a>
                        </li>
                        <li>
                            <a href="manage_artist.php">Manage Artist</a>
                        </li>
                        <li>
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

<!--Section: Categories-->
<section class="section section-categories grey lighten-4">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <?php
                    $limit = getSqlOffsets();
                    $videos_array = Admin::getAllVideos(true, $limit["st_limit"], $limit["end_limit"]);
                    if( (count($videos_array) > 0 || !$videos_array == null) ){
                ?>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Manage Videos</span>
                        <table class="striped responsive-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Artist</th>
                                <th>Video Title</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($videos_array as $key=>$value){ ?>
                            <tr>
                                <td width="70">
                                    <img src="<?php echo $value["profile_image"]; ?>"
                                         style="width: 40px;height:40px;margin-left: 10px;"
                                         alt="<?php echo $value["uploaded_by"]; ?>" class="responsive-img circle"/>
                                </td>
                                <td class="text-capitalize">
                                    <?php echo $value["uploaded_by"]; ?>
                                </td>
                                <td class="text-capitalize">
                                    <?php echo $value["v_name"]; ?>
                                </td>
                                <td>
                                    <a href="#view-video" class="btn blue lighten-2 modal-trigger video-trigger">
                                        <input type="hidden" class="video_name_m" value="<?php echo $value["v_name"]; ?>">
                                        <input type="hidden" class="video_path_m" value="<?php echo $value["v_path"]; ?>">
                                        <input type="hidden" class="video_id_m" value="<?php echo $value["v_id"]; ?>">
                                        <i class="fa fa-film"></i>
                                        <span class="hide-on-small-only">
                                                        Watch
                                                    </span>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-action">
                        <ul class="pagination">
                            <?php
                            $rs = $db->query(SEL_ALL." videos");
                            $no_of_rows = $db->num_rows($rs);
                            $a = $no_of_rows/10;
                            $a = ceil($a);

                            if(@isset($_GET['page']) && @$_GET['page'] > 1 ){

                                ?>
                                <li class="disabled">
                                    <a href="./manage_videos.php?page=<?php echo @$_GET['page'] - 1; ?>" class="blue-text">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>
                            <?php } $num = 0;
                            for($b = 1; $b <= $a; $b++){
                                $num++;
                                ?>
                                <li class="<?php if(@$_GET['page']==$b ||
                                    (!isset($_GET['page']) && $b==1)) echo "active blue lighten-2"; ?>">
                                    <a href="./manage_videos.php?page=<?php echo $b; ?>"
                                       class="<?php echo(@$_GET['page']==$b ||
                                           (!@isset($_GET['page']) && $b==1))?"white-text":"blue-text"; ?>">
                                        <?php echo $b; ?>
                                    </a>
                                </li>
                            <?php } if(@$_GET["page"] < $num){ ?>
                                <li class="waves-effect">
                                    <a href="./manage_videos.php?page=<?php echo @$_GET['page'] + 1; ?>" class="blue-text">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } else { ?>
                <div class="card-panel center default-card">
                    <I class="fa fa-film fa-3x blue-text text-darken-2"></I>
                    <p class="flow-text red-text">NO VIDEOS FOUND</p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<!--Footer-->
<?php if( (count($videos_array) > 3 && $videos_array != null) ){ ?>
    <?php include_once("../blogger_writer/css/footer.php"); ?>
<?php } else $db->close_connection(); ?>

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

<!--View Video-->
<div class="modal modal-fixed-footer" id="view-video">
    <div class="modal-content">
        <h4 class="text-capitalize"><i class="fa fa-film"></i> <span class="modal-video-name"></span></h4>
        <div class="row">
            <div class="col s12">
                <video class="responsive-video modal-video-src" controls preload="metadata" style="width:100%;height:100%;">
                    <source src="" type="video/mp4"/>
                </video>
                <form action="" style="display:inline-block;vertical-align:top;">
                    <div class="input-field">
                        <input type="hidden" class="modal-video-id" name="video_id_column"/>
                        <button type="submit" class="btn blue darken-3">
                            <i class="fa fa-send-o"></i><span class="hide-on-small-only"> Allow</span>
                        </button>
                    </div>
                </form>
                <form action="" class="delete-video-file" style="display:inline-block;vertical-align:top;">
                    <div class="input-field">
                        <button type="submit" class="btn red darken-3 right">
                            <input type="hidden" class="modal-video-id" name="video_id_column"/>
                            <i class="fa fa-trash"></i><span class="hide-on-small-only"> Delete</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="" class="modal-action modal-close btn-flat red-text waves-effect close-md">Close</a>
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

            $(".close-md").on("click", function(e){
                e.preventDefault();
            });

            //INIT MODAL
            $(".modal").modal({
                dismissible: false,
                ready: function(modal, trigger){

                }
            });

            $(".video-trigger").on("click", function(e){
                e.preventDefault();

                var video_path_node = $(this).find(".video_path_m");
                var video_id_node = $(this).find(".video_id_m");
                var video_name_node = $(this).find(".video_name_m");

                $(".modal-video-name").html(video_name_node.val());
                $(".modal-video-id").val(video_id_node.val());
                $(".modal-video-src").attr("src", video_path_node.val());
            });

            $(".delete-video-file").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url:"../ajax_codes/admin_delete_video.php",
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

        });
    }, 1000);

</script>

</body>
</html>