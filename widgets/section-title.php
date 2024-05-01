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

class Shapiro_Section_Title extends Widget_Base
{


    public function get_name()
    {
        return 'section_title';
    }

    public function get_title()
    {
        return esc_html__('Section Title', 'shapiro');
    }

    public function get_icon()
    {
        return 'eicon-site-title';
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
            'section_title',
            [
                'label' => esc_html__('Section Title', 'shapiro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add your section title', 'shapiro'),
            ]
        );



        $this->add_control(
            'text_align',
            [
                'label' => esc_html__('Alignment', 'shapiro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'shapiro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'shapiro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'shapiro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );




        $this->end_controls_section();



        // Style Tab Start

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'elementor-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#143E34',
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // $this->add_group_control(
        //     Group_Control_Typography::get_type(),
        //     [
        //         'name' => 'title_typography',
        //         'global' => [
        //             'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
        //         ],
        //         'selector' => '{{WRAPPER}} .section-title',
        //     ]
        // );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .section-title',
            ]
        );

        $this->end_controls_section();

        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <h2 class="section-title">
            <?php echo $settings['section_title']; ?>
        </h2>

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

        <h2 class="section-title">
            {{{ settings.section_title }}}
        </h2>
        <?php
    }


}