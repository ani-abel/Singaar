<?php
require_once("../PHP_classes/initialize.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Video: Jimmy Hendrix - Slay the dragon | Post Malone's Public Page</title>

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

        .btn-extend{ display: block !important; width: 100% !important; }
    </style>

</head>
<body class="grey lighten-4">
<!--Link j-Query-->
<script src="../js/jquery.min.js"></script>
<!--Link materialize.js-->
<script src="../js/materialize.min.js"></script>

<header>
    <div class="navbar-fixed">
        <nav class="blue darken-2">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="./public_page.php"><i class="fa fa-arrow-left white-text tooltipped"
                                                   data-position="top" data-tooltip="Public Page"></i></a>
                </div>
            </div>
        </nav>
    </div>
</header>

<!--Section: section-form-container-->
<section class="section section-form-container">
    <div class="row">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <div class="card blue darken-2 white-text">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <h5 class="card-title text-capitalize">
                                <i class="fa fa-music"></i> Jimmy Hendrix - Slay the dragon
                            </h5>
                            <span style="font-size:13px;"><i class="fa fa-calendar"></i> 12/12/2019</span>
                        </div>
                        <div class="col s12" style="margin-top: 10px;">
                            <div class="video-container">
                                <iframe src="https://www.youtube.com/embed/cQ5OqpHvIEo"
                                        allowfullscreen frameborder="0" width="853" height="450">
                                </iframe>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-content blue darken-3">
                    <h5 class="flow-text" style="margin: 0;">
                        <i class="fa fa-comments"></i> Comments
                    </h5>
                </div>
                <div class="card-content black-text white">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <img src="../images/person2.jpg" class="responsive-img circle" alt=""/>
                            <span class="title text-uppercase blue-text text-darken-3">Jimmy Hanson</span>
                            <br>
                            <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                            <article class="blog-article">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur eos ex molestiae necessitatibus nisi qui repudiandae rerum tempore velit?</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur eos ex molestiae necessitatibus nisi qui repudiandae rerum tempore velit?</p>
                            </article>
                        </li>
                        <li class="collection-item avatar">
                            <img src="../images/person2.jpg" class="responsive-img circle" alt=""/>
                            <span class="title text-uppercase blue-text text-darken-3">Jimmy Hanson</span>
                            <br>
                            <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                            <article class="blog-article">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur eos ex molestiae necessitatibus nisi qui repudiandae rerum tempore velit?</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur eos ex molestiae necessitatibus nisi qui repudiandae rerum tempore velit?</p>
                            </article>
                        </li>
                        <li class="collection-item avatar">
                            <img src="../images/person2.jpg" class="responsive-img circle" alt=""/>
                            <span class="title text-uppercase blue-text text-darken-3">Jimmy Hanson</span>
                            <br>
                            <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                            <article class="blog-article">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur eos ex molestiae necessitatibus nisi qui repudiandae rerum tempore velit?</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur eos ex molestiae necessitatibus nisi qui repudiandae rerum tempore velit?</p>
                            </article>
                        </li>
                        <li class="collection-item avatar">
                            <img src="../images/person2.jpg" class="responsive-img circle" alt=""/>
                            <span class="title text-uppercase blue-text text-darken-3">Jimmy Hanson</span>
                            <br>
                            <span class="grey-text"><i class="fa fa-calendar"></i> 12/12/2019</span>
                            <article class="blog-article">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur eos ex molestiae necessitatibus nisi qui repudiandae rerum tempore velit?</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur eos ex molestiae necessitatibus nisi qui repudiandae rerum tempore velit?</p>
                            </article>
                        </li>
                    </ul>
                </div>
                <div class="card-action valign-wrapper">
                    <div class="row">
                        <div class="col s6">
                            <a href="./public_page_video.php?v_id="
                               data-position="top"
                               data-tooltip="Previous Video"
                               class="btn-large btn-floating lighten-1 blue
                                       waves-effect waves-green tooltipped">
                                <i class="fa fa-chevron-circle-left white-text text-darken-2"></i>
                            </a>
                        </div>
                        <div class="col s6">
                            <a href="./public_page_video.php?v_id="
                               data-position="top"
                               data-tooltip="Next Video"
                               class="btn-large btn-floating lighten-1 blue
                                       waves-effect waves-green tooltipped">
                                <i class="fa fa-chevron-circle-right white-text text-darken-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!--Footer-->
<?php include_once("css/footer.php");?>

<div class="fixed-action-btn">
    <a href="#comment-on-audio" class="btn-floating btn-large red waves-effect tooltipped modal-trigger"
       data-position="top" data-tooltip="Comment">
        <i class="fa fa-comments"></i>
    </a>
</div>

<!--Modals -->
<!--Add-category modal-->
<div id="comment-on-audio" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Comment</h4>
        <form action="">
            <div class="file-field input-field">
                <div class="btn blue darken-3 waves-effect waves-ripple">
                    <span><i class="fa fa-image"></i> Add Image</span>
                    <input type="file" accept="image/*" name="comment_image" id=""/>
                </div>
                <div class="file-path-wrapper">
                    <input type="text" class="file-path"/>
                </div>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-user prefix"></i>
                <input type="text" id="name"/>
                <label for="name">Name</label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-pencil prefix"></i>
                <textarea name="" id="comment" class="materialize-textarea"></textarea>
                <label for="comment">Comment</label>
            </div>
            <div class="input-field">
                <button type="submit"
                        class="btn btn-extend blue darken-3 waves-effect waves-ripple">
                    <i class="fa fa-send-o"></i> SUBMIT
                </button>
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
    $("header,.section, .fixed-action-btn").hide();

    setTimeout(function(){
        $(document).ready(function(){
            //SHOW SECTIONS
            $("header,.section, .fixed-action-btn").fadeIn();

            //HIDE PRE-LOADER
            $(".loader").fadeOut();

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
                Materialize.toast("Marked as read", 3000, "rounded");
            });

            $(".deny").on("click", function(e){
                e.preventDefault();
                Materialize.toast("Message deleted", 3000, "rounded");
            });

            //INIT MODAL
            $(".modal").modal({
                dismissible: false
            });

            $(".close-md").on("click", function(e){
                e.preventDefault();
            });

        });
    }, 1000);

</script>

</body>
</html>