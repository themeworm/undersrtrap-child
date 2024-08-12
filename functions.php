<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles(): void
{
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

/* ----------------------------------------------------- */
/* Theme ACF Options */
/* ----------------------------------------------------- */

add_filter('acf/settings/show_admin', '__return_false');
add_filter('acf/settings/show_updates', '__return_false');

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );

function my_acf_json_save_point( $path ): string
{
    return get_stylesheet_directory() . '/acf-json';
}

function my_acf_json_load_point( $paths ) {
	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/acf-json';

	return $paths;
}

function get_property_meta(int $post_id): array {
	$property_attributes = [];

	if ( !function_exists('get_field') ) {
		return $property_attributes;
	}

	$fields = [
		'property_area'        => [
			'title' => esc_html__( 'Площадь', 'finlead-property' ),
			'unit'  => ' ' . esc_html__( 'м2', 'finlead-property' )
		],
		'property_price'       => [
			'title' => esc_html__( 'Стоимость', 'finlead-property' ),
			'unit'  => ' ' . esc_html__( 'р.', 'finlead-property' )
		],
		'property_living_area' => [
			'title' => esc_html__( 'Жилая площадь', 'finlead-property' ),
			'unit'  => ' ' . esc_html__( 'м2', 'finlead-property' )
		],
		'property_floor'       => [ 'title' => esc_html__( 'Этаж', 'finlead-property' ) ],
		'property_address'     => [ 'title' => esc_html__( 'Адрес', 'finlead-property' ) ],
	];

	foreach ( $fields as $field => $meta ) {
		$value = get_field( $field, $post_id );
		$property_attributes[ $field ] = [
			'value' => $value ? ( $value . ( $meta['unit'] ?? '' ) ) : '',
			'title' => $meta['title'],
		];
	}

	return $property_attributes;
}