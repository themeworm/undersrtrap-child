<?php
/**
 * The template for displaying all single property
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FinleadProperty
 */

get_header();

if ( function_exists('get_field') ) {
    $property_attributes = get_property_meta(get_the_ID());
    $property_photos = get_field('property_photos', get_the_ID());

    $post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $post_image = $post_thumbnail ?: get_stylesheet_directory_uri() . '/assets/images/no-image.webp';
    ?>


    <section class="page-content py-5">
        <div class="container">

            <div class="single-property">

                <div class="single-property__image mb-3 d-flex object-fit-cover">
                    <img src="<?php
                    echo esc_url($post_image); ?>" alt="<?php
                    echo get_the_title(); ?>" title="<?php
                    echo get_the_title(); ?>" loading="lazy" class="rounded"/>
                </div>

                <h1 class="projects-single-title"><?php
                    echo get_the_title(); ?></h1>

                <div class="row">
                    <div class="col-12 col-lg-9">
                        <?php
                        while ( have_posts() ) {
                            the_post(); ?>
                            <?php
                            the_content(); ?>
                        <?php
                        } ?>
                    </div>
                    <div class="col-12 col-lg-3">

                        <?php
                        if ( !empty($property_attributes) ) { ?>
                            <div class="property-attributes">
                                <?php
                                foreach ( $property_attributes as $name => $attribute ) {
                                    if ( !empty($attribute['value']) ) { ?>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap text-secondary"><?php
                                            echo esc_html($attribute['title']); ?>:

                                            <?php if ($name === 'property_address') { ?>
                                                <div class="small text-dark"><strong><?php echo esc_html($attribute['value']); ?></strong></div>
                                            <?php } else { ?>

                                                <span class="badge bg-primary text-light"><?php
                                                    echo esc_html($attribute['value']); ?>
                                                </span>

                                            <?php
                                            } ?>
                                        </div>
                                    <?php
                                    }
                                } ?>
                            </div>
                        <?php
                        } ?>
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'property_type');
                        if ( $terms && !is_wp_error($terms) ) { ?>
                            <div class="property-single-tags my-4">
                                <div class="text-secondary"><?php
                                    esc_html_e('Тип недвижимости:', 'finlead-property'); ?></div>
                                <?php
                                foreach ( $terms as $term ) { ?>
                                    <span class="badge bg-secondary text-light">#<a href="<?php
                                        echo get_term_link($term); ?>" class="text-white"><?php
                                            echo $term->name; ?></a></span>
                                <?php
                                } ?>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>

	            <?php
	            if ( ! empty( $property_photos ) ) { ?>
                    <h2><?php esc_html_e('Фотографии объекта', 'agency-configurator') ?></h2>
                    <div class="property-photos row py-3">
			            <?php
			            $i     = 0;
			            $total = count( $property_photos );
			            foreach ( $property_photos as $photo ) {
				            ++ $i; ?>
                            <div class="col-12 col-md-6 col-lg-4 my-3 d-flex">
                                <a href="<?php
					            echo esc_url( $photo ); ?>" data-bs-toggle="modal" data-bs-target="#photo-<?php
					            echo $i; ?>">
                                    <img src="<?php
						            echo esc_url( $photo ); ?>" alt="" loading="lazy" class="rounded object-fit-cover"/>
                                </a>

                                <div id="photo-<?php
					            echo $i; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                     aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                                <img src="<?php
									            echo esc_url( $photo ); ?>" alt="<?php
									            echo get_the_title(); ?>" loading="lazy"
                                                     class="rounded object-fit-cover"/>
                                            </div>
                                            <div class="modal-footer">
									            <?php
									            if ( $i !== 1 ) { ?>
                                                    <button class="btn btn-primary" data-bs-target="#photo-<?php
										            echo $i - 1; ?>" data-bs-toggle="modal">Назад
                                                    </button>
									            <?php
									            } ?>

									            <?php
									            if ( $i !== $total ) { ?>
                                                    <button class="btn btn-primary" data-bs-target="#photo-<?php
										            echo $i + 1; ?>" data-bs-toggle="modal">Вперед
                                                    </button>
									            <?php
									            } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
				            <?php
			            } ?>
                    </div>
		            <?php
	            } ?>

            </div>
        </div>
    </section>


<?php }

get_footer();
