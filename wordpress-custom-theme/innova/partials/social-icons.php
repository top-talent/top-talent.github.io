<ul class="social-icons list-unstyled d-flex">

  	<?php if ( get_field( 'social_icons_twitter', 'options' ) ): ?>

	  	<li class="social-icons__item">
			<a href="<?php the_field( 'social_icons_twitter', 'options' ); ?>" class="social-icons__item__social-icon-link d-flex align-items-center justify-content-center" target="_blank" rel="nofollow">
				<i class="fab fa-twitter"></i>
			</a>
	    </li><!-- .social-icons__item -->

    <?php endif; ?>

    <?php if ( get_field( 'social_icons_youtube', 'options' ) ): ?>

	  	<li class="social-icons__item">
			<a href="<?php the_field( 'social_icons_youtube', 'options' ); ?>" class="social-icons__item__social-icon-link d-flex align-items-center justify-content-center" target="_blank" rel="nofollow">
				<i class="fab fa-youtube"></i>
			</a>
	    </li><!-- .social-icons__item -->

    <?php endif; ?>

    <?php if ( get_field( 'social_icons_pinterest', 'options' ) ): ?>

	  	<li class="social-icons__item">
			<a href="<?php the_field( 'social_icons_pinterest', 'options' ); ?>" class="social-icons__item__social-icon-link d-flex align-items-center justify-content-center" target="_blank" rel="nofollow">
				<i class="fab fa-pinterest"></i>
			</a>
	    </li><!-- .social-icons__item -->

    <?php endif; ?>

    <?php if ( get_field( 'social_icons_facebook', 'options' ) ): ?>

	  	<li class="social-icons__item">
			<a href="<?php the_field( 'social_icons_facebook', 'options' ); ?>" class="social-icons__item__social-icon-link d-flex align-items-center justify-content-center" target="_blank" rel="nofollow">
				<i class="fab fa-facebook"></i>
			</a>
	    </li><!-- .social-icons__item -->

    <?php endif; ?>

    <?php if ( get_field( 'social_icons_instagram', 'options' ) ): ?>

	  	<li class="social-icons__item">
			<a href="<?php the_field( 'social_icons_instagram', 'options' ); ?>" class="social-icons__item__social-icon-link d-flex align-items-center justify-content-center" target="_blank" rel="nofollow">
				<i class="fab fa-instagram"></i>
			</a>
	    </li><!-- .social-icons__item -->

    <?php endif; ?>

    <?php if ( get_field( 'social_icons_google', 'options' ) ): ?>

	  	<li class="social-icons__item">
			<a href="<?php the_field( 'social_icons_google', 'options' ); ?>" class="social-icons__item__social-icon-link d-flex align-items-center justify-content-center" target="_blank" rel="nofollow">
				<i class="fab fa-google"></i>
			</a>
	    </li><!-- .social-icons__item -->

    <?php endif; ?>

    <?php if ( get_field( 'social_icons_linkedin', 'options' ) ): ?>

	  	<li class="social-icons__item">
			<a href="<?php the_field( 'social_icons_linkedin', 'options' ); ?>" class="social-icons__item__social-icon-link d-flex align-items-center justify-content-center" target="_blank" rel="nofollow">
				<i class="fab fa-linkedin-in"></i>
			</a>
	    </li><!-- .social-icons__item -->

    <?php endif; ?>

    <?php if ( get_field( 'social_icons_rss', 'options' ) ): ?>

	  	<li class="social-icons__item">
			<a href="<?php the_field( 'social_icons_rss', 'options' ); ?>" class="social-icons__item__social-icon-link d-flex align-items-center justify-content-center" target="_blank" rel="nofollow">
				<i class="fab fa-rss"></i>
			</a>
	    </li><!-- .social-icons__item -->

    <?php endif; ?>

</ul><!-- .social-icons list-unstyled d-flex -->