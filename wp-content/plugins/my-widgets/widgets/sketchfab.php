<?php

if (!defined("ABSPATH")) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

add_action("elementor/init",function(){
    class Sketchfab_Widget extends Widget_Base {
        public function get_name() {
            return "sketchfab-widget";
        }
        public function get_title() {
            return __("Sketchfab","my-widgets");
        }
        public function get_icon() {
            return "eicon-post-content";
        }
        public function get_categories() {
            return ["my-widgets"];
        }
        public function get_script_depends()
        {
            return ["sketchfab-script"];
        }
        public function get_style_depends()
        {
            return ["sketchfab-style"];
        }
        protected function _register_controls(){
            $this->start_controls_section(
                "section_content",["label"=>__("Opciones","my-widgets")]
            );
            $this->add_control("url-sketchfab",[
                "label"=> __("URL","my-widgets"),
                "type"=> Controls_Manager::TEXT,
                "default"=>"",
            ]);
            $this->end_controls_section();
        }
        protected function render(){
            $settings= $this->get_settings_for_display();
            $sketchfab_url = $settings["url-sketchfab"];
            ?>

            <div class="sketchfab-container">
                <iframe src="<?php echo $sketchfab_url; ?>/embed"
                title="Sketchfab"
                width="600"
                height="450"
                allow="autoplay; fullscreen; vr"
                frameborder="0"></iframe>
            </div>

            <?php
        }
    }
    function register_sketchfab_widget(){
        \Elementor\Plugin::instance()->widgets_manager->register(new Sketchfab_Widget());
    }
    add_action("elementor/widgets/widgets_registered","register_sketchfab_widget");
});