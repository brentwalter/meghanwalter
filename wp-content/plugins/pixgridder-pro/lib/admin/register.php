<?php
	global $options;

    if (isset($_GET['page']) && $_GET['page']=='pixgridder_register') {
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Options','pixgridder'); ?>: <small><?php _e('Register for automatic updating','pixgridder'); ?></small></h3>

            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=pixgridder_admin"); ?>">
            
                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pixgridder_user_name"><?php _e( 'Your CodeCanyon user name', 'pixgridder' ); ?> <small>(<a href="http://www.pixedelic.com/envato-assets/pixgridder/username.jpg" class="pix-iframe"><?php _e('what\'s that','pixgridder'); ?></a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_user_name'))); ?>" name="pixgridder_user_name" id="pixgridder_user_name">
                        <br>
                        <br>
                        <br>

                        <div id="check_license_message" class="hidden"></div>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">


                        <label for="pixgridder_license_key"><?php _e( 'Your Item Purchase Code', 'pixgridder' ); ?> <small>(<?php _e('where to find it:','pixgridder'); ?> <a href="http://www.pixedelic.com/envato-assets/pixgridder/click-downloads.jpg" class="pix-iframe">#1</a>, <a href="http://www.pixedelic.com/envato-assets/pixgridder/click-license.jpg" class="pix-iframe">#2</a>, <a href="http://www.pixedelic.com/envato-assets/pixgridder/license-code.jpg" class="pix-iframe">#3</a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_license_key'))); ?>" name="pixgridder_license_key" id="pixgridder_license_key">
                        <br>
                        <br>
                        <br>

                    </div><!-- .pix_column.second -->

                </div><!-- .pix_columns -->

                <div class="clear"></div>

                <input type="hidden" name="register_details" value="register_details" />
                <input type="hidden" name="action" value="pixgridder_data_save" />
                <input type="hidden" name="pixgridder_security" value="<?php echo wp_create_nonce('pixgridder_data'); ?>" />
                <button type="submit" class="pix-save-options pix_button fake_button alignright"><?php _e('Save options','pixgridder'); ?><i class="pixgridder-icon-ok-4"></i></button>
                <button type="submit" class="pix-save-options pix_button fake_button2 alignright"><?php _e('Save options','pixgridder'); ?><i class="pixgridder-icon-ok-4"></i></button>
                <button type="submit" class="pix-save-options pix_button alignright"><?php _e('Save options','pixgridder'); ?><i class="pixgridder-icon-ok-4"></i></button>
                <div id="gradient-save-button"></div>

            </form><!-- .dynamic_form -->

        </section><!-- #pix_content_loaded -->
<?php 
	}