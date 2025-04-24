<?php
defined( 'ABSPATH' ) || exit;

/**
 * @psalm-var array{ id: int, description: string } $params
 */

wp_nonce_field( 'term_meta_box', 'term_meta_box_nonce' );
?>
<p>
	<?php
	wp_editor(
		$params['description'],
		'term_description',
		[
			'media_buttons' => false,
			'textarea_rows' => 10,
			'teeny'         => true,
			'quicktags'     => true,
		]
	);
	?>
</p>
