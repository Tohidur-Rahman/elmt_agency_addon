<?php

class Agency_Slider_Section extends \Elementor\Widget_Base {


    public function get_name() {
		return 'slider_widget';
	}

	public function get_title() {
		return esc_html__( 'Slider Widget', 'elmntr-agency' );
	}

	public function get_icon() {
		return 'eicon-slider-device';
	}

	public function get_custom_help_url() {
		return 'https://go.elementor.com/widget-name';
	}

	public function get_categories() {
		return [ 'elementor_agency_addon' ];
	}

	public function get_keywords() {
		return [ 'slider', 'carousel' ];
	}

    protected function register_controls(){

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slider_image',
			[
				'label' => esc_html__( 'Choose Image', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'slider_subtitle', [
				'label' => esc_html__( 'Subtitle', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Subtitle' , 'elmntr-agency' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_title', [
				'label' => esc_html__( 'Title', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , 'elmntr-agency' ),
				'show_label' => false,
				'label_block' => true,
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'slider_desc', [
				'label' => esc_html__( 'Description', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Description' , 'elmntr-agency' ),
				'show_label' => false,
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'slider_btn_text', [
				'label' => esc_html__( 'Button Text', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read More' , 'elmntr-agency' ),
				'label_block' => true,
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'slider_btn_url',
			[
				'label' => esc_html__( 'Button URL', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elmntr-agency' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
					'separator' => 'before'
				],
			]
		);

		$this->add_control(
			'sliders',
			[
				'label' => esc_html__( 'Sliders List', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'slider_subtitle' => esc_html__( 'Slider Subtitle', 'elmntr-agency' ),
						'slider_title' => esc_html__( 'Slider Title', 'elmntr-agency' ),
						'slider_desc' => esc_html__( 'Slider Description', 'elmntr-agency' ),
						'slider_btn_text' => esc_html__( 'Read More. ', 'elmntr-agency' ),
					],
					[
						'slider_subtitle' => esc_html__( 'Slider Subtitle 1', 'elmntr-agency' ),
						'slider_title' => esc_html__( 'Slider Title 1', 'elmntr-agency' ),
						'slider_desc' => esc_html__( 'Slider Description 1', 'elmntr-agency' ),
						'slider_btn_text' => esc_html__( 'Read More 1', 'elmntr-agency' ),
					],
				],
				'title_field' => '{{{ slider_title }}}',
			]
		);
		
        $this->end_controls_section();

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'elmntr-agency' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slider_items', [
				'label' => esc_html__( 'Items', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 3,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label' => esc_html__( 'Autoplay?', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'elmntr-agency' ),
				'label_off' => esc_html__( 'False', 'elmntr-agency' ),
				'return_value' => 'true',
				'default' => 'true',
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

		// Slider Subheading
		$this->add_control(
			'slider_subheading',
			[
				'label' => esc_html__( 'Slider Subheading', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_subheading_typography',
				'selector' => '{{WRAPPER}} .slide-table h4',
			]
		);

		$this->add_control(
			'slider_subheading_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-table h4' => 'color: {{VALUE}}',
				],
				'default' => '#fff'
			]
		);

		$this->add_control(
			'slider_subheading_border',
			[
				'label' => esc_html__( 'Border Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-table h4:before' => 'background-color: {{VALUE}}',
				],
				'default' => '#635cdb'
			]
		);

		// Slider Title
		$this->add_control(
			'slider_title',
			[
				'label' => esc_html__( 'Slider Title', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_title_typography',
				'selector' => '{{WRAPPER}} .slide-table h2',
			]
		);

		$this->add_control(
			'slider_title_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-table h2' => 'color: {{VALUE}}',
				],
				'default' => '#fff'
			]
		);

		// Slider Description
		$this->add_control(
			'slider_desc',
			[
				'label' => esc_html__( 'Slider Description', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_desc_typography',
				'selector' => '{{WRAPPER}} .slide-table p',
			]
		);

		$this->add_control(
			'slider_desc_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-table p' => 'color: {{VALUE}}',
				],
				'default' => '#fff'
			]
		);

		// Slider Button
		$this->add_control(
			'slider_btn',
			[
				'label' => esc_html__( 'Slider Button', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slider_btn_typography',
				'selector' => '{{WRAPPER}} .slide-table a',
			]
		);

		$this->add_control(
			'slider_btn_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-table a' => 'color: {{VALUE}}',
				],
				'default' => '#fff'
			]
		);

		$this->add_control(
			'slider_btn_background',
			[
				'label' => esc_html__( 'Background', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-table a' => 'background-color: {{VALUE}}',
				],
				'default' => '#635cdb'
			]
		);


		// Slider Dots
		$this->add_control(
			'slider_dots',
			[
				'label' => esc_html__( 'Slider Dots', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'slider_dots_color',
			[
				'label' => esc_html__( 'Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider .owl-dots div' => 'background-color: {{VALUE}}',
				],
				'default' => '#eee'
			]
		);

		$this->add_control(
			'slider_dots_active',
			[
				'label' => esc_html__( 'Active Color', 'elmntr-agency' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider .owl-dots div.active' => 'background-color: {{VALUE}}',
				],
				'default' => '#635cdb'
			]
		);

		$this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
		$sliders = $settings['sliders'];
		$slider_items = $settings['slider_items'];
		$slider_autoplay = $settings['slider_autoplay'];

		if($slider_autoplay == 'true') {
			$slider_autoplay = 'true';
		} else {
			$slider_autoplay = 'false';
		}
	?>

		<script>
			jQuery(document).ready(function ($) {
			/* Slider Item Slide
				============================*/
				$(".slider").owlCarousel({
					items: <?php echo $slider_items;?>,
					autoplay: <?php echo $slider_autoplay?>,
					loop: true,
					nav: false,
					dots: true,
					smartSpeed: 500
				});
			});
		</script>
         <div class="slider owl-carousel">
			 <?php
				foreach($sliders as $slider) {
					?>
					<div class="single-slide" style="background-image:url('<?php echo $slider['slider_image']['url'];?>')">
					<div class="container">
						<div class="row">
							<div class="col-xl-12">
								<div class="slide-table">
									<div class="slide-tablecell">
										<h4><?php echo $slider['slider_subtitle'];?></h4>
										<h2><?php echo $slider['slider_title'];?></h2>
										<p><?php echo $slider['slider_desc'];?></p>
										<a href="<?php echo $slider['slider_btn_url']['url'];?>" class="box-btn"><?php echo $slider['slider_btn_text'];?> <i class="fa fa-angle-double-right"></i></a>
									</div>
								</div>
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
