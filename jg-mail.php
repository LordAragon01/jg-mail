<?php
/**
* Plugin Name: JG Mail
* Plugin URI: https://www.jggenterprise.net
* Description: Contact Form 
* Version: 1.0
* Requires at least: 5.6
* Requires PHP: 7.0
* Author: Joene Gonçalves
* Author URI: https://www.jggenterprise.net
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: jg-mail
* Domain Path: /languages
*/

if(!defined('ABSPATH')){
    exit;
}

if(!class_exists('Jg_Mail')){


    class Jg_Mail{


        public function __construct(){

            $this->define_constants();

            require_once(JG_MAIL_PATH . 'shortcode/class.jg-mail-shortcode.php');
            $shortcode = new Jg_Mail_Shortcode();

            add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 999);

        }

        /**
         * Define Constants
         */
       public function define_constants(){

        define('JG_MAIL_PATH', plugin_dir_path(__FILE__) );
        define('JG_MAIL_URL', plugin_dir_url(__FILE__));
        define('JG_MAIL_VERSION', '1.0.0');

       }
       
       /**
        * Activate Plugin and Create Page
        */
        public static function activate(){
            update_option('rewrite_rules', '');

            global $wpdb;

            $first_name = $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'contact-us'");
            $second_name = $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'contact-mail'");

            if($first_name === null){

                $current_user = wp_get_current_user();

                $page = array(                  
                    'post_title' => __('Contact Us', 'jg-mail'),
                    'post_name' => 'contact-us',
                    'post_status' => 'publish',
                    'post_author' => $current_user->ID,
                    'post_type' => 'page',
                    'post_content' => '<!-- wp:shortcode -->[jg-mail]<!-- /wp:shortcode -->'
                );
                wp_insert_post($page);

            }elseif($first_name != null && $second_name === null ){

                $current_user = wp_get_current_user();

                $page = array(                  
                    'post_title' => __('Contact Mail', 'jg-mail'),
                    'post_name' => 'contact-mail',
                    'post_status' => 'publish',
                    'post_author' => $current_user->ID,
                    'post_type' => 'page',
                    'post_content' => '<!-- wp:shortcode -->[jg-mail]<!-- /wp:shortcode -->'
                );
                wp_insert_post($page);

            }
        }

        /**
         * Deactivate Plugin
         */
        public static function deactivate(){
            flush_rewrite_rules();
        }

        /**
         * Delete Plugin
         */
        public static function uninstall(){
            delete_option('jg-mail');

            global $wpdb;

            $wpdb->query(
                "DELETE FROM $wpdb->posts
                WHERE post_type = 'page'
                AND post_name = 'contact-us' OR post_name = 'contact-mail'
                OR post_name IN ('contact-us','contact-mail');
                "
            );

        }

        /**
         * Register Scripts
         */
        public static function register_scripts(){

            wp_register_style('bootstrap_css', JG_MAIL_URL . 'assets/css/bootstrap.min.css', array(), '4.4.1', 'all');
            wp_register_style('mail_style', JG_MAIL_URL . 'assets/css/style.css', array(), JG_MAIL_VERSION, 'all');
            wp_register_script('bootstrap_js', JG_MAIL_URL . 'assets/js/bootstrap.min.js', array('jquery'), '4.4.1', true);
            wp_register_script('mail_script', JG_MAIL_URL . 'assets/js/script.js', array('jquery'), JG_MAIL_VERSION, true);           

        }

    }

}

if(class_exists('Jg_Mail')){

    register_activation_hook(__FILE__, array('Jg_Mail', 'activate'));
    register_deactivation_hook(__FILE__, array('Jg_Mail', 'deactivate'));
    register_uninstall_hook(__FILE__, array('Jg_Mail', 'uninstall'));

    $jg_mail = new Jg_Mail();

}