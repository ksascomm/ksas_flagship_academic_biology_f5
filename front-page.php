<?php
/*
Template Name: Home - Background Photo
*/
?>
<?php get_header();
$theme_option = flagship_sub_get_global_options();
?>
<main>
	<!-- Set photo background -->
	<div class="row hide-for-small-only" aria-label="Highlighted Biology Research Imagery">
		<div class="small-12 columns radius10">
			<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
				<?php the_post_thumbnail('full');?>
			<?php endif;?>
		</div>
	</div>
	
	<!-- Begin main content area -->
	<div class="row wrapper radius10" id="page" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="small-12 columns">
			
			<div class="row">
				<div class="small-12 columns">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
					<?php endwhile; endif; ?>
				</div>
			</div>
			<?php if ( have_rows( 'explore_the_department' ) ) :?>
			<div class="row">
				<div class="small-12 columns">
					<h4><?php echo $theme_option['flagship_sub_feed_name']; ?></h4>
				</div>
				<?php while ( have_rows( 'explore_the_department' ) ) : the_row(); ?>
				<article class="news-item" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost" aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
					<div class="small-12 large-4 columns post-container">
						<div class="row">
							<div class="small-11 small-centered columns post">
								<?php $explore_bucket_image = get_sub_field( 'explore_bucket_image' ); ?>
								<?php if ( $explore_bucket_image ) { ?>
								<img src="<?php echo $explore_bucket_image['url']; ?>" alt="<?php echo $explore_bucket_image['alt']; ?>" />
								<?php } ?>
								<div class="row">
									<div class="small-12 columns">
										<h1 itemprop="headline">
										<a href="<?php the_sub_field( 'explore_bucket_link' ); ?>"><?php the_sub_field( 'explore_bucket_heading' ); ?></a>
										</h1>
										<div class="entry-content" itemprop="text">
											<?php the_sub_field( 'explore_bucket_text' ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
				<?php endwhile; ?>
				<?php else : ?>
				<?php // no rows found ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>