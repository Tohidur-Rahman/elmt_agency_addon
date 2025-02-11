<?php

class Agency_Gallery_Section extends \Elementor\Widget_Base {

    public function get_name() {
		return 'gallery_widget';
	}

	public function get_title() {
		return esc_html__( 'Gallery Section', 'elmntr-agency' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_custom_help_url() {
		return 'https://go.elementor.com/widget-name';
	}

	public function get_categories() {
		return [ 'elementor_agency_addon' ];
	}

	public function get_keywords() {
		return [ 'gallery' ];
	}

    protected function register_controls(){

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'gallery_column',
			[
				'label' => esc_html__( 'Select Column', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-xl-4',
				'options' => [
					'col-xl-4'  => esc_html__( '3 Column', 'elmntr-agency' ),
					'col-xl-6' => esc_html__( '2 Column', 'elmntr-agency' ),
					'col-xl-3' => esc_html__( '4 Column', 'elmntr-agency' ),
				],
			]
		);

		

		$this->end_controls_section();

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'gallery_title', [
				'label' => esc_html__( 'Gallery Title', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Gallery Title' , 'elmntr-agency' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'gallery_main_image',
			[
				'label' => esc_html__( 'Choose Normal Image', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'gallery_big_image',
			[
				'label' => esc_html__( 'Choose Big Image', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'gallerys',
			[
				'label' => esc_html__( 'Gallery List', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ gallery_title }}}',
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
		$gallerys = $settings['gallerys'];	
		$gallery_column = $settings['gallery_column'];

		if( $gallery_column == 'col-xl-4') {
			$gallery_column = 'col-xl-4';
		} elseif($gallery_column == 'col-xl-3') {
			$gallery_column == 'col-xl-3';
		} elseif($gallery_column == 'col-xl-2') {
			$gallery_column == 'col-xl-2';
		} 
		
	?>
		<div class="row">
             <?php
			 	foreach($gallerys as $gallery) {
			?>
				<div class="<?php echo $gallery_column;?>">
                  <div class="single-gallery">
                     <img src="<?php echo $gallery['gallery_main_image']['url'];?>" alt="<?php echo $gallery['gallery_title'];?>">
                     <div class="gallery-hover">
                        <div class="gallery-content">

							
								<h3><a href="<?php echo $gallery['gallery_big_image']['url'];?>" class="gallery"><i class="fa fa-plus"></i> <?php echo $gallery['gallery_title'];?></a></h3>
							
                           
                        </div>
                     </div>
                  </div>
               </div>
			<?php
				 }
			?>
        </div>
	<?php
    }
}
