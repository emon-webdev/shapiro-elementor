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

class Shapiro_Companines_Choose extends Widget_Base
{


    public function get_name()
    {
        return 'companines_choose';
    }

    public function get_title()
    {
        return esc_html__('Companies Tab', 'shapiro');
    }

    public function get_icon()
    {
        return 'eicon-tabs';
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
                'label' => esc_html__('Companies Tab Items', 'shapiro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
			'tab_list',
			[
				'label' => esc_html__( 'About Services', 'shapiro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
                    [
						'name' => 'tab_id',
						'label' => esc_html__( 'Tab Id', 'shapiro' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'tab1' , 'shapiro' ),
						'label_block' => true,
					],
					[
						'name' => 'tab_button',
						'label' => esc_html__( 'Tab Button', 'shapiro' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Customization' , 'shapiro' ),
						'label_block' => true,
					],
					[
						'name' => 'tab_title',
						'label' => esc_html__( 'Tab Title', 'shapiro' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Engaging' , 'shapiro' ),
						'label_block' => true,
					],
					[
						'name' => 'tab_sub_title',
						'label' => esc_html__( 'Tab Sub Title', 'shapiro' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => esc_html__( 'Our program is based depth of research (we’ve partnered with Johns Hopkins and other universities) but delivered in the most engaging way.' , 'shapiro' ),
						'label_block' => true,
					],
					[
						'name' => 'tab_description',
						'label' => esc_html__( 'Tab Description', 'shapiro' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => esc_html__( 'They are longer, more expensive, less customized, less engaging, and don’t include nearly as much reinforcement. Harvard is one of the top universities in the world, but find out why many of the world’s leading ' , 'shapiro' ),
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
            <div class="companies-tab-area">
                <div class="container">
                    <div class="tab-items">
                        <div class="tab-menu">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs " role="tablist">
                                <?php 
                                    if ( $settings['tab_list'] ) {
                                        foreach (  $settings['tab_list'] as $item ) {
                                            echo '
                                                <li class="nav-item elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">
                                                    <a class="nav-link" data-toggle="tab" href="#'. esc_attr( $item['tab_id'] ).'">'.$item['tab_button'].'</a>
                                                </li>
                                            ';
                                        }
                                    }
                                ?>
                            </ul>
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php 
                                if ( $settings['tab_list'] ) { 
                                    $isFirstTab = true; 
                                    foreach (  $settings['tab_list'] as $item ) {
                                        $isActive = $isFirstTab ? "active" : " ";
                                        echo '
                                            <div id="'. esc_attr( $item['tab_id'] ).'" class="tab-pane  '.$isActive.'  elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">
                                                <div class="tab-top-content">
                                                    <h3>'.$item['tab_title'].'</h3>
                                                    <h4>'.$item['tab_sub_title'].'</h4>
                                                </div>
                                                '.wpautop($item['tab_description']) .'
                                            </div>
                                        ';
                                        $isFirstTab = false; 
                                    }
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
            <div class="companies-tab-area">
                <div class="container">
                    <div class="tab-items">
                    <!-- Left-side column for tab menu buttons -->
                        <div class="tab-menu">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs " role="tablist">
                                <# if ( settings.tab_list.length ) { #>

                                    

                                    <# _.each( settings.tab_list, function( item ) { #>
                                        <li class="nav-item elementor-repeater-item-{{ item._id }}">
                                            <a class="nav-link" data-toggle="tab" href="#{{ item.tab_id }}">
                                                {{{ item.tab_button }}}
                                            </a>
                                        </li> 
                                    <# });#>
                                <# }#>
                            </ul>
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <# if ( settings.tab_list.length ) { #>
                                <# var isFirstTab = true; #>
                                <# _.each( settings.tab_list, function( item ) { #>
                                    <# var isActive = isFirstTab ? "active" : ""; #>
                                    <div id="{{ item.tab_id }}" class="tab-pane {{isActive}} elementor-repeater-item-{{ item._id }}">
                                        <div class="tab-top-content">
                                            <h3>{{{item.tab_title}}}</h3>
                                            <h4>{{{item.tab_sub_title}}}</h4>
                                        </div>
                                        <p>{{{ item.tab_description }}}</p>
                                    </div>
                                    <# isFirstTab = false; #>
                                <# });#>
                            <# }#>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }
}

