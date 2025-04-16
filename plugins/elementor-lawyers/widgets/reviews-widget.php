<?php
class Elementor_Reviews_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'reviews_widget';
    }

    public function get_title(): string {
        return esc_html__('Reviews', 'elementor-lawyers');
    }

    public function get_icon(): string {
        return 'eicon-code';
    }

    public function get_categories(): array {
        return ['lawyers'];
    }

    public function get_keywords(): array {
        return ['reviews'];
    }

    protected function register_controls(): void {
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'elementor-lawyers'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_prev',
            [
                'label' => esc_html__('Prev Button', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'button_next',
            [
                'label' => esc_html__('Next Button', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'avatar',
            [
                'label' => esc_html__('Avatar', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'conpany_name',
            [
                'label' => esc_html__('Company Name', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-lawyers'),
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-lawyers'),
            ]
        );

        $repeater->add_control(
            'review',
            [
                'label' => esc_html__('Review', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'elementor-lawyers'),
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__('Reviews List', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ conpany_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        if (empty($settings['title'])) {
            return;
        }
        ?>
        
        <section class="reviews" style="<?php echo !empty($settings['background_image']['url']) ? 'background-image: url(' . esc_url($settings['background_image']['url']) . ');' : ''; ?>" id="reviews">
            <div class="container">
                <div class="reviews_head">
                    <div class="reviews_title">
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <span class="border"></span>
                    </div>

                    <div class="swiper_buttons">
                        <div class="swiper-slide-button prev"><img src="<?php echo esc_url($settings['button_prev']['url']); ?>" alt="prev"></div>
                        <div class="swiper-slide-button next"><img src="<?php echo esc_url($settings['button_next']['url']); ?>" alt="next"></div>
                    </div>
                </div>

                <div class="swiper">
                    <div class="card_wrapper">
                        <ul class="card_list swiper-wrapper">

                        <?php if (!empty($settings['reviews_list'])): ?>
                            <?php foreach ($settings['reviews_list'] as $item): ?>
                                <li class="card_item swiper-slide">
                                    <div class="reviews_swiper">
                                        <div class="users">
                                            <div class="icon">
                                                <img src="<?php echo esc_url($item['avatar']['url']); ?>" alt="user">
                                            </div>
                                            <div class="user_title">
                                                <p><?php echo esc_html($item['conpany_name']); ?></p>
                                                <h4><?php echo esc_html($item['name']); ?></h4>
                                            </div>
                                        </div>
                                        <div class="reviews_title-swiper">
                                            <p><?php echo esc_html($item['review']); ?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="buttons">
                    <?php if (!empty($settings['button_text'])): ?>
                        <button class="button_blue"><?php echo esc_html($settings['button_text']); ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <script>
            setTimeout(() => {
                new Swiper('.card_wrapper', {
                    loop: true,
                    spaceBetween: 30,

                    // If we need pagination
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: true
                    },

                    // Navigation arrows 
                    navigation: {
                        nextEl: '.next',
                        prevEl: '.prev',
                    },

                    // And if we need scrollbar
                    scrollbar: {
                        el: '.swiper-scrollbar',
                    },

                    breakpoints: {
                        768: {
                            slidesPerView: 1
                        },
                        1024: {
                            slidesPerView: 2
                        }
                    }
                });
            }, 1000);
        </script>
        
        <?php
    }
}