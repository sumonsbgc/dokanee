<div id="dokan-seller-listing-wrap">
    <div class="seller-listing-content">
		<?php if ( $sellers ) : ?>
            <ul class="dokan-seller-list column-<?php echo $per_row; ?>">
				<?php
				foreach ( $sellers as $seller ) {
					$store_info      = dokan_get_store_info( $seller->get_id() );
					$banner_id       = isset( $store_info['banner'] ) ? $store_info['banner'] : 0;
					$store_name      = isset( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : __( 'N/A',
						'dokani' );
					$store_url       = dokan_get_store_url( $seller->get_id() );
					$store_address   = dokan_get_seller_short_address( $seller->get_id() );
					$seller_rating   = dokan_get_seller_rating( $seller->get_id() );
					$banner_url      = ( $banner_id ) ? wp_get_attachment_image_src( $banner_id,
						$image_size ) : get_template_directory_uri() . '/assets/images/single-default-store-banner.png';
					$featured_seller = get_user_meta( $seller->get_id(), 'dokan_feature_seller', true );
					?>

                    <li class="dokan-single-seller woocommerce <?php echo ( ! $banner_id ) ? 'no-banner-img' : ''; ?>">
                        <div class="store-content">
                            <div class="featured-favourite">
								<?php if ( ! empty( $featured_seller ) && 'yes' == $featured_seller ): ?>
                                    <span class="featured-label"><?php _e( 'Featured', 'dokani' ); ?></span>
								<?php endif ?>

								<?php do_action( 'dokan_seller_listing_after_featured', $seller, $store_info ); ?>
                            </div>
                            <div class="store-banner">
								<?php
								if ( is_array( $banner_url ) ) { ?>
                                    <a href="<?php echo esc_url( $store_url ); ?>">
                                        <img src="<?php echo esc_url( $banner_url[0] ); ?>"
                                             alt="<?php echo esc_attr( $store_name ); ?>">
                                    </a>
								<?php } else { ?>
                                    <a href="<?php echo esc_url( $store_url ); ?>">
                                        <img src="<?php echo esc_url( $banner_url ); ?>"
                                             alt="<?php echo esc_attr( $store_name ); ?>">
                                    </a>
								<?php }
								?>
                            </div>
                            <div class="seller-avatar">
								<?php echo get_avatar( $seller->get_id(), 55 ); ?>
                            </div>
                        </div>
                        <div class="store-footer">
                            <div class="store-data">
                                <h2><a href="<?php echo esc_url( $store_url ); ?>"><?php echo $store_name; ?></a></h2>

								<?php do_action( 'dokan_seller_listing_after_store_data', $seller, $store_info ); ?>

                            </div>

							<?php do_action( 'dokan_seller_listing_footer_content', $seller->data, $store_info ); ?>
                        </div>
                    </li>

				<?php } ?>
                <div class="dokan-clearfix"></div>
            </ul> <!-- .dokan-seller-wrap -->
		<?php else: ?>
            <p class="dokan-error"><?php _e( 'No vendor found!', 'dokani' ); ?></p>
		<?php endif; ?>
    </div>
</div>