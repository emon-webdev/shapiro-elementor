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
class Shapiro_Popular_Speaker extends Widget_Base
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
        return 'popular_speaker';
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
        return __('Popular Speaker', 'shapiro');
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
        return 'eicon-posts-ticker';
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


        $this->add_control(
            'title',
            [
                'label' => __('Title', 'shapiro'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Girl Lookbook 2015',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'designation',
            [
                'label' => __('Designation', 'shapiro'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Girl Lookbook 2015',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'photo',
            [
                'label' => __('Photo', 'shapiro'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );


        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'shapiro'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );


        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show button?', 'textdomain'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
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

        ?>
        <div class="popular-speaker-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="speaker-wrapper">
                            <div class="single-speaker">
                                <?php if (!empty($settings['photo']['url'])): ?>
                                    <div class="speaker-img">
                                        <img src="<?php echo $settings['photo']['url']; ?>" alt="" srcset="">
                                    </div>
                                <?php endif; ?>
                                <div class="speaker-content">
                                    <h3>
                                        <?php echo esc_html($settings['title']); ?>
                                    </h3>
                                    <h4>
                                        <?php echo esc_html($settings['designation']); ?>
                                    </h4>
                                    <?php echo wpautop($settings['description']); ?>

                                    <?php
                                    if ('yes' !== $settings['show_button']) {
                                        echo '<button>Featured ⭐</button>';
                                    }
                                    ?>

                                </div>
                            </div>
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

        <div class="popular-speaker-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="speaker-wrapper">
                            <div class="single-speaker">
                                <# if( ! settings.photo.url ){ #>
                                    <div class="speaker-img">
                                        <img src="{{ settings.photo.url }}" alt="" srcset="">
                                    </div>
                                <# } #>
                                <div class="speaker-content">
                                    <h3>{{{ settings.title }}}</h3>
                                    <h4>{{{ settings.designation }}}</h4>
                                    <p>{{{ settings.description }}}</p>

                                    <# if ( settings.show_button !=='yes' ) { #>
                                        <button>Featured ⭐</button>
                                        <# } #>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }
}