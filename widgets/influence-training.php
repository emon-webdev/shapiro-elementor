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

class Shapiro_Influence_Training extends Widget_Base
{


    public function get_name()
    {
        return 'influence_training';
    }

    public function get_title()
    {
        return esc_html__('Influence Training', 'shapiro');
    }

    public function get_icon()
    {
        return 'eicon-gallery-group';
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
				'label' => esc_html__( 'Influence Training Content', 'shapiro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
                        'name' => 'image',
						'label' => esc_html__( 'Title', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
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

        <div class="influence-training-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php 
                            if ( $settings['list'] ) {
                                echo '<div class="influence-content">';
                                    foreach (  $settings['list'] as $item ) {
                                        echo '
                                        <div class="single-influence-content elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">
                                            <img src="'.$item['image']['url'].'" alt="" srcset="">
                                            '.wpautop($item['description']) .'
                                        </div>
                                        ';
                                    }
                                echo '</div>';
                            }
                        ?>
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


        <div class="influence-training-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <# if ( settings.list.length ) { #>
                            <div class="influence-content">
                                <# _.each( settings.tab_list, function( item ) { #>
                                    <# if( ! item.image.url ){ #>
                                        <div class="single-influence-content elementor-repeater-item-{{{item._id }}}">
                                            <img src="{{item.image.url}}" alt="" srcset="">
                                            <p>{{{item.description}}}</p>
                                        </div>
                                    <# } #>
                                <# });#>
                            </div>   
                        <# }#>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }


}

