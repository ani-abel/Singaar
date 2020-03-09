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
    <title><?php echo ucwords($blogger_node["username"]); ?> | Control Panel</title>

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
<!--Link canvas.js-->
<script src="../js/canvasjs.min.js"></script>
<!--Link chart.js-->
<script src="../js/chart.js"></script>
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
                        <li class="active">
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

<!--Section: stats-->
<section class="section section-stats center">
    <div class="row">
        <div class="col s12 m6 l3">
            <div class="card-panel blue lighten-1 white-text" >
                <i class="fa fa-user medium"></i>
                <h5>Total Artists</h5>
                <h5 class="count"><?php echo number_format(Admin::countAllArtists()); ?></h5>
                <div class="progress grey lighten-1">
                    <div class="determinate white" style="width:40%;"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="card-panel center">
                <i class="fa fa-pencil medium"></i>
                <h5>Posts</h5>
                <h5 class="count"><?php echo number_format(Admin::countAllPosts()); ?></h5>
                <div class="progress grey lighten-1">
                    <div class="determinate blue lighten-1" style="width:60%;"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="card-panel blue lighten-1 white-text" >
                <i class="fa fa-comments-o medium"></i>
                <h5>Comments</h5>
                <h5 class="count"><?php echo number_format(Admin::countAllComments()); ?></h5>
                <div class="progress grey lighten-1">
                    <div class="determinate white" style="width:40%;"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="card-panel" >
                <i class="fa fa-music medium"></i>
                <h5>Songs</h5>
                <h5 class="count"><?php echo number_format(Admin::countAllAudios()); ?></h5>
                <div class="progress grey lighten-1">
                    <div class="determinate blue lighten-1" style="width:10%;"></div>
                </div>
            </div>
        </div>

    </div>
</section>

<!--Section: upload artist music & videos-->
<section class="section section-allow-videos-n-music blue lighten-5">
    <div class="row">
        <div class="col s12 m7">
            <?php if(!Admin::getAllVideos() == null){ ?>
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
                        <?php
                            $vid = Admin::getAllVideos();
                            foreach ($vid as $key=>$value){
                                if($key <= 4){
                            ?>
                            <tr>
                                <td width="70">
                                    <img src="<?php echo $value["profile_image"]; ?>"
                                         style="width: 40px;height:40px;margin-left: 10px;"
                                         alt="<?php echo $value["uploaded_by"]; ?>" class="responsive-img circle"/>
                                </td>
                                <td class="text-capitalize"><?php echo $value["uploaded_by"]; ?></td>
                                <td class="text-capitalize"><?php echo $value["v_name"]; ?></td>
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
                        <?php } } ?>
                        </tbody>
                    </table>
                </div>
                <?php if(count(Admin::getAllVideos()) > 5){ ?>
                <div class="card-action">
                    <a href="./manage_videos.php" class="btn btn-extend blue darken-2 waves-effect waves-ripple">
                        MORE
                    </a>
                </div>
                <?php } ?>
            </div>
            <?php } else{ ?>
            <div class="card-panel center default-card">
                <I class="fa fa-film fa-3x blue-text text-darken-2"></I>
                <p class="flow-text red-text">NO VIDEOS FOUND</p>
            </div>
            <?php } ?>
        </div>
        <div class="col s12 m5">
            <?php if(!Admin::getAllAudios()==null){ ?>
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Manage Audios</span>
                    <table class="striped responsive-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Artist</th>
                            <th>Audio Title</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (Admin::getAllAudios() as $key=>$value){ ?>
                            <tr>
                                <td width="70">
                                    <img src="<?php echo $value["profile_image"]; ?>"
                                         style="width: 40px;height:40px;margin-left: 10px;"
                                         alt="<?php echo $value["uploaded_by"]; ?>" class="responsive-img circle"/>
                                </td>
                                <td class="text-capitalize"><?php echo $value["uploaded_by"]; ?></td>
                                <td class="text-capitalize"><?php echo $value["a_name"]; ?></td>
                                <td>
                                    <a href="#view-audio" class="btn blue lighten-2 modal-trigger audio-trigger">
                                        <input type="hidden" class="song_name" value="<?php echo $value["a_name"]; ?>">
                                        <input type="hidden" class="song_path" value="<?php echo $value["a_path"]; ?>">
                                        <input type="hidden" class="song_id" value="<?php echo $value["a_id"]; ?>">
                                        <i class="fa fa-headphones"></i>
                                        <span class="hide-on-small-only">
                                                        Listen
                                                    </span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if(count(Admin::getAllAudios()) > 5){ ?>
                <div class="card-action">
                    <a href="./manage_audios.php" class="btn btn-extend blue darken-2 waves-effect waves-ripple">
                        MORE
                    </a>
                </div>
                <?php } ?>
            </div>
            <?php } else{ ?>
            <div class="card-panel center default-card">
                <I class="fa fa-headphones fa-3x blue-text text-darken-2"></I>
                <p class="flow-text red-text">NO SONGS FOUND</p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!--Section: Recent-posts & todos-->
<section class="section section-recent blue lighten-4">
    <div class="row">
        <div class="col s12 m6 l8">
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
                                        <input type="hidden" class="video-id" value="<?php echo $value["id"]; ?>">
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
                    <a href="./manage_interviews.php" class="btn btn-extend blue darken-2 waves-effect waves-ripple">
                        MORE
                    </a>
                </div>
                <?php } ?>
            </div>
            <?php } else { ?>
            <div class="card-panel center default-card">
                <I class="fa fa-film fa-3x blue-text text-darken-2"></I>
                <p class="flow-text red-text">NO RECENT INTERVIEWS</p>
                <a href="#interview-modal"
                   class="btn blue lighten-1 waves-effect waves-ripple modal-trigger">
                    <i class="fa fa-plus"></i> Add Interview
                </a>
            </div>
            <?php } ?>
        </div>

        <div class="col s12 m6 l4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Todo List</span>
                    <form action="" id="todo-form">
                        <div class="input-field">
                            <input type="text" id="todo" name="todo"/>
                            <label for="todo"><i class="fa fa-plus"></i> Add Todo</label>
                        </div>
                    </form>
                    <p>
                        <i class="fa fa-list"></i> Things to do this,
                        <span class="blue-text"><?php echo strftime("%A",time()); ?></span>
                    </p>
                    <?php if( !(getToDo() == null) ){ ?>
                        <ul class="collection todos">
                            <?php foreach (getToDo() as $key=>$value){ ?>
                                <li class="collection-item text-capitalize">
                                    <div><?php echo $value; ?>
                                        <a href="" class="secondary-content delete"><i class="fa fa-times"></i></a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p class="center flow-text red-text" style="margin-top: 10px;">No Todo items</p>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</section>
<!--Section: Messages from artists-->
<section class="section section-artist-messages blue lighten-5">
    <div class="row">
        <div class="col s12 l9">
            <?php
                $complaints_array = Admin::getAllComplaints();
                if( (count($complaints_array) > 0 || !$complaints_array == null) ){
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
                                    <?php echo "{$value["msg_title"]}"; ?>
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
                <?php if( count($complaints_array) > 5 ){ ?>
                <div class="card-action">
                    <a href="./messaging.php"
                       class="btn btn-extend blue darken-2 waves-effect waves-ripple">
                        MORE
                    </a>
                </div>
                <?php } ?>
            </div>
            <?php } else { ?>
            <div class="card-panel center default-card">
                <I class="fa fa-question-circle-o fa-3x blue-text text-darken-2"></I>
                <p class="flow-text red-text">NO COMPLAINTS FOUND</p>
            </div>
            <?php } ?>
        </div>
        <div class="col s12 l3 no-padding">
            <div class="row">
                <div class="col s12 no-padding">
                    <div class="col s12">
                        <div class="card-panel blue darken-3 white-text">
                            <blockquote>
                                Sometimes we get so fixated on one door that closes that
                                we fail to see the new one that opens <br>
                                <span class="orange-text">--- Alexander Graham Bell</span>
                            </blockquote>
                        </div>
                    </div>
                <div class="col s12">
                    <div class="card-panel blue darken-3 white-text">
                        <blockquote>
                            Money never makes you friends, only a better class of enemies <br>
                            <span class="orange-text">--- Old Japanese Proverb</span>
                        </blockquote>
                    </div>
                </div>
                <div class="col s12">
                    <div class="card-panel blue darken-3 white-text">
                        <blockquote>
                            Sometimes we get so fixated on one door that closes that
                            we fail to see the one that opens <br>
                            <span class="orange-text">--- Alexander Graham Bell</span>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Footer-->
<?php include_once("../blogger_writer/css/footer.php"); ?>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red waves-effect tooltipped"
       data-position="top" data-tooltip="Options">
        <i class="fa fa-plus"></i>
    </a>
    <ul>
        <li>
            <a href="./new_post.php" class="btn-floating blue tooltipped"
               data-positoon="top" data-tooltip="Add a post">
                <i class="fa fa-pencil"></i>
            </a>
        </li>
        <li>
            <a href="#interview-modal" class="btn-floating amber darken-4 category-modal modal-trigger tooltipped"
               data-position="top" data-tooltip="Add Interviews">
                <i class="fa fa-film"></i>
            </a>
        </li>
    </ul>
</div>

<!--Modals -->
<!--View Audio-->
<div class="modal modal-fixed-footer" id="view-audio">
    <div class="modal-content">
        <h4 class="text-capitalize"><i class="fa fa-headphones"></i>
            <span class="modal-song-name text-capitalize"></span></h4>
        <div class="row">
            <div class="col s12">
                <audio controls preload="metadata" class="modal-audio-source" style="width:100%;">
                    <source src="" type="audio/mp3"/>
                </audio>
                <form action="" style="display:inline-block;vertical-align:top;">
                    <div class="input-field">
                        <input type="hidden" class="modal-audio-id" name="audio_file_id"/>
                        <button type="submit" class="btn blue darken-3">
                            <i class="fa fa-send-o"></i><span class="hide-on-small-only"> Allow</span>
                        </button>
                    </div>
                </form>
                <form action="" class="delete-audio-file" style="display:inline-block;vertical-align:top;">
                    <div class="input-field">
                        <button type="submit" class="btn red darken-3 right">
                            <input type="hidden" class="modal-audio-id" name="audio_file_id"/>
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
                        <input type="hidden" name="" class="modal-interview-id">
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

<!--Add interview modal-->
<div id="interview-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Artist Interview</h4>
        <form action="">
            <div class="file-field input-field">
                <div class="btn blue darken-3 waves-effect waves-ripple">
                    <span><i class="fa fa-film"></i> Add Video</span>
                    <input type="file" accept="video/*" name="comment_image" id=""/>
                </div>
                <div class="file-path-wrapper">
                    <input type="text" class="file-path"/>
                </div>
            </div>
            <div class="input-field">
                <input type="text" id="artist-name"/>
                <label for="artist-name">Artist's Name</label>
            </div>
            <div class="input-field">
                <select name="" id="">
                    <option value="" disabled selected>MONTH</option>
                    <option value="">JANUARY</option>
                    <option value="">FEBRUARY</option>
                    <option value="">MARCH</option>
                    <option value="">APRIL</option>
                    <option value="">MAY</option>
                    <option value="">JUNE</option>
                    <option value="">JULY</option>
                    <option value="">AUGUST</option>
                    <option value="">SEPTEMBER</option>
                    <option value="">OCTOBER</option>
                    <option value="">NOVEMBER</option>
                    <option value="">DECEMBER</option>
                </select>
            </div>
            <div class="input-field">
                <input type="text" id="video-year" readonly="readonly"
                       value="<?php echo date("Y"); ?>"/>
                <label for="video-year"><i class="fa fa-calendar"></i> Year</label>
            </div>
            <div class="input-field">
                <textarea id="basic-info" name="body" class="materialize-textarea"></textarea>
            </div>
            <div class="input-field">
                <button type="submit" class="btn blue darken-2"><i class="fa fa-plus"></i> Add Interview</button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="" class="modal-action modal-close btn-flat red-text waves-effect close-md">Close</a>
    </div>
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
                Materialize.toast("Comment Approved", 3000, "rounded");
            });

            $(".deny").on("click", function(e){
                e.preventDefault();
                Materialize.toast("Comment Denied", 3000, "rounded");
            });

            //Quick Todo
            $("#todo-form").on("submit", function(e){
                e.preventDefault();
                var todoText = $("#todo").val();

                if(todoText !== ""){
                    var output = "<li class=\"collection-item text-capitalize\"><div>"+todoText+" <a href=''" +
                        " class='secondary-content delete'><i class='fa fa-times'></i></a></div></li>";
                    $(".todos").append(output);

                    $.ajax({
                        url: "../ajax_codes/blogger_add_todo.php",
                        data: new FormData(this),
                        cache: false,
                        processData: false,
                        contentType: false,
                        type: "POST",
                        success: function(data){
                            Materialize.toast(data, 5000, "rounded");
                            $("#todo-form").trigger("reset");
                        }
                    });
                }
            });

            $(".delete").on("click", function(e){
                e.preventDefault();
                var index = $(".delete").index(this);
                $.ajax({
                    url: "../ajax_codes/blogger_delete_todo.php",
                    data: { todo_id : index },
                    cache: false,
                    type: "POST",
                    success: function(data){
                        Materialize.toast(data, 5000, "rounded");
                    }
                });
            });

            //Delete from todo list
            //Using event-delegation
            $(".todos").on("click", ".delete", function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
            });

            //INIT SELECT
            $("select").material_select();

            //INIT MODAL
            $(".modal").modal({
                dismissible: false,
                ready: function(modal, trigger){

                }
            });

            $(".close-md").on("click", function(e){
                e.preventDefault();
            });

            $(".interview-trigger").on("click", function(e){
                e.preventDefault();

                //get the class id's of the selected <divs>
                var video_node = $(this).find(".video-link");
                var video_by = $(this).find(".video-by");
                var video_for = $(this).find(".video-for");
                var video_period = $(this).find(".video-period");
                var video_id = $(this).find(".video-id");
                //output the results unto the modal
                $(".play-video").attr("src", video_node.val());
                $(".interview-by").html(video_by.val());
                $(".interview-for").html(video_for.val());
                $(".interview-period").html(video_period.val());
                $(".modal-interview-id").val(video_id.val());

            });

            $(".audio-trigger").on("click", function(e){
                e.preventDefault();

                var audio_node = $(this).find(".song_name");
                var audio_path_node = $(this).find(".song_path");
                var song_id_node = $(this).find(".song_id");

                $(".modal-audio-id").val(song_id_node.val());
                $(".modal-song-name").html(audio_node.val());
                $(".modal-audio-source").attr("src", audio_path_node.val());
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

            $(".delete-audio-file").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url:"../ajax_codes/admin_delete_audio.php",
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

            //INIT CK-EDITOR
            CKEDITOR.replace("body");

        });
    }, 1000);

</script>

</body>
</html>