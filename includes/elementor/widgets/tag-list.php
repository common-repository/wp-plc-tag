<?php
/**
 * tag-list.php - Elementor Tag List Widget
 *
 * Main File for Elementor Integration of Tag List Widget
 *
 * @category Widget
 * @package OnePlace\Tag\Elementor
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

class WPPLC_Tag_List extends Widget_Base {

    /**
     * WPPLC_Tag_List constructor.
     *
     * @param array $data
     * @param null $args
     * @since 1.0.0
     */
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    /**
     * internal name for elementor
     *
     * @return string
     * @since 1.0.0
     */
    public function get_name() {
        return 'wpplctaglist';
    }

    /**
     * Visible Title for Elementor Editor
     *
     * @return mixed
     * @since 1.0.0
     */
    public function get_title() {
        return __('Tag List', 'wp-plc-tag');
    }

    /**
     * Visible Icon for Elementor Editor
     *
     * @return string
     * @since 1.0.0
     */
    public function get_icon() {
        return 'fa fa-list';
    }

    /**
     * Category for this Widget in Elementor Editor
     *
     * @return array
     * @since 1.0.0
     */
    public function get_categories() {
        return ['wp-plc-tag'];
    }

    /**
     * Render Widget
     *
     * @since 1.0.0
     */
    protected function render() {
        # Get Elementor Widgets Settings
        $aSettings = $this->get_settings_for_display();

        # Get Articles from onePlace API
        $oAPIResponse = \OnePlace\Connect\Plugin::getDataFromAPI('/tag/api/list/article-single/category',['listmode'=>'info']);

        if($oAPIResponse->state == 'success') {
            # get items
            $aItems = $oAPIResponse->results;

            include __DIR__ . '/../../view/partials/tag-list.php';
        } else {
            echo 'error';
        }
    }

    /**
     * Template for Elementor Editor
     *
     * @since 1.0.0
     */
    protected function _content_template() {

    }

    /**
     * Elementor Controls for this Widget
     *
     * @since 1.0.0
     */
    protected function _register_controls() {
        /**
         * GENERAL SETTINGS - TITLE - START
         * @since 1.0.0
         */
        # Section - Start
        $this->start_controls_section(
            'section_tag_title',
            [
                'label' => __('Tag List - Title', 'wp-plc-tag'),
            ]
        );

        $this->add_control(
            'tag_list_title',
            [
                'label' => __( 'Title', 'wp-plc-tag' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Categories', 'wp-plc-tag' ),
                'placeholder' => __( 'Categories', 'wp-plc-tag' ),
            ]
        );

        # Section - End
        $this->end_controls_section();
        /**
         * GENERAL SETTINGS - TITLE - END
         * @since 1.0.0
         */

        /**
         * GENERAL SETTINGS - LIST - START
         * @since 1.0.0
         */
        # Section - Start
        $this->start_controls_section(
            'section_tag_title',
            [
                'label' => __('Tag List - General', 'wp-plc-tag'),
            ]
        );

        // List Style Type Control
        $this->add_control(
            'tab_list_style',
            [
                'label' => __( 'List Style', 'wp-plc-tag' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'square'  => __( 'Square', 'wp-plc-tag' ),
                    'circle' => __( 'Circle', 'wp-plc-tag' ),
                    'upper-roman' => __( 'Upper Roman', 'wp-plc-tag' ),
                    'lower-alpha' => __( 'Lower Alpha', 'wp-plc-tag' ),
                    'none' => __( 'None', 'wp-plc-tag' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .plc-tag-list' => 'list-style-type: {{VALUE}}',
                ],

            ]
        );

        $this->add_responsive_control(
            'tab_list_margin',
            [
                'label' => __( 'Margin', 'wp-plc-tag' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .plc-tag-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        # Section - End
        $this->end_controls_section();
        /**
         * GENERAL SETTINGS - LIST - END
         * @since 1.0.0
         */

        /**
         * STYLE SETTINGS - CONTAINER - START
         * @since 1.0.0
         */
        # Section - Start
        $this->start_controls_section(
            'tag_list_settings',
            [
                'label' => __('Tag List', 'wp-plc-tag'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tag_list_background_color',
            [
                'label' => __( 'Background Color', 'wp-plc-tag' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .plc-tag-list' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_list_padding',
            [
                'label' => __( 'Padding', 'wp-plc-tag' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .plc-tag-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        # Section - End
        $this->end_controls_section();
        /**
         * STYLE SETTINGS - CONTAINER - END
         * @since 1.0.0
         */

        /**
         * STYLE SETTINGS - TITLE - START
         * @since 1.0.0
         */
        # Section - Start
        $this->start_controls_section(
            'tag_list_item_settings',
            [
                'label' => __('Tag List - Item', 'wp-plc-tag'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        # List Item Title Color
        $this->add_control(
            'tag_list_item_color',
            [
                'label' => __( 'Textfarbe', 'wp-plc-tag' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#575756',
                'selectors' => [
                    '{{WRAPPER}} .plc-tag-list li,{{WRAPPER}} .plc-tag-list li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        # List Item Title Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tag_list_item_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .plc-tag-list li',
            ]
        );

        # List Item Title Text Shadow
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'tag_list_item_shadow',
                'label' => __( 'Text Shadow', 'wp-plc-tag' ),
                'selector' => '{{WRAPPER}} .plc-tag-list li',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tag_list_item_border',
                'selector' => '{{WRAPPER}} .plc-tag-list li',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'tag_list_item_border_radius',
            [
                'label' => __( 'Border Radius', 'wp-plc-tag' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .plc-tag-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        # Section - End
        $this->end_controls_section();
        /**
         * STYLE SETTINGS - TITLE - END
         * @since 1.0.0
         */
    }
}