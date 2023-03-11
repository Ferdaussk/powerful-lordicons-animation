<?php
namespace plordiconsa_lordicons_namespace\PageSettings;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\PageBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Page_Settings {

	const PANEL_TAB = 'new-tab';

	public function __construct() {
		add_action( 'elementor/init', [ $this, 'plordiconsa_adlordicons_add_panel_tab' ] );
		add_action( 'elementor/documents/register_controls', [ $this, 'plordiconsa_adlordicons_register_document_controls' ] );
	}

	public function plordiconsa_adlordicons_add_panel_tab() {
		Controls_Manager::add_tab( self::PANEL_TAB, esc_html__( 'Powerful Lordicons Animation', 'powerful-lordicons-animation' ) );
	}

	public function plordiconsa_adlordicons_register_document_controls( $document ) {
		if ( ! $document instanceof PageBase || ! $document::get_property( 'has_elements' ) ) {
			return;
		}

		$document->start_controls_section(
			'plordiconsa_new_section',
			[
				'label' => esc_html__( 'Settings', 'powerful-lordicons-animation' ),
				'tab' => self::PANEL_TAB,
			]
		);

		$document->add_control(
			'plordiconsa_text',
			[
				'label' => esc_html__( 'Title', 'powerful-lordicons-animation' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'powerful-lordicons-animation' ),
			]
		);

		$document->end_controls_section();
	}
}
