<?php

class Agency_Counter_Section extends \Elementor\Widget_Base {

    public function get_name() {
		return 'counter_widget';
	}

	public function get_title() {
		return esc_html__( 'Counter Section', 'elmntr-agency' );
	}

	public function get_icon() {
		return 'eicon-counter-circle';
	}

	public function get_custom_help_url() {
		return 'https://go.elementor.com/widget-name';
	}

	public function get_categories() {
		return [ 'elementor_agency_addon' ];
	}

	public function get_keywords() {
		return [ 'counter' ];
	}

    protected function register_controls(){

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Counter Column
		$this->add_control(
			'counter_column',
			[
				'label' => esc_html__( 'Select Column', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'columnFour',
				'options' => [
					'columnThree'  => esc_html__( '3 Column', 'elmntr-agency' ),
					'columnFour' => esc_html__( '4 Column', 'elmntr-agency' ),
					'columnTwo' => esc_html__( '2 Column', 'elmntr-agency' ),
				],
			]
		);

		// Counter List
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'counter_icon', [
				'label' => esc_html__( 'Icon', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'counter_number', [
				'label' => esc_html__( 'Number', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => esc_html__( 'Number' , 'elmntr-agency' ),
				'show_label' => true,
				'default' => 100
			]
		);

		$repeater->add_control(
			'counter_title', [
				'label' => esc_html__( 'Title', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Clients', 'elmntr-agency' )
			]
		);

		$this->add_control(
			'counters',
			[
				'label' => esc_html__( 'Counters List', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ counter_title }}}',
			]
		);
		
        $this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

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
				'selectors' => [
					'{{WRAPPER}} .section-title h3 span' => 'color: {{VALUE}}',
				],
				'default' => '#333'
			]
		);

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
				'selectors' => [
					'{{WRAPPER}} .section-title h3' => 'color: {{VALUE}}',
				],
				'default' => '#333'
			]
		);

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
				'selector' => '{{WRAPPER}} .section-title p',
			]
		);

		$this->add_control(
			'section_desc_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title p' => 'color: {{VALUE}}',
				],
				'default' => '#333'
			]
		);


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

		$this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
		$counter_column = $settings['counter_column'];
		$counters = $settings['counters'];
		
		if($counter_column == 'columnFour') {
			$counter_column = 'col-md-3'; 
		} elseif ($counter_column == 'columnThree') {
			$counter_column = 'col-md-4';
		} elseif($counter_column == 'columnTwo') {
			$counter_column = 'col-md-6';
		} else {

		}

	?>
		<div class="row no-space">
			<?php
				foreach($counters as $counter) {
			?>
				<div class="<?php echo $counter_column;?>">
					<div class="single-counter">
						<h4><i class="<?php echo $counter['counter_icon']['value'];?>"></i><span class="counter"><?php echo $counter['counter_number'];?></span><?php echo $counter['counter_title'];?></h4>
					</div>
				</div>
			<?php
				}
			?>
		</div>
	<?php
    }
}
