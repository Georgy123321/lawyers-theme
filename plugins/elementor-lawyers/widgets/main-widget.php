<?php
class Elementor_Main_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'main_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Main', 'elementor-lawyers' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'lawyers' ];
	}

	public function get_keywords(): array {
		return [ 'main'];
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
			'background_image',
			[
				'label' => esc_html__( 'Background Image', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'top_title',
			[
				'label' => esc_html__( 'Top Title', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => esc_html__( 'Button URL', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::URL,
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
		
		<main class="main" style="background-image: url('<?php echo $settings['background_image']['url']; ?>');">
			<div class="container">
				<div class="main_title title">
					<h3><?php echo $settings['top_title']; ?></h3>
					<h1><?php echo $settings['title']; ?></h1>
					<p><?php echo $settings['description']; ?></p>
					<a href="<?php echo $settings['button_url']['url']; ?>">
						<button class="button_blue">
							<?php echo $settings['button_text']; ?>
						</button>
					</a>	
				</div>
			</div>
		</main>

		<?php
	}
}