<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $woocommerce;
?>
<ul id="checkout-progress" class="clearfix">
	<li class="active"><a href="#" class="disabled"><span class="step-title"><?php _e( 'Shopping Cart', MTS_THEME_TEXTDOMAIN ); ?></span><span class="items"><?php echo $woocommerce->cart->cart_contents_count; ?></span></a><span class="icon"><i class="fa fa-angle-right"></i></span></li>
	<li><a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ) ?>"><span class="step-title"><?php _e( 'Checkout Details', MTS_THEME_TEXTDOMAIN ); ?></span></a><span class="icon"><i class="fa fa-angle-right"></i></span></li>
	<li><a href="#" class="disabled"><span class="step-title"><?php _e( 'Order Complete', MTS_THEME_TEXTDOMAIN ); ?></span></a></li>
</ul>
<?php
$mts_options = get_option( MTS_THEME_NAME );
wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

	<div class="c-8-12">

		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<table class="shop_table cart" cellspacing="0">
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="product-remove">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', MTS_THEME_TEXTDOMAIN ) ), $cart_item_key );
								?>
							</td>

							<td class="product-thumbnail">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $_product->is_visible() )
										echo $thumbnail;
									else
										printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
								?>
							</td>

							<td class="product-data">
								<?php
									echo '<div class="product-name">';
									if ( ! $_product->is_visible() )
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
									else
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );
									echo '</div>';
									// Meta data
									echo WC()->cart->get_item_data( $cart_item );

		               				// Backorder notification
		               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
		               					echo '<p class="backorder_notification">' . __( 'Available on backorder', MTS_THEME_TEXTDOMAIN ) . '</p>';

		               				echo sprintf( '<dl><dt>%s</dt><dd>%s</dd></dl>', __('Unit Price:', MTS_THEME_TEXTDOMAIN ), apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) );
								?>
							</td>

							<td class="product-quantity">
								<?php
									echo sprintf( '<span class="mts-cart-label clearfix">%s</span>', __('Quantity:', MTS_THEME_TEXTDOMAIN ) );
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
											'min_value'   => '0'
										), $_product, false );
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
								?>
							</td>

							<td class="product-subtotal">
								<?php
									echo sprintf( '<span class="mts-cart-label clearfix">%s</span>%s', __('Total:', MTS_THEME_TEXTDOMAIN ), apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) );
								?>
							</td>
						</tr>
						<?php
					}
				}

				do_action( 'woocommerce_cart_contents' );
				?>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_after_cart_table' ); ?>

	</div>

	<div class="c-4-12">
		<div class="cart-actions clearfix">
			<?php if ( WC()->cart->coupons_enabled() ) { ?>
				<div class="coupon">

					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Enter Coupon code', MTS_THEME_TEXTDOMAIN ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'OK', MTS_THEME_TEXTDOMAIN ); ?>" />

					<?php do_action('woocommerce_cart_coupon'); ?>

				</div>
			<?php } ?>

			<?php woocommerce_cart_totals(); ?>

			<input type="submit" class="button update-cart-button" name="update_cart" value="<?php _e( 'Update Cart', MTS_THEME_TEXTDOMAIN ); ?>" />

			<a href="<?php echo esc_url( wc_get_checkout_url() ) ;?>" class="checkout-button button">
				<?php _e( 'Proceed to Checkout', MTS_THEME_TEXTDOMAIN ); ?>
			</a>

			<?php //do_action( 'woocommerce_proceed_to_checkout' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>

	</div>

</form>

<div class="cart-collaterals c-8-12">
	<?php do_action( 'woocommerce_cart_collaterals' ); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>