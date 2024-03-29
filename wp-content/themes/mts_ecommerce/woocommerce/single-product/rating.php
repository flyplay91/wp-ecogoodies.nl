<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>

	<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', MTS_THEME_TEXTDOMAIN ), $average ); ?>">
			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', MTS_THEME_TEXTDOMAIN ), '<span itemprop="bestRating">', '</span>' ); ?>
				<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, MTS_THEME_TEXTDOMAIN ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
			</span>
		</div>
		<?php if ( comments_open() ) : ?>
			<div class="review-count-wrap">
				<span class="review-count"><?php printf( _n( '%s Review', '%s Reviews', $review_count, MTS_THEME_TEXTDOMAIN ), '<span itemprop="ratingCount" class="count">' . $review_count . '</span>' ); ?></span><a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php _e('Add Your Review', MTS_THEME_TEXTDOMAIN)?></a>
			</div>
		<?php endif ?>

		<?php $tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) ); ?>
		<div class="product_meta">
			<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, MTS_THEME_TEXTDOMAIN ) . ' ', '.</span>' ); ?>
		</div>
	
	</div>
	
<?php endif; ?>
	
