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

class Shapiro_Hero_Area extends Widget_Base
{


    public function get_name()
    {
        return 'hero_area';
    }

    public function get_title()
    {
        return esc_html__('Hero Area', 'shapiro');
    }

    public function get_icon()
    {
        return 'eicon-elementor';
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
			'title',
			[
				'label' => esc_html__( 'Title', 'shapiro' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Hero title', 'shapiro' ),
				'placeholder' => esc_html__( 'Type your title here', 'shapiro' ),
                'label_block'=> true,
			]
		);

        $this->add_control(
			'description',
			[
				'label' => esc_html__( 'Hero Description', 'shapiro' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default description', 'shapiro' ),
				'placeholder' => esc_html__( 'Type your description here', 'shapiro' ),
			]
		);
        

        $this->add_control(
			'form_title',
			[
				'label' => esc_html__( 'Form Title', 'shapiro' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Form heading', 'shapiro' ),
				'placeholder' => esc_html__( 'Type your title here', 'shapiro' ),
                'label_block'=> true,
			]
		);

        $this->add_control(
			'form_shortcode',
			[
				'label' => esc_html__( 'Form Shortcode', 'shapiro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'your shortcode here', 'shapiro' ),
                'label_block'=> true,
			]
		);

        


        $this->end_controls_section();



        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $shortcode = $settings['form_shortcode'];
        $shortcode = do_shortcode(shortcode_unautop($shortcode))
        ?>

        <div class="hero-area">
            <div class="container">
                <div class="row">
                   <div class="col-lg-6">
                    <div class="hero-content">
                        <h2><?php echo $settings['title']; ?></h2>
                        <?php echo wpautop($settings['description']) ; ?>
                    </div>
                   </div>
                   <div class="col-lg-5 offset-lg-1">
                        <div class="contact-form">
                            <h2><?php echo $settings['form_title']; ?></h2>
                            <?php echo $shortcode; ?>
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

        <div class="hero-area">
            <div class="container">
                <div class="row">
                   <div class="col-lg-6">
                    <div class="hero-content">
                        <h2> {{{ settings.widget_title }}} </h2>
                        <p>
                            {{{ settings.description }}}
                        </p>
                    </div>
                   </div>
                   <div class="col-lg-5 offset-lg-1">
                        <div class="contact-form">
                            <h2>{{{ settings.form_title }}}</h2>
                            {{{settings.form_shortcode}}}
                        </div>
                   </div>
                </div>
            </div>
        </div>
     

        <?php
    }


}

