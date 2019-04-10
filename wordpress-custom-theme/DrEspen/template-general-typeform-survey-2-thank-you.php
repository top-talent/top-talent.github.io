<?php
/**
 * Template Name: General Page - Typeform Survey 2 Thank You
 */
?>
<?php while (have_posts()) : the_post(); ?>
	<?php get_template_part( 'templates/page', 'header' );
	$upload_dir = wp_upload_dir(); ?>

		<link id="font" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&text=" rel="stylesheet" type="text/css">

		<style type="text/css">
			/* This is to override the typical 'about-espen' on every single page */
			#about-espen, .newsletter-section, .TGA-text {
				display: none;
			}

			h1 {
				font-size: 24px;
				color: #C94429;
				text-align: center;
				margin: 30px auto 0;
				max-width: 800px;
			}

			.content-holder {
				width: 100%;
				text-align: center;
			}

			.content-holder img {
				margin: 20px 0;
			}

			.wistia_embed {
				margin: 30px auto;
			}

			.locked-video {
				cursor: pointer;
			}
		</style>

		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				jQuery( '.locked-video' ).click( function() {
					jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, 1000);
				});
			});
		</script>

		<div class="content-holder">
			<?php get_template_part('templates/content', 'page'); ?>
			<?php
				//$postid = get_the_ID();
				$postcustoms = get_post_custom( $post->ID );
				if( $postcustoms['embed_youcanbookme'][0] == 1 ) { ?>
					<iframe style="width: 100%; height: 650px; border: 0px; background-color: transparent;" src="https://drespen.youcanbook.me/?noframe=true&skipHeaderFooter=true&email=<?php echo $_GET['email']; ?>" width="300" height="150" frameborder="0"></iframe>
					<script>function keepInView(item) {if((document.documentElement&&document.documentElement.scrollTop)||document.body.scrollTop>item.offsetTop)item.scrollIntoView();}</script>
			<?php } ?>
		</div>
<?php endwhile; ?>
