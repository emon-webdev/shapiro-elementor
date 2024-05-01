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
class Shapiro_Content_Blog extends Widget_Base
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
        return 'content-block';
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
        return __('Content Block', 'shapiro');
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
                'label' => __('Title', 'plugin-domain'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Girl Lookbook 2015',
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'shapiro'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Default Content', 'shapiro'),
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Background Image', 'shapiro'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'shapiro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-double-angle-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'shapiro'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'textdomain'),
                'label_block' => true,
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

        if ($settings['link']['is_external'] === true) {
            $target = '_blank';
        } else {
            $target = '_self';
        }
        ?>

        <div class="content-box">
            <div class="content-box-bg" style="background-image:url(<?php echo $settings['image']['url']; ?>)">
                <?php echo wpautop($settings['content']); ?>
                <h6>
                    <?php echo $settings['title']; ?>
                </h6>
                <a href="<?php echo $settings['link']['url']; ?>" title="" target="<?php echo $target; ?>">
                    <i class="<?php echo $settings['icon']['value']; ?>"></i>
                </a>
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

        <?php
    }
}