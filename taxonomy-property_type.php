<?php
/**
 * The template for displaying Property type taxonomy pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FinleadProperty
 */

get_header();

$title = '';
$queried_object = get_queried_object();
if ( isset($queried_object->taxonomy) && $queried_object->taxonomy == 'property_type' ) {
    $title = $queried_object->name;
}
?>

    <section class="page-content py-5">
        <div class="container">
            <div class="title-container">

                <h1 class="page-title"><?php
                    echo esc_html($title); ?></h1>
            </div>
            <div class="property-archive row">
                <?php
                while ( have_posts() ) {
                    the_post();

                    get_template_part('template-parts/property');
                } ?>
            </div>

            <?php
            $args = array(
                'prev_next' => true,
                'prev_text' => '<span class="pagination-prev">&laquo;</span>',
                'next_text' => '<span class="pagination-next">&raquo;</span>',
                'add_args' => false,
                'add_fragment' => '',
                'screen_reader_text' => ' ',
                'aria_label' => __('Недвижимость'),
            );
            $nav = get_the_posts_pagination($args);
            echo $nav; ?>
        </div>
    </section>

<?php

get_footer();
