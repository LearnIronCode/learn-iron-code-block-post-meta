<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package learn-iron-code-block-post-meta
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function iron_code_post_meta_block_init() {
	// Until Gutenberg is merged into WordPress core, register_block_type()
	// will only exist when the Gutenberg plugin is installed and activated.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	$dir = dirname( __FILE__ );

	$index_js = 'iron-code-post-meta/index.js';
	wp_register_script(
		'iron-code-post-meta-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'iron-code-post-meta/editor.css';
	wp_register_style(
		'iron-code-post-meta-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(
			'wp-blocks',
		),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'iron-code-post-meta/style.css';
	wp_register_style(
		'iron-code-post-meta-block',
		plugins_url( $style_css, __FILE__ ),
		array(
			'wp-blocks',
		),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'learn-iron-code-block-post-meta/iron-code-post-meta', array(
		'editor_script' => 'iron-code-post-meta-block-editor',
		'editor_style'  => 'iron-code-post-meta-block-editor',
		'style'         => 'iron-code-post-meta-block',
		'render_callback' => 'iron_code_post_meta_block_render_callback',
	) );
}
add_action( 'init', 'iron_code_post_meta_block_init' );

/**
 * Iron_code_post_meta_block_render_callback
 *
 * @param mixed $attributes Attributes from the block we are rendering.
 * @return string Markup to output on the page.
 */
function iron_code_post_meta_block_render_callback( $attributes ) {
	return sprintf( '<div class="wp-block-learn-iron-code-block-post-meta-iron-code-post-meta">Stored Post Meta Value (<code>fe_learn_post_meta_block</code>) is: "<code>%s</code>"</div>',
		esc_html( get_post_meta( get_the_ID(), 'fe_learn_post_meta_block', true ) )
	);
}

add_action( 'init', 'expose_post_meta_to_rest_fe_learn_post_meta_block' );

/**
 * Expose_post_meta_to_rest_fe_learn_post_meta_block
 *
 * Expose our the post meta value with key 'fe_learn_post_meta_block'
 * to the REST API (by default post meta values are not accessible via
 * the REST API).
 */
function expose_post_meta_to_rest_fe_learn_post_meta_block() {
	register_meta(
		'post',
		'fe_learn_post_meta_block',
		[
			'type'         => 'string',
			'single'       => true,
			'show_in_rest' => true,
		]
	);
}
