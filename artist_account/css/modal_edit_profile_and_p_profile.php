<!--Modals -->
<!--Add-category modal-->
<div id="edit-profile" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Edit Profile</h4>
        <form action="" method="post" id="update-profile">
            <div class="file-field input-field">
                <div class="btn blue darken-3 waves-effect waves-ripple">
                    <span><i class="fa fa-image"></i> Change Image</span>
                    <input type="file" accept="image/*" name="profile_image"/>
                </div>
                <div class="file-path-wrapper">
                    <input type="text" class="file-path"/>
                </div>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-user prefix"></i>
                <input type="text" name="username"
                       id="username" required value="<?php echo $artist_info_node["username"]; ?>"/>
                <label for="username">Username</label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-envelope-o prefix"></i>
                <input type="email" name="email"
                       id="email" class="validate" required value="<?php echo $artist_info_node["email"]; ?>"/>
                <label for="email" data-error="Invalid email" data-success="Valid email">Email</label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-lock prefix"></i>
                <input type="password" name="password"
                       id="password" value="<?php isset($artist_info_node["password"])?
                    Login::clearUpPassword($artist_info_node["password"]):""; ?>"/>
                <label for="password">Password</label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-music prefix"></i>
                <?php $musical_style = explode(",",$artist_info_node["musical_style"]); ?>
                <select name="musical_style[]" multiple required>
                    <option value="" selected disabled>MUSICAL STYLE</option>
                    <option <?php foreach($musical_style as $key=>$value)
                    { if($value == "gospel") echo "selected"; } ?> value="gospel">GOSPEL</option>
                    <option <?php foreach($musical_style as $key=>$value)
                    { if($value == "rap") echo "selected"; } ?> value="rap">RAP</option>
                    <option <?php foreach($musical_style as $key=>$value)
                    { if($value == "regae") echo "selected"; } ?> value="regae">REGAE</option>
                    <option <?php foreach($musical_style as $key=>$value)
                    { if($value == "soul") echo "selected"; } ?> value="soul">SOUL</option>
                    <option <?php foreach($musical_style as $key=>$value)
                    { if($value == "rnb") echo "selected"; } ?> value="rnb">RnB</option>
                    <option <?php foreach($musical_style as $key=>$value)
                    { if($value == "country") echo "selected"; } ?> value="country">COUNTRY</option>
                    <option <?php foreach($musical_style as $key=>$value)
                    { if($value == "edm") echo "selected"; } ?> value="edm">EDM</option>
                </select>
            </div>
            <div class="input-field">
                <button type="submit" class="btn btn-extend blue darken-3">
                    <i class="fa fa-send-o"></i> &nbsp;UPDATE
                </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="" class="modal-action modal-close btn-flat red-text waves-effect close-md">Close</a>
    </div>
</div>
<!--Manage-public-page modal-->
<div id="manage-public-page" class="modal modal-fixed-footer">
    <div class="modal-content" style="overflow-x: hidden !important;">
        <h4>Manage public page</h4>
        <form action="" method="post" id="public-page-settings">
            <?php $public_page = Artists::getPublicPageDetails()[0]; ?>
            <div class="switch">
                <p style="font-size: 17px !important;" class="blue-text text-darken-2">Turn public page
                    <span class="red-text text-darken-3">on/off</span>
                </p>
                <p class="grey-text">Turning your public page off makes it invisible to site users</p>
                <label>
                    Off
                    <input type="checkbox" name="isPublic"
                        <?php echo ( (!empty($public_page["isPublic"]) && ($public_page["isPublic"] == 1) )
                            ? "checked" : ""); ?> />
                    <span class="lever"></span>
                    On
                </label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-pencil prefix"></i>
                <textarea name="profile_text" id="profile-txt" class="materialize-textarea"><?php
                    echo (!empty($public_page["profile_text"]) ? $public_page["profile_text"] : ""); ?></textarea>
                <label for="profile-txt">About Yourself and your music</label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-facebook-square prefix"></i>
                <input type="text"
                       pattern="(^https?:\/\/www\.facebook\.com\/[a-zA-Z\d_\.]+|^www\.facebook\.com\/[a-zA-Z\d_\.]+|^facebook\.com\/[a-zA-Z\d_\.]+)"
                       name="fb_page" id="fb-profile" class="validate" value="<?php
                echo (!empty($public_page["fb_link"]) ? $public_page["fb_link"] : ""); ?>">
                <label for="fb-profile" data-error="Invalid facebook link: must begin with 'www.facebook.com/your_page'"
                       data-success="Valid facebook link">
                    Facebook Page (optional)
                </label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-twitter prefix"></i>
                <input type="text" pattern="^\@" name="twitter_handle" id="twitter-profile" class="validate" value="<?php
                echo (!empty($public_page["twitter_link"])?$public_page["twitter_link"]:""); ?>">
                <label for="twitter-profile" data-error="All twitter handles begin with '@'"
                       data-success="Valid twitter handle">
                    Twitter Handle (optional)
                </label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-instagram prefix"></i>
                <input type="text" pattern="^\@" name="instagram_handle" id="instagram-profile" class="validate" value="<?php
                echo (!empty($public_page["instagram_page"])?$public_page["instagram_page"]:""); ?>">
                <label for="instagram-profile" data-error="All instagram handles begin with '@'"
                       data-success="Valid instagram handle">
                    Instagram Handle (optional)
                </label>
            </div>
            <div class="input-field blue-text text-darken-3">
                <i class="fa fa-whatsapp prefix"></i>
                <input type="tel" pattern="\+?\d{5,}" name="whatsapp"
                       id="whatsapp-number" class="validate" value="<?php
                echo (!empty($public_page["whatsapp_numbers"])?$public_page["whatsapp_numbers"]:""); ?>">
                <label for="whatsapp-number" data-error="Only digits allowed"
                       data-success="Valid whatsapp number">
                    Whatsapp Number (optional)
                </label>
            </div>
            <div class="input-field">
                <button type="submit" class="btn btn-extend blue darken-3">
                    <i class="fa fa-cog"></i> &nbsp;Change Settings
                </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="" class="modal-action modal-close btn-flat red-text waves-effect close-md">Close</a>
    </div>
</div>