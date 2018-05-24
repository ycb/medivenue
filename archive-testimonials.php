<?php
/**
 * The main template file
 * Testimonials Archive
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package Hestia
 * @since Hestia 1.0
 * @modified 1.1.30
 */

get_header();

	$default_blog_layout        = hestia_sidebar_on_single_post_get_default();
	$hestia_blog_sidebar_layout = get_theme_mod( 'hestia_blog_sidebar_layout', $default_blog_layout );

	$args                 = array(
		'sidebar-right' => 'col-md-8 archive-post-wrap',
		'sidebar-left'  => 'col-md-8 archive-post-wrap',
		'full-width'    => 'col-md-10 col-md-offset-1 archive-post-wrap',
	);
	$hestia_sidebar_width = get_theme_mod( 'hestia_sidebar_width', 25 );
	if ( $hestia_sidebar_width > 3 && $hestia_sidebar_width < 80 ) {
		$args['sidebar-left'] .= ' col-md-offset-1';
	}

	$class_to_add     = hestia_get_content_classes( $hestia_blog_sidebar_layout, 'sidebar-1', $args );
	$class_of_content = ''; ?>
	<div id="primary" class="<?php echo hestia_boxed_layout_header(); ?> page-header header-small" data-parallax="active">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 text-center">
					<h1 class="hestia-title">Testimonials</h1>
				</div>
			</div>
		</div>
		<?php hestia_output_wrapper_header_background(); ?>
	</div>
</header>
<div class="<?php echo hestia_layout(); ?>">
	<div class="hestia-blogs">
		<div class="container">
			<div class="row">
				<?php
				if ( $hestia_blog_sidebar_layout === 'sidebar-left' ) {
					get_sidebar();
				}
				?>


<div class="<?php echo esc_attr( $class_to_add ); ?>">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();

							$testimonial_data = get_post_meta( get_the_ID(), '_testimonial', true );
					        $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
					        $source = ( empty( $testimonial_data['source'] ) ) ? '' : ' - ' . $testimonial_data['source'];
					        $link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
					        $cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;

							get_template_part( 'template-parts/content-testimonials' );
						endwhile;
						the_posts_pagination();
					else :
						get_template_part( 'template-parts/content-testimonials', 'none' );
					endif;
					?>

				</div>
  

   				<?php

				if ( $hestia_blog_sidebar_layout === 'sidebar-right' ) {
					get_sidebar();
				}
				 
				?>

			
			</div>
		</div>
	</div>
	<?php
	get_footer(); ?>
