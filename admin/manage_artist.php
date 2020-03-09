<?php
require_once("../PHP_classes/initialize.php");

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
    <title>Manage Artists | <?php echo ucwords($blogger_node["username"]); ?></title>

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
                        <li class="active">
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
                <div class="card my-search-section" style="display:none;">
                    <div class="card-content">
                        <span class="card-title">Search</span>
                        <form action="" type="post" class="search-for-artist">
                            <div class="input-field blue-text text-darken-3">
                                <i class="fa fa-search prefix"></i>
                                <input type="search" id="search-for-artist" name="search_text"/>
                                <label for="search-for-artist">Search</label>
                            </div>
                        </form>
                        <div class="search-results-container">
                            <p class="flow-text center default-msg"><i class="fa fa-search"></i> Search
                                <span class="blue-text text-darken-2">Singaar</span>
                            </p>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="btn btn-extend red darken-3 waves-effect waves-ripple close-search">
                            close
                        </div>
                    </div>
                </div>
                <?php
                    $limit = getSqlOffsets();
                    $post_array = Admin::getAllArtists($limit["st_limit"], $limit["end_limit"]);
                    if( (count($post_array) > 0 || $post_array != null) ){
                ?>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Manage Artists</span>
                        <table class="striped responsive-table">
                            <thead>
                            <tr>
                                <th>Rank</th>
                                <th></th>
                                <th>Artist</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($post_array as $key=>$value){ ?>
                                <tr>
                                    <td class="blue-text text-darken-3"><?php echo $value["rank"]; ?></td>
                                    <td width="70">
                                        <img src="<?php echo $value["profile_image"]; ?>"
                                             style="width: 40px;height:40px;margin-left: 10px;"
                                             alt="<?php echo $value["username"]; ?>" class="responsive-img circle"/>
                                    </td>
                                    <td class="text-capitalize"><?php echo $value["username"]; ?></td>
                                    <td>
                                        <a href="#message-modal" class="btn blue lighten-2 open-msg-modal modal-trigger">
                                            <input type="hidden" class="user-id" value="<?php echo $value["id"]; ?>">
                                            <input type="hidden" class="user-name" value="<?php echo $value["username"]; ?>">
                                            <i class="fa fa-comments-o"></i>
                                            <span class="hide-on-small-only">
                                                        Message
                                                    </span>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if($value["isBlocked"]==1){ ?>
                                        <form action="" method="post" class="block-user">
                                            <input type="hidden" name="user_id" value="<?php echo $value["id"]; ?>">
                                            <button type="submit"
                                                    data-position="top"
                                                    data-tooltip="Block"
                                                    class="btn btn-floating red darken-3
                                                    tooltipped waves-effect waves-ripple">
                                                <i class="fa fa-lock"></i>
                                            </button>
                                        </form>
                                        <?php } else { ?>
                                        <form action="" method="post" class="unblock-user">
                                            <input type="hidden" name="user_id" value="<?php echo $value["id"]; ?>">
                                            <button type="submit"
                                                    data-position="top"
                                                    data-tooltip="Unblock"
                                                    class="btn btn-floating tooltipped teal darken-1
                                                    waves-effect waves-ripple">
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-action">
                        <ul class="pagination">
                            <?php
                            $rs = $db->query(SEL_ALL." users WHERE(role=1)");
                            $no_of_rows = $db->num_rows($rs);
                            $a = $no_of_rows/10;
                            $a = ceil($a);

                            if(@isset($_GET['page']) && @$_GET['page'] > 1 ){

                                ?>
                                <li class="disabled">
                                    <a href="./manage_artist.php?page=<?php echo @$_GET['page'] - 1; ?>" class="blue-text">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>
                            <?php } $num = 0;
                            for($b = 1; $b <= $a; $b++){
                                $num++;
                                ?>
                                <li class="<?php if(@$_GET['page']==$b ||
                                    (!isset($_GET['page']) && $b==1)) echo "active blue lighten-2"; ?>">
                                    <a href="./manage_artist.php?page=<?php echo $b; ?>"
                                       class="<?php echo(@$_GET['page']==$b ||
                                           (!@isset($_GET['page']) && $b==1))?"white-text":"blue-text"; ?>">
                                        <?php echo $b; ?>
                                    </a>
                                </li>
                            <?php } if(@$_GET["page"] < $num){ ?>
                                <li class="waves-effect">
                                    <a href="./manage_artist.php?page=<?php echo @$_GET['page'] + 1; ?>" class="blue-text">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } else { ?>
                <div class="card-panel center">
                    <p class="flow-text red-text">NO ARTISTS YET</p>
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
            <a href="" class="btn-floating amber darken-4 trigger-search tooltipped"
               data-position="top" data-tooltip="Search artists">
                <i class="fa fa-search"></i>
            </a>
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

<!--Add-Post-modal-->
<div id="message-modal" class="modal modal-fixed-footer white">
    <div class="modal-content">
        <h4 class="text-capitalize">
            <i class="fa fa-comments"></i> Message To:
            <span class="blue-text text-darken-3 modal-display-message-to"></span>
        </h4>
        <form action="" class="message-artist">
            <div class="input-field">
                <input type="text" id="title" required name="message_title"/>
                <label for="title">Message Title</label>
                <input type="hidden" class="artist-id-modal" name="artist_id"/>
            </div>
            <div class="input-field">
                <textarea name="message_body" id="message_body" required class="materialize-textarea"></textarea>
                <label for="message_body">Message</label>
            </div>
            <div class="input-field">
                <button type="submit" class="btn blue darken-2"><i class="fa fa-send-o"></i> Send</button>
            </div>
        </form>
    </div>
    <div class="modal-footer white">
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

            //INIT SELECT
            $("select").material_select();

            $(".close-md").on("click", function(e){
                e.preventDefault();
            });

            //INIT MODAL
            $(".modal").modal({
                dismissible: false,
                ready: function (modal, trigger){
                    
                }
            });

            $(".trigger-search").on("click", function(e){
                e.preventDefault();
                $(".my-search-section").fadeIn();
            });

            $(".close-search").on("click", function(e){
                e.preventDefault();
                $(".my-search-section").fadeOut();
            });

            $(".block-user").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url: "../ajax_codes/admin_block_artist.php",
                    type: "POST",
                    data: new FormData(this),
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(".unblock-user").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url: "../ajax_codes/admin_unblock_artist.php",
                    type: "POST",
                    data: new FormData(this),
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(".search-for-artist").on("submit", function(e){
                e.preventDefault();
                var search_text = $("#search-for-artist").val();
                var search_con = $(".search-results-container");

                if(search_text !== ""){
                    $.ajax({
                        url: "../ajax_codes/admin_search_for_artist.php",
                        type: "POST",
                        data: new FormData(this),
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(data){
                            search_con.html(data);
                        }
                    });
                }
                else{
                    var text = "<p class='flow-text center default-msg'><i class='fa fa-search'></i> Search ";
                    text += "<span class='blue-text text-darken-2'>Singaar</span></p>";
                    search_con.html(text);
                }
            });

            $(".open-msg-modal").on("click", function(e){
                e.preventDefault();
                var save_in = $(".artist-id-modal");
                var node = $(this).find(".user-id");
                var username = $(this).find(".user-name");
                $(".modal-display-message-to").html(username.val());
                save_in.attr("value", node.val());
            });

            $(".message-artist").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url: "../ajax_codes/admin_message_artist.php",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    success: function(data){
                        if(/Message sent/ig.test(data))
                            $(".message-artist").trigger("reset");

                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(document).on("click", ".ajax-block-user", function(e){
                e.preventDefault();

                var user_id = $(this).data("user_id");

                $.ajax({
                    url: "../ajax_codes/admin_ajax_block_artist.php",
                    type: "POST",
                    data: { user_id : user_id },
                    success: function(data){
                        Materialize.toast(data, 10000, "rounded");
                    }
                });
            });

            $(document).on("click", ".ajax-unblock-user", function(e){
                e.preventDefault();

                var user_id = $(this).data("user_id");

                $.ajax({
                    url: "../ajax_codes/admin_ajax_unblock_artist.php",
                    type: "POST",
                    data: { user_id : user_id },
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