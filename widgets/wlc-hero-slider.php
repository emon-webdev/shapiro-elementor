<?php
namespace Shapiro_Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class shapiro_Wlc_Hero extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'wlc-hero';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Hero Slider', 'shapiro');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-post-slider';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['shapiroservices'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['shapiro'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Content', 'shapiro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_title',
            [
                'label' => esc_html__('Title', 'shapiro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Slide Title', 'shapiro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_content',
            [
                'label' => esc_html__('Content', 'shapiro'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Slide Content', 'shapiro'),
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'slide_desc',
            [
                'label' => esc_html__('Slide', 'shapiro'),
                'type' => Controls_Manager::TEXT,
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'slide_image',
            [
                'label' => esc_html__('Slide Image', 'shapiro'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => true,
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'shapiro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_title' => esc_html__('Slide #1', 'shapiro'),
                        'slide_content' => esc_html__('Slide content.', 'shapiro'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'setting_section',
            [
                'label' => __('Slider Settings', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'fade',
            [
                'label' => __('Fade effecct?', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __('No', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop?', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __('No', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'arrows',
            [
                'label' => __('Show arrows?', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'your-plugin'),
                'label_off' => __('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __('Show dots?', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'your-plugin'),
                'label_off' => __('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay?', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __('No', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_time',
            [
                'label' => __('Autoplay Time', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '5000',
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();










    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();


        if ($settings['slides']) {
            $dynamic_id = rand(78676, 967698);
            if (count($settings['slides']) > 1) {
                if ($settings['fade'] == 'yes') {
                    $fade = 'true';
                } else {
                    $fade = 'false';
                }
                if ($settings['arrows'] == 'yes') {
                    $arrows = 'true';
                } else {
                    $arrows = 'false';
                }
                if ($settings['dots'] == 'yes') {
                    $dots = 'true';
                } else {
                    $dots = 'false';
                }
                if ($settings['autoplay'] == 'yes') {
                    $autoplay = 'true';
                } else {
                    $autoplay = 'false';
                }
                if ($settings['loop'] == 'yes') {
                    $loop = 'true';
                } else {
                    $loop = 'false';
                }
                echo '<script>
					jQuery(document).ready(function($) {
						$("#slides-' . $dynamic_id . '").slick({
							arrows: ' . $arrows . ',
							prevArrow: "<i class=\'fa fa-angle-left\'></i>",
							nextArrow: "<i class=\'fa fa-angle-right\'></i>",
							dots: ' . $dots . ',
							fade: ' . $fade . ',
							autoplay: ' . $autoplay . ',
							loop: ' . $loop . ',';

                if ($autoplay == 'true') {
                    echo 'autoplaySpeed: ' . $settings['autoplay_time'] . '';
                }


                echo '
						});
					});
				</script>';
            }
            echo '<div id="slides-' . $dynamic_id . '" class="wlc__hero">';
            foreach ($settings['slides'] as $slide) {
                echo '<div class="single-slide" style="background-image:url(' . wp_get_attachment_image_url($slide['slide_image']['id'], 'large') . ')">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="wlc__content">
                                        <div>
                                            ' . wpautop($slide['slide_content']) . '
                                        </div>
                                        <div class="slide-info">
                                            <h4>' . $slide['slide_title'] . '</h4>
                                            ' . wpautop($slide['slide_desc']) . '
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 offset-lg-1">
                                    <div class="wlc__form">
                                    ' . wpautop($slide['slide_content']) . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            echo '</div>';


        }


    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function content_template()
    {
        ?>

        <?php
    }
}