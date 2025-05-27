<?php

namespace RusAggression\TermCPT;

use WP_Post;

final class Admin {
	/** @var self|null */
	private static $instance;

	public static function get_instance(): self {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->init();
	}

	public function init(): void {
		add_action( 'admin_init', [ $this, 'admin_init' ] );
	}

	public function admin_init(): void {
		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
		add_filter( 'wp_insert_post_data', [ $this, 'wp_insert_post_data' ] );
	}

	public function add_meta_boxes(): void {
		add_meta_box(
			'term_details',
			__( 'Term Details', 'term-cpt' ),
			[ $this, 'term_meta_box_callback' ],
			'term',
			'normal',
			'high'
		);
	}

	public function term_meta_box_callback( WP_Post $post ): void {
		$params = [
			'id'          => $post->ID,
			'description' => get_post_field( 'post_content', $post->ID, 'edit' ),
		];

		self::render( 'term-metabox', $params );
	}

	public function wp_insert_post_data( array $data ): array {
		if ( ! isset( $_POST['term_meta_box_nonce'] ) ||
			! is_string( $_POST['term_meta_box_nonce'] ) ||
			! wp_verify_nonce( sanitize_text_field( $_POST['term_meta_box_nonce'] ), 'term_meta_box' )
		) {
			return $data;
		}

		if ( isset( $_POST['term_description'] ) && is_string( $_POST['term_description'] ) ) {
			$data['post_content'] = wp_kses_post( $_POST['term_description'] );
		}

		return $data;
	}

	/**
	 * @psalm-suppress UnusedParam
	 */
	// phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
	private static function render( string $template, array $params = [] ): void /* NOSONAR */ {
		/** @psalm-suppress UnresolvableInclude */
		require __DIR__ . '/../views/' . $template . '.php'; // NOSONAR
	}
}
