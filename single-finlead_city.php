<?php
/**
 * The template for displaying all single city
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FinleadProperty
 */

get_header();

$fin_assigned_properties = get_post_meta(get_the_ID(), 'fin_assigned_properties', true) ? unserialize(
    get_post_meta(get_the_ID(), 'fin_assigned_properties', true)
) : [];

$post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
$post_image = $post_thumbnail ?: get_stylesheet_directory_uri() . '/assets/images/no-image.webp';
?>


    <section class="page-content py-5">
        <div class="container">

            <div class="single-city">

                <div class="single-city__image mb-3 d-flex object-fit-cover">
                    <img src="<?php
                    echo esc_url($post_image); ?>" alt="<?php
                    echo get_the_title(); ?>" title="<?php
                    echo get_the_title(); ?>" loading="lazy" class="rounded"/>
                </div>


                <h1 class="city-single-title"><?php
                    echo get_the_title(); ?></h1>

                <div class="d-flex justify-content-between">

                    <?php
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    } ?>

                </div>

                <div class="property-archive row">

                    <?php
                    if ( !empty($fin_assigned_properties) ) {
                        $args = array(
                            'post_type' => 'finlead_property',
                            'posts_per_page' => 10,
                            'post__in' => $fin_assigned_properties,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        $query = new \WP_Query($args);

                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                get_template_part('template-parts/property');
                            }
                        }

                        wp_reset_postdata();
                    } ?>
                </div>

            </div>
        </div>
    </section>


<?php

get_footer();
