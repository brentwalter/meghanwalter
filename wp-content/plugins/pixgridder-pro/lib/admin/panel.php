<?php
	global $options;

	$plugin = get_plugin_data(PIXGRIDDER_PATH.'pixgridder.php');

    if (isset($_GET['page']) && $_GET['page']=='pixgridder_admin') {
?>

	<?php
	/******************************
	*
	*	Save option or compile css (for the AJAX method look functions.php -> save_via_ajax() )
	*
	******************************/
		foreach ($_REQUEST as $key => $value) {
			if ( $key=='compile_css' && $value=="compile_css" ) {
				$context = $_REQUEST;
                $pixGridder = new PixGridder(); 
                $pixGridder->compile_css($context);
			} elseif ( $key=='register_details' && $value=="register_details" ) {
				$context = $_REQUEST;
                $pixGridder = new PixGridder(); 
                $pixGridder->check_license($context);
			} elseif ( preg_match("/pixgridder_array/", $key) ) {
				delete_option($key);
				add_option($key, $value);
			} else {
				if(isset($_REQUEST[$key]) ) {
					update_option($key, $value);
				}
			}
		}

	?>
<div id="pix_ap_wrap">
	<?php if ( get_option('pixgridder_info_update')=='' ) { ?>
	<div class="outer_info alert">
		Since <strong>PixGridder 1.0.1</strong> is available the automatic update for the plugin, just go to <strong>Pixgridder Pro &rarr; General &rarr; Register</strong> and follow the instructions: enter the details of your purchase (your CodeCanyon username and your purchaser license code... screenshot about that are available on the admin panel itself).<br>
		After entering the details and saving, you should receive a &quot;Success&quot; message: now you'll be notified when a new version of the plugin is available and you'll be able to update directly from your WP dashboard.<br>
		The automatic update is intended for the regular licenses only and it allows until <strong>5 installations</strong> (I imagined beta test sites and some domain changes etc.). For questions regarding extended licenses or any issues contact me on <a href="http://codecanyon.net/user/pixedelic" target="_blank">CodeCanyon</a><br>
		<strong>N.B.:</strong> the notifier works only with the plugin activated.
		<span class="info_close"><input type="hidden" name="pixgridder_info_update" value=""></span>
		<input type="hidden" name="action" value="pixgridder_data_save" />
		<input type="hidden" name="pixgridder_security" value="<?php echo wp_create_nonce('pixgridder_data'); ?>" />
	</div>
	<?php } ?>
	<?php if ( get_option('pixgridder_info_addon')=='' ) { ?>
	<div class="outer_info alert">
		Since <strong>PixGridder 2.0.0</strong> the plugin comes with another plugin called <strong>Shortcodelic</strong> that provides advanced shortcodes. Just <a href="http://codecanyon.net/item/pixgridder-pro-page-grid-composer-for-wordpress/5251972" target="_blank">download PixGridder from CodeCanyon</a>, you don't need to pay again, of course: the new plugin is inside the zip. Enjoy it.
		<span class="info_close"><input type="hidden" name="pixgridder_info_addon" value=""></span>
		<input type="hidden" name="action" value="pixgridder_data_save" />
		<input type="hidden" name="pixgridder_security" value="<?php echo wp_create_nonce('pixgridder_data'); ?>" />
	</div>
	<?php } ?>
	<header id="pix_ap_header" class="cf">
		<section class="alignleft">
			<h2><?php echo $plugin['Name']; ?></h2>
		</section><!-- .alignleft -->
		<section class="alignright">
			<h5><?php _e('Version','pixgridder'); ?> <?php echo $plugin['Version']; ?><?php do_action('pix_check_update'); ?></h5>
			<a href="http://www.pixedelic.com/pixgridder_current_version_changelog.php" class="pix_button pix-iframe"><?php _e('See the changelog','pixgridder'); ?></a>
		</section><!-- .alignright -->
	</header><!-- #pix_ap_header -->

	<section id="pix_ap_body" class="cf">
		<div id="pix_ap_main_nav_fake">
		</div><!-- #pix_ap_main_nav_fake -->
		<nav id="pix_ap_main_nav">
			<ul>
				<li class="cf" data-store="general">
					<a href="#">
						<i class="pixgridder-icon-cog-2"></i>
					</a>
					<ul>
                    	<li data-store="verygeneral">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_verygeneral"><?php _e('Very general','pixgridder'); ?></a>
                        </li>
                    	<li data-store="register">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_register"><?php _e('Register','pixgridder'); ?></a>
                        </li>
						<li data-store="settings">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_settings"><?php _e('Settings','pixgridder'); ?></a>
						</li>
						<li data-store="css">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_css"><?php _e('Compile CSS file','pixgridder'); ?></a>
						</li>
						<li data-store="rules">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_rules"><?php _e('Add rules','pixgridder'); ?></a>
						</li>
					</ul>
				</li>
				<li class="cf" data-store="documentation">
					<a href="#">
						<i class="pixgridder-icon-book-3"></i>
					</a>
					<ul>
                    	<li data-store="descdoc">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_descdoc"><?php _e('Description','pixgridder'); ?></a>
                        </li>
                    	<li data-store="startdoc">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_startdoc"><?php _e('Installation','pixgridder'); ?></a>
                        </li>
                    	<li data-store="admindoc">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_admindoc"><?php _e('Admin panel','pixgridder'); ?></a>
                        </li>
                    	<li data-store="builderdoc">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=pixgridder_builderdoc"><?php _e('Grid builder','pixgridder'); ?></a>
                        </li>
					</ul>
				</li>
			</ul>
		</nav>
        <section id="pix_content_loaded">
        </section><!-- #pix_content_loaded -->
	</section><!-- #pix_ap_body -->

	<div id="spinner_wrap">
    	<div id="spinner">
		    <span id="ball_1" class="spinner_ball"></span>
		    <span id="ball_2" class="spinner_ball"></span>
		    <span id="ball_3" class="spinner_ball"></span>
		    <span id="ball_4" class="spinner_ball"></span>
		    <span id="ball_5" class="spinner_ball"></span>
		</div>
    	<div id="spinner2">
		    <span id="ball_1_2" class="spinner_ball_2"></span>
		    <span id="ball_2_2" class="spinner_ball_2"></span>
		    <span id="ball_3_2" class="spinner_ball_2"></span>
		    <span id="ball_4_2" class="spinner_ball_2"></span>
		    <span id="ball_5_2" class="spinner_ball_2"></span>
		</div>
	</div>
</div><!-- #pix_ap_wrap -->

<?php 
	}