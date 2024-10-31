<?php
        /*
        Plugin Name: Pixelate
        Plugin URI: http://webninja.es
        Description: Plugin to easily pixelate any images and optionally reveal them on hover/click. This is a port from pixelate.js by 43081j.
        Version: 0.1
        Author: Sergio Bonet
        Author URI: http://webninja.es
        License: GPL2
        */
        /*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)
    
        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License, version 2, as 
        published by the Free Software Foundation.
    
        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.
    
        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */
        function og_pixelate_setup(){
            wp_enqueue_script( "pixelate.js", WP_PLUGIN_URL . "/ogpixelate/js/pixelate.js" , array( "jquery" ) );
        }
    
        add_action( 'init', 'og_pixelate_setup' );
    
        function og_pixelate_shortcode( $attr, $content ) {
    
             $defaults = array(
               "revealonclick"=>"false" 
            );
             $op = shortcode_atts( $defaults, $attr );
               
                $dom = new DOMDocument();            
                $dom->loadHTML($content);    
                $tags = $dom->getElementsByTagName('img'); 
                if( count($tags) > 0 ) {  
                $tag = $tags->item(0);
                if(!is_null($tag)) {
                    $tag->setAttribute( 'data-pixelate', 'true' );
                    if( $op["revealonclick"] == "true" ){
                        $tag->setAttribute( 'data-revealonclick', 'true' );
                    }else{
                        $tag->setAttribute( 'data-reveal', 'true' );
                    }
                    return $dom->saveHTML();    
                }                
                else {
                    return do_shortcode( $content );
                }
                }
                else {
                    return do_shortcode( $content );
                }
        }
    
        add_shortcode( 'pixelate' , 'og_pixelate_shortcode' );
?>