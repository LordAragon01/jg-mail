<?php


if(!class_exists('Jg_Mail_Shortcode')){

    class Jg_Mail_Shortcode{

        public function __construct(){

            add_shortcode('jg-mail', array($this, 'add_shortcode'));

        }

        public function add_shortcode($atts = array(), $content = null, $tag = ''){


            $atts = array_change_key_case((array)$atts, CASE_LOWER);


            extract(shortcode_atts(
                array(
                    'id' => '',
                    'orderby' => 'date'
                ),
                $atts,
                $tag
            ));


            if(!empty($id)){

                $id = array_map('absint', explode(',', $id));

            }

            ob_start();
            require(JG_MAIL_PATH . 'functions/class.sendmail.php');
            require(JG_MAIL_PATH . 'views/contact-us-shortcode.php');
            wp_enqueue_style('bootstrap_css');
            wp_enqueue_style('mail_style');
            wp_enqueue_script('mail_script');
            wp_enqueue_script('bootstrap_js');
            return ob_get_clean();

        }


    }

}