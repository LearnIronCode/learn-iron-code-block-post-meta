( function( wp ) {
	/**
	 * Registers a new block provided a unique name and an object defining its behavior.
	 * @see https://github.com/WordPress/gutenberg/tree/master/blocks#api
	 */
	var registerBlockType = wp.blocks.registerBlockType;
	/**
	 * Returns a new element of given type. Element is an abstraction layer atop React.
	 * @see https://github.com/WordPress/gutenberg/tree/master/element#element
	 *
	 * TextControl Renders a text input field.
	 * @see https://github.com/WordPress/gutenberg/blob/master/components/text-control
	 */
	var el = wp.element.createElement,
		TextControl = wp.components.TextControl;

	/**
	 * Retrieves the translation of text.
	 * @see https://github.com/WordPress/gutenberg/tree/master/i18n#api
	 */
	var __ = wp.i18n.__;

	/**
	 * Every block starts by registering a new block type definition.
	 * @see https://wordpress.org/gutenberg/handbook/block-api/
	 */
	registerBlockType( 'learn-iron-code-block-post-meta/iron-code-post-meta', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __( 'Iron Code Post Meta' ),

		/**
		 * Add dashicon icon in Gutenberg block selector.
		 * @see https://developer.wordpress.org/resource/dashicons/#welcome-learn-more
		 */
		icon: 'welcome-learn-more',

		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'widgets',

		/**
		 * Optional block extended support features.
		 */
		supports: {
			// Removes support for an HTML mode.
			html: false,
		},

		/**
		 * The edit function describes the structure of your block in the context of the editor.
		 * This represents what the editor will render when the block is used.
		 * @see https://wordpress.org/gutenberg/handbook/block-edit-save/#edit
		 *
		 * @param {Object} [props] Properties passed from the editor.
		 * @return {Element}       Element to render.
		 */
		edit: function( props ) {

			/**
			 * Function to update "myVal" attribute.
			 */
			function onChangeMyVal( newMyVal ) {
				// Update the value that will be stored in post meta.
				props.setAttributes( { myVal: newMyVal } );
			}

			/**
			 * Render our block for the editor using our myVal attribute.
			 *
			 * Additionally, assign an onChange function for updating the myVal attribute.
			 */
			return el(
				TextControl,
				{
					className: props.className,
					onChange: onChangeMyVal,
					placeHolder: __('Enter your post meta value here'),
					value: props.attributes.myVal
				}
			);
		},

		/**
		 * The save function defines the way in which the different attributes should be combined
		 * into the final markup, which is then serialized by Gutenberg into `post_content`.
		 * @see https://wordpress.org/gutenberg/handbook/block-edit-save/#save
		 *
		 * @return {Element}       Element to render.
		 */
		save: function() {
			// Our meta attribute is automatically saved to post meta.
			return null;
		}
	} );
} )(
	window.wp
);
