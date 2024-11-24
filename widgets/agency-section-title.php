<?php

class Agency_Section_Title extends \Elementor\Widget_Base {

	public function get_name() {
		return 'section_title_widget';
	}

	public function get_title() {
		return esc_html__( 'Section Title', 'elmntr-agency' );
	}

	public function get_icon() {
		return 'eicon-site-title';
	}

	// Category Id
	public function get_categories() {
		return [ 'elementor_agency_addon' ];
	}

	public function get_keywords() {
		return [ 'heading', 'title' ];
	}

    protected function register_controls() {

		// Start Section
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		// Section Subheading
		$this->add_control(
			'section_subheading',
			[
				'label' => esc_html__( 'Section Subheading', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'who we are?', 'elmntr-agency' ),
				'placeholder' => esc_html__( 'Enter your Subheading', 'elmntr-agency' ),
				'label_block' => true,
			]
		);

		// Section Heading
		$this->add_control(
			'section_heading',
			[
				'label' => esc_html__( 'Section Heading', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'about us', 'elmntr-agency' ),
				'placeholder' => esc_html__( 'Enter your Heading', 'elmntr-agency' ),
				'label_block' => true,
				'separator' => 'before'
			]
		);
		// Section Description
		$this->add_control(
			'section_desc',
			[
				'label' => esc_html__( 'Section Description', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry typesetting industry.', 'elmntr-agency' ),
				'placeholder' => esc_html__( 'Type your description here', 'elmntr-agency' ),
				'label_block' => true,
				'separator' => 'before'
			]
		);
		// End Section
		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Subheading Style
		$this->add_control(
			'section_subheading_style',
			[
				'label' => esc_html__( 'Section Subheading', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_subheading_typography',
				'selector' => '{{WRAPPER}} .section-title h3 span',
			]
		);
		$this->add_control(
			'section_subheading_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .section-title h3 span' => 'color: {{VALUE}}',
				],
			]
		);

		// Heading Style
		$this->add_control(
			'section_heading_style',
			[
				'label' => esc_html__( 'Section Heading', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_heading_typography',
				'selector' => '{{WRAPPER}} .section-title h3',
			]
		);
		$this->add_control(
			'section_heading_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
				],
			]
		);

		// Description Style
		$this->add_control(
			'section_desc_style',
			[
				'label' => esc_html__( 'Section Description', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_desc_typography',
				'selector' => '{{WRAPPER}} .section-title h3',
			]
		);
		$this->add_control(
			'section_desc_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .section-title p' => 'color: {{VALUE}}',
				],
			]
		);

		// Section Border Style
		$this->add_control(
			'section_border_style',
			[
				'label' => esc_html__( 'Border', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'section_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title::before, .section-title::after' => 'background-color: {{VALUE}}',
				],
				'default' => '#635cdb'
			]
		);
		
		// End Section
		$this->end_controls_section();

	}

	// Display output
	protected function render() {
		$settings = $this->get_settings_for_display();
		$section_subheading = $settings['section_subheading'];
		$section_heading = $settings['section_heading'];
		$section_desc = $settings['section_desc'];
		?>
		<div class="row section-title">
			<div class="col-md-6 text-right">
				<h3><span><?php echo $section_subheading;?></span> <?php echo $section_heading;?></h3>
			</div>
			<div class="col-md-6">
				<p><?php echo $section_desc;?></p>
			</div>
		</div>
		<?php
	}

	// Display without Refresh
	

}