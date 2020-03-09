<!--Section: section-my-modal-overlay-->
<section class="section-my-modal-overlay all-notifications"
         style="height:100%;width:100%;background:rgba(0,0,0,0.3);position:fixed;
         z-index:99999999999;top:0;display:none;">
    <div class="row">
        <div class="col s12 m8 offset-m2 l4 offset-l4 white darken-1 z-depth-5 no-padding "
             style="margin-top:1% !important;margin-bottom:1% !important;padding-top:0;position:relative">
            <div class="row" style="margin-bottom: 0 !important;">
                <div class="col s12 blue darken-3 center white-text">
                    <p class="flow-text">
                        <i class="fa fa-bell-o"></i> NOTIFICATIONS
                    </p>
                </div>
                <div class="col s12 no-padding hold-notifications">
                    <ul class="collection no-padding">
                        <?php
                        $total_notifications = 0;
                        $notify_arr1 = Artists::getAllContactInvitationNotifications();
                        if( (!$notify_arr1 == null || count($notify_arr1) > 0) ){
                            $total_notifications += count($notify_arr1);
                            foreach($notify_arr1 as $key=>$value){
                                ?>
                                <li class="collection-item avatar">
                                    <img src="<?php echo $value["profile_image"]; ?>"
                                         class="circle responsive-img"
                                         style="width:50px;height: 50px;"
                                         alt="<?php echo $value["n_from"]; ?>"/>
                                    <p>
                                <span class="red-text text-lighten-2 text-lowercase">@<?php echo $value["n_from"]; ?>
                                </span> added you to their contact list.
                                        Add to see their messages.
                                    </p>
                                    <input type="hidden" class="n-id" value="<?php echo $value["n_id"]; ?>"/>
                                    <input type="hidden" class="n-from-id" value="<?php echo $value["n_from_id"]; ?>"/>
                                    <button class="btn blue darken-3 waves-effect waves-ripple confirm-contact">
                                        Add
                                    </button>
                                    <button class="btn btn-floating red darken-2 waves-effect decline-invitation
                            waves-ripple form-inline tooltipped"
                                            data-position="top"
                                            data-tooltip="Delete notification">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </li>
                            <?php } } ?>
                        <?php
                        $notify_arr2 = Artists::getAllContactInvitationConfirmedNotifications();
                        if( (!$notify_arr2 == null || count($notify_arr2) > 0) ){
                            $total_notifications += count($notify_arr2);
                            foreach($notify_arr2 as $key=>$value){
                                ?>
                                <li class="collection-item avatar">
                                    <img src="<?php echo $value["profile_image"]; ?>"
                                         class="circle responsive-img"
                                         style="width:50px;height: 50px;"
                                         alt="<?php echo $value["n_from"]; ?>"/>
                                    <p>
                                        <span class="red-text text-lighten-2 text-lowercase">@<?php echo $value["n_from"]; ?></span>
                                        accepted your invitation to be your contact.
                                    </p>
                                    <button class="btn btn-floating red darken-2 delete-notification
                             waves-effect waves-ripple form-inline tooltipped"
                                            data-position="top"
                                            data-tooltip="Delete notification">
                                        <input type="hidden" class="del_n_id" value="<?php echo $value["n_id"]; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </li>
                            <?php } } ?>
                        <?php
                        $notify_arr3 = Artists::getAllContactDeclinedNotf();
                        if( (!$notify_arr3 == null || count($notify_arr3) > 0) ){
                            $total_notifications += count($notify_arr3);
                            foreach($notify_arr3 as $key=>$value){
                                ?>
                                <li class="collection-item avatar">
                                    <img src="<?php echo $value["profile_image"]; ?>"
                                         class="circle responsive-img"
                                         style="width:50px;height:50px;"
                                         alt="<?php echo $value["n_from"]; ?>"/>
                                    <p>
                                        <span class="red-text text-lighten-2">@<?php echo $value["n_from"]; ?></span>
                                        declined your invitation to be a contact
                                    </p>
                                    <button class="btn btn-floating red darken-2 waves-effect delete-notification
                            waves-ripple form-inline tooltipped"
                                            data-position="top"
                                            data-tooltip="Delete notification">
                                        <input type="hidden" class="del_n_id" value="<?php echo $value["n_id"]; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </li>
                            <?php } } ?>
                        <?php
                        if( Artists::unRepliedFanMail() > 0 ){
                            $total_notifications += 1;
                            ?>
                            <li class="collection-item avatar">
                                <img src="../images/open_envelope.png"
                                     class="circle responsive-img"
                                     style="width:50px;height: 50px;"
                                     alt="fan mail icon"/>
                                <p>
                                    You have <span class="red-text text-lighten-2"><?php echo Artists::unRepliedFanMail(); ?>
                                        unreplied</span> fan mail messages
                                </p>
                                <button class="btn blue darken-3 waves-effect waves-ripple">
                                    Read
                                </button>
                            </li>
                        <?php } ?>
                        <?php if( $total_notifications == 0 ){ ?>
                            <li class="collection-item center">
                                <i class="fa fa-trash fa-3x"></i>
                                <p class="flow-text">No Notifications</p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col s12 z-depth-5" style="padding: 10px 5px;">
                    <button class="btn btn-extend red darken-2 waves-effect waves-ripple" id="close-my-notifications">
                        CLOSE
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>