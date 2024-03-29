<?php
/**
 * Related Products Carousel
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related-products">
		<div class="featured-category-title"><?php _e( 'Related Products', MTS_THEME_TEXTDOMAIN ); ?></div>
		<div class="related-products-container clearfix">
        	<div id="slider" class="related-products-category">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product-related-carousel' ); ?>

			<?php endwhile; // end of the loop. ?>
			</div>
			<div class="custom-nav">
          <a class="btn related-products-prev"><i class="fa fa-angle-left"></i></a>
          <a class="btn related-products-next"><i class="fa fa-angle-right"></i></a>
        </div>
		</div>
	</div>

<?php endif;

wp_reset_postdata();