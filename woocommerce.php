<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrapwp
 */

get_header();
?>
	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-9 col-lg-9">
				<main id="main" class="site-main">
                    <?php woocommerce_content(); ?>
				</main><!-- #main -->
			</div><!-- #primary -->
	

<?php
get_sidebar();
get_footer();
