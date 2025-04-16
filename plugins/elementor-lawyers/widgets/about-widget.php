<?php
class Elementor_About_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'about_widget';
	}

	public function get_title(): string {
		return esc_html__( 'About', 'elementor-lawyers' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'lawyers' ];
	}

	public function get_keywords(): array {
		return [ 'about'];
	}

	protected function register_controls(): void {

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'elementor-lawyers' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'desc',
			[
				'label' => esc_html__('Description', 'elementor-wpthefor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('', 'elementor-wpthefor'),
			]
		);

		$this->add_control(
			'description_list',
			[
				'label' => __('Description List', 'elementor-wpthefor'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ desc  }}}',
			]
		);

		$this->add_control(
			'button_text-one',
			[
				'label' => esc_html__( 'Button Text', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'button_text-two',
			[
				'label' => esc_html__( 'Button Text', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
		// Content Tab End
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['title'] ) ) {
			return;
		}
		?>
		
		<section class="about" id="about">
			<div class="container">
				<div class="about_container">
					<div class="about_title">
						<h2><?php echo $settings['title']; ?></h2>
						<span class="border"></span>
	
						<?php if (!empty($settings['description_list'])): ?>
							<?php foreach ($settings['description_list'] as $item): ?>
								<p><?php echo $item['desc']; ?></p>
							<?php endforeach; ?>
						<?php endif; ?>


						<div class="buttons">
							<?php if (!empty($settings['button_text-one'])): ?>
								<button class="button_blue"><?php echo $settings['button_text-one']; ?></button>
							<?php endif; ?>

							<?php if (!empty($settings['button_text-two'])): ?>
								<button class="button_grey"><?php echo $settings['button_text-two']; ?></button>
							<?php endif; ?>
						</div>
					</div>
	
				<div class="about_img">
					<img src="<?php echo $settings['image']['url']; ?>" alt="<?php echo esc_attr($settings['image']['alt']); ?>">
				</div>
			</div>	
		</div>
	</section>

		<?php
	}
}