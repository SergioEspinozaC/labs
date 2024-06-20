<?php

if (!defined("ABSPATH")) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

add_action("elementor/init",function(){
    class Pokeapi_Widget extends Widget_Base {
        public function get_name() {
            return "pokeapi-widget";
        }
        public function get_title() {
            return __("Pokeapi","my-widgets");
        }
        public function get_icon() {
            return "eicon-elementor";
        }
        public function get_categories() {
            return ["my-widgets"];
        }
        public function get_script_depends()
        {
            return ["pokeapi-script"];
        }
        public function get_style_depends()
        {
            return ["pokeapi-style"];
        }
        protected function _register_controls(){
            $this->start_controls_section(
                "section_content",["label"=>__("Opciones","my-widgets")]
            );
            $this->add_control("banner",[
                "label"=> __("banner","my-widgets"),
                "type"=> Controls_Manager::MEDIA,
            ]);
            $this->end_controls_section();
        }
        protected function render(){
            $settings= $this->get_settings_for_display();
            $banner = $settings["banner"]["url"];
            ?>

            <div class="pokeapi-container">
                <img class="banner" src="<?php echo $banner; ?>" alt="">
                <ul id="pokelist"></ul>
            </div>

            <?php
        }
    }
    function register_pokeapi_widget(){
        \Elementor\Plugin::instance()->widgets_manager->register(new Pokeapi_Widget());
    }
    add_action("elementor/widgets/widgets_registered","register_pokeapi_widget");
});