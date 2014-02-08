<?php

class PixGridder{

	/**
	 * @since   2.3.0
	 *
	 * @var     string
	 */
	protected $version = '2.3.0';

	/**
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'pixgridder';

	/**
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_name = 'PixGridder Pro';

	/**
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * @since    2.3.0
	 */
	public function __construct() {
		add_action( 'init', array( &$this, 'load_plugin_textdomain' ) );
		add_action( 'wp_head', array( &$this, 'filter_content' ) );
		add_action( 'admin_menu', array( &$this, 'add_menu' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );
		add_action( 'add_meta_boxes', array( &$this, 'add_meta' ) );
		add_action( 'save_post', array( &$this, 'content_save' ) );
		add_action( 'save_post', array( &$this, 'disable_save' ) );
		add_action( 'wp_ajax_pixgridder_height_preview', array( &$this, 'save_height_preview' ) );
		add_action( 'wp_ajax_pixgridder_data_save', array( &$this, 'save_via_ajax' ) );
		add_action( 'wp_ajax_css_pixgridder_ajax', array( &$this, 'compile_css_ajax' ) );
		add_action( 'admin_head', array( &$this, 'remove_subpages' ) );
		add_action( 'admin_head', array( &$this, 'js_vars' ) );
		add_action( 'admin_head', array( &$this, 'add_tinyMCE' ) );
		add_filter( 'mce_css', array( &$this, 'add_tinymce_css' ) );
		add_action( 'admin_head', array( &$this, 'default_editor' ) );
		add_filter( 'admin_body_class', array( &$this, 'admin_class_by_editor' ) );

		add_action( 'wp_enqueue_scripts', array( &$this, 'front_styles' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'front_scripts' ) );
		add_action( 'wp_footer', array( &$this, 'fx_vars' ) );
		add_filter( 'body_class', array( &$this, 'body_class' ) );
		add_filter( 'the_content', array( &$this, 'filter_content' ), 10 );
		add_filter( 'the_content', array( &$this, 'filter_content' ), 100 );
		add_filter( 'pre_set_site_transient_update_plugins', array( &$this, 'check_for_plugin_update' ));
		add_filter( 'plugins_api', array( &$this, 'plugin_api_call' ), 10, 3);

    }

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		self::add_general();
	}

	/**
	 * Fired when the plugin is uninstall.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function uninstall( $network_wide ) {

        global $wpdb;
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '%pixgridder_%'");

        $results = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_content LIKE '%pixgridder%' AND post_name NOT LIKE '%autosave%' AND post_name NOT LIKE '%revision%'");
        foreach ( $results as $result ) 
        {
            $id = $result->ID;
            $content = $result->post_content;
            $content = preg_replace('/<!--pixgridder(.+?)-->/', '', $content);
            $content = preg_replace('/<!--\/pixgridder(.+?)-->/', '', $content);
            $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = %s WHERE ID = $id", $content ) );
        }
	}

	/**
	 * Load text domain for translation.
	 *
	 * @since    1.1.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

	/**
	 * Load tinyMCE custom functions.
	 *
	 * @since    1.0.0
	 */
	public function add_tinyMCE() {
		global $post, $pagenow;

		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			$typenow = get_post_type();
			$templatenow = get_post_meta($post->ID,'_wp_page_template', true) == '' ? 'default' : get_post_meta($post->ID,'_wp_page_template', true);
			$editor = get_post_meta( $post->ID, 'pixBuilderDisable', true );
			$post_types_selected = get_option( 'pixgridder_post_type' ) != '' ? get_option( 'pixgridder_post_type' ) : array();
			$page_template = get_option( 'pixgridder_page_template' ) != '' ? get_option( 'pixgridder_page_template' ) : array();

			$pixgridder_array_rules_ = get_option('pixgridder_array_rules_'); 

		    if ( ($typenow != 'page' && in_array($typenow,$post_types_selected)) || ($typenow == 'page' && (in_array($templatenow,$page_template) || empty($page_template))) ) {
		        $display = true;
	        } else {
		        $display = false;        	
	        }	    	
	        $i = 0;

	        if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
	            while($i<count($pixgridder_array_rules_)) {
	           	 	$post_type = $pixgridder_array_rules_[$i]['post_type'];
	            	$meta_name = $pixgridder_array_rules_[$i]['meta_name'];
	            	$meta_value = $pixgridder_array_rules_[$i]['meta_value'];
	            	$enabled = $pixgridder_array_rules_[$i]['enabled'];
	            	if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
				        $display = true;
	            	} elseif  ( $typenow == $post_type && $enabled == 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
				        $display = false;
	            	}
	            	$i++;
	            }
	        }

	        if ( $editor == 'on' ) {
	        	$display = false;
	        }
			
			if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
				return;
			if ( get_user_option('rich_editing') == 'true' && ( $display == true ) ) {
				add_filter('mce_external_plugins', 'add_pixgridder_js' );
			}

			function add_pixgridder_js($plugin_array) {
				$plugin_array['pixgridder'] = PIXGRIDDER_URL.'scripts/pixgridder_tinyMCE.js';
				return $plugin_array;
			}		

			function tinymce_settings($settings) {
				//$settings['extended_valid_elements'] = "span[!class]";
			    $settings['theme_advanced_resizing'] = false;
			    return $settings;
			}
			add_filter('tiny_mce_before_init','tinymce_settings');
		}
	}

	/**
	 * Register and enqueue front-end scripts.
	 *
	 * @since    1.0.0
	 */
	public function front_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-modernizr', PIXGRIDDER_URL.'scripts/modernizr.pix.js', array(), '2.6.2' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->plugin_slug . '-fx', PIXGRIDDER_URL.'scripts/fx.js', array($this->plugin_slug.'-modernizr','jquery'));
	}

	/**
	 * Register and enqueue front-end style sheets.
	 *
	 * @since    1.0.0
	 */
	public function front_styles() {
		$theme_style = get_stylesheet_directory().'/gridder.css';
		if (file_exists($theme_style)) {
			wp_enqueue_style( $this->plugin_slug, get_stylesheet_directory_uri().'/gridder.css', array(), $this->version );
		} else {
			wp_enqueue_style( $this->plugin_slug, PIXGRIDDER_URL.'css/front-gridder.css', array(), $this->version );
		}
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since    1.0.0
	 */
	public function admin_styles() {
		global $pagenow;
		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			wp_enqueue_style( $this->plugin_slug .'-fontello', PIXGRIDDER_URL.'css/fontello.css', array(), $this->version );
			wp_enqueue_style( $this->plugin_slug .'-open-sans', PIXGRIDDER_URL.'css/open_sans.css', array(), $this->version );
			wp_enqueue_style( $this->plugin_slug, PIXGRIDDER_URL.'css/gridder.css', array(), $this->version );
		} else if ('admin.php' == $pagenow && isset($_GET['page']) && $_GET['page']=='pixgridder_admin') {
			wp_enqueue_style ( 'wp-jquery-ui-dialog' );
			wp_enqueue_style( $this->plugin_slug .'-codemirror', PIXGRIDDER_URL.'css/codemirror.css', array(), $this->version );
			wp_enqueue_style( $this->plugin_slug .'-codemirror-skin', PIXGRIDDER_URL.'css/codemirror-skin.css', array(), $this->version );
			wp_enqueue_style( $this->plugin_slug .'-fontello', PIXGRIDDER_URL.'css/fontello.css', array(), $this->version );
			wp_enqueue_style( $this->plugin_slug .'-open-sans', PIXGRIDDER_URL.'css/open_sans.css', array(), $this->version );
			wp_enqueue_style( $this->plugin_slug .'-admin', PIXGRIDDER_URL.'css/admin.css', array(), $this->version );
		}
	}

	/**
	 * Register and enqueue admin-specific scripts.
	 *
	 * @since    1.0.0
	 */
	public function admin_scripts() {
		global $pagenow;
		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			wp_enqueue_script( $this->plugin_slug . '-modernizr', PIXGRIDDER_URL.'scripts/modernizr.pix.js', array(), '2.6.2' );
			wp_enqueue_script( $this->plugin_slug . '-ui-touch-punch', PIXGRIDDER_URL.'scripts/jquery.ui.touch-punch.min.js', array('jquery-ui-mouse'), '0.2.2', false );
			wp_enqueue_script( $this->plugin_slug . '-livequery', PIXGRIDDER_URL.'scripts/jquery.livequery.js', array('jquery'), '1.1.1', false );
			wp_enqueue_script( $this->plugin_slug, PIXGRIDDER_URL.'scripts/gridder.js', array($this->plugin_slug.'-modernizr','jquery','jquery-ui-core',$this->plugin_slug.'-ui-touch-punch','jquery-ui-sortable',$this->plugin_slug.'-livequery','jquery-ui-resizable','jquery-ui-dialog') );
		} else if ('admin.php' == $pagenow && isset($_GET['page']) && $_GET['page']=='pixgridder_admin') {
			wp_enqueue_script( $this->plugin_slug . '-modernizr', PIXGRIDDER_URL.'scripts/modernizr.pix.js', array(), '2.6.2' );
			wp_enqueue_script( $this->plugin_slug . '-ui-touch-punch', PIXGRIDDER_URL.'scripts/jquery.ui.touch-punch.min.js', array('jquery-ui-mouse'), '0.2.2', false );
			wp_enqueue_script( $this->plugin_slug . '-ui-slider', PIXGRIDDER_URL.'scripts/jquery.ui.slider.js', array('jquery-ui-core','jquery-ui-mouse','jquery-ui-widget') );
			wp_enqueue_script( $this->plugin_slug . '-codemirror', PIXGRIDDER_URL.'scripts/codemirror.js', array('jquery'), '3.14', false );
			wp_enqueue_script( $this->plugin_slug . '-css-mode', PIXGRIDDER_URL.'scripts/css.js', array($this->plugin_slug.'-codemirror'), '3.14', false );
			wp_enqueue_script( $this->plugin_slug . '-livequery', PIXGRIDDER_URL.'scripts/jquery.livequery.js', array('jquery'), '1.1.1', false );
			wp_enqueue_script( $this->plugin_slug . '-easing', PIXGRIDDER_URL.'scripts/jquery.easing.min.js', array('jquery'), '1.3', false );
			wp_enqueue_script( $this->plugin_slug . '-admin', PIXGRIDDER_URL.'scripts/admin.js', array($this->plugin_slug.'-modernizr','jquery','jquery-ui-core',$this->plugin_slug.'-ui-touch-punch','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable',$this->plugin_slug.'-ui-slider',$this->plugin_slug.'-css-mode',$this->plugin_slug.'-livequery',$this->plugin_slug.'-easing','jquery-ui-dialog'));
		}
	}

	/**
	 * Set the defalt tinyMCE editor.
	 *
	 * @since    1.0.0
	 */
	public function default_editor() {
		global $post, $pagenow;

		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			$typenow = get_post_type();
			$templatenow = get_post_meta($post->ID,'_wp_page_template', true) == '' ? 'default' : get_post_meta($post->ID,'_wp_page_template', true);
			$editor = get_post_meta( $post->ID, 'pixBuilderDisable', true );
			$post_types_selected = get_option( 'pixgridder_post_type' ) != '' ? get_option( 'pixgridder_post_type' ) : array();
			$page_template = get_option( 'pixgridder_page_template' ) != '' ? get_option( 'pixgridder_page_template' ) : array();

			$pixgridder_array_rules_ = get_option('pixgridder_array_rules_'); 

		    if ( ($typenow != 'page' && in_array($typenow,$post_types_selected)) || ($typenow == 'page' && (in_array($templatenow,$page_template) || empty($page_template))) ) {
		        $display = true;
	        } else {
		        $display = false;        	
	        }	    	
	        $i = 0;

	        if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
	            while($i<count($pixgridder_array_rules_)) {
	           	 	$post_type = $pixgridder_array_rules_[$i]['post_type'];
	            	$meta_name = $pixgridder_array_rules_[$i]['meta_name'];
	            	$meta_value = $pixgridder_array_rules_[$i]['meta_value'];
	            	$enabled = $pixgridder_array_rules_[$i]['enabled'];
	            	if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
				        $display = true;
	            	} elseif  ( $typenow == $post_type && $enabled == 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
				        $display = false;
	            	}
	            	$i++;
	            }
	        }
			
	        if ( $editor == 'on' ) {
	        	$display = false;
	        }

			if ( $display == true ) {
				add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
			}
		}
	}


	/**
	 * Add the class "pixgridder" to the front-end body
	 *
	 * @since    1.0.0
	 */
	public function body_class($classes) {
		$classes[] = 'pixgridder';
		if ( get_option('pixgridder_fx')!='none' && get_option('pixgridder_fx')!='' ) {
			$classes[] = 'pix-scroll-load';
		}
		if ( get_option('pixgridder_fx')=='available' ) {
			$classes[] = 'available';
		}
		return $classes;
	}


	/**
	 * Change the admin body class if the grid builder is activated for that particular post/page.
	 *
	 * @since    1.1.0
	 *
	 */
	public function admin_class_by_editor($classes) {
		global $pagenow, $post;

		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {

			$typenow = get_post_type();
			$templatenow = get_post_meta($post->ID,'_wp_page_template', true) == '' ? 'default' : get_post_meta($post->ID,'_wp_page_template', true);
			$editor = get_post_meta( $post->ID, 'pixBuilderDisable', true );
			$post_types_selected = get_option( 'pixgridder_post_type' );
			$page_template = get_option( 'pixgridder_page_template' );

			$pixgridder_array_rules_ = get_option('pixgridder_array_rules_'); 

		    if ( ($typenow != 'page' && in_array($typenow,$post_types_selected)) || ($typenow == 'page' && (empty($page_template) || in_array($templatenow,$page_template))) ) {
		        $display = true;
	        } else {
		        $display = false;        	
	        }	    	
	        $i = 0;

	        if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
	            while($i<count($pixgridder_array_rules_)) {
	           	 	$post_type = $pixgridder_array_rules_[$i]['post_type'];
	            	$meta_name = $pixgridder_array_rules_[$i]['meta_name'];
	            	$meta_value = $pixgridder_array_rules_[$i]['meta_value'];
	            	$enabled = $pixgridder_array_rules_[$i]['enabled'];
	            	if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
				        $display = true;
	            	} elseif  ( $typenow == $post_type && $enabled == 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
				        $display = false;
	            	}
	            	$i++;
	            }
	        }
			
	        if ( $editor == 'on' ) {
	        	$display = false;
	        }

			if ( $display==true ) {
				$classes .= ' pix_body_builder';
			}

			return $classes;
		}
	}

	/**
	 * Add the metaboxes: the grid builder and its tabs to switch between builder and preview.
	 *
	 * @since    1.0.0
	 */
	public function add_meta() {
		global $post;

		$typenow = get_post_type();
		$templatenow = get_post_meta($post->ID,'_wp_page_template', true) == '' ? 'default' : get_post_meta($post->ID,'_wp_page_template', true);
		$editor = get_post_meta( $post->ID, 'pixBuilderDisable', true );
		$post_types_selected = get_option( 'pixgridder_post_type' ) != '' ? get_option( 'pixgridder_post_type' ) : array();
		$page_template = get_option( 'pixgridder_page_template' ) != '' ? get_option( 'pixgridder_page_template' ) : array();

		$pixgridder_array_rules_ = get_option('pixgridder_array_rules_'); 

	    if ( ($typenow != 'page' && in_array($typenow,$post_types_selected)) || ($typenow == 'page' && (in_array($templatenow,$page_template) || empty($page_template))) ) {
	        $display = true;
        } else {
	        $display = false;        	
        }	    	
        $i = 0;

        if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
            while($i<count($pixgridder_array_rules_)) {
           	 	$post_type = $pixgridder_array_rules_[$i]['post_type'];
            	$meta_name = $pixgridder_array_rules_[$i]['meta_name'];
            	$meta_value = $pixgridder_array_rules_[$i]['meta_value'];
            	$enabled = $pixgridder_array_rules_[$i]['enabled'];
            	if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
			        $display = true;
            	} elseif  ( $typenow == $post_type && $enabled == 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
			        $display = false;
            	}
            	$i++;
            }
        }

	    $post_types = get_post_types();
	    foreach ( $post_types as $post_type ) {
			if ( $display == true ) {
				add_meta_box( 'pixgridder_disable', 'PixGridder options', 'pixgridder_disable', $post_type, 'normal', 'high' );
			}
	    }

        if ( $editor == 'on' ) {
        	$display = false;
        }

	    $post_types = get_post_types();
	    foreach ( $post_types as $post_type ) {
			if ( $display == true ) {
		        add_meta_box( 'pixgridder_builder', 'PixGridder', 'pixgridder_builder', $post_type, 'normal', 'low' );
		        add_meta_box( 'pixgridder_content', 'PixGridder Content', 'pixgridder_content', $post_type, 'normal' );
			}
	    }

		function pixgridder_content( $post, $display ) {
		    $values = get_post_custom( $post->ID );
		    $pixgridder_content = isset( $values['pixgridder_content'] ) ? esc_attr( $values['pixgridder_content'][0] ) : '';
		    wp_nonce_field( 'pixgridder_content_nonce', 'pixgridder_content_nonce' );
		    ?>
		    <div class="pix_meta_boxes">
		        <p>
		            <label for="pixBuilderTxtArea"><?php _e('Content','pixgridder'); ?></label><br>
		            <div class="field_wrap"><textarea name="pixgridder_content" id="pixBuilderTxtArea" ><?php echo $pixgridder_content; ?></textarea></div>
		        </p>
		        <div class="clear"></div>
		        
		 
		    </div><!-- .pix_meta_boxes -->
		    <?php  
		}

		function pixgridder_builder( $post, $display ) {
		    require_once( PIXGRIDDER_PATH.'lib/pixgridder-builder.php' );
		}

		function pixgridder_disable( $post, $display ) {
		    $values = get_post_custom( $post->ID );
			$pixBuilderDisable = isset( $values['pixBuilderDisable'] ) ? esc_attr( $values['pixBuilderDisable'][0] ) : 'off';
			$pixBuilderRemove = isset( $values['pixBuilderRemove'] ) ? esc_attr( $values['pixBuilderRemove'][0] ) : 'off';
		    wp_nonce_field( 'pixgridder_disable_nonce', 'pixgridder_disable_nonce' );
		    ?>
		    <div class="pix_meta_boxes">
		        <p>
		            <label for="pixBuilderDisable"><?php _e('Disable the grid builder','pixgridder'); ?>
		            <input type="checkbox" name="pixBuilderDisable" id="pixBuilderDisable" <?php checked( $pixBuilderDisable, 'on' ); ?>></label>
		        </p>
		        <p>
		            <label for="pixBuilderRemove"><?php _e('Remove any trace of PixGridder from this page','pixgridder'); ?>
		            <input type="checkbox" name="pixBuilderRemove" id="pixBuilderRemove"></label>
		        </p>
		        <p>
		        	<small>Icons are from <a href="http://fontello.com/" target="_blank">Fontello.com</a> (licenses available there for all the sets)</small>
		        </p>
		    </div><!-- .pix_meta_boxes -->
		    <?php 
		}

	}

	/**
	 * Save the data sent thorugh metaboxes.
	 *
	 * @since    1.0.0
	 */
	public function content_save( $post_id ) {
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	    if( !isset( $_POST['pixgridder_content_nonce'] ) || !wp_verify_nonce( $_POST['pixgridder_content_nonce'], 'pixgridder_content_nonce' ) ) return;

	    if( !current_user_can( 'edit_post', $post_id ) ) return;
	    
	    if( isset( $_POST['pixgridder_content'] ) )
	        update_post_meta( $post_id, 'pixgridder_content', esc_attr( $_POST['pixgridder_content'] ) );
	        
	}
	public function disable_save( $post_id ) {
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	    if( !isset( $_POST['pixgridder_disable_nonce'] ) || !wp_verify_nonce( $_POST['pixgridder_disable_nonce'], 'pixgridder_disable_nonce' ) ) return;

	    if( !current_user_can( 'edit_post', $post_id ) ) return;
	    
		$chkedit = ( isset( $_POST['pixBuilderDisable'] ) && $_POST['pixBuilderDisable'] ) ? 'on' : 'off';
		update_post_meta( $post_id, 'pixBuilderDisable', $chkedit );
	    
		if ( isset( $_POST['pixBuilderRemove'] ) && $_POST['pixBuilderRemove'] ) {
	        global $wpdb;
	        $results = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE ID = $post_id");
	        foreach ( $results as $result ) {
	            $content = $result->post_content;
	            $content = preg_replace('/<!--pixgridder(.+?)-->/', '', $content);
	            $content = preg_replace('/<!--\/pixgridder(.+?)-->/', '', $content);
	            $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = %s WHERE ID = $post_id", $content ) );
	        }
		}
	}

	/**
	 * Save via AJAX the height of the preview wrap.
	 *
	 * @since    1.0.0
	 */
	public function save_height_preview() {
		update_option('pixgridder_height_preview',$_POST['height']);
		die();
	}

	/**
	 * Replace the html comments in the post content to create the grid
	 *
	 * @since    2.3.0
	 *
	 */
	public function filter_content($content) {

	    global $post, $active_gridder;

		$typenow = get_post_type();
		$templatenow = get_post_meta($post->ID,'_wp_page_template', true) == '' ? 'default' : get_post_meta($post->ID,'_wp_page_template', true);
		$editor = get_post_meta( $post->ID, 'pixBuilderDisable', true );
		$post_types_selected = get_option( 'pixgridder_post_type' );
		$page_template = get_option( 'pixgridder_page_template' );

		$pixgridder_array_rules_ = get_option('pixgridder_array_rules_'); 

	    if ( ($typenow != 'page' && in_array($typenow,$post_types_selected)) || ($typenow == 'page' && (empty($page_template) || in_array($templatenow,$page_template))) ) {
	        $display = true;
        } else {
	        $display = false;        	
        }

        $row_open = stripslashes(get_option('pixgridder_row_open'));
        $row_close = stripslashes(get_option('pixgridder_row_close'));
        $column_open = stripslashes(get_option('pixgridder_column_open'));
        $column_close = stripslashes(get_option('pixgridder_column_close'));

        $i = 0;

	    if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
	        while($i<count($pixgridder_array_rules_)) {
	            $post_type = $pixgridder_array_rules_[$i]['post_type'];
	            $meta_name = $pixgridder_array_rules_[$i]['meta_name'];
	            $meta_value = $pixgridder_array_rules_[$i]['meta_value'];
	            $enabled = $pixgridder_array_rules_[$i]['enabled'];
	            $start_row = stripslashes($pixgridder_array_rules_[$i]['start_row']);
	            $end_row = stripslashes($pixgridder_array_rules_[$i]['end_row']);
	            $start_column = stripslashes($pixgridder_array_rules_[$i]['start_column']);
	            $end_column = stripslashes($pixgridder_array_rules_[$i]['end_column']);
	            if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name == '') && $start_row != 'default' ) {
			        $display = true;
	                $row_open = $start_row;
	            }
	            if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name == '') && $end_row != 'default' ) {
			        $display = true;
	                $row_close = $end_row;
	            }
	            if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name == '') && $start_column != 'default' ) {
			        $display = true;
	                $column_open = $start_column;
	            }
	            if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name == '') && $end_column != 'default' ) {
			        $display = true;
	                $column_close = $end_column;
	            }
	            $i++;
	        }
	    }

	    if ( $display == true ) {

	    	$active_gridder = true;

			require_once( ABSPATH . WPINC . '/class-oembed.php' );
			$oembed = _wp_oembed_get_object();
			$providers = $oembed->providers;

			if ( !function_exists('pixgrider_match_oembed') ) {
				function pixgrider_match_oembed($matches) {
		        	$var = preg_replace('/<p>/', '', $matches[0]);
		        	$var = preg_replace('/<\/p>/', '', $var);
				    global $wp_embed;
		            return $wp_embed->autoembed($var);
		        }
		    }

			foreach ($providers as $key => $value) {
				if(substr($key,0,1) == '#') {
					$content = preg_replace_callback(
				        "$key",
				        'pixgrider_match_oembed',
				        $content
				    );
				}
			}

			$content = preg_replace('/data-id\[(.+?)\]/', 'id="$1"', $content);
			$content = preg_replace('/data-class\[(.+?)\]/', 'class="$1"', $content);
			$content = preg_replace('/<!--pixgridder:column\[(.?[^\]\s]+)\]--><!--\/pixgridder:column(.+?)-->/', '', $content);
			$content = preg_replace('/<!--pixgridder:row\[(.?[^\]\s]+)\]--><!--\/pixgridder:row(.+?)-->/', '', $content);
			$content = preg_replace('/<p><!--pixgridder:(.+?)-->(?!<!--)/', '<!--pixgridder:$1--><p>', $content);
			$content = preg_replace('/<p><!--\/pixgridder:(.+?)-->(?!<!--)/', '<!--/pixgridder:$1--><p>', $content);
			$content = preg_replace('/<p><!--pixgridder:(.+?)--><\/p>/', '<!--pixgridder:$1-->', $content);
			$content = preg_replace('/<p><!--\/pixgridder:(.+?)--><\/p>/', '<!--/pixgridder:$1-->', $content);
			$content = preg_replace('/<!--\/pixgridder:(.+?)--><p><\/p>/', '<!--/pixgridder:$1-->', $content);
			if ( strpos($column_open,' class=') !== false ) {
				preg_match('/ class=[\'"](.+?)[\'"]/',$column_open,$class);
				$column_open = preg_replace('/ class=[\'"](.+?)[\'"]/', ' class="$1 dollar2"', $column_open);
				$column_open = str_replace("dollar2", "$2", $column_open);
				$content = preg_replace('/<!--pixgridder:column(.+?) class="(.+?)"-->/', $column_open, $content);
				$column_open = str_replace(" $2", "", $column_open);
				$content = preg_replace('/<!--pixgridder:column(.+?)-->/', $column_open, $content);
				$content = preg_replace('/data-col="\[col=(.?[^\]\s]+)\] id="(.+?)""/', 'data-col="$1" id="$2"', $content);
				$content = preg_replace('/data-col="\[col=(.+?)\]"/', 'data-col="$1"', $content);
			} else {
				$content = preg_replace('/<!--pixgridder:column\[col=(.+?)\]-->/', $column_open, $content);
				$column_open = preg_replace('/<(.+?)>/', '<$1 dollar2>', $column_open);
				$column_open = str_replace("dollar2", "$2", $column_open);
				$content = preg_replace('/<!--pixgridder:column\[col=(.?[^\]\s]+)\](.+?)-->/', $column_open, $content);
			}
			$content = preg_replace('/ class=/', ' class=', $content);
			if ( strpos($row_open,' class=') !== false ) {
				preg_match('/ class=[\'"](.+?)[\'"]/',$row_open,$class);
				$row_open = preg_replace('/ class=[\'"](.+?)[\'"]/', ' class="$1 dollar2"', $row_open);
				$row_open = str_replace("dollar2", "$2", $row_open);
				$content = preg_replace('/<!--pixgridder:row(.+?) class="(.+?)"-->/', $row_open, $content);
				$row_open = str_replace(" $2", "", $row_open);
				$content = preg_replace('/<!--pixgridder:row(.+?)-->/', $row_open, $content);
				$content = preg_replace('/data-cols="\[cols=(.?[^\]\s]+)\] id="(.+?)""/', 'data-cols="$1" id="$2"', $content);
				$content = preg_replace('/data-cols="\[cols=(.+?)\]"/', 'data-cols="$1"', $content);
			} else {
				$content = preg_replace('/<!--pixgridder:row\[cols=(.+?)\]-->/', $row_open, $content);
				$row_open = preg_replace('/<(.+?)>/', '<$1 dollar2>', $row_open);
				$row_open = str_replace("dollar2", "$2", $row_open);
				$content = preg_replace('/<!--pixgridder:row\[cols=(.?[^\]\s]+)\](.+?)-->/', $row_open, $content);
			}
			$content = preg_replace('/<!--\/pixgridder:row\[cols=(.+?)\]-->/', $row_close, $content);
			$content = preg_replace('/<!--\/pixgridder:column\[col=(.+?)\]-->/', $column_close, $content);
			$content = preg_replace('/  class=/', ' class=', $content);
			$content = preg_replace('/<p><\/p>/', '', $content);

		} else {

	    	$active_gridder = false;

			$content = preg_replace('/<!--pixgridder(.+?)-->/', '', $content);
			$content = preg_replace('/<!--\/pixgridder(.+?)-->/', '', $content);

		}

		return $content;
	}

	/**
	 * Add plugin menu.
	 *
	 * @since    1.0.0
	 */
	public function add_menu() {
		if (function_exists('add_options_page')) {
			add_menu_page($this->plugin_name, $this->plugin_name, 'activate_plugins', 'pixgridder_admin', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Very general', 'Very general', 'activate_plugins', 'pixgridder_verygeneral', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Register', 'Register', 'activate_plugins', 'pixgridder_register', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Settings', 'Settings', 'activate_plugins', 'pixgridder_settings', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Compile CSS file', 'Compile CSS file', 'activate_plugins', 'pixgridder_css', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Add rules', 'Add rules', 'activate_plugins', 'pixgridder_rules', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Installation', 'Installation', 'activate_plugins', 'pixgridder_descdoc', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Installation', 'Installation', 'activate_plugins', 'pixgridder_startdoc', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Admin panel', 'Admin panel', 'activate_plugins', 'pixgridder_admindoc', array( $this, 'register_options' ));
			add_submenu_page('pixgridder_admin', 'Grid builder', 'Grid builder', 'activate_plugins', 'pixgridder_builderdoc', array( $this, 'register_options' ));
		}
	}

	/**
	 * Options.
	 *
	 * @since    1.1.0
	 *
	 */
	public static function register_options() {
	    global $options;

	    $page_template = locate_template( array( 'page.php' ) );
        $pixgridder_post_type = (!empty($page_template)) ? array("page" => "page") : '';

        if (!empty($page_template)) {
	        $pixgridder_page_template['default'] = 'default';
	    }
        $templates = get_page_templates();
        $pixgridder_page_template = array();
        foreach ( $templates as $template_name => $template_filename ) {
        	$pixgridder_page_template[$template_filename] = $template_filename;
        }

		$options = array (
			array( "id" => "pixgridder_info_addon",
				"std" => ""),
			array( "id" => "pixgridder_info_update",
				"std" => ""),
			array( "id" => "pixgridder_height_preview",
				"std" => "550"),
			array( "id" => "pixgridder_allow_ajax",
				"std" => "true"),
			array( "id" => "pixgridder_no_trace",
				"std" => "0"),
			array( "id" => "pixgridder_user_name",
				"std" => ""),
			array( "id" => "pixgridder_license_key",
				"std" => ""),
			array( "id" => "pixgridder_fx",
				"std" => 'pix-fadeIn'),
			array( "id" => "pixgridder_disable_preview",
				"std" => '0'),
			array( "id" => "pixgridder_row_open",
				"std" => "<div class=\"row\" data-cols=\"$1\">"),
			array( "id" => "pixgridder_row_close",
				"std" => "</div><!--.row[data-cols=\"$1\"]-->"),
			array( "id" => "pixgridder_column_open",
				"std" => "<div class=\"column\" data-col=\"$1\">"),
			array( "id" => "pixgridder_column_close",
				"std" => "</div><!--.column[data-col=\"$1\"]-->"),
			array( "id" => "pixgridder_min_cols",
				"std" => "3"),
			array( "id" => "pixgridder_max_cols",
				"std" => "12"),
			array( "id" => "pixgridder_exclude_cols",
				"std" => ""),
			array( "id" => "pixgridder_post_type",
				"std" => $pixgridder_post_type),
			array( "id" => "pixgridder_page_template",
				"std" => $pixgridder_page_template),
			array( "id" => "pixgridder_css_selector",
				"std" => '.row .column'),
			array( "id" => "pixgridder_css_gutter",
				"std" => '3'),
			array( "id" => "pixgridder_css_gutter_h",
				"std" => '3'),
			array( "id" => "pixgridder_opacity_ms",
				"std" => '500'),
			array( "id" => "pixgridder_animation_ms",
				"std" => '350'),
			array( "id" => "pixgridder_css_padding",
				"std" => '0'),
			array( "id" => "pixgridder_css_break",
				"std" => '768'),
			array( "id" => "pixgridder_css_code",
				"std" => '\/* PixGridder custom stylesheet *\/'),
			array( "id" => "pixgridder_include_generated_css",
				"std" => 'true')
		);
		
		self::pixgridder_admin( array( &$this, 'register_options' ) );
		self::pixgridder_verygeneral( array( &$this, 'register_options' ) );
		self::pixgridder_register( array( &$this, 'register_options' ) );
		self::pixgridder_settings( array( &$this, 'register_options' ) );
		self::pixgridder_css( array( &$this, 'register_options' ) );
		self::pixgridder_rules( array( &$this, 'register_options' ) );
		self::pixgridder_descdoc( array( &$this, 'register_options' ) );
		self::pixgridder_startdoc( array( &$this, 'register_options' ) );
		self::pixgridder_admindoc( array( &$this, 'register_options' ) );
		self::pixgridder_builderdoc( array( &$this, 'register_options' ) );

		return $options;
	}

	/**
	 * Display the menu for admin panel.
	 *
	 * @since    1.0.0
	 */
	public static function pixgridder_admin() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/panel.php' );
	}

	/**
	 * Display the general admin page.
	 *
	 * @since    1.0.0
	 */
	public static function pixgridder_verygeneral() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/general.php' );
	}

	/**
	 * Display the register page.
	 *
	 * @since    1.0.0
	 */
	public static function pixgridder_register() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/register.php' );
	}

	/**
	 * Display the general settings.
	 *
	 * @since    1.0.0
	 */
	public static function pixgridder_settings() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/settings.php' );
	}

	/**
	 * Display the css compiler.
	 *
	 * @since    1.0.0
	 */
	public static function pixgridder_css() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/css.php' );
	}

	/**
	 * Display the "add rules" page.
	 *
	 * @since    1.0.0
	 */
	public static function pixgridder_rules() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/rules.php' );
	}

	/**
	 * Display the documentation pages.
	 *
	 * @since    1.0.0
	 */
	public static function pixgridder_descdoc() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/documentation.php' );
	}
	public static function pixgridder_startdoc() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/documentation.php' );
	}
	public static function pixgridder_admindoc() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/documentation.php' );
	}
	public static function pixgridder_builderdoc() {
		require_once( PIXGRIDDER_PATH . 'lib/admin/documentation.php' );
	}

	/**
	 * Register options in the database.
	 *
	 * @since    1.0.0
	 */
	public static function add_general() {
		global $options;
		self::register_options();
		
		foreach ($options as $value) :
			if(!get_option($value['id'])){
				add_option($value['id'], $value['std']);
			}
		endforeach;
	}

	/**
	 * Save the options on the admin panel via AJAX.
	 *
	 * @since    1.0.0
	 */
	public function save_via_ajax() {
		global $options;
		check_ajax_referer('pixgridder_data', 'pixgridder_security');

		$data = $_POST;
		unset($data['pixgridder_security'], $data['action']);

		foreach ($_REQUEST as $key => $value) {
			if ( preg_match("/pixgridder_array/", $key) ) {
				delete_option($key);
				if(!get_option($key)) {
					add_option($key, $value);
				} else {
					update_option($key, $value);
				}
			}
		}
		
		foreach ($_REQUEST as $key => $value) {
			if( isset($_REQUEST[$key]) ) {
				update_option($key, $value);
			}
		}		
	}

	/**
	 * Remove the subpages via CSS.
	 *
	 * @since    1.0.0
	 */
	public function remove_subpages() { ?>
	    <style type="text/css" media="screen">
	        #toplevel_page_pixgridder_admin ul, #toplevel_page_pixgridder_admin .wp-menu-toggle, #toplevel_page_pixgridder_admin .wp-submenu, #toplevel_page_pixgridder_admin.wp-not-current-submenu .wp-menu-arrow {
	            display: none!important;
	        }
	    </style>
	<?php }

	/**
	 * Set the animation on the frontend as JS var.
	 *
	 * @since    1.0.0
	 */
	public function fx_vars() {
		?>
		<script type="text/javascript">
		//<![CDATA[
			var pixgridder_fx = "<?php echo get_option('pixgridder_fx'); ?>", pixgridder_css_selector = "<?php echo get_option('pixgridder_css_selector'); ?>";
		//]]>
		</script>
	<?php }

	/**
	 * Set the content width as JS var.
	 *
	 * @since    1.1.0
	 */
	public function js_vars() {
		global $content_width, $post, $pagenow;

		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {

			$typenow = get_post_type();
			$templatenow = get_post_meta($post->ID,'_wp_page_template', true) == '' ? 'default' : get_post_meta($post->ID,'_wp_page_template', true);
			$editor = get_post_meta( $post->ID, 'pixBuilderDisable', true );
			$post_types_selected = get_option( 'pixgridder_post_type' ) != '' ? get_option( 'pixgridder_post_type' ) : array();
			$page_template = get_option( 'pixgridder_page_template' ) != '' ? get_option( 'pixgridder_page_template' ) : array();

			$pixgridder_array_rules_ = get_option('pixgridder_array_rules_'); 

		    if ( ($typenow != 'page' && in_array($typenow,$post_types_selected)) || ($typenow == 'page' && (in_array($templatenow,$page_template) || empty($page_template))) ) {
		        $display = 'true';
	        } else {
		        $display = 'false';        	
	        }	    	
	        $i = 0;

	        if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
	            while($i<count($pixgridder_array_rules_)) {
	           	 	$post_type = $pixgridder_array_rules_[$i]['post_type'];
	            	$meta_name = $pixgridder_array_rules_[$i]['meta_name'];
	            	$meta_value = $pixgridder_array_rules_[$i]['meta_value'];
	            	$enabled = $pixgridder_array_rules_[$i]['enabled'];
	            	if ( $typenow == $post_type && $enabled != 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
				        $display = 'true';
	            	} elseif  ( $typenow == $post_type && $enabled == 'disabled' && ( get_post_meta( $post->ID, $meta_name, true ) == $meta_value || $meta_name=='' ) ) {
				        $display = 'false';
	            	}
	            	$i++;
	            }
	        }
			
	        if ( $editor == 'on' ) {
	        	$display = 'false';
	        }

			if ( isset( $content_width ) ) {
				$pix_content_width = $content_width;
		    } else {
				$pix_content_width = 980;
		    } ?>
			<script type="text/javascript">
			//<![CDATA[
				var pixgridder_content_width = <?php echo $pix_content_width; ?>, pixgridder_url = "<?php echo PIXGRIDDER_URL; ?>", pixgridder_display = <?php echo $display; ?>, pixgridder_preview_text = "<?php _e('Preview','pixgridder'); ?>", pixgridder_builder_text = "<?php _e('Builder','pixgridder'); ?>", pixgridder_disable_preview = "<?php echo get_option('pixgridder_disable_preview'); ?>";
			//]]>
			</script>
		<?php }
	}


	/**
	 * The css compiler.
	 *
	 * @since    1.0.0
	 */
	public function compile_css($context) {

		global $wp_filesystem;

		if ( ! WP_Filesystem($creds) ) {
			request_filesystem_credentials($url, '', true, false, null);
			return;
		}		

		$css_dir = get_stylesheet_directory();

		$css_file = trailingslashit($css_dir) . 'gridder.css';

		$target_dir = $wp_filesystem->find_folder(PIXGRIDDER_URL . 'lib');
		$target_file = trailingslashit($target_dir).'push.php';

		$css = wp_remote_post( $target_file, array( 'body' => $context ) );

		if (!is_wp_error($css) && ($css['response']['code'] == 200)) {
			$css = $css['body'];
			ob_clean();
			$wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE );
		}

	}


	/**
	 * The css compiler via AJAX.
	 *
	 * @since    1.0.0
	 */
	public function compile_css_ajax() {

		global $wp_filesystem;

		if ( ! WP_Filesystem($creds) ) {
			request_filesystem_credentials($url, '', true, false, null);
			return;
		}		

		$css_dir = get_stylesheet_directory();

		$css_file = trailingslashit($css_dir) . 'gridder.css';

		$target_dir = $wp_filesystem->find_folder(PIXGRIDDER_URL . 'lib');
		$target_file = trailingslashit($target_dir).'push.php';

		$context = $_POST['context'];

		$css = wp_remote_post( $target_file, array( 'body' => $context ) );

		if (!is_wp_error($css) && ($css['response']['code'] == 200)) {
			$css = $css['body'];
			ob_clean();
			$wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE );
		}

	    die();
	}

	/**
	 * Add custom stylesheet to tinyMCE.
	 *
	 * @since    2.0.0
	 */
	public static function add_tinymce_css($wp) {
        $wp .= ',' . PIXGRIDDER_URL . 'css/tinymce_frame.css';
        return $wp;
    }

	/**
	 * License checker.
	 *
	 * @since    1.0.1
	 */
	public function check_license($context) {

		$request_url = 'http://www.pixedelic.com/api/products/pixgridder.php';
		
		$request_string = array(
				'body' => array(
					'action' => 'check_pixgridder_license', 
					'id' => '5251972',
					'username' => $_REQUEST['pixgridder_user_name'],
					'license' => $_REQUEST['pixgridder_license_key']
				)
			);
		
		$raw_response = wp_remote_post($request_url, $request_string);

		if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
			$body = addslashes($raw_response['body']);
			if( stripos($body,'perfect')!=false ) { ?>
<script type="text/javascript">
/* <![CDATA[ */
var pixgridder_check_license = 'true',
	pixgridder_check_message = '<?php echo $body; ?>';
/* ]]> */
</script>
			<?php } else { ?>
<script type="text/javascript">
/* <![CDATA[ */
var pixgridder_check_license = 'false',
	pixgridder_check_message = '<?php echo $body; ?>';
/* ]]> */
</script>
			<?php }
		}
		
	}

	/**
	 * Check for update.
	 *
	 * @since    1.0.1
	 */
	public function check_for_plugin_update($checked_data) {
		global $wp_version;

		$api_url = 'http://www.pixedelic.com/api/';

		if (empty($checked_data->checked))
			return $checked_data;
		
		$args = array(
			'dir' => sanitize_title( $this->plugin_name ),
			'slug' => $this->plugin_slug,
			'version' => $checked_data->checked[ PIXGRIDDER_NAME ],
			'id' => '5251972',
			'user' => get_option('pixgridder_user_name'),
			'license' => get_option('pixgridder_license_key')
		);

		$request_string = array(
				'body' => array(
					'action' => 'basic_check', 
					'request' => serialize($args),
					'api-key' => md5(get_bloginfo('url'))
				),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
			);
		
		$raw_response = wp_remote_post($api_url, $request_string);

		if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
			$response = unserialize($raw_response['body']);

		if (is_object($response) && !empty($response)) // Feed the update data into WP updater
			$checked_data->response[ PIXGRIDDER_NAME ] = $response;
		
		return $checked_data;
	}

	/**
	 * Call for update.
	 *
	 * @since    2.1.0
	 */
	public function plugin_api_call($def, $action, $args) {
		global $wp_version;
		
		$api_url = 'http://www.pixedelic.com/api/';
		
		if (!isset($args->slug) || ($args->slug != $this->plugin_slug))
			return false;
		
		$plugin_info = get_site_transient('update_plugins');
		$current_version = $plugin_info->checked[ PIXGRIDDER_NAME ];
		$args->version = $current_version;
		
		$request_string = array(
				'body' => array(
					'action' => $action, 
					'request' => serialize($args),
					'api-key' => md5(get_bloginfo('url'))
				),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
			);
		
		$request = wp_remote_post($api_url, $request_string);

		if (is_wp_error($request)) {
			$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
		} else {
			$res = unserialize($request['body']);

			if ($res === false)
				$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
		}
		
		return $res;
	}
}