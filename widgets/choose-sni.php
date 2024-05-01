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

class Shapiro_Choose_SNI extends Widget_Base
{


    public function get_name()
    {
        return 'choose_sni';
    }

    public function get_title()
    {
        return esc_html__('Choose SNI', 'shapiro');
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
                'label' => esc_html__('Content', 'shapiro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
			'about_title',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => Controls_Manager::TEXTAREA,
                'rows' => 6,
				'default' => esc_html__( 'About Shapiro Negotiation Institute', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
			]
		);


        $this->add_control(
			'about_description',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'About Shapiro Negotiation Description', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'about_services',
            [
                'label' => esc_html__('About Services', 'shapiro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'About Services', 'shapiro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'shapiro' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '#1' , 'shapiro' ),
						'label_block' => true,
					],
					[
						'name' => 'description',
						'label' => esc_html__( 'Description', 'shapiro' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => esc_html__( 'Engaging and interactive experiences One of the reasons our training is so sticky.' , 'shapiro' ),
						'show_label' => false,
					],
				],
			]
		);


        $this->end_controls_section();



        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="about-shapiro-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                       <div class="about-content">
                             <?php echo $settings['about_title']; ?>
                            <?php echo wpautop($settings['about_description']); ?>
                       </div>
                    </div>

                    <div class="col-lg-6">
                       <div class="row">
                            <?php 
                                if ( $settings['list'] ) {
                                    foreach (  $settings['list'] as $item ) {
                                        echo '
                                            <div class="col-lg-6 elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">
                                                <div class="single-about-service  ">
                                                    <h2>'.$item['title'].'</h2>
                                                    '.wpautop($item['description']) .'
                                                </div>
                                            </div>
                                        ';
                                    }
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
            <div class="about-shapiro-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-content">
                                <h2>
                                    {{{ settings.about_title }}}
                                </h2>
                                <p>{{{ settings.about_description }}}</p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <# if ( settings.list.length ) { #>
                                    <# _.each( settings.list, function( item ) { #>
                                        <div class="col-lg-6 elementor-repeater-item-{{ item._id }}">
                                            <div class="single-about-service  ">
                                                    <h2>{{{ item.title }}}</h2>
                                                    <P>{{{ item.description }}}</P>
                                            </div>
                                        </div>
                                    <# }); #>
                                <# } #>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php
    }
}

