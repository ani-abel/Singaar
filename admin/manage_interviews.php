<?php
require_once("../PHP_classes/initialize.php");

global $session;
if( !($session->is_logged_in() || isset($session->user_id, $_SESSION['role'])) || $_SESSION['role'] != "admin"){
    $session->logout();
    redirect_to("../php/login.php");
}

$blogger_node = BlogWriter::getBloggerInfo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Interviews | <?php echo ucwords($blogger_node["username"]); ?></title>

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
                <?php if(!Admin::getAllInterviews() == null){ ?>
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Proposed Artist Interviews</span>
                            <table class="striped responsive-table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Artist</th>
                                    <th>Uploaded By</th>
                                    <th>Month Of</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach(Admin::getAllInterviews() as $key=>$value){  ?>
                                    <tr>
                                        <td width="70">
                                            <img src="<?php echo $value["profile_image"]; ?>"
                                                 style="width: 40px;height:40px;margin-left: 10px;"
                                                 alt="Image" class="responsive-img circle"/>
                                        </td>
                                        <td class="text-capitalize"><?php echo $value["artist_name"] ?></td>
                                        <td class="text-capitalize"><?php echo $value["uploaded_by"]; ?></td>
                                        <td class="text-capitalize"><?php echo "{$value["month_of"]}, {$value["year"]}"; ?></td>
                                        <td>
                                            <a href="#view-proposed-interview"
                                               class="btn blue lighten-2 modal-trigger interview-trigger">
                                                <input type="hidden" class="video-link" value="<?php echo $value["video_link"]; ?>">
                                                <input type="hidden" class="video-for" value="<?php echo $value["artist_name"]; ?>">
                                                <input type="hidden" class="video-by" value="<?php echo $value["uploaded_by"]; ?>">
                                                <input type="hidden" class="video-period"
                                                       value="<?php echo "{$value["month_of"]}, {$value["year"]}"; ?>">
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
                        <?php if(count(Admin::getAllInterviews(true)) > 5){ ?>
                            <div class="card-action">
                                <a href="./manage_interviews.php"
                                   class="btn btn-extend blue darken-2 waves-effect waves-ripple">
                                    MORE
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else{ ?>
                    <div class="card-panel center default-card">
                        <I class="fa fa-film fa-3x blue-text text-darken-2"></I>
                        <p class="flow-text red-text">NO RECENT INTERVIEWS</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<!--Footer-->
<?php include_once("../blogger_writer/css/footer.php"); ?>

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

<!--View Proposed Interviews-->
<div class="modal modal-fixed-footer" id="view-proposed-interview">
    <div class="modal-content">
        <h4 class="text-capitalize"><i class="fa fa-calendar"></i> <span class="interview-period"></span></h4>
        <h6 class="grey-text text-capitalize"><span><i class="fa fa-music"></i></span>
            <span class="interview-for"></span></h6>
        <h6 class="grey-text text-capitalize" style="margin-bottom: 15px;">
            <span><i class="fa fa-upload"></i></span>
            <span class="interview-by"></span>
        </h6>
        <div class="row">
            <div class="col s12">
                <video class="responsive-video play-video" preload="metadata" controls style="width:100%;height:100%;">
                    <source src="" type="video/mp4"/>
                </video>
                <form action="" style="display:inline-block;vertical-align:top;">
                    <div class="input-field">
                        <button type="submit" class="btn blue darken-3">
                            <i class="fa fa-send-o"></i><span class="hide-on-small-only"> Allow</span>
                        </button>
                    </div>
                </form>
                <form action="" style="display:inline-block;vertical-align:top;">
                    <div class="input-field">
                        <button type="submit" class="btn red darken-3 right">
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

            $(".interview-trigger").on("click", function(e){
                e.preventDefault();

                //get the class id's of the selected <divs>
                var video_node = $(this).find(".video-link");
                var video_by = $(this).find(".video-by");
                var video_for = $(this).find(".video-for");
                var video_period = $(this).find(".video-period");
                //output the results unto the modal
                $(".play-video").attr("src", video_node.val());
                $(".interview-by").html(video_by.val());
                $(".interview-for").html(video_for.val());
                $(".interview-period").html(video_period.val());

            });

        });
    }, 1000);

</script>

</body>
</html>