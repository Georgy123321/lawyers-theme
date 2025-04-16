<?php
class Elementor_Lawyers_Widget extends \Elementor\Widget_Base {

    public function get_name(): string {
        return 'lawyers_widget';
    }

    public function get_title(): string {
        return esc_html__('Lawyers', 'elementor-lawyers');
    }

    public function get_icon(): string {
        return 'eicon-code';
    }

    public function get_categories(): array {
        return ['lawyers'];
    }

    public function get_keywords(): array {
        return ['lawyers'];
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
            'title',
            [
                'label' => esc_html__('Title', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
            'post',
            [
                'label' => esc_html__('Post', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-lawyers'),
            ]
        );

        $repeater->add_control(
            'hover_name',
            [
                'label' => esc_html__('Hover Name', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-lawyers'),
            ]
        );

        $repeater->add_control(
            'hover_post',
            [
                'label' => esc_html__('Hover Post', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-lawyers'),
            ]
        );

        $repeater->add_control(
            'hover_desc',
            [
                'label' => esc_html__('Hover Description', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'elementor-lawyers'),
            ]
        );

        $repeater->add_control(
            'hover_experience',
            [
                'label' => esc_html__('Hover experience', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-lawyers'),
            ]
        );

        $this->add_control(
            'card_list',
            [
                'label' => esc_html__('Card List', 'elementor-lawyers'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
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
        
        <section class="lawyers grey" id="lawyers">
            <div class="container">
                <div class="lawyers_title title">
                    <h2><?php echo esc_html($settings['title']); ?></h2>
                    <span class="border"></span>
                    <p><?php echo wp_kses_post($settings['description'], array('br' => array())); ?></p>
                </div>

                <div class="crads">
                    <?php if (!empty($settings['card_list'])): ?>
                        <?php foreach ($settings['card_list'] as $item): ?>
                            <div class="card_item">
                                <div class="card_image">
                                    <?php if (!empty($item['image']['url'])): ?>
                                        <img src="<?php echo esc_url($item['image']['url']); ?>" 
                                            alt="<?php echo esc_attr($item['image']['alt']); ?>">
                                    <?php endif; ?>
                                    <div class="card_overlay">
                                        <h4><?php echo esc_html($item['hover_name']); ?></h4>
                                        <p class="name"><?php echo esc_html($item['hover_post']); ?></p>
                                        <p class="desc">
                                            <?php echo wp_kses_post($item['hover_desc']); ?>
                                        </p>
                                        <p class="experience"><?php echo esc_html($item['hover_experience']); ?></p>
                                    </div>
                                </div>
                                <div class="cards_text">
                                    <h4><?php echo esc_html($item['name']); ?></h4>
                                    <p><?php echo esc_html($item['post']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}