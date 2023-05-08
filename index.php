<?php
require_once 'db.php';
require_once 'functions.php'; // This file should contain the `get_template_part` function and other helper functions

// Get the active theme from the database or configuration
$active_theme = 'mytheme'; // Replace this with a call to your actual active theme

// Include the active theme's header
get_template_part('header');

// Parse the request URI
$request_uri = trim($_SERVER['REQUEST_URI'], '/');

// Add routing logic to determine which content to display
if (preg_match('/^post\/(\d+)$/', $request_uri, $matches)) {
    // Single post
    $post_id = $matches[1];
    require_once "themes/{$active_theme}/single.php";
} elseif (preg_match('/^page\/(\d+)$/', $request_uri, $matches)) {
    // Single page
    $page_id = $matches[1];
    require_once "themes/{$active_theme}/page.php";
} else {
    // Other pages, like home or archive, go here
}

// Include the active theme's sidebar and footer
get_template_part('sidebar');
get_template_part('footer');