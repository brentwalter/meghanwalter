<?php
	global $options;

    if (isset($_GET['page']) && $_GET['page']=='pixgridder_verygeneral') {
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Options','pixgridder'); ?>: <small><?php _e('Very general','pixgridder'); ?></small></h3>

            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=pixgridder_admin"); ?>">
            
                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pixgridder_allow_ajax">
                            <input type="hidden" name="pixgridder_allow_ajax" value="0">
                            <input type="checkbox" id="pixgridder_allow_ajax" name="pixgridder_allow_ajax" value="true" <?php checked( get_option('pixgridder_allow_ajax'), 'true' ); ?>>
                            <span></span>
                            <?php _e('Enable ajax to save data','pixgridder'); ?> <small>(<a href="#" data-dialog="<?php _e('Where available (not on this page, for instance) your options will be saved without refreshing the page.<br>If you encounter any problem just switch this field off.','pixgridder'); ?>"><?php _e('more info','pixgridder'); ?></a>)</small>
                        </label>
                        <br>
                        <br>
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <label for="pixgridder_no_trace">
                            <input type="hidden" name="pixgridder_no_trace" value="0">
                            <input type="checkbox" id="pixgridder_no_trace" name="pixgridder_no_trace" value="true" <?php checked( get_option('pixgridder_no_trace'), 'true' ); ?>>
                            <span></span>
                            <?php _e('Remove any trace of PixGridder when you uninstall it','pixgridder'); ?> <small>(<?php _e('a backup is always recommended...','pixgridder'); ?> <a href="#" data-dialog="<?php _e('If you tick this checkbox you will lose any trace of the plugin and, if you install it again, you will have to start from scratch','pixgridder'); ?>"><?php _e('more info','pixgridder'); ?></a>)</small>
                        </label>
                        <br>
                        <br>
                        <br>

                    </div><!-- .pix_column.second -->
                </div><!-- .pix_columns -->

                <div class="clear"></div>

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