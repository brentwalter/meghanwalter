<?php

    global $post;

    $plugin = get_plugin_data(PIXGRIDDER_PATH.'pixgridder.php');

    $typenow = get_post_type();

    $pixgridder_array_rules_ = get_option('pixgridder_array_rules_'); 

    $i = 0;

    $min = get_option('pixgridder_min_cols');
    $max = get_option('pixgridder_max_cols');
    $exclude = get_option('pixgridder_exclude_cols');

    if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
        while($i<count($pixgridder_array_rules_)) {
            $post_type = $pixgridder_array_rules_[$i]['post_type'];
            $meta_name = $pixgridder_array_rules_[$i]['meta_name'];
            $meta_value = $pixgridder_array_rules_[$i]['meta_value'];
            $hide_min = $pixgridder_array_rules_[$i]['min'];
            $hide_max = $pixgridder_array_rules_[$i]['max'];
            $hide_exclude = $pixgridder_array_rules_[$i]['exclude'];
            if ( $typenow == $post_type && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name == '') && $hide_min != '' && $hide_min != 'default' ) {
                $min = $hide_min;
            }
            if ( $typenow == $post_type && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name == '') && $hide_max != '' && $hide_max != 'default' ) {
                $max = $hide_max;
            }
            if ( $typenow == $post_type && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name == '') && $hide_exclude != '' && $hide_exclude != 'default' ) {
                $exclude = $hide_exclude;
            }
            $i++;
        }
    }

    if ( 'publish' == $post->post_status ) {
        $preview_link = esc_url( get_permalink( $post->ID ) );
    } else {
        $preview_link = set_url_scheme( get_permalink( $post->ID ) );
        $preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
    }

?>
<div class="wp-editor-container" id="pix-builder-editor-container">

    <div class="pix_builder_header">
        PixGridder Pro <?php echo $plugin['Version']; ?>
    </div><!-- #pix_builder_header -->
            
    <div id="pix_builder_preview" style="height:<?php echo get_option('pixgridder_height_preview'); ?>px">
        <iframe src="" data-src="<?php echo $preview_link; ?>" onload="pix_loaded_iframe()" id="pix-builder-iframe" name="iframe-preview" width="100%" height="400"></iframe>
        <div id="pix_loader_iframe">
            <div id="pix_loader_wrap">
                <div id="pix_loader_gear_1"></div>
                <div id="pix_loader_gear_2"></div>
                <div id="pix_loader_gear_3"></div>
            </div>
        </div>
        <div id="pix_builder_preview_resizer"><span class="pix_canvas_handle"></span></div>
    </div><!-- #pix_builder_preview -->

	<div id="pix_builder_canvas">
            
        <!-- pix_section_builder CLONE -- START -->
        <div class="pix_section_builder pix_section_builder_movable pix_clone_section" data-cols="<?php echo $min; ?>">
            <div class="pix_section_header">
                <div class="pix_section_mover">
                    <i class="pixgridder-icon-move-3"></i>
                </div><!-- .pix_section_mover -->
                <div class="pix_section_error">
                    <i class="pixgridder-icon-attention-2"></i>
                </div><!-- .pix_section_error -->
                <div class="pix_section_id">
                    <i class="pixgridder-icon-code-1"></i>
                </div><!-- .pix_section_id -->
                <div class="pix_section_clone">
                    <i class="pixgridder-icon-docs"></i>
                </div><!-- .pix_section_clone -->
            </div><!-- .pix_section_header -->
            <div class="pix_section_body">
                <div class="pix_section_body_wrap">
                    <?php for ($i = 1; $i <= $max; $i++) { ?>
                        <div class="pix_builder_column" data-col="1"></div>
                    <?php } ?>

                    <!-- pix_builder_column CLONE -- START -->
                    <div class="pix_builder_column pix_column_active pix_clone_column" data-col="1">
                        <div class="pix_builder_content">
                        </div><!-- .pix_builder_content -->
                        <div class="pix_builder_prevent">
                        </div><!-- .pix_builder_prevent -->
                        <div class="pix_column_gradient"></div>
                        <div class="pix_column_mover pix-ui">
                            <i class="pixgridder-icon-move-3"></i>
                        </div><!-- .pix_column_mover -->
                        <div class="pix_column_edit pix-ui">
                            <i class="pixgridder-icon-pencil-2"></i>
                        </div><!-- .pix_column_edit -->
                        <div class="pix_column_clone pix-ui">
                            <i class="pixgridder-icon-docs"></i>
                        </div><!-- .pix_column_clone -->
                        <div class="pix_column_id pix-ui">
                            <i class="pixgridder-icon-code-1"></i>
                        </div><!-- .pix_column_id -->

                        <div class="pix_column_increase pix-ui">
                            <i class="pixgridder-icon-plus-1"></i>
                        </div><!-- .pix_column_increase -->
                        <div class="pix_column_reduce pix-ui">
                            <i class="pixgridder-icon-minus-1"></i>
                        </div><!-- .pix_column_reduce -->
                        <div class="pix_column_delete pix-ui">
                            <i class="pixgridder-icon-trash-1"></i>
                        </div><!-- .pix_column_delete -->
                        <textarea></textarea>
                    </div>
                    <!-- pix_builder_column CLONE -- END -->

                </div><!-- .pix_section_body_wrap -->
            </div><!-- .pix_section_body -->
            <div class="pix_section_footer">
                <label class="for_select">
                    <span class="for_select">
                        <select class="pix_section_template">
                            <?php $exclude = explode(",", $exclude);
                            for ($i = $min; $i <= $max; $i++) {
                                if ( !is_array($exclude) || empty($exclude) || !in_array($i, $exclude)) {
                                    if ($i == 1) { ?>
                                <option value="<?php echo $i; ?>"><?php printf( __( '%s column', 'pixgridder' ), $i ); ?></option>
                                    <?php } else { ?>
                                <option value="<?php echo $i; ?>"><?php printf( __( '%s columns', 'pixgridder' ), $i ); ?></option>
                                <?php }
                                }
                            } ?>
                        </select><!-- select.pix_section_template -->
                    </span><!-- span.for_select -->
                </label><!-- label.for_select -->
                <div class="pix_section_delete">
                    <i class="pixgridder-icon-trash-1"></i>
                </div><!-- .pix_section_delete -->
            </div><!-- .pix_section_footer -->
            <textarea class="pix_section_txt"></textarea>
        </div><!-- .pix_section_builder -->
        <!-- pix_section_builder CLONE -- END -->
            
        <div class="pix_section_builder">
            <div class="pix_section_header pix_last_section">
                <div class="pix_add_section">
                    <i class="pixgridder-icon-plus-1"></i>
                </div><!-- .pix_add_section -->
            </div><!-- .pix_section_header -->
        </div>
    </div><!-- .pix_section_builder -->
            
</div><!-- #pix-builder-editor-container -->


<div id="textarea_builder" style="width:80%;">
    <?php wp_editor( '','textArea'); ?> 
</div>

<div id="pix_builder_row_fields" data-title="<?php _e('Add some values','pixgridder'); ?>"<?php apply_filters( 'row_extra_height', '' ); ?>>
    <label><?php _e('ID','pixgridder'); ?>:</label>
    <input data-use="id" value="" placeholder="<?php _e('Set a CSS ID','pixgridder'); ?>">
    <label><?php _e('Class','pixgridder'); ?>:</label>
    <input data-use="class" value="" placeholder="<?php _e('Set a CSS class','pixgridder'); ?>">
    <?php apply_filters( 'row_extra_fields', '' ); ?>
</div>

<div id="pix_builder_column_fields" data-title="<?php _e('Add some values','pixgridder'); ?>"<?php apply_filters( 'column_extra_fields', '' ); ?>>
    <label><?php _e('ID','pixgridder'); ?>:</label>
    <input data-use="id" value="" placeholder="<?php _e('Set a CSS ID','pixgridder'); ?>">
    <label><?php _e('Class','pixgridder'); ?>:</label>
    <input data-use="class" value="" placeholder="<?php _e('Set a CSS class','pixgridder'); ?>">
    <label><?php _e( 'Select an effect', 'pixgridder' ); ?>:</label>
    <label class="for_select hidden">
        <span class="for_select">
            <select data-use="fx">
                <option value="" selected="selected">none</option>
                <option value="pix-fadeIn">pix-fadeIn</option>
                <option value="pix-fadeDown">pix-fadeDown</option>
                <option value="pix-fadeUp">pix-fadeUp</option>
                <option value="pix-fadeLeft">pix-fadeLeft</option>
                <option value="pix-fadeRight">pix-fadeRight</option>
                <option value="pix-zoomIn">pix-zoomIn</option>
                <option value="pix-zoomOut">pix-zoomOut</option>
                <option value="pix-rotateIn">pix-rotateIn</option>
                <option value="pix-rotateOut">pix-rotateOut</option>
                <option value="pix-flipClock">pix-flipClock</option>
                <option value="pix-swing">pix-swing</option>
                <option value="pix-turnForward">pix-turnForward</option>
                <option value="pix-turnBackward">pix-turnBackward</option>
            </select>
        </span>
    </label>
</div>

<div id="pix_builder_yard"></div>

<div id="pix_builder_cant"></div>

<script>
var pix_builder_modal = 'close';
</script>