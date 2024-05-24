<?php
/*
Plugin Name: Elementor Custom Widget (KYL)
Description: Adds a new widget to the Elementor page builder.
Version: 1.0
Author: Kylokean
Author URI: https://www.kylokean.com
*/


// This function adds a new widget to the Elementor page builder.
function custom_add_elementor_widget() {
    if (class_exists('Elementor\Widget_Base')) {
        
        class Custom_Elementor_Widget extends \Elementor\Widget_Base {
            
            public function get_name() {
                return 'custom-widget';
            }
            
            public function get_title() {
                return 'KYL Widget 01';
            }
            
            public function get_icon() {
                return 'eicon-section';
            }
            
            public function get_categories() {
                return ['general'];
            }
            
            protected function _register_controls() {
                $this->start_controls_section(
                    'custom_section',
                    [
                        'label' => 'Custom Section',
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );
                
                $this->add_control(
                    'custom_text',
                    [
                        'label' => 'Custom Text',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Hello World',
                    ]
                );
                
                $this->end_controls_section();
            }
            
            protected function render() {
                $settings = $this->get_settings_for_display();
                echo '<div class="custom-widget">';
                echo '<h3>' . $settings['custom_text'] . '</h3>';
                echo '</div>';
            }
            
            protected function _content_template() {}
        }
        
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Custom_Elementor_Widget());
    }
}

// Hook the custom_add_elementor_widget function to the elementor/widgets/widgets_registered action hook.
add_action('elementor/widgets/widgets_registered', 'custom_add_elementor_widget');
