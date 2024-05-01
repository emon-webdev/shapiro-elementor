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

class Shapiro_Company_Logo extends Widget_Base
{


    public function get_name()
    {
        return 'company_logo';
    }

    public function get_title()
    {
        return esc_html__('Company Logo', 'shapiro');
    }

    public function get_icon()
    {
        return 'eicon-code';
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
                'label' => esc_html__('Select Company Logo', 'shapiro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => esc_html__('Add Images', 'textdomain'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
            ]
        );

        $this->end_controls_section();


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="company-logos">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-logo">
                            <h1>Company Logo</h1>
                            <?php

                            foreach ($settings['gallery'] as $image) {
                                echo '<img src="' . esc_attr($image['url']) . '">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
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

        <div class="company-logos">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-logo">
                            <h1>Company Logo</h1>
                            <# _.each( settings.gallery, function( image ) { #>
                                <img src="{{ image.url }}">
                                <# }); #>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }


}