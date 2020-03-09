<?php
require_once("../PHP_classes/initialize.php");

if( !($session->is_logged_in() || isset($session->user_id, $_SESSION['role'])) || $_SESSION['role'] != "admin"){
    $session->logout();
    redirect_to("../php/login.php");
}

if( !isset($_GET["post_id"]) ){
    redirect_to("index.php");
}

$post_id = base64_decode($_GET["post_id"]);

if(!is_array(BlogWriter::getAPost($post_id))){
    redirect_to("posts.php");
}

$post_node = BlogWriter::getAPost($post_id);
$post_title = deleteEscape($post_node["post_title"]);
$post_body = deleteEscape($post_node["post_body"]);
$category_id = $post_node["category_id"];

$blogger_node = BlogWriter::getBloggerInfo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Content for post one | <?php echo ucwords($blogger_node["username"]); ?></title>

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
                        <li class="active">
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

<!--Section: Posts-->
<section class="section section-posts grey lighten-4">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 m6">
                                <span class="card-title">Post Details</span>
                            </div>
                            <?php if( !($blogger_node["profile_imgSm"] == null && $blogger_node["username"]) ){ ?>
                                <div class="col s12 m6 center">
                                    <img src="<?php echo $blogger_node["profile_imgSm"]; ?>"
                                         class="responsive-img circle"
                                         style="width: 40px;margin-left: 10px" alt="Image"/>
                                    <p><i class="fa fa-user"></i> <?php echo $blogger_node["username"]; ?></p>
                                    <time class="grey-text"><i class="fa fa-calendar"></i>
                                        <?php echo dateToString(); ?>
                                    </time>
                                </div>
                            <?php } ?>
                        </div>
                        <form action="" id="form">
                            <div class="input-field">
                                <input type="text" required id="title" name="post_title" maxlength="300"
                                       value="<?php echo strtolower($post_title) ?>">
                                <label for="title">Title</label>
                            </div>

                            <div class="input-field">
                                <select id="" required name="post_category">
                                    <option value="" disabled>Select Option</option>
                                    <option value="1" <?php echo ($category_id==1)?"selected":""; ?>>Foreign
                                    </option>
                                    <option value="2" <?php echo ($category_id==2)?"selected":""; ?>>Local</option>
                                </select>
                                <label for="">Category</label>
                            </div>

                            <div class="input-field">
                                <textarea name="body" id="body" required class="materialize-textarea">
                                    <?php echo $post_body; ?>
                                </textarea>
                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                            </div>
                            <div class="input-field">
                                <p class="red-text text-darken-2" style="font-size: 16px;">
                                    <i class="fa fa-bell-o"></i> Remember to double-click on the save button to update post
                                </p>
                                <button type="submit" class="btn green darken-2 save-btn">
                                    <i class="fa fa-floppy-o"></i> Save
                                </button>
                                <button class="btn red darken-2 delete-btn">
                                    <input type="hidden" name="del_post_id"
                                           class="del_post_id" value="<?php echo $post_id; ?>">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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

            $(".delete-btn").on("click", function(e){
                e.preventDefault();

                var post_id = $(".del_post_id").val();

                $.ajax({
                    url:"../ajax_codes/blogger_delete_post.php",
                    data: { "del_post_id" : post_id },
                    cache: false,
                    type: "POST",
                    success: function(data){
                        Materialize.toast(data, 5000, "rounded");
                        setTimeout(function(){
                            location.href = "posts.php";
                        }, 8000);
                    }
                });
            });

            $("#form").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url:"../ajax_codes/blogger_update_post.php",
                    data: new FormData(this),
                    cache: false,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    success: function(data){
                        Materialize.toast(data, 5000, "rounded");
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