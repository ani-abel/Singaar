<?php
require_once("../PHP_classes/initialize.php");

global $session;
if( !($session->is_logged_in() || isset($session->user_id, $_SESSION['role'])) || $_SESSION['role'] != "blogger"){
    $session->logout();
    redirect_to("../php/login.php");
}

$blogger_node = BlogWriter::getBloggerInfo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Singaar | Control Panel</title>

    <!--Import Google icon font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icons?family=Material+icons"/>

    <!--Link materialize.css file here-->
    <link rel="stylesheet" href="../css/materialize.min.css" media="screen, projection" />
    <link rel="stylesheet" href="css/main3.css" />
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

        .btn-extend{ display: block !important; width: 100% !important; }

        .loader{ position: absolute !important; top: 40% !important; left: 47% !important; }
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
                        <li class="active">
                            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="posts.php">Posts</a>
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

        <li><div class="divider"></div></li>

        <li><a href="" class="subheader">Account Controls</a></li>

        <li><a href="../php/logout.php" class="waves-effect"><i class="fa fa-power-off"></i> Logout</a></li>

    </ul>
</header>

<!--Section: stats-->
<section class="section section-stats center">
    <div class="row">
        <div class="col s12 m6 l4">
            <div class="card-panel blue lighten-1 white-text" >
                <i class="fa fa-user medium"></i>
                <h5>Total Artists</h5>
                <h5 class="count"><?php echo BlogWriter::getNumberOfAllArtists(); ?></h5>
                <div class="progress grey lighten-1">
                    <div class="determinate white" style="width:40%;"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="card-panel center">
                <i class="fa fa-pencil medium"></i>
                <h5>Posts</h5>
                <h5 class="count"><?php echo BlogWriter::getNumberOfPostsMade(); ?></h5>
                <div class="progress grey lighten-1">
                    <div class="determinate blue lighten-1" style="width:60%;"></div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="card-panel blue lighten-1 white-text" >
                <i class="fa fa-comments-o medium"></i>
                <h5>Comments</h5>
                <h5 class="count"><?php echo BlogWriter::getNumberOfAllComments(); ?></h5>
                <div class="progress grey lighten-1">
                    <div class="determinate white" style="width:40%;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Section: Recent-posts & todos-->
<section class="section section-recent blue lighten-3">
    <div class="row">
        <div class="col s12 m6 l8">
            <?php if( !(BlogWriter::getAllPostsByThisWriter(false) == null) ){ ?>
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Recent Posts</span>
                    <table class="striped responsive-table">
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
                            $arr = BlogWriter::getAllPostsByThisWriter(false);
                            foreach($arr as $key=>$value){
                                $post_id = $value["post_id"];
                                $post_title = $value["post_title"];
                                $post_category = $value["category"];
                                $date_of_entry = dateToString($value["date_of_entry"]);

                                $date_of_entry = explode(",", $date_of_entry);
                                $date_of_entry = $date_of_entry[1];
                        ?>
                        <tr>
                            <td class="text-uppercase truncate tooltipped"
                                data-position="top" data-tooltip="<?php echo ucwords($post_title); ?>">
                                <?php echo $post_title; ?>
                            </td>
                            <td class="text-capitalize"><?php echo $post_category; ?></td>
                            <td><?php echo $date_of_entry; ?></td>
                            <td>
                                <a href="details.php?post_id=<?php echo base64_encode($post_id); ?>"
                                   class="btn blue lighten-2 tooltipped"
                                   data-position="top" data-tooltip="Edit/delete posts">Manage</a>
                            </td>
                            <td>
                                <a href="./comments.php?post_id=<?php echo base64_encode($post_id); ?>"
                                 class="btn red lighten-2 tooltipped"
                                   data-position="top" data-tooltip="View comments for this post">Comments</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-action">
                    <a href="./posts.php" class="btn btn-extend blue darken-2 waves-effect waves-ripple">
                        MORE
                    </a>
                </div>
            </div>
            <?php } else { ?>
            <div class="card center default-card">
                <p class="flow-text red-text">NO POSTS HAVE BEEN MADE BY YOU</p>
                <a href="./new_post.php"
                   class="btn blue lighten-1 waves-effect waves-ripple">
                    <i class="fa fa-plus"></i> Add Post
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

<!--Modals -->
<!--Edit-profile modal-->
<div id="category-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Edit Profile</h4>
        <form action="" method="post" id="edit-profile-form">
            <div class="input-field">
                <input type="text" id="bw-username" name="new_username"
                       required value="<?php echo $blogger_node['username']; ?>">
                <label for="bw-username"><i class="fa fa-user"></i> New Username</label>
            </div>
            <div class="input-field">
                <?php
                    $r = base64_decode($blogger_node['password']);
                    $r= preg_replace("/^JinGo/","",$r);
                    $r= preg_replace("/si ng aar$/","",$r);
                ?>
                <input type="password" id="bw-password" name="new_password"
                       required value="<?php echo $r; ?>">
                <label for="bw-password"><i class="fa fa-lock"></i> New Password</label>
            </div>
            <div class="input-field">
                <input type="email" id="bw-email" required name="new_email"
                       class="validate" value="<?php echo $blogger_node['email']; ?>">
                <label for="bw-email" data-error="Invalid Email" data-success="Valid Email">
                    <i class="fa fa-envelope-o"></i> New Email
                </label>
            </div>
            <div class="input-field edit-profile-err-log" style="display:none;"></div>
            <div class="input-field">
                <button type="submit" class="btn blue darken-2">Submit</button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="" class="modal-action modal-close btn-flat red-text waves-effect close-md">Close</a>
    </div>
</div>

<!--Add interview modal-->
<div id="interview-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Artist Interview</h4>
        <form action="" method="post" enctype="multipart/form-data" id="add-artist-interview">
            <div class="file-field input-field">
                <div class="btn blue darken-3 waves-effect waves-ripple">
                    <span><i class="fa fa-film"></i> Add Video</span>
                    <input type="file" required accept="video/*" name="interview_video"/>
                </div>
                <div class="file-path-wrapper">
                    <input type="text" class="file-path"/>
                </div>
            </div>
            <div class="input-field">
                <input type="text" id="artist-name" name="artist_name" required/>
                <label for="artist-name">Artist's Name</label>
            </div>
            <div class="input-field">
                <select name="interview_month" required>
                    <option value="" disabled selected>MONTH</option>
                    <option value="january">JANUARY</option>
                    <option value="february">FEBRUARY</option>
                    <option value="march">MARCH</option>
                    <option value="april">APRIL</option>
                    <option value="may">MAY</option>
                    <option value="june">JUNE</option>
                    <option value="july">JULY</option>
                    <option value="august">AUGUST</option>
                    <option value="september">SEPTEMBER</option>
                    <option value="october">OCTOBER</option>
                    <option value="november">NOVEMBER</option>
                    <option value="december">DECEMBER</option>
                </select>
            </div>
            <div class="input-field">
                <input type="text" id="video-year" readonly="readonly"
                       value="<?php echo strftime("%Y"); ?>"/>
                <label for="video-year"><i class="fa fa-calendar"></i> Year</label>
            </div>
            <div class="input-field">
                <p class="red-text text-darken-3">
                    <i class="fa fa-pencil"></i> Brief 'hype' or intro to promote the interview
                </p>
                <textarea id="basic-info" required name="body" class="materialize-textarea"></textarea>
            </div>
            <div class="input-field add-interview-err-log" style="display:none;"></div>
            <div class="input-field">
                <button type="submit" class="btn blue darken-2"><i class="fa fa-plus"></i> Add Interview</button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="" class="modal-action modal-close btn-flat red-text waves-effect close-md">Close</a>
    </div>
</div>

<?php include_once("css/footer.php"); ?>

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
        <li>
            <a href="#category-modal" class="btn-floating deep-purple category-modal modal-trigger tooltipped"
            data-position="top" data-tooltip="Edit account">
                <i class="fa fa-user-circle"></i>
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

            $("#edit-profile-form").on("submit", function(e){
                e.preventDefault();
                var error_log = $(".edit-profile-err-log");

                $.ajax({
                    url: "../ajax_codes/blogger_edit_profile.php",
                    data: new FormData(this),
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(/Profile info has been changed/ig.test(data)){
                            error_log.fadeOut();
                            Materialize.toast(data, 5000, "rounded");
                            $("#edit-profile-form").trigger("reset");
                        }
                        else{
                            error_log.fadeIn();
                            error_log.html(data);
                        }
                    }
                });
            });

            $("#add-artist-interview").on("submit", function(e){
                e.preventDefault();
                var error_log = $(".add-interview-err-log");

                $.ajax({
                    url: "../ajax_codes/blogger_add_interview.php",
                    data: new FormData(this),
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(/added successfully/ig.test(data)){
                            error_log.fadeOut();
                            Materialize.toast(data, 5000, "rounded");
                            $("#add-artist-interview").trigger("reset");
                        }
                        else{
                            error_log.fadeIn();
                            error_log.html(data);
                        }
                    }
                });
            });

            //INIT MODAL
            $(".modal").modal({
                dismissible: false
            });

            $(".close-md").on("click", function(e){
                e.preventDefault();
            });

            //INIT CK-EDITOR
            CKEDITOR.replace("body");

        });
    }, 1000);

</script>

</body>
</html>