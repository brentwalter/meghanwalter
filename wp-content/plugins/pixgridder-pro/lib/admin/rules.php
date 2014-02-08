<?php
	global $options;

    if (isset($_GET['page']) && $_GET['page']=='pixgridder_rules') {
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Options','pixgridder'); ?>: <small><?php _e('Add rules','pixgridder'); ?></small></h3>

            <?php if (get_option('pixgridder_allow_ajax')=='true') { ?>
            <form action="/" class="dynamic_form ajax_form cf">
            <?php } else { ?>
            <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=pixgridder_admin"); ?>">
            <?php } ?>
            
                <?php
                    $pixgridder_array_rules_ = get_option('pixgridder_array_rules_'); 
                    echo '<input type="hidden" name="pixgridder_array_rules_" value="">';
                ?>

                <div class="pix_columns cf">

                        <h4><?php _e('Your custom rules:', 'pixgridder'); ?></h4>

                        <div class="pix-sorting">

                            <div class="pix-sorting-elem hidden clone">
                                <div class="edit-element"><i class="pixgridder-icon-pencil-1"></i></div><!-- .edit-element -->
                                <div class="middle-element"></div><!-- .middle-element -->
                                <div class="delete-element"><i class="pixgridder-icon-trash-1"></i></div><!-- .delete-element -->

                                <div class="element-content">
                                    <dl>
                                        <dt><?php _e('Post type','pixgridder'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="post_type" data-clone="pixgridder_array_rules_[i][post_type]"></dd>

                                        <dt><?php _e('Post meta name','pixgridder'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="meta_name" data-clone="pixgridder_array_rules_[i][meta_name]"></dd>

                                        <dt><?php _e('Post meta value','pixgridder'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="meta_value" data-clone="pixgridder_array_rules_[i][meta_value]"></dd>
    
                                        <dt><?php _e('Enabled','pixgridder'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="enabled" data-clone="pixgridder_array_rules_[i][enabled]"></dd>
    
                                        <input type="hidden" data-name="start_row" value="default" data-clone="pixgridder_array_rules_[i][start_row]">
                                        <input type="hidden" data-name="end_row" value="default" data-clone="pixgridder_array_rules_[i][end_row]">
                                        <input type="hidden" data-name="start_column" value="default" data-clone="pixgridder_array_rules_[i][start_column]">
                                        <input type="hidden" data-name="end_column" value="default" data-clone="pixgridder_array_rules_[i][end_column]">
                                        <input type="hidden" data-name="min" value="default" data-clone="pixgridder_array_rules_[i][min]">
                                        <input type="hidden" data-name="max" value="default" data-clone="pixgridder_array_rules_[i][max]">
                                        <input type="hidden" data-name="exclude" value="default" data-clone="pixgridder_array_rules_[i][exclude]">

                                    </dl>
                                </div><!-- .element-content -->
                            </div><!-- .pix-sorting-elem -->


                        <?php 

                            $i = 0;
                            if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
                                while($i<count($pixgridder_array_rules_)) {
                        ?>

                            <div class="pix-sorting-elem">
                                <div class="edit-element"><i class="pixgridder-icon-pencil-1"></i></div><!-- .edit-element -->
                                <div class="middle-element"></div><!-- .middle-element -->
                                <div class="delete-element"><i class="pixgridder-icon-trash-1"></i></div><!-- .delete-element -->

                                <div class="element-content">
                                    <dl>
                                        <dt><?php _e('Post type','pixgridder'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="post_type" name="pixgridder_array_rules_[<?php echo $i; ?>][post_type]" value="<?php if(isset($pixgridder_array_rules_[$i]['post_type'])) { echo esc_attr($pixgridder_array_rules_[$i]['post_type']); } ?>"></dd>
                                        <dt><?php _e('Post meta name','pixgridder'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="meta_name" name="pixgridder_array_rules_[<?php echo $i; ?>][meta_name]" value="<?php if(isset($pixgridder_array_rules_[$i]['meta_name'])) { echo esc_attr($pixgridder_array_rules_[$i]['meta_name']); } ?>"></dd>
                                        <dt><?php _e('Post meta value','pixgridder'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="meta_value" name="pixgridder_array_rules_[<?php echo $i; ?>][meta_value]" value="<?php if(isset($pixgridder_array_rules_[$i]['meta_value'])) { echo esc_attr($pixgridder_array_rules_[$i]['meta_value']); } ?>"></dd>
                                        <dt><?php _e('Enabled','pixgridder'); ?>:</dt>
                                            <dd><input type="text" readOnly="true" data-name="enabled" name="pixgridder_array_rules_[<?php echo $i; ?>][enabled]" value="<?php if(isset($pixgridder_array_rules_[$i]['enabled'])) { echo esc_attr($pixgridder_array_rules_[$i]['enabled']); } ?>"></dd>

                                        <input type="hidden" data-name="start_row" name="pixgridder_array_rules_[<?php echo $i; ?>][start_row]" value="<?php if(isset($pixgridder_array_rules_[$i]['start_row'])) { echo esc_attr($pixgridder_array_rules_[$i]['start_row']); } ?>">
                                        <input type="hidden" data-name="end_row" name="pixgridder_array_rules_[<?php echo $i; ?>][end_row]" value="<?php if(isset($pixgridder_array_rules_[$i]['end_row'])) { echo esc_attr($pixgridder_array_rules_[$i]['end_row']); } ?>">
                                        <input type="hidden" data-name="start_column" name="pixgridder_array_rules_[<?php echo $i; ?>][start_column]" value="<?php if(isset($pixgridder_array_rules_[$i]['start_column'])) { echo esc_attr($pixgridder_array_rules_[$i]['start_column']); } ?>">
                                        <input type="hidden" data-name="end_column" name="pixgridder_array_rules_[<?php echo $i; ?>][end_column]" value="<?php if(isset($pixgridder_array_rules_[$i]['end_column'])) { echo esc_attr($pixgridder_array_rules_[$i]['end_column']); } ?>">
                                        <input type="hidden" data-name="min" name="pixgridder_array_rules_[<?php echo $i; ?>][min]" value="<?php if(isset($pixgridder_array_rules_[$i]['min'])) { echo esc_attr($pixgridder_array_rules_[$i]['min']); } ?>">
                                        <input type="hidden" data-name="max" name="pixgridder_array_rules_[<?php echo $i; ?>][max]" value="<?php if(isset($pixgridder_array_rules_[$i]['max'])) { echo esc_attr($pixgridder_array_rules_[$i]['max']); } ?>">
                                        <input type="hidden" data-name="exclude" name="pixgridder_array_rules_[<?php echo $i; ?>][exclude]" value="<?php if(isset($pixgridder_array_rules_[$i]['exclude'])) { echo esc_attr($pixgridder_array_rules_[$i]['exclude']); } ?>">

                                    </dl>
                                </div><!-- .element-content -->

                            </div><!-- .pix-sorting-elem -->

                        <?php
                                    $i++;
                                } 
                            }
                        ?>

                            <a href="#" class="pix_button add-element"><?php _e('Add a new rule','pixgridder'); ?></a>
                        </div><!-- .pix-sorting -->

                </div><!-- .pix_columns -->

                <div class="clear"></div>

                <input type="hidden" name="action" value="pixgridder_data_save" />
                <input type="hidden" name="pixgridder_security" value="<?php echo wp_create_nonce('pixgridder_data'); ?>" />
                <button type="submit" class="pix-save-options pix_button fake_button alignright"><?php _e('Save options','pixgridder'); ?><i class="pixgridder-icon-ok-4"></i></button>
                <button type="submit" class="pix-save-options pix_button fake_button2 alignright"><?php _e('Save options','pixgridder'); ?><i class="pixgridder-icon-ok-4"></i></button>
                <button type="submit" class="pix-save-options pix_button alignright"><?php _e('Save options','pixgridder'); ?><i class="pixgridder-icon-ok-4"></i></button>
                <div id="gradient-save-button"></div>

<!-- #START: Hidden div to fill the icon fields -->

                <div class="dialog-edit-sorting-elements hidden" data-title="<?php _e('Edit','pixgridder'); ?>" data-width="480">
                    <label class="for_select" for="post-type-hide"><?php _e('Post type','pixgridder'); ?>:
                        <span class="for_select">
                            <select data-name="post_type" id="post-type-hide">
                                <?php 
                                    $post_types = get_post_types(array( 'public' => true ));   

                                    foreach ( $post_types as $post_type ) {
                                        if ( post_type_supports( $post_type, 'editor' ) ) {
                                            $object = get_post_type_object($post_type);
                                            $label = $object->label;
                                            $name = $object->name; ?>
                                            <option value="<?php echo $name; ?>"><?php echo $label; ?></option>
                                        <?php }
                                    }
                                ?>
                            </select>
                        </span>
                    </label>
                    <br>

                    <label for="meta-name-hide"><?php _e('Post meta name','pixgridder'); ?>:</label>
                    <input id="meta-name-hide" type="text" value="" data-name="meta_name" >

                    <label for="meta-value-hide"><?php _e('Post meta value','pixgridder'); ?>:</label>
                    <input id="meta-value-hide" type="text" value="" data-name="meta_value" >

                    <label class="for_select" for="enabled-hide"><?php _e('Enabled the grid builder in this case','pixgridder'); ?>:
                        <span class="for_select">
                            <select data-name="enabled" id="enabled-hide">
                                <option value="enabled">enabled</option>
                                <option value="disabled">disabled</option>
                            </select>
                        </span>
                    </label>
                    <br>


                    <label for="start-row-hide"><?php printf( __( 'Replace %s with <small>(start of rows)</small>', 'pixgridder' ), '<code>&lt;!--pixgridder:row[cols=$1]--&gt;</code>' ); ?>:</label>
                    <input id="start-row-hide" type="text" value="" data-name="start_row" >

                    <label for="end-row-hide"><?php printf( __( 'Replace %s with <small>(end of rows)</small>', 'pixgridder' ), '<code>&lt;!--/pixgridder:row[cols=$1]--&gt;</code>' ); ?>:</label>
                    <input id="end-row-hide" type="text" value="" data-name="end_row" >

                    <label for="start-col-hide"><?php printf( __( 'Replace %s with <small>(start of columns)</small>', 'pixgridder' ), '<code>&lt;!--pixgridder:column[col=$1]--&gt;</code>' ); ?>:</label>
                    <input id="start-col-hide" type="text" value="" data-name="start_column" >

                    <label for="end-col-hide"><?php printf( __( 'Replace %s with <small>(end of columns)</small>', 'pixgridder' ), '<code>&lt;!--/pixgridder:column[col=$1]--&gt;</code>' ); ?>:</label>
                    <input id="end-col-hide" type="text" value="" data-name="end_column">

                    <label for="min-col-hide"><?php _e( 'Set a minimum of columns', 'pixgridder' ); ?>:</label>
                    <input id="min-col-hide" type="text" value="" data-name="min">

                    <label for="max-col-hide"><?php _e( 'Set a maximum of columns', 'pixgridder' ); ?>:</label>
                    <input id="max-col-hide" type="text" value="" data-name="max">

                    <label for="exclude-hide"><?php _e('Exclude some numbers from the range <small>(use commas to separate values)</small>','pixgridder'); ?>:</label>
                    <input id="exclude-hide" type="text" value="" data-name="exclude" >

               </div><!-- .dialog-edit-sorting-elements -->

<!-- #END: Hidden div to fill the icon fields -->

            </form><!-- .dynamic_form -->

        </section><!-- #pix_content_loaded -->
<?php 
	}