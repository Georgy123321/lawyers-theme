<?php
class Elementor_News_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'news_widget';
	}

	public function get_title(): string {
		return esc_html__( 'News', 'elementor-lawyers' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'lawyers' ];
	}

	public function get_keywords(): array {
		return [ 'news'];
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
		
		<section class="news" id="news">
			<div class="container">
				<div class="news_title title">
					<h2><?php echo $settings['title']; ?></h2>
					<span class="border"></span>
					<p><?php echo wp_kses($settings['description'], array('br' => array())); ?></p>
				</div>

				<div class="news_container">
					<?php
					$get_query = new WP_Query;
					$post_count = $settings['post_count'];
					if (empty($settings['post_count'])) {
						$post_count = 10;
					}
					// Получаем основные новости
					$news = $get_query->query([
						'post_type' => 'news',
						'posts_per_page' => $post_count,
						'tax_query' => array(
							array(
								'taxonomy' => 'news_category',
								'field'    => 'slug',
								'terms'    => 'hidden',
								'operator' => 'NOT IN',
							),
						),
					]);

					foreach ($news as $post) : 
						setup_postdata($post);
						$thumbnail = get_the_post_thumbnail_url($post->ID, 'full');
						if (!$thumbnail) {
							$thumbnail = '/assets/img/news-1.png';
						}
					?>
						<div class="news_card">
							<a href="<?php echo get_permalink($post->ID); ?>">
								<img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>">
								<div class="news_title-card">
									<h4><?php echo get_the_title($post->ID); ?></h4>
									<p><?php echo get_the_date('d M. Y г.', $post->ID); ?></p>
									<p><?php echo wp_trim_words(get_the_excerpt($post->ID), 40); ?></p>
								</div>
							</a>
						</div>
					<?php
					endforeach;
					wp_reset_postdata();
					?>
				</div>

				<!-- скрытые новости -->
				<div class="news_extra">
					<?php
					// Получаем скрытые новости
					$hidden_news = $get_query->query([
						'post_type' => 'news',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'news_category',
								'field'    => 'slug',
								'terms'    => 'hidden',
							),
						),
					]);

					foreach ($hidden_news as $post) : 
						setup_postdata($post);
						$thumbnail = get_the_post_thumbnail_url($post->ID, 'full');
						if (!$thumbnail) {
							$thumbnail = '/assets/img/news-1.png'; // Запасное изображение
						}
					?>
						<div class="news_card">
							<a href="<?php echo get_permalink($post->ID); ?>">
								<img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>">
								<div class="news_title-card">
									<h4><?php echo get_the_title($post->ID); ?></h4>
									<p><?php echo get_the_date('d M. Y г.', $post->ID); ?></p>
									<p><?php echo wp_trim_words(get_the_excerpt($post->ID), 40); ?></p>
								</div>
							</a>
						</div>
					<?php
					endforeach;
					wp_reset_postdata();
					?>
				</div>
				<!-- скрытые новости -->

				<div class="news_button">
					<button class="button_blue" id="toggleNews"><?php echo $settings['button_text']; ?></button>
				</div>
			</div>
		</section>

		<?php
	}
}