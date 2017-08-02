<?php
$mts_options = get_option(MTS_THEME_NAME);
if ( mts_isWooCommerce() ) { ?>
	<div class="featured-product-tabs home-section clearfix">
		<div class="container">
			<ul class="tabs">
				<li class="tab active loaded"><a href="#" data-tab="best_sellers_tab"><?php _e('Best sellers',MTS_THEME_TEXTDOMAIN); ?></a></li>
				<li class="tab"><a href="#" data-tab="new_products_tab"><?php _e('New Arrivals',MTS_THEME_TEXTDOMAIN); ?></a></li>
				<li class="tab"><a href="#" data-tab="top_rated_tab"><?php _e('Top Rated',MTS_THEME_TEXTDOMAIN); ?></a></li>
			</ul>
			<div class="tabs-content">
				<div class="tab-content best_sellers_tab active">
					<?php
					$best_sellers_args = array( 'meta_key' => 'total_sales', 'orderby' => 'meta_value_num','posts_per_page' => 4, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product');
					$best_sellers_args['meta_query'] = WC()->query->get_meta_query();
					$best_sellers_query = new WP_Query( apply_filters( 'ecommerce_homepage_tab_args', $best_sellers_args, 'best_sellers_tab' ) );

					if ( $best_sellers_query->have_posts() ) {

						echo '<ul class="products woocommerce">';

						while ( $best_sellers_query->have_posts() ) {
							$best_sellers_query->the_post();
							wc_get_template( 'content-product-featured-carousel.php' );
						}

						echo '</ul>';
					}

					wp_reset_postdata();
					?>
				</div>
				<div class="tab-content new_products_tab">
				</div>
				<div class="tab-content top_rated_tab">
				</div>
			</div>
		</div>
	</div>
<?php } ?>