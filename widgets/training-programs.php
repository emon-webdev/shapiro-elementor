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

class Shapiro_Training_Programs extends Widget_Base
{


    public function get_name()
    {
        return 'training_programs';
    }

    public function get_title()
    {
        return esc_html__('Training Programs', 'shapiro');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
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
			'list',
			[
				'label' => esc_html__( 'Training Programs', 'shapiro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'shapiro' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'add title here' , 'shapiro' ),
						'label_block' => true,
					],
					[
						'name' => 'description',
						'label' => esc_html__( 'Description', 'shapiro' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => esc_html__( 'add description here' , 'shapiro' ),
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

        <div class="training-programs-area">
            <div class="container">
                <div class="row">
                    <?php 
                        if ( $settings['list'] ) {
                            foreach (  $settings['list'] as $item ) {
                                echo '
                                    <div class="col-lg-4 elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">
                                            <div class="single-training-programs">
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
        <div class="why-choose-area">
            <div class="container">
                <div class="row">

                    <# if ( settings.list.length ) { #>
                        <# _.each( settings.list, function( item ) { #>
                            <div class="col-lg-4 elementor-repeater-item-{{ item._id }}">
                                <div class="single-training-programs">
                                    <h2>{{{ item.title }}}</h2>
                                    <P>{{{ item.description }}}</P>
                                </div>
                            </div>
                        <# }); #>
                    <# } #>

                </div>
            </div>
        </div>

        <?php
    }
}

