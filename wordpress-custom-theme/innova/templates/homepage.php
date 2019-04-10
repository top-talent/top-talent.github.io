<?php
    /*
    	Template Name: Homepage
    *
    *   @package Crunch
    *   @since Crunch 2.0.0
    */
?>

<?php get_header(); ?>

<main id="main" class="homepage-template">

	<section class="homepage-intro">
		<div class="container">
			<div class="row align-items-md-center align-items-lg-end">
				<div class="col-md-6">
					<div class="homepage-intro__content-wrapper element-paddings">
						<h1 class="homepage-intro__content-wrapper__title"><?php the_title(); ?></h1><!-- /.homepage-intro__content-wrapper__title -->
						<div class="homepage-intro__content-wrapper__content content element-small-margin-top">
							<?php the_field( 'intro_content' ); ?>
						</div><!-- /.homepage-intro__content-wrapper__content content element-small-margin-top -->
						<a href="#range-of-readers" class="innova-button innova-button__full-background innova-button__full-background--white scroll">Find out more</a>
					</div><!-- /.homepage-intro__content-wrapper element-paddings -->
				</div><!-- /.col-md-6 -->
				<div class="col-md-6">

					<?php if( have_rows('intro_image') ): ?>
						<?php while( have_rows('intro_image') ): the_row(); ?>

							<?php echo do_shortcode('[dflip id="127" type="button"]

								<span class="homepage-intro__look-inside__title d-block">L<img src="'.get_template_directory_uri().'/images/icon__eyes.svg" alt="Eyes icon" class="homepage-intro__look-inside__title__eyes-icon" />k inside</span>
								<span class="homepage-intro__look-inside__subtitle d-block">Click to view</span>

							[/dflip]'); ?>

							<?php $image = get_sub_field('image'); ?>
							<?php if( !empty($image) ): ?>

								<?php echo do_shortcode('[dflip id="127" type="button"]

									<img src="'.$image['url'].'" alt="'.$image['alt'].'" class="homepage-intro__image-link__image" />

								[/dflip]'); ?>

							<?php endif; ?>

						<?php endwhile; ?>
					<?php endif; ?>

				</div><!-- /.col-md-6 -->
			</div><!-- /.row align-items-md-center align-items-lg-end -->
		</div><!-- /.container -->
	</section><!-- /.homepage-intro -->

	<div id="range-of-readers" class="range-of-readers element-padding-bottom">
		<div class="container">
			<div class="row justify-content-lg-between align-items-lg-end">
				<div class="col-12 col-md-auto">
					<h2 class="range-of-readers__title"><?php the_field( 'range_of_readers_title' ); ?></h2><!-- /.range-of-readers__title -->

					<?php if( have_rows('range_of_readers_button') ): ?>
						<?php while( have_rows('range_of_readers_button') ): the_row(); ?>

							<button type="button" class="innova-button innova-button__download innova-button__download--primary-color d-lg-none" data-toggle="modal" data-target="#rangeOfReadersModal">
								<span class="innova-button__download__value"><?php the_sub_field( 'value' ); ?></span>
								<span class="innova-button__download__subtitle"><?php the_sub_field( 'subtitle' ); ?></span>
							</button>

						<?php endwhile; ?>
					<?php endif; ?>

					<?php if( have_rows('range_of_readers') ): ?>

						<ul id="range-of-readers-tabs" class="nav nav-tabs element-medium-margin-top" role="tablist">

							<?php $loop_counter = 1; ?>
							<?php while( have_rows('range_of_readers') ): the_row(); ?>

								<?php $books = 0; ?>
								<?php if( have_rows('books') ): ?>
									<?php while( have_rows('books') ): the_row(); ?>
										<?php $books++; ?>
									<?php endwhile; ?>
								<?php endif; ?>

								<li class="nav-item">
									<a class="nav-link<?php if($loop_counter == 1) echo ' active'; ?><?php if($books == 0) echo ' disabled'; ?>" id="<?php echo create_slug(get_sub_field('category_name')); ?>-tab" data-toggle="tab" href="#<?php echo create_slug(get_sub_field('category_name')); ?>" role="tab" aria-controls="<?php echo create_slug(get_sub_field('category_name')); ?>" aria-selected="<?php if($loop_counter == 1) { echo 'true'; } else { echo 'false'; } ?>"><?php the_sub_field('category_name') ?></a>
								</li><!-- /.nav-item -->

								<?php $loop_counter++; ?>
							<?php endwhile; ?>

						</ul><!-- /#range-of-readers-tabs.nav nav-tabs element-medium-margin-top -->

					<?php endif; ?>

				</div><!-- /.col-12 col-md-auto -->
				<div class="col-12 col-md-auto">

					<?php if( have_rows('range_of_readers_button') ): ?>
						<?php while( have_rows('range_of_readers_button') ): the_row(); ?>

							<button type="button" class="innova-button innova-button__download innova-button__download--primary-color d-none d-lg-inline-block" data-toggle="modal" data-target="#rangeOfReadersModal">
								<span class="innova-button__download__value"><?php the_sub_field( 'value' ); ?></span>
								<span class="innova-button__download__subtitle"><?php the_sub_field( 'subtitle' ); ?></span>
							</button>

						<?php endwhile; ?>
					<?php endif; ?>

				</div><!-- /.col-12 col-md-auto -->
			</div><!-- /.row justify-content-lg-between align-items-lg-end -->
			<div class="row">
				<div class="col-12">

					<?php if( have_rows('range_of_readers') ): ?>

						<div id="range-of-readers-tabs-contnet" class="tab-content">

							<?php $loop_counter = 1; ?>
							<?php while( have_rows('range_of_readers') ): the_row(); ?>

								<div class="tab-pane fade<?php if($loop_counter == 1) echo ' show active'; ?>" id="<?php echo create_slug(get_sub_field('category_name')); ?>" role="tabpanel" aria-labelledby="<?php echo create_slug(get_sub_field('category_name')); ?>-tab">

									<?php $category_slug = create_slug(get_sub_field('category_name')); ?>

									<?php if( have_rows('books') ): ?>

										<div id="<?php echo $category_slug; ?>-slider" class="owl-carousel owl-theme">

											<?php while( have_rows('books') ): the_row(); ?>

												<?php if( have_rows('book') ): ?>
													<?php while( have_rows('book') ): the_row(); ?>

														<div class="single-book">

															<?php $image = get_sub_field('cover'); 
																		$book_shortcode=get_sub_field('book_shortcode');
															?>
															<?php if( !empty($image) ): ?>
																
																<?php echo do_shortcode($book_shortcode); ?>
																	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="single-book__image" />
															<?php endif; ?>

															<h3 class="single-book__title element-small-margin-top"><?php the_sub_field('title'); ?></h3><!-- /.single-book__title element-small-margin-top -->
														</div><!-- /.single-book -->

													<?php endwhile; ?>
												<?php endif; ?>

											<?php endwhile; ?>

										</div><!-- /#books-slider-1.owl-carousel owl-theme -->

									<?php endif; ?>

								</div><!-- /#home.tab-pane fade show active -->

								<?php $loop_counter++; ?>
							<?php endwhile; ?>

						</div><!-- /#range-of-readers-tabs-contnet.tab-content -->
	
					<?php endif; ?>	

				</div><!-- /.col-12 -->
			</div><!-- /.row -->
			<div class="row">
				<div class="col col-auto">
					<?php echo do_shortcode('[dflip id="127" type="button"]
						L<img src="'.get_template_directory_uri().'/images/icon__eyes.svg" alt="Eyes icon" class="range-of-readers__sample-reader-button__eyes-icon" />k inside a <br>Sample Reader
					[/dflip]'); ?>							
				</div><!-- /.col col-auto -->
				<div class="col col-auto">
					<a href="#" class="range-of-readers__watch-video element-medium-margin-top" data-toggle="modal" data-target="#videoModal">
						Watch Graded Readers Marketing Overview
					</a>
				</div><!-- /.col col-auto -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /#range-of-readers.range-of-readers element-padding-bottom -->

	<div id="videoModal" class="video-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-header__title">Graded Readers Overview</h3>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  	<span aria-hidden="true">&times;</span>
					</button>
				</div><!-- /.modal-header -->
				<div class="modal-body">
					<div class="videoWrapper">
						<!-- <iframe width="560" height="349" src="https://www.youtube.com/embed/mZ68QHKkiSU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
						<iframe class="embed-responsive-item" width="700" height="372" src="https://innova.sfo2.digitaloceanspaces.com/wp-content/uploads/2018/12/video/reader_presentation_v7_1_1.mp4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
				</div><!-- /.modal-body -->
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /#videoModal.video-modal modal fade -->

	<div id="rangeOfReadersModal" class="form-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="rangeOfReadersModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<?php if( have_rows('range_of_readers_button') ): ?>
						<?php while( have_rows('range_of_readers_button') ): the_row(); ?>

							<h3 class="modal-header__title"><?php the_sub_field( 'value' ); ?> <?php the_sub_field( 'subtitle' ); ?></h3><!-- /.modal-header__title -->

						<?php endwhile; ?>
					<?php endif; ?>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  	<span aria-hidden="true">&times;</span>
					</button>
				</div><!-- /.modal-header -->
				<div class="modal-body">
					<?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]'); ?>
				</div><!-- /.modal-body -->
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /#rangeOfReadersModalModal.form-modal modal fade -->

	<div id="range-of-practice-tests" class="range-of-practice-tests">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="range-of-practice-tests__title"><?php the_field( 'range_of_practice_tests_title' ); ?></h2><!-- /.range-of-practice-tests__title -->
					<span class="range-of-practice-tests__subtitle d-block element-extra-small-margin-top"><?php the_field( 'range_of_practice_tests_subtitle' ); ?></span>

					<?php if( have_rows('range_of_practice_tests') ): ?>

						<ul id="range-of-practice-tests-tabs" class="nav nav-tabs element-medium-margin-top" role="tablist">

							<?php $loop_counter = 1; ?>
							<?php while( have_rows('range_of_practice_tests') ): the_row(); ?>

								<?php $books = 0; ?>
								<?php if( have_rows('books') ): ?>
									<?php while( have_rows('books') ): the_row(); ?>
										<?php $books++; ?>
									<?php endwhile; ?>
								<?php endif; ?>

								<li class="nav-item">
									<a class="nav-link<?php if($loop_counter == 1) echo ' active'; ?><?php if($books == 0) echo ' disabled'; ?>" id="<?php echo create_slug(get_sub_field('category_name')); ?>-tab" data-toggle="tab" href="#<?php echo create_slug(get_sub_field('category_name')); ?>" role="tab" aria-controls="<?php echo create_slug(get_sub_field('category_name')); ?>" aria-selected="<?php if($loop_counter == 1) { echo 'true'; } else { echo 'false'; } ?>"><?php the_sub_field('category_name') ?></a>
								</li><!-- /.nav-item -->

								<?php $loop_counter++; ?>
							<?php endwhile; ?>

						</ul><!-- /#range-of-practice-tests-tabs.nav nav-tabs element-medium-margin-top -->

					<?php endif; ?>

					<?php if( have_rows('range_of_practice_tests') ): ?>

						<div id="range-of-practice-tests-tabs-contnet" class="tab-content">

							<?php $loop_counter = 1; ?>
							<?php while( have_rows('range_of_practice_tests') ): the_row(); ?>

								<div class="tab-pane fade<?php if($loop_counter == 1) echo ' show active'; ?>" id="<?php echo create_slug(get_sub_field('category_name')); ?>" role="tabpanel" aria-labelledby="<?php echo create_slug(get_sub_field('category_name')); ?>-tab">

									<?php $category_slug = create_slug(get_sub_field('category_name')); ?>

									<?php if( have_rows('books') ): ?>

										<div id="<?php echo $category_slug; ?>-slider" class="owl-carousel owl-theme">

											<?php while( have_rows('books') ): the_row(); ?>

												<?php if( have_rows('book') ): ?>
													<?php while( have_rows('book') ): the_row(); ?>

														<div class="single-book">

															<?php $image = get_sub_field('cover'); 
																		$book_link = get_sub_field('book_link');
															?>
															<?php if( !empty($image) ): ?>

																<a href="<?php echo $book_link; ?>" tarket="_black" ><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="single-book__image" /></a>

															<?php endif; ?>

															<h3 class="single-book__title element-small-margin-top"><?php the_sub_field('title'); ?></h3><!-- /.single-book__title element-small-margin-top -->
														</div><!-- /.single-book -->

													<?php endwhile; ?>
												<?php endif; ?>

											<?php endwhile; ?>

										</div><!-- /#books-slider-1.owl-carousel owl-theme -->

									<?php endif; ?>

								</div><!-- /#home.tab-pane fade show active -->

								<?php $loop_counter++; ?>
							<?php endwhile; ?>

						</div><!-- /#range-of-practice-tests-tabs-contnet.tab-content -->

					<?php endif; ?>
				</div><!-- /.col-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /#range-of-practice-tests.range-of-practice-tests -->
<div id="range-of-practice-tests" class="range-of-practice-tests">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="range-of-practice-tests__title"><?php the_field( 'range_of_practice_tests_title' ); ?></h2><!-- /.range-of-practice-tests__title -->
					<span class="range-of-practice-tests__subtitle d-block element-extra-small-margin-top"><?php the_field( 'range_of_practice_tests_subtitle' ); ?></span>

					<?php if( have_rows('range_of_practice_tests') ): ?>

						<ul id="range-of-practice-tests-tabs" class="nav nav-tabs element-medium-margin-top" role="tablist">

							<?php $loop_counter = 1; ?>
							<?php while( have_rows('range_of_practice_tests') ): the_row(); ?>

								<?php $books = 0; ?>
								<?php if( have_rows('books') ): ?>
									<?php while( have_rows('books') ): the_row(); ?>
										<?php $books++; ?>
									<?php endwhile; ?>
								<?php endif; ?>

								<li class="nav-item">
									<a class="nav-link<?php if($loop_counter == 1) echo ' active'; ?><?php if($books == 0) echo ' disabled'; ?>" id="<?php echo create_slug(get_sub_field('category_name')); ?>-tab" data-toggle="tab" href="#<?php echo create_slug(get_sub_field('category_name')); ?>" role="tab" aria-controls="<?php echo create_slug(get_sub_field('category_name')); ?>" aria-selected="<?php if($loop_counter == 1) { echo 'true'; } else { echo 'false'; } ?>"><?php the_sub_field('category_name') ?></a>
								</li><!-- /.nav-item -->

								<?php $loop_counter++; ?>
							<?php endwhile; ?>

						</ul><!-- /#range-of-practice-tests-tabs.nav nav-tabs element-medium-margin-top -->

					<?php endif; ?>

					<?php if( have_rows('range_of_practice_tests') ): ?>

						<div id="range-of-practice-tests-tabs-contnet" class="tab-content">

							<?php $loop_counter = 1; ?>
							<?php while( have_rows('range_of_practice_tests') ): the_row(); ?>

								<div class="tab-pane fade<?php if($loop_counter == 1) echo ' show active'; ?>" id="<?php echo create_slug(get_sub_field('category_name')); ?>" role="tabpanel" aria-labelledby="<?php echo create_slug(get_sub_field('category_name')); ?>-tab">

									<?php $category_slug = create_slug(get_sub_field('category_name')); ?>

									<?php if( have_rows('books') ): ?>

										<div id="<?php echo $category_slug; ?>-slider" class="owl-carousel owl-theme">

											<?php while( have_rows('books') ): the_row(); ?>

												<?php if( have_rows('book') ): ?>
													<?php while( have_rows('book') ): the_row(); ?>

														<div class="single-book">

															<?php $image = get_sub_field('cover'); 
																		$book_link = get_sub_field('book_link');
															?>
															<?php if( !empty($image) ): ?>

																<a href="<?php echo $book_link; ?>" tarket="_black" ><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="single-book__image" /></a>

															<?php endif; ?>

															<h3 class="single-book__title element-small-margin-top"><?php the_sub_field('title'); ?></h3><!-- /.single-book__title element-small-margin-top -->
														</div><!-- /.single-book -->

													<?php endwhile; ?>
												<?php endif; ?>

											<?php endwhile; ?>

										</div><!-- /#books-slider-1.owl-carousel owl-theme -->

									<?php endif; ?>

								</div><!-- /#home.tab-pane fade show active -->

								<?php $loop_counter++; ?>
							<?php endwhile; ?>

						</div><!-- /#range-of-practice-tests-tabs-contnet.tab-content -->

					<?php endif; ?>
				</div><!-- /.col-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /#range-of-practice-tests.range-of-practice-tests -->
	<section id="about" class="about">
		<div class="container">
			<div class="row">
				<div class="col-12">

					<?php if( have_rows('about_content') ): ?>
						<?php while( have_rows('about_content') ): the_row(); ?>

							<h2 class="about__title"><?php the_sub_field( 'title' ); ?></h2><!-- /.about__title -->

						<?php endwhile; ?>
					<?php endif; ?>

					<?php if( have_rows('about_content') ): ?>
						<?php while( have_rows('about_content') ): the_row(); ?>

							<div class="about__content content">
								<?php the_sub_field( 'content' ); ?>
							</div><!-- /.about__content content -->

						<?php endwhile; ?>
					<?php endif; ?>

				</div><!-- /.col-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /#about.about -->

	<section id="distributions" class="distributions element-padding-top">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<h2 class="distributions__title"><?php the_field( 'distributions_title' ); ?></h2><!-- /.distributions__title -->
					<div class="distributions__content content element-medium-margin-top">
						<?php the_field( 'distributions_content' ); ?>
					</div><!-- /.distributions__content content element-medium-margin-top -->

					<?php if( have_rows('distributions_button') ): ?>
						<?php while( have_rows('distributions_button') ): the_row(); ?>

							<button type="button" class="innova-button innova-button__download innova-button__download--primary-color" data-toggle="modal" data-target="#distributionsModal">
								<span class="innova-button__download__value"><?php the_sub_field( 'value' ); ?></span>
								<span class="innova-button__download__subtitle"><?php the_sub_field( 'subtitle' ); ?></span>
							</button>

						<?php endwhile; ?>
					<?php endif; ?>

				</div><!-- /.col-md-6 -->
			</div><!-- /.row align-items-center -->
		</div><!-- /.container -->
	</section><!-- /#distributions.distributions element-padding-top -->

	<div id="distributionsModal" class="form-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="distributionsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<?php if( have_rows('distributions_button') ): ?>
						<?php while( have_rows('distributions_button') ): the_row(); ?>

							<h3 class="modal-header__title"><?php the_sub_field( 'value' ); ?> <?php the_sub_field( 'subtitle' ); ?></h3><!-- /.modal-header__title -->

						<?php endwhile; ?>
					<?php endif; ?>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  	<span aria-hidden="true">&times;</span>
					</button>
				</div><!-- /.modal-header -->
				<div class="modal-body">
					<?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
				</div><!-- /.modal-body -->
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /#distributionsModal.form-modal modal fade -->

	<section class="get-in-touch element-paddings">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<h2 class="get-in-touch__title"><?php the_field( 'get_in_touch_title' ); ?></h2><!-- /.get-in-touch__title -->
				</div><!-- /.col-md-6 col-lg-7 -->
				<div class="col-md-6 col-lg-5">
					<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
				</div><!-- /.col-md-6 col-lg-5 -->
			</div><!-- /.row align-items-center -->
		</div><!-- /.container -->
	</section><!-- /.get-in-touch element-paddings -->

</main><!-- /#main.homepage-template -->

<?php get_footer(); ?>