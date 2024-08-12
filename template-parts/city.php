<?php
/**
 * Template part for displaying city
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FinleadProperty
 */

$post_thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$post_image     = $post_thumbnail ?: get_stylesheet_directory_uri() . '/assets/images/no-image.webp';

?>

<article id="post-<?php
the_ID(); ?>" <?php
post_class( 'city-archive-item col-12 col-lg-6 position-relative rounded overflow-hidden my-3' ); ?>>
    <a href="<?php
	echo get_the_permalink(); ?>" aria-label="<?php
	echo get_the_title(); ?>" class="text-dark">
        <div class="project-item-top">

            <img class="rounded" src="<?php
			echo esc_url( $post_image ); ?>" loading="lazy" alt="<?php
			echo get_the_title(); ?>">

        </div>

        <div class="city-item-attributes position-absolute bottom-0 p-3 pt-5">
            <h4 class="city-item-title">
				<?php
				echo get_the_title(); ?>
            </h4>
            <div class="city-item__description small">
				<?php
				echo wp_trim_words( get_the_content(), 15, '...' ); ?>
            </div>
        </div>
    </a>
</article>
