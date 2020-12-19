<?php
namespace WowDiviCarouselLite;

defined( 'ABSPATH' ) || die();

class AssetsManager {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {

		wp_enqueue_style(
			'wdcl-slick',
			WDCL_PLUGIN_ASSETS . 'vendor/slick/slick.css',
			null,
			WDCL_PLUGIN_VERSION
		);

		wp_enqueue_style(
			'wdcl-slick-theme',
			WDCL_PLUGIN_ASSETS . 'vendor/slick/slick-theme.css',
			null,
			WDCL_PLUGIN_VERSION
		);

		wp_enqueue_script(
			'wdcl-slick',
			WDCL_PLUGIN_ASSETS . 'vendor/slick/slick.min.js',
			array( 'jquery' ),
			WDCL_PLUGIN_VERSION,
			true
		);

	}

}

new AssetsManager();
