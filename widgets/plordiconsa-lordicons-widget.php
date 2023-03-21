<?php
namespace plordiconsa_lordicons_namespace\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PLORDICONSA_Effective_widgets extends Widget_Base {

	public function get_name() {
		return esc_html__( 'PowerfulLordiconsAnimation', 'powerful-lordicons-animation' );
	}

	public function get_title() {
		return esc_html__( 'Powerful Lordicons Animation', 'powerful-lordicons-animation' );
	}

	public function get_icon() {
		return 'plordiconsa-effective-icon eicon-animation';
	}

	public function get_categories() {
		return [ 'bwdthebest_general_category' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'plordiconsa_section_general_settings',
			array(
				'label' => esc_html__( 'General Settings', 'powerful-lordicons-animation' ),
			)
		);

		$this->add_control(
			'plordiconsa_source',
			array(
				'label'   => esc_html__( 'File Source', 'powerful-lordicons-animation' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'url'  => esc_html__( 'External URL', 'powerful-lordicons-animation' ),
					'file' => esc_html__( 'Media File', 'powerful-lordicons-animation' ),
				),
				'default' => 'url',
			)
		); // 

		$this->add_control(
			'plordiconsa_lordicons_url',
			array(
				'label'       => esc_html__( 'Animation JSON URL', 'powerful-lordicons-animation' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default' 		=> 'https://cdn.lordicon.com/vixtkkbk.json',
				'description' => 'Get URL/JSON file from <a href="https://lordicon.com/icons" target="_blank">here...!!</a> Follow <a href="https://prnt.sc/G0sKSPQLyi78" target="_blank">here...!!!</a>',
				'label_block' => true,
				'condition'   => array(
					'plordiconsa_source' => 'url',
				),
			)
		);

		$this->add_control(
			'plordiconsa_lordicons_file',
			array(
				'label'              => esc_html__( 'Upload JSON File', 'powerful-lordicons-animation' ),
				'type'               => Controls_Manager::MEDIA,
				'media_type'         => 'application/json',
				'frontend_available' => true,
				'condition'          => array(
					'plordiconsa_source' => 'file',
				),
			)
		);

		$this->add_control(
			'plordiconsa_lordicons_loop',
			array(
				'label'        => esc_html__( 'Loop', 'powerful-lordicons-animation' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'plordiconsa_lordicons_reverse',
			array(
				'label'        => esc_html__( 'Reverse', 'powerful-lordicons-animation' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'plordiconsa_lordicons_speed',
			array(
				'label'   => esc_html__( 'Animation Speed', 'powerful-lordicons-animation' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1,
				'min'     => 0.1,
				'max'     => 3,
				'step'    => 0.1,
			)
		);

		$this->add_control(
			'plordiconsa_trigger',
			array(
				'label' => esc_html__( 'Trigger', 'powerful-lordicons-animation' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none' => esc_html__( 'None', 'powerful-lordicons-animation' ),
					'hover' => esc_html__( 'Hover', 'powerful-lordicons-animation' ),
					'scroll' => esc_html__( 'Scroll', 'powerful-lordicons-animation' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'plordiconsa_hover_leave_reverse',
			array(
				'label'        => esc_html__( 'Reset on Mouse Leave', 'powerful-lordicons-animation' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'condition'    => array(
					'plordiconsa_trigger'         => 'hover',
					'lordicons_reverse!' => 'true',
				),
			)
		);

		$this->add_control(
			'plordiconsa_lordicons_hover',
			array(
				'label'        => esc_html__( 'Play on Hover', 'powerful-lordicons-animation' ),
				'type'         => Controls_Manager::HIDDEN,
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'plordiconsa_animate_on_scroll',
			array(
				'label'        => esc_html__( 'Play On Scroll', 'powerful-lordicons-animation' ),
				'type'         => Controls_Manager::HIDDEN,
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'plordiconsa_animate_speed',
			array(
				'label'     => esc_html__( 'Speed', 'powerful-lordicons-animation' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 4,
				),
				'range'     => array(
					'px' => array(
						'max'  => 10,
						'step' => 0.1,
					),
				),
				'condition' => array(
					'plordiconsa_trigger'         => 'scroll',
					'lordicons_reverse!' => 'true',
				),
			)
		);

		$this->add_control(
			'plordiconsa_animate_view',
			array(
				'label'     => esc_html__( 'Viewport', 'powerful-lordicons-animation' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'sizes' => array(
						'start' => 0,
						'end'   => 100,
					),
					'unit'  => '%',
				),
				'labels'    => array(
					__( 'Bottom', 'powerful-lordicons-animation' ),
					__( 'Top', 'powerful-lordicons-animation' ),
				),
				'scales'    => 1,
				'handles'   => 'range',
				'condition' => array(
					'plordiconsa_trigger'         => array('scroll'),
					'lordicons_reverse!' => 'true',
				),
			)
		);

		$this->add_responsive_control(
			'plordiconsa_animation_size',
			array(
				'label'      => esc_html__( 'Size', 'powerful-lordicons-animation' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 200,
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 800,
					),
					'em' => array(
						'min' => 1,
						'max' => 30,
					),
				),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}}.plordiconsa-lordicons-canvas .plordiconsa-lordicons-animation, {{WRAPPER}}.plordiconsa-lordicons-svg svg'    => 'width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'plordiconsa_lordicons_rotate',
			array(
				'label'       => esc_html__( 'Rotate (degrees)', 'powerful-lordicons-animation' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Set rotation value in degrees', 'powerful-lordicons-animation' ),
				'range'       => array(
					'px' => array(
						'min' => -180,
						'max' => 180,
					),
				),
				'default'     => array(
					'size' => 0,
				),
				'selectors'   => array(
					'{{WRAPPER}} .plordiconsa-lordicons-animation' => 'transform: rotate({{SIZE}}deg)',
				),
			)
		);

		$this->add_responsive_control(
			'plordiconsa_animation_align',
			array(
				'label'     => esc_html__( 'Alignment', 'powerful-lordicons-animation' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'powerful-lordicons-animation' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'powerful-lordicons-animation' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'powerful-lordicons-animation' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => false,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'plordiconsa_link_switcher',
			array(
				'label' => esc_html__( 'Link', 'powerful-lordicons-animation' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Place URL', 'powerful-lordicons-animation' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array( 'active' => true ),
				'default'     => array(
					'url' => '#',
				),
				'placeholder' => 'https://example.com/',
				'label_block' => true,
				'separator'   => 'after',
				'condition'   => array(
					'plordiconsa_link_switcher'  => 'yes',
				),
			)
		);
		$this->add_control(
			'plordiconsa_lordicons_renderer',
			array(
				'label'        => esc_html__( 'Render As', 'powerful-lordicons-animation' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'svg'    => esc_html__( 'SVG', 'powerful-lordicons-animation' ),
					'canvas' => esc_html__( 'Canvas', 'powerful-lordicons-animation' ),
				),
				'default'      => 'svg',
				'prefix_class' => 'plordiconsa-lordicons-',
				'render_type'  => 'template',
				'label_block'  => true,
				'separator'    => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'plordiconsa_catpost_carousel_box_style',
			[
				'label' => esc_html__( 'Wrap Style', 'powerful-lordicons-animation' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Hover control start for box
		$this->start_controls_tabs(
			'plordiconsa_box_style_post'
		);
		$this->start_controls_tab(
			'plordiconsa_box_normal_post',
			[
				'label' => esc_html__( 'Normal', 'powerful-lordicons-animation' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'plordiconsa_box_bg_grediant_color',
				'label' => esc_html__( 'Background', 'powerful-lordicons-animation' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .plordiconsa-lordicons-animation svg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'plordiconsa_box_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'powerful-lordicons-animation' ),
				'selector' => '{{WRAPPER}} .plordiconsa-lordicons-animation svg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'plordiconsa_box_border',
				'label' => esc_html__( 'Border', 'powerful-lordicons-animation' ),
				'selector' => '{{WRAPPER}} .plordiconsa-lordicons-animation svg',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'plordiconsa_box_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'powerful-lordicons-animation' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'plordiconsa_box_bg_grediant_color_hover',
				'label' => esc_html__( 'Background', 'powerful-lordicons-animation' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .plordiconsa-lordicons-animation:hover svg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'plordiconsa_box_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'powerful-lordicons-animation' ),
				'selector' => '{{WRAPPER}} .plordiconsa-lordicons-animation:hover svg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'plordiconsa_box_border_hover',
				'label' => esc_html__( 'Border', 'powerful-lordicons-animation' ),
				'selector' => '{{WRAPPER}} .plordiconsa-lordicons-animation:hover svg',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End

		$this->add_responsive_control(
			'plordiconsa_the_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'powerful-lordicons-animation'),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .plordiconsa-lordicons-animation svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'plordiconsa_the_box_border_bottom',
			[
				'label' => esc_html__('Margin', 'powerful-lordicons-animation'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .plordiconsa-lordicons-animation svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'plordiconsa_box_padding',
			[
				'label' => esc_html__('Padding', 'powerful-lordicons-animation'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .plordiconsa-lordicons-animation svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if(!empty($settings['plordiconsa_lordicons_url'] || $settings['plordiconsa_lordicons_file']['url'])){
			$anim_url = 'url' === $settings['plordiconsa_source'] ? $settings['plordiconsa_lordicons_url'] : $settings['plordiconsa_lordicons_file']['url'];
			if ( empty( $anim_url ) ) {
				return;
			}
			if ( '' !== $settings['plordiconsa_trigger'] ) {
				$settings['plordiconsa_lordicons_hover'] = false;
				$settings['plordiconsa_animate_on_scroll'] = false;
			}
			$this->add_render_attribute(
				'lordicons',
				array(
					'class' => 'plordiconsa-lordicons-animation',
					'data-lordicons-url' => $anim_url,
					'data-lordicons-loop' => $settings['plordiconsa_lordicons_loop'],
					'data-lordicons-reverse' => $settings['plordiconsa_lordicons_reverse'],
					'data-lordicons-hover' => $settings['plordiconsa_lordicons_hover'] || 'hover' === $settings['plordiconsa_trigger'],
					'data-lordicons-speed' => $settings['plordiconsa_lordicons_speed'],
					'data-lordicons-render' => $settings['plordiconsa_lordicons_renderer'],
				)
			);
			if ( 'hover' === $settings['plordiconsa_trigger'] && 'true' === $settings['plordiconsa_hover_leave_reverse'] ) {
				$this->add_render_attribute( 'lordicons', 'data-lordicons-reset', 'true' );
			}
			if ( $settings['plordiconsa_animate_on_scroll'] || 'scroll' === $settings['plordiconsa_trigger'] ) {
				$this->add_render_attribute(
					'lordicons',
					array(
						'class' => 'plordiconsa-lordicons-scroll',
						'data-lordicons-scroll' => 'true',
						'data-scroll-start' => isset( $settings['plordiconsa_animate_view']['sizes']['start'] ) ? $settings['plordiconsa_animate_view']['sizes']['start'] : '0',
						'data-scroll-end' => isset( $settings['plordiconsa_animate_view']['sizes']['end'] ) ? $settings['plordiconsa_animate_view']['sizes']['end'] : '100',
						'data-scroll-speed' => $settings['plordiconsa_animate_speed']['size'],
					)
				);
			}
			if ( 'yes' === $settings['plordiconsa_link_switcher'] ) {
					$this->add_link_attributes( 'link', $settings['link'] );
			}
			echo 'yes' === $settings['plordiconsa_link_switcher']?'<a href="'.$settings['link']['url'].'">':'';
				echo '<div '.wp_kses_post( $this->get_render_attribute_string( 'lordicons' ) ).'></div>';
			echo 'yes' === $settings['plordiconsa_link_switcher']?'</a>':'';
		}else{echo esc_html__('Add the Lordicon link/file.');}
	}
}