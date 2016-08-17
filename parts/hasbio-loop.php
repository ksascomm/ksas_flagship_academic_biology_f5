<li class="person no-margin<?php echo get_the_directory_filters($post);?> <?php echo get_the_roles($post); ?>">			 
	<h4 class="no-margin">
		<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field">	   
			<?php the_title(); ?>
		</a>
	</h4>
	<p class="no-margin">
	<?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?>
		<strong><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></strong> 
	<?php endif; ?>
	<br>
	<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?>
		<strong>Research Interests:&nbsp;</strong><?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?>
	<?php endif; ?>
	</p>
	<p class="contact no-margin">
		<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : $email = get_post_meta($post->ID, 'ecpt_email', true); ?>
			<span class="icon-mail"> <a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>"><?php echo get_post_meta($post->ID, 'ecpt_email', true); ?> </a></span>
		<?php endif; ?>
		<?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
			<span class="fa fa-phone-square"></span> <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?>
		<?php endif; ?>
		<?php if ( get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
			<span class="icon-printer"><?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?></span>
		<?php endif; ?>
		<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
			<span class="icon-location"><?php echo get_post_meta($post->ID, 'ecpt_office', true); ?></span>
		<?php endif; ?>
	</p>
</li>		
