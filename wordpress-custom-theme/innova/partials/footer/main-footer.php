<div class="footer-wrapper">
	<footer class="main-footer">
		<div class="main-footer__first-stage element-paddings">
			<div class="container">
				<div class="row justify-content-md-between align-items-md-center w-100">
					<div class="col-12 col-md-auto">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo__innova--mobile.svg" alt="<?php echo get_bloginfo('name'); ?>" class="main-footer__first-stage__logo" />
					</div><!-- /.col-12 col-md-auto -->
					<div class="col-12 col-md-8">

						<?php if( have_rows('contact_details', 'options') ): ?>
							<?php while( have_rows('contact_details', 'options') ): the_row(); ?>

								<address class="main-footer__first-stage__address element-medium-margin-top"><?php the_sub_field( 'address' ); ?></address><!-- /.main-footer__first-stage__address element-medium-margin-top -->
								<ul class="main-footer__first-stage__contact-details element-extra-small-margin-top">
									<li class="main-footer__first-stage__contact-details__single-contact">
										<a href="tel:<?php echo filter_var(get_sub_field('phone_number'), FILTER_SANITIZE_NUMBER_INT); ?>" class="main-footer__first-stage__contact-details__single-contact__link"><?php the_sub_field( 'phone_number' ); ?></a>
									</li><!-- /.main-footer__first-stage__contact-details__single-contact -->
									<li class="main-footer__first-stage__contact-details__single-contact">
										<a href="mailto:<?php the_sub_field( 'email_address' ); ?>" class="main-footer__first-stage__contact-details__single-contact__link"><?php the_sub_field( 'email_address' ); ?></a>
									</li><!-- /.main-footer__first-stage__contact-details__single-contact -->
								</ul><!-- /.main-footer__first-stage__contact-details element-extra-small-margin-top -->

							<?php endwhile; ?>
						<?php endif; ?>

					</div><!-- /.col-12 col-md-8 -->
				</div><!-- /.row justify-content-md-between align-items-md-center w-100 -->
			</div><!-- /.container -->
		</div><!-- /.main-footer__first-stage element-paddings -->
		<div class="main-footer__second-stage">
			<div class="container">
				<div class="row">
					<div class="col-12">

						<?php
						    wp_nav_menu([
						        'menu'            => 'Footer Navigation',
						        'theme_location'  => 'footer_navigation',
						        'items_wrap'	  => '<ul id="%1$s" class="%2$s"><li> © '.date('Y').' '.get_bloginfo('name').'</li>%3$s<li>Site created by <a href="http://www.beckyhollandpartners.co.uk/" target="_blank" rel="nofollow">BH&P</a></li></ul>'
						    ]);
						?>

					</div><!-- /.col-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.main-footer__second-stage -->
	</footer><!-- /.main-footer -->
</div><!-- /.footer-wrapper -->