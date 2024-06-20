<?php
/**
 * Plugin Name: My Gutenberg Blocks
 * Description: Mi plugin con bloques
 * Version: 1.0
 * Author: Sergio Espinoza
*/

if(!defined("ABSPATH")) {
    exit;
 }


 function my_gutenberg_blocks_register_blocks()
 {
     $asset_file = include (plugin_dir_path(__FILE__) . "/build/index.asset.php");
 
     //Registra scripts el editor del bloque
     wp_enqueue_script(
         "my-blocks-editor",
         plugin_dir_url(__FILE__) . 'build/index.js',
         $asset_file["dependencies"],
         $asset_file["version"]
     );
    
 
 
     //Registrar los estilos del editor de bloques
     wp_register_style(
         "my-blocks-editor-style",
         plugins_url("build/editor.css", __FILE__ ),
         array(),
         $asset_file["version"]
     );
    
 
     //Registrar los estilos del frontend
     wp_register_style(
         "my-blocks-style",
         plugins_url("build/style.css", __FILE__ ),
         array(),
         $asset_file["version"]
     );
 
 require_once plugin_dir_path(__FILE__) ."includes/blocks/sketchfab-block.php";
 //require_once plugin_dir_path(__FILE__) ."blocks/poke-block.php";
 
 
 }
 
 add_action("init","my_gutenberg_blocks_register_blocks");