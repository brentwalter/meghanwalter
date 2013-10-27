<?php global $theme_options; ?>

		</div> <!-- .main-content  -->
	</div> <!-- .wrap-inside -->
</div> <!-- .wrapper -->
<?php if ( isset($theme_options['call_to_action_enabled']) && $theme_options['call_to_action_enabled'] == 1 )
		get_template_part( '/includes/quote'); ?>
<div id="footer-wrap-outer" class="primary-color">
	<div id="footer">
		<div id="footer-inside" class="container">
			<?php if(is_active_sidebar('footer-sidebar')) { ?>
				<div id="footer-widgets">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
					<?php endif; ?>
				</div> <!-- #footer-widgets  -->
			<?php } ?>
		</div> <!-- #footer-inside  -->
		<div class="clear"></div>
	</div> <!-- #footer  -->
</div> <!-- #footer-wrap-outer  -->

<div id="bottom-info-wrapper">
	<div id="bottom-info" class="container">
		<div id="copyright" ><a href="/">&copy;<?php echo date("Y"); ?> GEM Multimedia llc</a></div>
		<?php if ( ! empty( $theme_options['payment_visa'] ) || ! empty( $theme_options['payment_mastercard'] ) || ! empty( $theme_options['payment_amex'] ) || ! empty( $theme_options['payment_paypal'] ) || ! empty( $theme_options['payment_checks'] ) ) { ?>
			<div id="weaccept-wrap">
				<div id="accepted">
					<?php if( ! empty( $theme_options['payment_visa'] )  ) { ?>
						<div class="visa"></div>
					<?php } ?>
					<?php if( ! empty( $theme_options['payment_mastercard'] )  ) { ?>
						<div class="mastercard"></div>
					<?php } ?>
					<?php if( ! empty( $theme_options['payment_amex'] )  ) { ?>
						<div class="amex"></div>
					<?php } ?>
					<?php if( ! empty( $theme_options['payment_paypal'] )  ) { ?>
						<div class="paypal"></div>
					<?php } ?>
					<?php if( ! empty( $theme_options['payment_checks'] )  ) { ?>
						<div class="checks"></div>
					<?php } ?>
				</div> <!-- #accepted -->
			</div> <!-- #weaccept-wrap -->
		<?php } ?>
	</div> <!-- bottom info -->
</div> <!-- #bottom-info-wrapper-->
<?php wp_footer(); ?>

</body>
</html>