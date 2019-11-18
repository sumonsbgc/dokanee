<?php
/**
 * The template for displaying all product categories.
 *
 * @package dokani
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php dokani_content_class(); ?>>
		<main id="main" <?php dokani_main_class(); ?>>

			<?php

			/**
			 * dokani_before_main_content hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'dokani_before_main_content' ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php dokani_article_schema( 'CreativeWork' ); ?>>
				<div class="inside-article">
					<?php

					$args = array(
						'orderby'    => 'name',
						'order'      => 'ASC',
						'hide_empty' => true,
						'taxonomy'   => 'product_cat',
					);
					$categories = get_categories( $args );

					if ( $categories ) {

						foreach ( $categories as $cat ) {
							if($cat->category_parent == 0) {
								echo '<div class="cat-wrapper">';
								echo '<h3 class="cat-title"><a href="' . get_category_link( $cat->cat_ID ) . '">' . $cat->name . '</a></h3>';

								$args = array(
									'child_of'   => $cat->cat_ID,
								);

								$sub_cats = get_terms( 'product_cat', $args );

								if($sub_cats){
									echo '<ul>';
									foreach ( $sub_cats as $sub_cat ) {
										echo '<li><a href="' . get_category_link( $sub_cat->term_id ) . '">' . $sub_cat->name . '</a></li>';
									}
									echo '</ul>';
								}
								echo '</div>';
							}
						}

					} else {
						echo "No category found";
					}

					?>
				</div>
			</article>

			<?php
			/**
			 * dokani_after_main_content hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'dokani_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
/**
 * dokani_after_primary_content_area hook.
 *
 * @since 1.0.0
 */
do_action( 'dokani_after_primary_content_area' );

dokani_construct_sidebars();

get_footer();
