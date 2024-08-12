<?php
/**
 * Template part for displaying property
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FinleadProperty
*/

$property_attributes = get_property_meta( get_the_ID() );

$post_thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$post_image     = $post_thumbnail ?: get_stylesheet_directory_uri() . '/assets/images/no-image.webp';

?>

<article id="post-<?php
the_ID(); ?>" <?php
post_class( 'property-archive-item col-12 col-lg-6 position-relative rounded overflow-hidden my-3' ); ?>>
    <a href="<?php
	echo get_the_permalink(); ?>" aria-label="<?php
	echo get_the_title(); ?>" class="text-dark">
        <div class="property-item-top h-100">
            <img class="rounded h-100 object-fit-cover" src="<?php
			echo esc_url( $post_image ); ?>" loading="lazy" alt="<?php
			echo get_the_title(); ?>">
        </div>

        <div class="property-item-attributes position-absolute bottom-0 p-3 pt-5">
			<?php
			if ( ! empty( $property_attributes ) ) { ?>
                <h4 class="property-item-title">
					<?php
					echo wp_trim_words( get_the_title(), 6, '...' ); ?>
                </h4>
                <div class="property-attributes d-flex flex-wrap justify-content-start">
					<?php
					foreach ( $property_attributes as $attribute ) {
						if ( ! empty( $attribute['value'] ) ) { ?>
                            <div class="d-flex justify-content-between align-items-center small"><?php
								echo esc_html( $attribute['title'] ); ?>: <span class="badge bg-light text-dark mx-2"><?php
									echo esc_html( $attribute['value'] ); ?></span></div>
							<?php
						}
					} ?>

					<?php
					$terms = get_the_terms( get_the_ID(), 'property_type' );
					if ( $terms && ! is_wp_error( $terms ) ) { ?>
                        <div class="d-flex justify-content-between align-items-center small"><?php
							esc_html_e( 'Тип:', 'finlead-property' ); ?>
							<?php
							foreach ( $terms as $term ) { ?>
                                <span class="badge bg-light text-dark mx-2"><?php
									echo $term->name; ?></span>
								<?php
							} ?>
                        </div>
						<?php
					} ?>
                </div>
				<?php
			} ?>
        </div>
    </a>
</article>
