<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

$main_domain = 'https://xstore.8theme.com/demos/';
$versions = array(
    'default' => array(
        'title' => 'Default',
        'preview_url' => 'https://xstore.8theme.com/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'woocommerce','wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'organic-cosmetics' => array(
        'title' => 'Organic-Cosmetics',
        'preview_url' => $main_domain . '2/organic-cosmetics/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'static-blocks' => true,
            'testimonials' => false,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
            'multiple_headers' => true,
            'multiple_conditions' => true,
            'multiple_single_product' => true,
            'multiple_single_product_conditions' => true,
            'single_product_builder' => true,
        ),
        'plugins' => array( 'woocommerce', 'wwp-vc-gmaps', 'contact-form-7', 'revslider', 'mailchimp-for-wp', 'mpc-massive' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'ecotransport' => array(
        'title' => 'Eco Transport',
        'preview_url' => $main_domain . '2/ecotransport/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => true,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
            'multiple_headers' => true,
            'multiple_conditions' => true,
            'multiple_single_product' => true,
            'multiple_single_product_conditions' => true,
            'single_product_builder' => true,
        ),
        'plugins' => array( 'woocommerce', 'contact-form-7', 'revslider', 'mailchimp-for-wp', 'mpc-massive' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'eco-scooter' => array(
        'title' => 'Eco scooter',
        'preview_url' => $main_domain . '2/eco-scooter/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            // 'grid-builder' => true,
            //'mailchimp' => false,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            // 'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            //'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
            'single_product_builder' => true,
        ),
        'plugins' => array( 'woocommerce', 'contact-form-7', 'revslider' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'niche-market' => array(
        'title' => 'Niche market',
        'preview_url' => $main_domain . '2/niche-market/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            // 'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            // 'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            // 'testimonials' => false,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
            'single_product_builder' => true,
        ),
        'plugins' => array( 'woocommerce', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'decor' => array(
        'title' => 'Home decor',
        'preview_url' => $main_domain . '2/home-decor/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => true,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => false,            
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => false,            
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'woocommerce','revslider','contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all',
    ),
    'minimalist-outfits' => array(
        'title' => 'Minimalist outfits',
        'preview_url' => $main_domain . '2/minimalist-outfits/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'woocommerce','revslider','contact-form-7', 'mailchimp-for-wp','sb-woocommerce-infinite-scroll' ),
        'type' => 'demo',
        'filter' => 'all',
    ),
    'language-courses' => array(
        'title' => 'Language courses',
        'preview_url' => $main_domain . '2/language-courses/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'content-presets' => true,            
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,            
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => false,            
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all corporate',
    ),
    'fashion' => array(
        'title' => 'Fashion',
        'preview_url' => $main_domain . '2/fashion/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ), 
    'artmaxy' => array(
        'title' => 'Artmaxy',
        'preview_url' => $main_domain . '2/artmaxy/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => true,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all',
    ),   
    'lingerie' => array(
        'title' => 'Lingerie',
        'preview_url' => $main_domain . '2/lingerie/',
        'to_import' => array(
            'content' => true,
            //'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => true,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'babyland01' => array(
        'title' => 'BabyLand 01',
        'preview_url' => $main_domain . '2/babyland01/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => true,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all',
    ),
    'organic02' => array(
        'title' => 'Organic 02',
        'preview_url' => $main_domain . '2/organic02/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all',
    ),
    'organic01' => array(
        'title' => 'Organic 01',
        'preview_url' => $main_domain . '2/organic01/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => true,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'electron01' => array(
        'title' => 'Electron 01',
        'preview_url' => $main_domain . '2/electron01/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => true,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'electron02' => array(
        'title' => 'Electron 02',
        'preview_url' => $main_domain . '2/electron02/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'marseille02' => array(
        'title' => 'Marseille 02',
        'preview_url' => $main_domain . '2/marseille02/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'marseille01' => array(
        'title' => 'Marseille 01',
        'preview_url' => $main_domain . '2/marseille01/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => false,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all',
    ),
    'designers' => array(
        'title' => 'Designers',
        'preview_url' => $main_domain . '2/designers/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => false,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all',
    ),
    'cleaning' => array(
        'title' => 'Cleaning',
        'preview_url' => $main_domain . '2/cleaning/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => false,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            //'products' => false,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            //'testimonials' => false,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all',
    ),
    'baby-shop' => array(
        'title' => 'Baby Shop',
        'preview_url' => $main_domain . '2/baby-shop/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all',
    ),
    'carwash' => array(
        'title' => 'Car wash',
        'preview_url' => $main_domain . '2/carwash/',
        'to_import' => array(
            'content' => true,
            //'contact-forms' => false,
            //'grid-builder' => false,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'delivery' => array(
        'title' => 'Delivery',
        'preview_url' => $main_domain . '2/delivery/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => false,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            //'products' => false,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => false,
            //'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => false,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular catalog one-page',
    ),
    'photographer' => array(
        'title' => 'Photographer',
        'preview_url' => $main_domain . '2/photographer/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => false,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'x-phone' => array(
        'title' => 'X-Phone',
        'preview_url' => $main_domain . '2/x-phone/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),    
    'plumbing' => array(
        'title' => 'Plumbing',
        'preview_url' => $main_domain . '2/plumbing/',
        'to_import' => array(
            'content' => true,
            //'contact-forms' => false,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            //'testimonials' => false,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'furniture2' => array(
        'title' => 'Furniture 2',
        'preview_url' => $main_domain . 'furniture2/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            //'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'interior' => array(
        'title' => 'Interior',
        'preview_url' => $main_domain . 'interior/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => true,
            //'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            //'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'spa' => array(
        'title' => 'Spa',
        'preview_url' => $main_domain . 'spa/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            //'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            //'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular catalog',
    ),
    'mobile' => array(
        'title' => 'Mobile Apps',
        'preview_url' => $main_domain . 'mobile/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            //'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp','subscriptio' ),
        'type' => 'demo',
        'filter' => 'all popular catalog one-page',
    ),
    'burger' => array(
        'title' => 'Burger',
        'preview_url' => $main_domain . 'burger/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => true,
            //'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'wedding' => array(
        'title' => 'Wedding',
        'preview_url' => $main_domain . 'wedding/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            //'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'bicycle' => array(
        'title' => 'Bicycle',
        'preview_url' => $main_domain . 'bike/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            //'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 3,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular one-page',

    ),
    'furniture' => array(
        'title' => 'Furniture',
        'preview_url' => $main_domain . 'furniture/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => false,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'cosmetics' => array(
        'title' => 'Cosmetics',
        'preview_url' => $main_domain . 'cosmetics/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'engineer' => array(
        'title' => 'Engineer',
        'preview_url' => $main_domain . 'engineer/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'glasses' => array(
        'title' => 'Glasses',
        'preview_url' => $main_domain . 'glasses/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'kids' => array(
        'title' => 'Kids',
        'preview_url' => $main_domain . 'kids/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'organic' => array(
        'title' => 'Organic',
        'preview_url' => $main_domain . 'organic/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            //'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            //'projects' => false,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'drinks' => array(
        'title' => 'Drinks',
        'preview_url' => $main_domain . 'drinks/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular catalog',
    ),
    'bakery' => array(
        'title' => 'Bakery',
        'preview_url' => $main_domain . 'bakery/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'hipster' => array(
        'title' => 'Hipster',
        'preview_url' => $main_domain . 'hipster/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'jewellery' => array(
        'title' => 'Jewellery',
        'preview_url' => $main_domain . 'jewellery/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'landing' => array(
        'title' => 'Landing',
        'preview_url' => $main_domain . 'landing-watch/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular catalog one-page',
    ),
    'hosting' => array(
        'title' => 'Hosting',
        'preview_url' => $main_domain . 'hosting/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'subscriptio' ),
        'type' => 'demo',
        'filter' => 'all popular catalog one-page corporate',
    ),
    'electronics' => array(
        'title' => 'Electronics',
        'preview_url' => $main_domain . 'electronics/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),    
    'sushi' => array(
        'title' => 'Sushi Restaurant',
        'preview_url' => $main_domain . 'sushi/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular catalog',
    ),
    'gym' => array(
        'title' => 'Gym',
        'preview_url' => $main_domain . 'gym/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'corporate' => array(
        'title' => 'Corporate',
        'preview_url' => $main_domain . 'corporate/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular catalog corporate',
    ),  
    'finances' => array(
        'title' => 'Finances',
        'preview_url' => $main_domain . 'finances/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular catalog corporate',
    ),
     'marketing' => array(
        'title' => 'Marketing',
        'preview_url' => $main_domain . 'marketing/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular corporate',
    ), 
     'lawyer' => array(
        'title' => 'Lawyer',
        'preview_url' => $main_domain . 'lawyer/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular corporate',
    ),
    'flowers' => array(
        'title' => 'Flowers',
        'preview_url' => $main_domain . 'flowers/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'handmade' => array(
        'title' => 'Handmade',
        'preview_url' => $main_domain . 'handmade/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'medical' => array(
        'title' => 'Medical',
        'preview_url' => $main_domain . 'medical/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'minimal' => array(
        'title' => 'Minimal',
        'preview_url' => $main_domain . 'minimal/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'concert' => array(
        'title' => 'Concert',
        'preview_url' => $main_domain . 'concert/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'animals' => array(
        'title' => 'Animals',
        'preview_url' => $main_domain . 'animals/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'underwear' => array(
        'title' => 'Underwear',
        'preview_url' => $main_domain . 'underwear/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'books' => array(
        'title' => 'Books',
        'preview_url' => $main_domain . 'books/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 4,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'makeup' => array(
        'title' => 'Makeup',
        'preview_url' => $main_domain . 'makeup/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'tea' => array(
        'title' => 'Tea',
        'preview_url' => $main_domain . 'tea/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'freelance' => array(
        'title' => 'Freelance',
        'preview_url' => $main_domain . 'freelance/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular catalog one-page corporate',
    ),
    'shoes' => array(
        'title' => 'Shoes',
        'preview_url' => $main_domain . 'shoes/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'cocktails' => array(
        'title' => 'Cocktails',
        'preview_url' => $main_domain . 'cocktails/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 2,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular catalog',
    ),
    'barbershop' => array(
        'title' => 'Barbershop',
        'preview_url' => $main_domain . 'barbershop/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular catalog',
    ),
    'business' => array(
        'title' => 'Business',
        'preview_url' => $main_domain . 'business/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular catalog corporate',
    ),
    'games' => array(
        'title' => 'Games',
        'preview_url' => $main_domain . 'games/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'typography' => array(
        'title' => 'Typography',
        'preview_url' => $main_domain . 'typography/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular one-page',
    ),
    'pizza' => array(
        'title' => 'Pizza',
        'preview_url' => $main_domain . 'pizza/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            // 'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => 3,
            'home_page' => true,
        ),
        'plugins' => array( 'revslider', 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'dark' => array(
        'title' => 'Dark',
        'preview_url' => $main_domain . 'dark/',
        'to_import' => array(
            'content' => true,
            'contact-forms' => true,
            'grid-builder' => true,
            'mailchimp' => true,
            'media' => true,
            'menu' => true,
            'fonts' => false,
            'options' => true, 
            'pages' => true,
            'posts' => true,
            'products' => true,
            'projects' => true,
            //'smart-products' => true,
            'static-blocks' => true,
            'testimonials' => true,
            'variations' => true,
            //'vc-templates' => true,
            'widgets' => true,
            'slider' => true,
            'home_page' => true,
        ),
        'type' => 'demo',
        'filter' => 'all popular',
    ),
    'coming-soon-red' => array(
        'title' => 'Coming soon red',
        'preview_url' => $main_domain . 'coming-soon-page/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'coming-soon-dark' => array(
        'title' => 'Coming soon dark',
        'preview_url' => $main_domain . 'coming-soon-black/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'coming-soon-white' => array(
        'title' => 'Coming soon white',
        'preview_url' => $main_domain . 'coming-soon-white/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'coming-soon-flat' => array(
        'title' => 'Coming soon flat',
        'preview_url' => $main_domain . 'coming-soon-flat/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'coming-soon-xstore' => array(
        'title' => 'Coming soon xstore',
        'preview_url' => $main_domain . 'coming-soon-xstore/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'coming-soon-we-are-coming-soon' => array(
        'title' => 'We are coming soon',
        'preview_url' => $main_domain . '2/we-are-coming-soon/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'plugins' => array('mpc-massive'),
        'type' => 'demo'
    ),
    'coming-soon-great-things-are-coming' => array(
        'title' => 'Great things are coming',
        'preview_url' => $main_domain . '2/great-things-are-coming/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'plugins' => array('mpc-massive'),
        'type' => 'demo'
    ),    
    'coming-soon-modern-x-coming' => array(
        'title' => 'Modern X coming',
        'preview_url' => $main_domain . '2/modern-x-coming/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'plugins' => array('mpc-massive'),
        'type' => 'demo'
    ),
    'coming-soon-space-coming' => array(
        'title' => 'Space coming',
        'preview_url' => $main_domain . '2/space-coming/',
        'to_import' => array(
            'pages' => true,
            'home_page' => true,
        ),
        'plugins' => array('mpc-massive'),
        'type' => 'demo'
    ),
    'faq' => array(
        'title' => 'FaQ',
        'preview_url' => $main_domain . 'typography-page/faq/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'home-default-red' => array(
        'title' => 'Home default red',
        'preview_url' => $main_domain . 'home-default',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'widgets' => true,
            'home_page' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'home-default-yellow' => array(
        'title' => 'Home default yellow',
        'preview_url' => $main_domain . '',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'options' => true,
            'slider' => true,
        ),
        'type' => 'page'
    ),   
    'home-banners' => array(
        'title' => 'Home banners',
        'preview_url' => $main_domain . 'home-banners/?preset=boxed',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),    
    'home-minimal' => array(
        'title' => 'Home minimal',
        'preview_url' => $main_domain . 'home-minimal',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => 2,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'home-boxed' => array(
        'title' => 'Home boxed',
        'preview_url' => $main_domain . 'home-boxed/?preset=boxed',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),   
    'look-book-fresh' => array(
        'title' => 'Look Book Fresh',
        'preview_url' => $main_domain . 'typography-page/look-book-fresh/?preset=lookbook',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'look-book' => array(
        'title' => 'Look Book',
        'preview_url' => $main_domain . 'typography-page/look-book/?preset=lookbook',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'team' => array(
        'title' => 'Meet the team',
        'preview_url' => $main_domain . 'typography-page/team-members/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'single-member' => array(
        'title' => 'Single Member',
        'preview_url' => $main_domain . 'typography-page/single-member-page/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'parallax-presentation' => array(
        'title' => 'Parallax Presentation',
        'preview_url' => $main_domain . 'typography-page/parallax-presentation/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'modern-process' => array(
        'title' => 'Modern Process',
        'preview_url' => $main_domain . 'typography-page/modern-process/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'informations' => array(
        'title' => 'Informations',
        'preview_url' => $main_domain . 'typography-page/informations/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'our-office' => array(
        'title' => 'Our Office',
        'preview_url' => $main_domain . 'our-office/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'instagram' => array(
        'title' => 'Instagram Wall',
        'preview_url' => $main_domain . 'typography-page/instagram-wall/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'track-order' => array(
        'title' => 'Track order',
        'preview_url' => $main_domain . 'track-order-2/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'animals-about' => array(
        'title' => 'Animals - About',
        'preview_url' => $main_domain . 'animals/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'animals-contactus' => array(
        'title' => 'Animals - Contacts',
        'preview_url' => $main_domain . 'animals/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'artmaxy-about' => array(
        'title' => 'Artmaxy - About Us',
        'preview_url' => $main_domain . '2/artmaxy/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'artmaxy-drawing' => array(
        'title' => 'Artmaxy - Drawing',
        'preview_url' => $main_domain . '2/artmaxy/process-of-drawing/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ), 
    'artmaxy-contacts' => array(
        'title' => 'Artmaxy - Contacts',
        'preview_url' => $main_domain . '2/artmaxy/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),    
    'bakery-about' => array(
        'title' => 'Bakery - About us',
        'preview_url' => $main_domain . 'bakery/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),            
    'books-store' => array(
        'title' => 'Books - Store',
        'preview_url' => $main_domain . 'books/store/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'books-author' => array(
        'title' => 'Books - Author',
        'preview_url' => $main_domain . 'books/author/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'books-contacts' => array(
        'title' => 'Books - Contacts',
        'preview_url' => $main_domain . 'books/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'books-about' => array(
        'title' => 'Books - About',
        'preview_url' => $main_domain . 'books/about/',
        'to_import' => array(
            'content' => true,
            'slider' => 1
        ),
        'type' => 'page'
    ),       
    'baby-shop-about' => array(
        'title' => 'Baby shop - About us',
        'preview_url' => $main_domain . '2/baby-shop/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'baby-shop-contact' => array(
        'title' => 'Baby shop - Contact us',
        'preview_url' => $main_domain . '2/baby-shop/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'babyland01-about' => array(
        'title' => 'BabyLand01 - About us',
        'preview_url' => $main_domain . '2/babyland01/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'babyland01-contact' => array(
        'title' => 'BabyLand01 - Contact us',
        'preview_url' => $main_domain . '2/babyland01/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'barbershop-contacts' => array(
        'title' => 'Barbershop - Contacts',
        'preview_url' => $main_domain . 'barbershop/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'barbershop-albums' => array(
        'title' => 'Barbershop - Albums',
        'preview_url' => $main_domain . 'barbershop/our-albums/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'business-about' => array(
        'title' => 'Business - About',
        'preview_url' => $main_domain . 'business/team/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'business-contacts' => array(
        'title' => 'Business - Contacts',
        'preview_url' => $main_domain . 'business/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'business-services' => array(
        'title' => 'Business - Services',
        'preview_url' => $main_domain . 'business/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),            
    'burger-best' => array(
        'title' => 'Burger - Best burger',
        'preview_url' => $main_domain . 'burger/best-burger/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'burger-delivery' => array(
        'title' => 'Burger - Delivery time',
        'preview_url' => $main_domain . 'burger/delivery-time/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'corporate-service' => array(
        'title' => 'Corporate - Service',
        'preview_url' => $main_domain . 'corporate/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'corporate-certificates' => array(
        'title' => 'Corporate - Certificates',
        'preview_url' => $main_domain . 'corporate/certificates/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'corporate-team' => array(
        'title' => 'Corporate - Team',
        'preview_url' => $main_domain . 'corporate/team/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'corporate-contacts' => array(
        'title' => 'Corporate - Contacts',
        'preview_url' => $main_domain . 'corporate/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cosmetics-about' => array(
        'title' => 'Cosmetics - About us',
        'preview_url' => $main_domain . 'cosmetics/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),              
    'concert-gallery' => array(
        'title' => 'Concert - Gallery',
        'preview_url' => $main_domain . 'concert/gallery/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'concert-contactus' => array(
        'title' => 'Concert - Contacts',
        'preview_url' => $main_domain . 'concert/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'concert-introduction' => array(
        'title' => 'Concert - Introduction',
        'preview_url' => $main_domain . 'concert/place-introduction/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cocktails-kind' => array(
        'title' => 'Coktails - Kind of cocktails',
        'preview_url' => $main_domain . 'cocktails/kind-of-cocktails/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cocktails-menu' => array(
        'title' => 'Сocktails - Menu',
        'preview_url' => $main_domain . 'cocktails/menu/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cocktails-instructions' => array(
        'title' => 'Сocktails - Instructions',
        'preview_url' => $main_domain . 'cocktails/instructions/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cocktails-contacts' => array(
        'title' => 'Сocktails - Contacts',
        'preview_url' => $main_domain . 'cocktails/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cocktails-about' => array(
        'title' => 'Сocktails - About',
        'preview_url' => $main_domain . 'cocktails/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'carwash-work' => array(
        'title' => 'Car wash - How we work',
        'preview_url' => $main_domain . '2/carwash/how-we-work/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),    
    'cleaning-booking' => array(
        'title' => 'Cleaning - Booking',
        'preview_url' => $main_domain . '2/cleaning/booking/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cleaning-team' => array(
        'title' => 'Cleaning - Team',
        'preview_url' => $main_domain . '2/cleaning/our-team/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'delivery-company' => array(
        'title' => 'Devilvery - Our Company',
        'preview_url' => $main_domain . '2/delivery/our-company/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'delivery-tracking' => array(
        'title' => 'Delivery - tracking',
        'preview_url' => $main_domain . '2/delivery/tracking/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'designers-shop' => array(
        'title' => 'Designers - Shop',
        'preview_url' => $main_domain . '2/designers/our-shop/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'designers-gallery' => array(
        'title' => 'Designers - Gallery',
        'preview_url' => $main_domain . '2/designers/gallery/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'drinks-our-history' => array(
        'title' => 'Drinks - Our history ',
        'preview_url' => $main_domain . 'drink/our-history/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'electronics-about' => array(
        'title' => 'Electronics - About us',
        'preview_url' => $main_domain . 'electronics/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'electronics-contacts' => array(
        'title' => 'Electronics - Contacts',
        'preview_url' => $main_domain . 'electronics/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'electron01-contacts' => array(
        'title' => 'Electron 01 - Contact us',
        'preview_url' => $main_domain . '2/electron01/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'electron01-delivery' => array(
        'title' => 'Electron 01 - Delivery',
        'preview_url' => $main_domain . '2/electron01/delivery-rules/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'electron02-about' => array(
        'title' => 'Electron 02 - About us',
        'preview_url' => $main_domain . '2/electron02/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'electron02-contacts' => array(
        'title' => 'Electron 02 - Contact us',
        'preview_url' => $main_domain . '2/electron02/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'electron02-trackorder' => array(
        'title' => 'Electron 02 - Track order',
        'preview_url' => $main_domain . '2/electron02/track-order/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'engineer-about' => array(
        'title' => 'Engineer - About us',
        'preview_url' => $main_domain . 'engineer/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'fashion-about' => array(
        'title' => 'Fashion - About',
        'preview_url' => $main_domain . 'fashion/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'fashion-contacts' => array(
        'title' => 'Fashion - Contacts',
        'preview_url' => $main_domain . 'fashion/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'finances-about' => array(
        'title' => 'Finances - About',
        'preview_url' => $main_domain . 'finances/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'finances-contacts' => array(
        'title' => 'Finances - Contacts',
        'preview_url' => $main_domain . 'finances/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'finances-services' => array(
        'title' => 'Finances - Services',
        'preview_url' => $main_domain . 'finances/offer/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),       
    'flowers-about' => array(
        'title' => 'Flowers - About',
        'preview_url' => $main_domain . 'flowers/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'flowers-contacts' => array(
        'title' => 'Flowers - Contacts',
        'preview_url' => $main_domain . 'flowers/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'freelance-experience' => array(
        'title' => 'Freelance - Experience',
        'preview_url' => $main_domain . 'freelance/experience/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'freelance-portfolio' => array(
        'title' => 'Freelance - Portfolio',
        'preview_url' => $main_domain . 'freelance/portfolio/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'freelance-services' => array(
        'title' => 'Freelance - Services',
        'preview_url' => $main_domain . 'freelance/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'furniture-about' => array(
        'title' => 'Furniture - About us',
        'preview_url' => $main_domain . 'furniture/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'furniture2-about' => array(
        'title' => 'Furniture 2 - About us',
        'preview_url' => $main_domain . 'furniture2/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'furniture2-contact-us' => array(
        'title' => 'Furniture 2 - Contact Us',
        'preview_url' => $main_domain . 'furniture2/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),  
    'games-about' => array(
        'title' => 'Games - About',
        'preview_url' => $main_domain . 'games/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'games-contacts' => array(
        'title' => 'Games - Contacts',
        'preview_url' => $main_domain . 'games/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'glasses-about' => array(
        'title' => 'Glasses - About us',
        'preview_url' => $main_domain . 'glasses/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ), 
    'gym-contacts' => array(
        'title' => 'Gym - Contacts',
        'preview_url' => $main_domain . 'gym/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'gym-about' => array(
        'title' => 'Gym - About us',
        'preview_url' => $main_domain . 'gym/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ), 
    'handmade-instruction' => array(
        'title' => 'Handmade - Instruction',
        'preview_url' => $main_domain . 'handmade/instruction',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),  
    'hipster-about' => array(
        'title' => 'Hipster - About Us',
        'preview_url' => $main_domain . 'hipster/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'decor-about' => array(
        'title' => 'Home decor - About us',
        'preview_url' => $main_domain . '2/home-decor/about-us-home-decor/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'decor-contacts' => array(
        'title' => 'Home decor - Contact us',
        'preview_url' => $main_domain . '2/home-decor/contact-us-home-decor/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'hosting-about' => array(
        'title' => 'Hosting - About us',
        'preview_url' => $main_domain . 'hosting/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'hosting-contacts' => array(
        'title' => 'Hosting - Contacts',
        'preview_url' => $main_domain . 'hosting/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ), 
    'interior-about' => array(
        'title' => 'Interior - About us',
        'preview_url' => $main_domain . 'interior/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'interior-categories' => array(
        'title' => 'Interior - Categories',
        'preview_url' => $main_domain . 'interior/categories/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'jewellery-about' => array(
        'title' => 'Jewellery - About us',
        'preview_url' => $main_domain . 'jewellery/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'kids-about' => array(
        'title' => 'Kids - About us',
        'preview_url' => $main_domain . 'kids/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'language-courses-about-lessons' => array(
        'title' => 'Language courses - About lessons',
        'preview_url' => $main_domain . '2/language-courses/about-lessons/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'language-courses-contacts' => array(
        'title' => 'Language courses - Contacts',
        'preview_url' => $main_domain . '2/language-courses/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'language-courses-our-courses' => array(
        'title' => 'Language courses - Our courses',
        'preview_url' => $main_domain . '2/language-courses/our-courses/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'language-courses-prices' => array(
        'title' => 'Language courses - Prices',
        'preview_url' => $main_domain . '2/language-courses/our-prices/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lawyer-about' => array(
        'title' => 'Lawyer - About',
        'preview_url' => $main_domain . 'lawyer/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lawyer-team' => array(
        'title' => 'Lawyer - Team',
        'preview_url' => $main_domain . 'lawyer/lawyers-team/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lawyer-contacts' => array(
        'title' => 'Lawyer - Contacts',
        'preview_url' => $main_domain . 'lawyer/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lawyer-services' => array(
        'title' => 'Lawyer - Services',
        'preview_url' => $main_domain . 'lawyer/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lingerie-about' => array(
        'title' => 'Lingerie - Aabout Us',
        'preview_url' => $main_domain . '2/lingerie/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lingerie-contact' => array(
        'title' => 'Lingerie - Contact Us',
        'preview_url' => $main_domain . '2/lingerie/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),    
    'makeup-contacts' => array(
        'title' => 'Makeup - Contacts',
        'preview_url' => $main_domain . 'makeup/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'makeup-about' => array(
        'title' => 'Makeup - About',
        'preview_url' => $main_domain . 'makeup/about/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'marketing-about' => array(
        'title' => 'Marketing - About',
        'preview_url' => $main_domain . 'marketing/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'marketing-contacts' => array(
        'title' => 'Marketing - Contacts',
        'preview_url' => $main_domain . 'marketing/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'marketing-works' => array(
        'title' => 'Marketing - Works',
        'preview_url' => $main_domain . 'marketing/works/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'marketing-services' => array(
        'title' => 'Marketing - Services',
        'preview_url' => $main_domain . 'marketing/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'marketing-offers' => array(
        'title' => 'Marketing - Offers',
        'preview_url' => $main_domain . 'marketing/offers/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'medical-doctors' => array(
        'title' => 'Medical - Doctors',
        'preview_url' => $main_domain . 'medical/our-doctors',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'medical-offers' => array(
        'title' => 'Medical - Offers',
        'preview_url' => $main_domain . 'medical/offers',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'medical-contacts' => array(
        'title' => 'Medical - Contacts',
        'preview_url' => $main_domain . 'medical/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'minimal-contacts' => array(
        'title' => 'Minimal - Contacts',
        'preview_url' => $main_domain . 'minimal/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'minimal-about' => array(
        'title' => 'Minimal - About',
        'preview_url' => $main_domain . 'minimal/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'minimal-lookbook' => array(
        'title' => 'Minimal - Lookbook',
        'preview_url' => $main_domain . 'minimal/lookbook/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'minimalist-outfits-about' => array(
        'title' => 'Minimalist outfits - About',
        'preview_url' => $main_domain . '2/minimalist-outfits/minimalist-outfits-about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'minimalist-outfits-contacts' => array(
        'title' => 'Minimalist outfits - Contact us',
        'preview_url' => $main_domain . '2/minimalist-outfits/minimalist-outfits-contacts/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'organic-about' => array(
        'title' => 'Organic - About us',
        'preview_url' => $main_domain . 'organic/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'organic-contacts' => array(
        'title' => 'Organic - Contacts',
        'preview_url' => $main_domain . 'organic/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),    
    'organic01-about' => array(
        'title' => 'Organic01 - About us',
        'preview_url' => $main_domain . '2/organic01/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'organic01-contacts' => array(
        'title' => 'Organic01 - Contacts',
        'preview_url' => $main_domain . '2/organic01/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'organic01-delivery' => array(
        'title' => 'Organic01 - Delivery price',
        'preview_url' => $main_domain . '2/organic01/delivery-price/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'organic02-about' => array(
        'title' => 'Organic02 - About us',
        'preview_url' => $main_domain . '2/organic02/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'organic02-contact' => array(
        'title' => 'Organic02 - Contacts',
        'preview_url' => $main_domain . '2/organic02/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'plumbing-about' => array(
        'title' => 'Plumbing - About Us',
        'preview_url' => $main_domain . '2/plumbing/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ), 
    'photographer-about-us' => array(
        'title' => 'Photographer - About Me ',
        'preview_url' => $main_domain . '2/photographer/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'photographer-contact-us' => array(
        'title' => 'Photographer - Comtact Me',
        'preview_url' => $main_domain . '2/photographer/contact-me/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'photographer-offers' => array(
        'title' => 'Photographer - Our Offers',
        'preview_url' => $main_domain . '2/photographer/our-offers/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'pizza-about' => array(
        'title' => 'Pizza - About',
        'preview_url' => $main_domain . 'pizza/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'pizza-contacts' => array(
        'title' => 'Pizza - Contacts',
        'preview_url' => $main_domain . 'pizza/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'pizza-menu' => array(
        'title' => 'Pizza - Menu',
        'preview_url' => $main_domain . 'pizza/our-menu/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'pizza-food-tracker' => array(
        'title' => 'Pizza - Food Tracker',
        'preview_url' => $main_domain . 'pizza/time-delivery/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'shoes-about' => array(
        'title' => 'Shoes - About',
        'preview_url' => $main_domain . 'shoes/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'shoes-contacts' => array(
        'title' => 'Shoes - Contacts',
        'preview_url' => $main_domain . 'shoes/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'spa-about' => array(
        'title' => 'Spa - About',
        'preview_url' => $main_domain . 'spa/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'spa-recipe' => array(
        'title' => 'Spa - Recipe',
        'preview_url' => $main_domain . 'spa/recipe/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'spa-services' => array(
        'title' => 'Spa - Services',
        'preview_url' => $main_domain . 'spa/our-services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'sushi-contacts' => array(
        'title' => 'Sushi - Contacts',
        'preview_url' => $main_domain . 'sushi/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'sushi-about' => array(
        'title' => 'Sushi - About us',
        'preview_url' => $main_domain . 'sushi/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'sushi-info' => array(
        'title' => 'Sushi - Information',
        'preview_url' => $main_domain . 'sushi/information/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'sushi-menu' => array(
        'title' => 'Sushi - Menu',
        'preview_url' => $main_domain . 'sushi/our-menu/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'tea-kind-of-tea' => array(
        'title' => 'Tea - Kind of tea',
        'preview_url' => $main_domain . 'tea/kind-of-tea/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'tea-ceremony' => array(
        'title' => 'Tea - Ceremony',
        'preview_url' => $main_domain . 'tea/tea-ceremony/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'tea-about' => array(
        'title' => 'Tea - About',
        'preview_url' => $main_domain . 'tea/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'tea-contacts' => array(
        'title' => 'Tea - Contacts',
        'preview_url' => $main_domain . 'tea/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'underwear-about' => array(
        'title' => 'Underwear - About',
        'preview_url' => $main_domain . 'underwear/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'underwear-contacts' => array(
        'title' => 'Underwear - Contacts',
        'preview_url' => $main_domain . 'underwear/contacts/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),    
    'wedding-about' => array(
        'title' => 'Wedding - About',
        'preview_url' => $main_domain . 'wedding/about/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'wedding-contact' => array(
        'title' => 'Wedding - Contact',
        'preview_url' => $main_domain . 'wedding/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'x-phone-contact' => array(
        'title' => 'X-Phone - Contact Us',
        'preview_url' => $main_domain . '2/x-phone/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'x-phone-gallery' => array(
        'title' => 'X-Phone - Gallery',
        'preview_url' => $main_domain . '2/x-phone/our-gallery/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'x-phone-stores' => array(
        'title' => 'X-Phone - Stores',
        'preview_url' => $main_domain . '2/x-phone/our-stores/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    )
);

$popular_demos = array(
    'default',
    'niche-market',
    'marseille02',
    'electronics',
    'animals',
    'engineer',
    'organic01',
    'bicycle',
    'landing',
    'electron01',
    'furniture',
    'hipster',
    'decor',
    'minimalist-outfits',
    'electron02',
    'lingerie',
    'glasses',
    'x-phone',
    'electronics',
    'fashion',
    'interior',
    'minimal',
    'mobile',
    'underwear',
    'burger',
    'dark',
    'carwash',
    'delivery',
    'photographer',
    'typography',
    'games',
    'business',
    'barbershop',
    'cocktails',
    'organic',
    'shoes',
    'freelance',
    'plumbing',
    'furniture2',
    'spa',
    'pizza',
    'tea',
    'books',
    'jewellery',
    'corporate',
    'gym',
    'makeup',
    'marketing',
    'wedding',
    'kids',
    'sushi',
    'handmade',
    'hosting',
    'medical',
    'finances',
    'concert',
    'flowers',
    'bakery',
    'lawyer',
    'cosmetics',
    'drinks',
);

$popular = $catalog = $one_page = $corporate = -1;
foreach ($versions as $key => $value) {
    $versions[$key]['orders'] = array(
        'popular' => $popular,
        'catalog' => $catalog,
        'one-page' => $one_page,
        'corporate' => $corporate
    );
    $popular++;
    $catalog++;
    $one_page++;
    $corporate++;
}

$popular = -1;
foreach ($popular_demos as $key) {
    $versions[$key]['orders']['popular'] = $popular;
    $popular++;
}

return $versions;