<?php
class Elementor_Services_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'services_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Services', 'elementor-lawyers' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'lawyers' ];
	}

	public function get_keywords(): array {
		return [ 'services'];
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
			'post_count',
			[
				'label' => esc_html__( 'Post Count', 'elementor-lawyers' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$this->add_control(
			'button_text',
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
		
		<section class="services grey" id="services">
		<div class="container">
			<div class="services_title title">
				<h2><?php echo $settings['title']; ?></h2>
				<span class="border"></span>
				<p><?php echo wp_kses($settings['description'], array('br' => array())); ?></p>	
			</div>

			<div class="services_item">
				<?php
				$get_query = new WP_Query;
				$post_count = $settings['post_count'];
				if (empty($settings['post_count'])) {
					$post_count = 10;
				}
				// Получаем основные услуги (не из скрытой категории)
				$services = $get_query->query([
					'post_type' => 'services',
					'posts_per_page' => $post_count,
					'tax_query' => array(
						array(
							'taxonomy' => 'service_category',
							'field'    => 'slug',
							'terms'    => 'hidden',
							'operator' => 'NOT IN',
						),
					),
				]);

				foreach ($services as $service) : ?>
					<div class="services_card">
						<?php echo get_the_post_thumbnail($service->ID, 'full'); ?>
						<h4><a href="<?php echo esc_url(get_permalink($service->ID)); ?>"><?php echo esc_html($service->post_title); ?></a></h4>
						<p><?php echo wp_trim_words($service->post_excerpt, 20); ?></p>
					</div>
				<?php
				endforeach;
				wp_reset_postdata();
				?>
			</div>

			<!-- скрытый блок начало -->
			<div class="services_extra">
				<?php
				// Проверяем существование категории
				$hidden_term = get_term_by('slug', 'hidden', 'service_category');

				if (!$hidden_term) {
					echo '<!-- Категория hidden не найдена -->';
				} else {
					// Создаем новый объект запроса
					$hidden_query = new WP_Query([
						'post_type' => 'services',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'service_category',
								'field'    => 'term_id',
								'terms'    => $hidden_term->term_id,
							),
						),
					]);

					if ($hidden_query->have_posts()) :
						while ($hidden_query->have_posts()) : $hidden_query->the_post();
							?>
							<div class="services_card">
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('full'); ?>
								<?php endif; ?>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						echo '<!-- Нет записей в категории hidden -->';
					endif;
				}
				?>
			</div>
			<!-- скрытый блок конец -->

			<div class="services_button">
				<button class="button_blue" id="toggleServices"><?php echo $settings['button_text']; ?></button>
			</div>
		</div>
	</section>

		<?php
	}
}