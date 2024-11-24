<?php

class Agency_About_Section extends \Elementor\Widget_Base {

	public function get_name() {
		return 'about_section_widget';
	}

	public function get_title() {
		return esc_html__( 'About Section', 'elmntr-agency' );
	}

	public function get_icon() {
		return 'eicon-plus-square-o';
	}

	// Category Id
	public function get_categories() {
		return [ 'elementor_agency_addon' ];
	}

	public function get_keywords() {
		return [ 'about', 'section' ];
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
		
		// About Title
		$this->add_control(
			'about_title',
			[
				'label' => esc_html__( 'Title', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Welcome to About', 'elmntr-agency' ),
				'placeholder' => esc_html__( 'Type your title here', 'elmntr-agency' ),
				'label_block' => true,
			]
		);

		// About Description
		$this->add_control(
			'about_desc',
			[
				'label' => esc_html__( 'About Description', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry typesetting industry.', 'elmntr-agency' ),
				'placeholder' => esc_html__( 'Type your description here', 'elmntr-agency' ),
				'label_block' => true,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'about_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'read more', 'elmntr-agency' ),
				'placeholder' => esc_html__( 'Type your button text here', 'elmntr-agency' ),
				'label_block' => true,
			]
		);

		// About Button URL
		$this->add_control(
			'about_btn_url',
			[
				'label' => esc_html__( 'Button URL', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elmntr-agency' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
			]
		);
		
		// End Section
		$this->end_controls_section();

		$this->start_controls_section(
			'about_section',
			[
				'label' => esc_html__( 'About Features', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'about_feature_icon', 
			[
				'label' => esc_html__( 'About Feature Icon', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-star',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'about_feature_title', 
			[
				'label' => esc_html__( 'About Feature Title', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Mission' , 'elmntr-agency' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'about_feature_desc', 
			[
				'label' => esc_html__( 'About Feature Description', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dummy text here.' , 'elmntr-agency' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'features_list',
			[
				'label' => esc_html__( 'About Features List', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'about_feature_title' => esc_html__( 'Our Mission', 'elmntr-agency' ),
						'about_feature_desc' => esc_html__( 'Lorem ispusm dummy text here.', 'elmntr-agency' ),
					],
				],
				'title_field' => '{{{ about_feature_title }}}',
			]
		);

		$this->end_controls_section();

		// Style About Section
		$this->start_controls_section(
			'about_section_style',
			[
				'label' => esc_html__( 'Content Style', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Subheading Style
		$this->add_control(
			'about_title_style',
			[
				'label' => esc_html__( 'About Content', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'about_title_typography',
				'selector' => '{{WRAPPER}} .page-title h4',
			]
		);
		$this->add_control(
			'about_title_color',
			[
				'label' => esc_html__( 'Title Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .page-title h4' => 'color: {{VALUE}}',
				],
			]
		);

		// About Desc Style
		$this->add_control(
			'about_desc_style',
			[
				'label' => esc_html__( 'About Desc Style', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'about_desc_typography',
				'selector' => '{{WRAPPER}} .about p',
			]
		);
		$this->add_control(
			'about_desc_color',
			[
				'label' => esc_html__( 'Desc Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .about p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'about_btn_style',
			[
				'label' => esc_html__( 'About Button', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'about_btn_typography',
				'selector' => '{{WRAPPER}} .about a',
			]
		);

		$this->add_control(
			'about_btn_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about a' => 'color: {{VALUE}}',
				],
				'default' => '#fff'
			]
		);

		$this->add_control(
			'about_btn_background',
			[
				'label' => esc_html__( 'Background Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about a' => 'background-color: {{VALUE}}',
				],
				'default' => '#635cdb'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'about_feature_style',
			[
				'label' => esc_html__( 'About Features', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'about_feature_title_style',
			[
				'label' => esc_html__( 'About Feature Title', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'about_feature_typography',
				'selector' => '{{WRAPPER}} .single_about h4',
			]
		);

		$this->add_control(
			'about_feature_title_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single_about h4' => 'color: {{VALUE}}',
				],
				'default' => '#333'
			]
		);
		
		// End Section
		$this->end_controls_section();

	}

	// Display output
	protected function render() {
		$settings = $this->get_settings_for_display();
		$about_title = $settings['about_title'];
		$about_desc = $settings['about_desc'];
		$about_btn_text = $settings['about_btn_text'];
		$about_btn_url = $settings['about_btn_url'];
		$features_list = $settings['features_list'];
		?>
		<div class="row">
			<div class="col-md-7">
				<div class="about">
					<div class="page-title">
					<h4><?php echo $about_title;?></h4>
					</div>
					<p><?php echo $about_desc;?></p>
					<a href="<?php echo $about_btn_url['url'];?>" class="box-btn"><?php echo $about_btn_text;?><i class="fa fa-angle-double-right"></i></a>
				</div>
			</div>
			<div class="col-md-5">
				<?php
					foreach($features_list as $feature) {
				?>
					<div class="single_about">
						<i class="<?php echo $feature['about_feature_icon']['value'];?>"></i>
						<h4><?php echo $feature['about_feature_title'];?></h4>
						<p><?php echo $feature['about_feature_desc'];?></p>
					</div>
				<?php
					}
				?>
			</div>
		</div>
		<?php
	}

	// Display without Refresh
	

}