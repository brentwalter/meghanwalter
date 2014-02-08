<?php
	global $options;

    if (isset($_GET['page']) && $_GET['page']=='pixgridder_settings') {
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Options','pixgridder'); ?>: <small><?php _e('Settings','pixgridder'); ?></small></h3>

            <?php if (get_option('pixgridder_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=pixgridder_admin"); ?>">
            <?php } ?>
            
                <div class="pix_columns cf">
                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
                    <div class="pix_column alignleft">

                        <label for="pixgridder_disable_preview">
                            <input type="hidden" name="pixgridder_disable_preview" value="0">
                            <input type="checkbox" id="pixgridder_disable_preview" name="pixgridder_disable_preview" value="true" <?php checked( get_option('pixgridder_disable_preview'), 'true' ); ?>>
                            <span></span>
                            <?php _e('Disable the preview tab on builder','pixgridder'); ?>
                        </label>
                        <br>
                        <br>


                        <label for="pixgridder_fx"><?php _e( 'Select the default effect to apply to your columns on scroll event', 'pixgridder' ); ?>  <small>(<a href="#" data-dialog="<?php _e('If you prefer you can add a class to a column directly through the grid builder UI to override the general option. The list of the class available is the same of options available for this select box.','pixgridder'); ?>"><?php _e('more info','pixgridder'); ?></a>)</small>:
                            <span class="for_select">
                                <select id="pixgridder_fx" name="pixgridder_fx">
                                    <option value="none" <?php selected( get_option('pixgridder_fx'), 'none' ); ?>>none</option>
                                    <option value="available" <?php selected( get_option('pixgridder_fx'), 'available' ); ?>>available</option>
                                    <option value="pix-fadeIn" <?php selected( get_option('pixgridder_fx'), 'pix-fadeIn' ); ?>>pix-fadeIn</option>
                                    <option value="pix-fadeDown" <?php selected( get_option('pixgridder_fx'), 'pix-fadeDown' ); ?>>pix-fadeDown</option>
                                    <option value="pix-fadeUp" <?php selected( get_option('pixgridder_fx'), 'pix-fadeUp' ); ?>>pix-fadeUp</option>
                                    <option value="pix-fadeLeft" <?php selected( get_option('pixgridder_fx'), 'pix-fadeLeft' ); ?>>pix-fadeLeft</option>
                                    <option value="pix-fadeRight" <?php selected( get_option('pixgridder_fx'), 'pix-fadeRight' ); ?>>pix-fadeRight</option>
                                    <option value="pix-zoomIn" <?php selected( get_option('pixgridder_fx'), 'pix-zoomIn' ); ?>>pix-zoomIn</option>
                                    <option value="pix-zoomOut" <?php selected( get_option('pixgridder_fx'), 'pix-zoomOut' ); ?>>pix-zoomOut</option>
                                    <option value="pix-rotateIn" <?php selected( get_option('pixgridder_fx'), 'pix-rotateIn' ); ?>>pix-rotateIn</option>
                                    <option value="pix-rotateOut" <?php selected( get_option('pixgridder_fx'), 'pix-rotateOut' ); ?>>pix-rotateOut</option>
                                    <option value="pix-flipClock" <?php selected( get_option('pixgridder_fx'), 'pix-flipClock' ); ?>>pix-flipClock</option>
                                    <option value="pix-swing" <?php selected( get_option('pixgridder_fx'), 'pix-swing' ); ?>>pix-swing</option>
                                    <option value="pix-turnForward" <?php selected( get_option('pixgridder_fx'), 'pix-turnForward' ); ?>>pix-turnForward</option>
                                    <option value="pix-turnBackward" <?php selected( get_option('pixgridder_fx'), 'pix-turnBackward' ); ?>>pix-turnBackward</option>
                               </select>
                            </span>
                        </label>
                        <br>
                        <br>

                        <label for="pixgridder_post_type"><?php _e( 'Select the post types and the template you want to apply the default settings to', 'pixgridder' ); ?>:</label>
                        <blockquote>
                        <?php   
                            $post_types = get_post_types(array( 'public' => true ));   

                            $pixgridder_post_type = get_option('pixgridder_post_type');
                            $pixgridder_page_template = get_option('pixgridder_page_template');

                            foreach ( $post_types as $post_type ) {
                                if ( post_type_supports( $post_type, 'editor' ) ) {
                                    $object = get_post_type_object($post_type);
                                    $label = $object->label;
                                    $name = $object->name; ?>
                                    <label for="pixgridder_post_type_<?php echo $name; ?>"<?php if ( $name=="page" ) { ?> class="for_pages"<?php } ?>>
                                        <input type="hidden" name="pixgridder_post_type[<?php echo $name; ?>]" value="0">
                                        <input type="checkbox" id="pixgridder_post_type_<?php echo $name; ?>" name="pixgridder_post_type[<?php echo $name; ?>]" value="<?php echo $name; ?>" <?php if (isset($pixgridder_post_type[$name])) { checked( $pixgridder_post_type[$name], $name ); } ?>>
                                        <span></span>
                                        <?php echo $label; ?>
                                    </label>
                                    <?php if ( $name=="page" ) { ?>
                                        <blockquote>
                                            <?php
                                                $page_template = locate_template( array( 'page.php' ) );
                                                if (!empty($page_template)) { ?>
                                                    <label for="pixgridder_page_template_default">
                                                        <input type="hidden" name="pixgridder_page_template[default]" value="0">
                                                        <input type="checkbox" id="pixgridder_page_template_default" name="pixgridder_page_template[default]" value="default" <?php if (isset($pixgridder_page_template['default'])) { checked( $pixgridder_page_template['default'], 'default' ); } ?>>
                                                        <span></span>
                                                        Page.php
                                                    </label>
                                                    <br>
                                                <?php }
                                                $templates = get_page_templates();
                                                foreach ( $templates as $template_name => $template_filename ) { ?>
                                                    <label for="pixgridder_page_template_<?php echo $template_filename; ?>">
                                                        <input type="hidden" name="pixgridder_page_template[<?php echo $template_filename; ?>]" value="0">
                                                        <input type="checkbox" id="pixgridder_page_template_<?php echo $template_filename; ?>" name="pixgridder_page_template[<?php echo $template_filename; ?>]" value="<?php echo $template_filename; ?>" <?php if (isset($pixgridder_page_template[$template_filename])) { checked( $pixgridder_page_template[$template_filename], $template_filename ); } ?>>
                                                        <span></span>
                                                        <?php echo $template_name; ?>
                                                    </label>
                                                    <br>
                                                <?php }
                                            ?>
                                        </blockquote>
                                    <?php } else { ?>
                                    <br><?php
                                    }
                                }
                            }
                        ?>
                        </blockquote>
                        <br>

                        <label for="pixgridder_min_cols"><?php _e( 'Set a minimum of columns as default option', 'pixgridder' ); ?>:</label>
                        <div class="slider_div">
                            <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_min_cols'))); ?>" name="pixgridder_min_cols" id="pixgridder_min_cols">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pixgridder_max_cols"><?php _e( 'Set a maximum of columns as default option', 'pixgridder' ); ?>:</label>
                        <div class="slider_div">
                            <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_max_cols'))); ?>" name="pixgridder_max_cols" id="pixgridder_max_cols">
                            <div class="slider_cursor"></div>
                        </div><!-- .slider_div -->
                        <br>

                        <label for="pixgridder_exclude_cols"><?php _e( 'Exclude some numbers from the range', 'pixgridder' ); ?> <small>(<a href="#" data-dialog="<?php _e('Separate the values with commas, no empty spaces allowed, for instance: <strong>5,7,12</strong>','pixgridder'); ?>"><?php _e('how to','pixgridder'); ?></a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_exclude_cols'))); ?>" name="pixgridder_exclude_cols" id="pixgridder_exclude_cols">
                        <br>

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <div class="tip_info">
                            <?php _e( 'If you change the values here below (how the rows and the columns start and finish) you won\'t be able to use the automatic CSS compiler anymore, but you will have to create your own CSS by using an editor', 'pixgridder' ); ?>
                        </div>

                        <label for="pixgridder_row_open"><?php printf( __( 'Replace this code %s with', 'pixgridder' ), '<br><code>&lt;!--pixgridder:row[cols=$1]--&gt;</code><br>' ); ?> <small>(<a href="#" data-dialog="<?php _e('It is how a row is open and the signs <code>$1</code> will be replaced by the number of columns.','pixgridder'); ?>"><?php _e('more info','pixgridder'); ?></a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_row_open'))); ?>" name="pixgridder_row_open" id="pixgridder_row_open">
                        <br>

                        <label for="pixgridder_row_close"><?php printf( __( 'Replace this code %s with', 'pixgridder' ), '<br><code>&lt;!--/pixgridder:row[cols=$1]--&gt;</code><br>' ); ?> <small>(<a href="#" data-dialog="<?php _e('It is how a row is closed and the signs <code>$1</code> will be replaced by the number of columns.','pixgridder'); ?>"><?php _e('more info','pixgridder'); ?></a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_row_close'))); ?>" name="pixgridder_row_close" id="pixgridder_row_close">
                        <br>

                        <label for="pixgridder_column_open"><?php printf( __( 'Replace this code %s with', 'pixgridder' ), '<br><code>&lt;!--pixgridder:column[col=$1]--&gt;</code><br>' ); ?> <small>(<a href="#" data-dialog="<?php _e('It is how a column is open and the signs <code>$1</code> will be replaced by the number that indicates the width of the column itself.','pixgridder'); ?>"><?php _e('more info','pixgridder'); ?></a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_column_open'))); ?>" name="pixgridder_column_open" id="pixgridder_column_open">
                        <br>

                        <label for="pixgridder_column_close"><?php printf( __( 'Replace this code %s with', 'pixgridder' ), '<br><code>&lt;!--/pixgridder:column[col=$1]--&gt;</code><br>' ); ?> <small>(<a href="#" data-dialog="<?php _e('It is how a column is closed and the signs <code>$1</code> will be replaced by the number that indicates the width of the column itself.','pixgridder'); ?>"><?php _e('more info','pixgridder'); ?></a>)</small>:</label>
                        <input type="text" value="<?php echo stripslashes(esc_html(get_option('pixgridder_column_close'))); ?>" name="pixgridder_column_close" id="pixgridder_column_close">
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