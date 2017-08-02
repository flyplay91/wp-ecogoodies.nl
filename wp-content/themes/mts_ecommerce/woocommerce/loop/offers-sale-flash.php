<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $mts_options;

?>
<div class="mts-product-badges">
<?php if ( $product->is_on_sale() ) : ?>

	<?php
	
	$sale_price = $product->sale_price;
	$regular_price = $product->regular_price;

	if ( 'variable' == $product->product_type  ) {
		$available_variations = $product->get_available_variations();
		$variation_id = $available_variations[0]['variation_id'];
		$variation = new WC_Product_Variation( $variation_id );
		$regular_price = $variation->regular_price;
		$sale_price = $variation->sale_price;
	}

	if ( !empty( $regular_price ) ){
		$sale = ceil( ( ($regular_price - $sale_price) / $regular_price ) * 100 );
	}
	?>

	<?php if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) : ?>
		<?php echo apply_filters( 'mts_offers_sale_flash', '<span class="onsale-badge">-' . $sale . '%</span>', $post, $product ); ?>
	<?php endif; ?>

<?php endif; ?>
</div>