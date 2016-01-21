<?php
/*
Template Name: People Directory (Alphabetically)
*/
?>	

<?php get_header(); 
	$theme_option = flagship_sub_get_global_options();
	$roles = get_terms('role', array(
						'orderby' 		=> 'ID',
						'order'			=> 'ASC',
						'hide_empty'    => true,
						)); 
	$filters = get_terms('filter', array(
						'orderby'       => 'name', 
						'order'         => 'ASC',
						'hide_empty'    => true, 
						));
	$role_slugs = array();
	$filter_slugs = array();
	foreach($roles as $role) {
		$role_slugs[] = $role->slug;
	}
	$role_classes = implode(' ', $role_slugs);
	foreach($filters as $filter) {
		$filter_slugs[] = $filter->slug;
	}
	$filter_classes = implode(' ', $filter_slugs);
	?>
<div class="row wrapper radius10">
	<section class="row">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="large-12 columns">
				<h2><?php the_title();?></h2>
				<p><?php the_content();?></p>
			</div>
		<?php endwhile; endif; ?>
		<div class="large-12 columns">
			<?php $theme_option = flagship_sub_get_global_options();
				if ( $theme_option['flagship_sub_directory_search']  == '1' ) { get_template_part('parts', 'directory-search'); } ?>
		</div>
	</section>



	<section class="row" id="fields_container">
		<ul class="large-12 columns" id="directory">
		<?php if ( false === ( $people_query = get_transient( 'people_query_alpha_' . $role_slug ) )) {				
				$people_query = new WP_Query(array(
						'post_type' => 'people',
						'meta_key' => 'ecpt_people_alpha',
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'posts_per_page' => '-1'));
				set_transient( 'people_query_alpha_' . $role_slug, $people_query, 2592000 );
			} 				        	
				if ($people_query->have_posts() ) : while ($people_query->have_posts()) : $people_query->the_post(); ?>
					<?php if ( get_post_meta($post->ID, 'ecpt_bio', true) ) { get_template_part('parts','hasbio-loop'); } else { get_template_part('parts', 'nobio-loop'); } ?>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				<!-- Page Content -->
			<?php if ( $theme_option['flagship_sub_directory_search']  == '1' ) { ?>
			<div class="row" id="noresults">
				<div class="small-4 small-centered columns">
				</div>
			</div>
			<?php } ?>
		</ul>
	</section>	

</div> <!-- End content wrapper -->
<?php get_footer(); ?>