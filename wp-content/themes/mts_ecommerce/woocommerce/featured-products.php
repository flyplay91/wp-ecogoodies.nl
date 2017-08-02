<?php
/**
 * Featured Products Carousel
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$mts_options = get_option( MTS_THEME_NAME );

global $product, $woocommerce_loop;

$args = array(
	'post_type'				=> 'product',
	'post_status' 			=> 'publish',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 	    => $mts_options['mts_featured_products_num'],
	'orderby' 	            => 'date',
	'order' 	            => 'desc',
	'meta_query'			=> array(
		array(
			'key' 		=> '_visibility',
			'value' 	=> array('catalog', 'visible'),
			'compare'	=> 'IN'
		),
		array(
			'key' 		=> '_featured',
			'value' 	=> 'yes'
		)
	)
);

$products = new WP_Query( apply_filters( 'mts_featured_products_query', $args ) );

if ( $products->have_posts() ) : ?>
<div class="woocommerce">
	<div class="featured-products">
		<div class="featured-category-title"><?php _e( 'Featured Products',MTS_THEME_TEXTDOMAIN ); ?></div>
		<div class="featured-products-container clearfix">
	    	<div id="slider" class="featured-products-category">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product-featured-carousel' ); ?>

			<?php endwhile; // end of the loop. ?>

			</div>
			<div class="custom-nav">
	          <a class="btn featured-products-prev"><i class="fa fa-angle-left"></i></a>
	          <a class="btn featured-products-next"><i class="fa fa-angle-right"></i></a>
	        </div>
		</div>
	</div>
</div>
<?php endif;

wp_reset_postdata();