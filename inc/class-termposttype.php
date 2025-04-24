<?php

namespace RusAggression\TermCPT;

final class TermPostType {
	public static function register(): void {
		if ( post_type_exists( 'term' ) ) {
			return;
		}

		$labels = [
			'name'               => _x( 'Terms', 'post type general name', 'term-cpt' ),
			'singular_name'      => _x( 'Term', 'post type singular name', 'term-cpt' ),
			'menu_name'          => _x( 'Term', 'admin menu', 'term-cpt' ),
			'add_new'            => _x( 'Add New', 'database', 'term-cpt' ),
			'add_new_item'       => __( 'Add New Term', 'term-cpt' ),
			'edit_item'          => __( 'Edit Term', 'term-cpt' ),
			'new_item'           => __( 'New Term', 'term-cpt' ),
			'view_item'          => __( 'View Term', 'term-cpt' ),
			'search_items'       => __( 'Search Terms', 'term-cpt' ),
			'not_found'          => __( 'No terms found', 'term-cpt' ),
			'not_found_in_trash' => __( 'No terms found in trash', 'term-cpt' ),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'has_archive'        => true,
			'publicly_queryable' => true,
			'query_var'          => true,
			'rewrite'            => [ 'slug' => 'term' ],
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'supports'           => [ 'title', 'thumbnail' ],
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-tag',
			'show_in_rest'       => true,
			'rest_base'          => 'terms',
		];

		register_post_type( 'term', $args );
	}

	public static function unregister(): void {
		unregister_post_type( 'term' );
	}
}
