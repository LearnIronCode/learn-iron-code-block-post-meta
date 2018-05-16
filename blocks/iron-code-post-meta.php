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
	) );
}
add_action( 'init', 'iron_code_post_meta_block_init' );
