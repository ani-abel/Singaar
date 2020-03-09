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
    <title>Posts | <?php echo ucwords($blogger_node["username"]); ?></title>

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

<!--TODO: Loop through all the posts in the DB and use pagination on them-->

<!--Section: Posts-->
<section class="section section-posts grey lighten-4">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <?php
                    $limit = getSqlOffsets();
                    $post_array = Admin::getAllBlogPosts($limit["st_limit"], $limit["end_limit"]);
                    if( (count($post_array) > 0 || $post_array != null) ){
                ?>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Posts</span>
                        <table class="striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date Created</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($post_array as $key=>$value){
                                $value["date_of_entry"] = explode(",", $value["date_of_entry"]);
                                $value["date_of_entry"] = $value["date_of_entry"][1];
                                ?>
                                <tr>
                                    <td class="text-uppercase truncate tooltipped"
                                        data-position="top"
                                        data-tooltip="<?php echo ucwords($value["post_title"]); ?>">
                                        <?php echo deleteEscape($value["post_title"]); ?>
                                    </td>
                                    <td class="text-capitalize"><?php echo $value["category"]; ?></td>
                                    <td><?php echo $value["date_of_entry"]; ?></td>

                                    <td>
                                        <a href="details.php?post_id=<?php echo base64_encode($value["post_id"]); ?>"
                                           class="btn blue lighten-2 tooltipped"
                                           data-position="top" data-tooltip="Edit/delete posts">Manage</a>
                                    </td>
                                    <td>
                                        <a href="./comments.php?post_id=<?php
                                        echo base64_encode($value["post_id"]); ?>"
                                           class="btn red lighten-2 tooltipped"
                                           data-position="top" data-tooltip="View comments for this post">Comments</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-action">
                        <ul class="pagination">
                            <?php
                            $rs = $db->query(SEL_ALL." blog_posts");
                            $no_of_rows = $db->num_rows($rs);
                            $a = $no_of_rows/10;
                            $a = ceil($a);

                            if(@isset($_GET['page']) && @$_GET['page'] > 1 ){

                                ?>
                                <li class="disabled">
                                    <a href="./posts.php?page=<?php echo @$_GET['page'] - 1; ?>" class="blue-text">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>
                            <?php } $num = 0;
                            for($b = 1; $b <= $a; $b++){
                                $num++;
                                ?>
                                <li class="<?php if(@$_GET['page']==$b ||
                                    (!isset($_GET['page']) && $b==1)) echo "active blue lighten-2"; ?>">
                                    <a href="./posts.php?page=<?php echo $b; ?>"
                                       class="<?php echo(@$_GET['page']==$b ||
                                           (!@isset($_GET['page']) && $b==1))?"white-text":"blue-text"; ?>">
                                        <?php echo $b; ?>
                                    </a>
                                </li>
                            <?php } if(@$_GET["page"] < $num){ ?>
                                <li class="waves-effect">
                                    <a href="./posts.php?page=<?php echo @$_GET['page'] + 1; ?>" class="blue-text">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } else{ ?>
                <div class="card-panel center">
                    <p class="flow-text red-text">NO POSTS HAVE BEEN MADE</p>
                    <a href="./new_post.php"
                       class="btn blue lighten-1 waves-effect waves-ripple">
                        <i class="fa fa-plus"></i> Add Post
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<!--Footer-->
<?php if( (count($post_array) > 3 && $post_array != null) ){ ?>
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