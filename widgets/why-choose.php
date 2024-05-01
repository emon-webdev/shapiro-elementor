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

class Shapiro_Why_Choose extends Widget_Base
{


    public function get_name()
    {
        return 'why_choose';
    }

    public function get_title()
    {
        return esc_html__('Why Choose', 'shapiro');
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
			'list',
			[
				'label' => esc_html__( 'Choose Content', 'shapiro' ),
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
				// 'default' => [
				// 	[
				// 		'title' => esc_html__( 'Title #1', 'shapiro' ),
				// 		'description' => esc_html__( 'Item content. Click the edit button to change this text.', 'shapiro' ),
				// 	],
				// ],
				// 'title_field' => '{{{ title }}}',
			]
		);


        $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Right Side Image', 'shapiro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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

        <div class="why-choose-area">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-5">
                        <?php 
                            if ( $settings['list'] ) {
                                echo '<div class="why-choose-content">';
                                foreach (  $settings['list'] as $item ) {
                                    echo '
                                    <div class="why-choose-single-content elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">
                                        <h2>'.$item['title'].'</h2>
                                        '.wpautop($item['description']) .'
                                        
                                    </div>
                                    ';
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                    <div class="col-lg-7">
                        <?php if (!empty($settings['image']['url'])): ?>
                            <div class="why-choose-img">
                                <img src="<?php echo $settings['image']['url']; ?>" alt="" srcset="">
                            </div>
                        <?php endif; ?>
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
        <div class="why-choose-area">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-5">
                    <# if ( settings.list.length ) { #>
                        <div class="why-choose-content">
                            <# _.each( settings.list, function( item ) { #>
                                <div class="why-choose-single-content elementor-repeater-item-{{ item._id }}">
                                    <h2>{{{ item.title }}}</h2>
                                    <P>{{{ item.description }}}</P>
                                </div>
                            <# }); #>
                        </div>
                    <# } #>

                    </div>
                    <div class="col-lg-7">
                    <# if( ! settings.image.url ){ #>
                        <div class="why-choose-img">
                            <img src="{{ settings.image.url }}" alt="" srcset="">
                        </div>
                    <# } #>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }


}
