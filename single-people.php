<?php get_header(); ?>
<div class="row wrapper radius10" id="page" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="small-12 columns radius-left offset-topgutter">
		<div class="content">
			<div class="row">
				<div class="small-5 small-offset-7 columns">
					<label for="jump">
						<h5>Jump to Faculty Member</h5>
					</label>
					<select name="jump" id="jump" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<option>---<?php the_title(); ?></option>
						<?php endwhile; endif; ?>
						<?php $jump_menu_query = new WP_Query(array(
							'post-type' => 'people',
							'role' => 'tenured-and-tenure-track-faculty',
							'meta_key' => 'ecpt_people_alpha',
							'orderby' => 'meta_value',
							'order' => 'ASC',
						'posts_per_page' => '-1')); ?>
						<?php while ($jump_menu_query->have_posts()) : $jump_menu_query->the_post(); ?>
						<option value="<?php the_permalink() ?>"><?php the_title(); ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="small-12 medium-4 columns bio">
				<?php if ( has_post_thumbnail()) { ?>
					<?php the_post_thumbnail('full', array('class' => 'headshot')); ?>
				<?php } ?>
				<h1><?php the_title() ?></h1>
				<h2><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></h2>
	
				<p class="listing">
					<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
					<span class="icon-location"></span><?php echo get_post_meta($post->ID, 'ecpt_office', true); ?><br>
					<?php endif; ?>
					
					<?php if ( get_post_meta($post->ID, 'ecpt_hours', true) ) : ?>
					<span class="icon-calendar-2"></span><?php echo get_post_meta($post->ID, 'ecpt_hours', true); ?><br>
					<?php endif; ?>
					
					<?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
					<span class="icon-phone"></span><?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?><br>
					<?php endif; ?>
					
					<?php if ( get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
					<span class="icon-printer"></span><?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?><br>
					<?php endif; ?>
					
			    	<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : $email = get_post_meta($post->ID, 'ecpt_email', true); ?>
							<span class="icon-mail"></span> <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;<?php echo email_munge($email); ?>">
							
								<?php echo email_munge($email); ?> </a><br>
					<?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_cv', true) ) : ?>
					<a href="<?php echo get_post_meta($post->ID, 'ecpt_cv', true); ?>"><span class="icon-file-pdf"></span>Curriculum Vitae</a><br>
				<?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_website', true) ) : ?>
					<a href="<?php echo get_post_meta($post->ID, 'ecpt_website', true); ?>" target="_blank"><span class="icon-globe"></span>Personal Website</a><br>
				<?php endif; ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_lab_website', true) ) : ?>
					<a href="<?php echo get_post_meta($post->ID, 'ecpt_lab_website', true); ?>" target="_blank"><span class="icon-globe"></span>Group/Lab Website</a><br>
				<?php endif; ?>
				<?php if (get_post_meta($post->ID, 'ecpt_google_id', true) ) : ?>
					<a href="http://scholar.google.com/citations?user=<?php echo get_post_meta($post->ID, 'ecpt_google_id', true); ?>" target="_blank"><span class="fa fa-google"></span> Google Scholar Profile</a><br>
				<?php endif; ?>
				<?php if (get_post_meta($post->ID, 'ecpt_orcid_id', true) ) : ?>
					<a href="http://orcid.org/<?php echo get_post_meta($post->ID, 'ecpt_orcid_id', true); ?>" target="_blank"><span class="fa fa-user"></span> ORCID Profile</a>
				<?php endif; ?>
		    	<?php if (get_post_meta($post->ID, 'ecpt_microsoft_id', true)) : ?>
		    		<span class="fa fa-windows"></span> <a href="https://academic.microsoft.com/#/detail/<?php echo get_post_meta($post->ID, 'ecpt_microsoft_id', true); ?>" target="_blank"> Microsoft Academic Profile</a>
				<?php endif; ?>
		    	<?php if (get_post_meta($post->ID, 'ecpt_twitter', true)) : ?>
		    		<span class="fa fa-twitter"></span> <a href="https://twitter.com/<?php echo get_post_meta($post->ID, 'ecpt_twitter', true); ?>" target="_blank"> @<?php echo get_post_meta($post->ID, 'ecpt_twitter', true); ?></a>
				<?php endif; ?>								
			</p>
		</div>
		<div class="small-12 medium-8 columns">
			<dl class="tabs" data-tab>
				<?php if ( get_post_meta($post->ID, 'ecpt_bio', true) ) : ?><dd class="active"><a href="#bioTab">Biography</a></dd><?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_research', true) ) : ?><dd><a href="#researchTab">Research</a></dd><?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_teaching', true) ) : ?><dd><a href="#teachingTab">Teaching</a></dd><?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_publications', true) || get_post_meta($post->ID, 'ecpt_microsoft_id', true) || get_post_meta($post->ID, 'ecpt_google_id', true)) : ?><dd><a href="#publicationsTab">Publications</a></dd><?php endif; ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_books_cond', true) == 'on' ) : ?><dd><a href="#booksTab">Books</a></dd><?php endif; ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_extra_tab_title', true) ) : ?><dd><a href="#extraTab"><?php echo get_post_meta($post->ID, 'ecpt_extra_tab_title', true); ?></a></dd><?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_extra_tab_title2', true) ) : ?><dd><a href="#extra2Tab"><?php echo get_post_meta($post->ID, 'ecpt_extra_tab_title2', true); ?></a></dd><?php endif; ?>
			</dl>
			
			<div class="tabs-content">
				<?php if ( get_post_meta($post->ID, 'ecpt_bio', true) ) : ?>
				<div class="content active" id="bioTab">
					<?php echo get_post_meta($post->ID, 'ecpt_bio', true); ?>
				</div>
				<?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_research', true) ) : ?>
				<div class="content" id="researchTab"><?php echo get_post_meta($post->ID, 'ecpt_research', true); ?></div>
				<?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_teaching', true) ) : ?>
				<div class="content" id="teachingTab"><?php echo get_post_meta($post->ID, 'ecpt_teaching', true); ?></div>
				<?php endif; ?>
				
				<?php if ( get_post_meta($post->ID, 'ecpt_publications', true) || get_post_meta($post->ID, 'ecpt_google_id', true) ) : ?>
					<div class="content" id="publicationsTab">
						<?php if ( get_post_meta($post->ID, 'ecpt_publications', true) ) : echo get_post_meta($post->ID, 'ecpt_publications', true); endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_books_cond', true) == 'on' ) : locate_template('/parts/faculty-books.php', true, false); endif;?>
				<?php if ( get_post_meta($post->ID, 'ecpt_extra_tab', true) ) : ?>
					<div class="content"  id="extraTab"><?php echo get_post_meta($post->ID, 'ecpt_extra_tab', true); ?></div>
				<?php endif; ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_extra_tab2', true) ) : ?>
					<div class="content" id="extra2Tab"><?php echo get_post_meta($post->ID, 'ecpt_extra_tab2', true); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>
	</div>	<!-- End main content (left) section -->
	</div> <!-- End #page -->
	<?php get_footer(); ?>