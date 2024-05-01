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

class Shapiro_Cta extends Widget_Base
{


    public function get_name()
    {
        return 'shapiro_cta';
    }

    public function get_title()
    {
        return esc_html__('CTA', 'shapiro');
    }

    public function get_icon()
    {
        return 'eicon-call-to-action';
    }

    public function get_categories()
    {
        return ['shapiroservices'];
    }

    public function get_keywords()
    {
        return ['hello', 'world'];
    }

    protected function register_controls()
    {

        // Content Tab Start

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'shapiro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Border Style', 'shapiro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'layout_1',
                'options' => [
                    'layout_1' => esc_html__('Cta Content', 'shapiro'),
                    'layout_2' => esc_html__('Cta Content With Button', 'shapiro'),
                ],
                // 'selectors' => [
                //     '{{WRAPPER}} .cta-content' => 'border-style: {{VALUE}};',
                // ],
            ]
        );


        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'shapiro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default title', 'shapiro'),
                'placeholder' => esc_html__('Type your title here', 'shapiro'),
                'label_block' => true,
                'condition' => [
                    'layout' => 'layout_2',
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'shapiro'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Default description', 'shapiro'),
                'placeholder' => esc_html__('Type your description here', 'shapiro'),
            ]
        );


        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Description', 'shapiro'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Default description', 'shapiro'),
                'placeholder' => esc_html__('Type your description here', 'shapiro'),
                'condition' => [
                    'layout' => 'layout_1',
                ],
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__('Phone Number', 'shapiro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('(410) 662-4764', 'shapiro'),
                'condition' => [
                    'layout' => 'layout_2',
                ],
            ]
        );

        $this->add_control(
            'button_label',
            [
                'label' => esc_html__('Button Title', 'shapiro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Send Message', 'shapiro'),
                'condition' => [
                    'layout' => 'layout_2',
                ],
            ]
        );


        $this->add_control(
            'website_link',
            [
                'label' => esc_html__('Link', 'shapiro'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'shapiro'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
                'condition' => [
                    'layout' => 'layout_2',
                ],
            ]
        );






        $this->end_controls_section();



        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['website_link']['url'])) {
            $this->add_link_attributes('website_link', $settings['website_link']);
        }

        $number = str_replace(['(', ')', ' ', '-'], '', $settings['phone_number']);

        ?>

        <div class="cta-content cta-btn-content">
            <?php
            if ($settings['layout'] === 'layout_2') {
                echo '<h1>' . esc_html($settings['title']) . '</h1>';
            }
            echo wpautop($settings['description']);

            if ($settings['layout'] === 'layout_1') {
                echo '<h3>' . esc_html($settings['subtitle']) . '</h3>';
            } else {
                echo '
                    <div class="cta-btn-group text-center">
                        <a class="btn-secondary" href="tel:'.esc_attr( $number ).'">'.esc_html( $settings['phone_number'] ).'</a>
                        <a class="btn-primary" '.$this->get_render_attribute_string( 'website_link' ).'>'.esc_html($settings['button_label']).'</a>
                    </div>
                    ';
            }
            ?>

        </div>




        <?php
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

        <div class="cta-content cta-btn-content">
            <# if (settings.layout === 'layout_2') { #>
                <h1>{{{ settings.title }}}</h1>
            <# } #>
            <p>{{{ settings.description}}}</p>
            <# if (settings.layout === 'layout_1') { #>
                <h3>{{{ settings.subtitle }}}</h3>
            <# } else { #>
                <div class="cta-btn-group text-center">
                    <a class="btn-secondary">{{{ settings.phone_number }}}</a>
                    <a class="btn-primary">{{{ settings.button_label}}}</a>
                </div>
            <# } #>
        </div>

        <?php
    }


}
