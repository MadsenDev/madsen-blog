<?php
function get_template_part($name) {
    // Get the active theme from the database or configuration
    $active_theme = 'default'; // Replace this with a call to your actual active theme

    // Construct the path to the template part
    $template_part_path = "themes/{$active_theme}/{$name}.php";

    // Check if the template part file exists
    if (file_exists($template_part_path)) {
        // Include the template part
        include($template_part_path);
    } else {
        // Fallback or error handling if the template part doesn't exist
        echo "Template part '{$name}' not found in theme '{$active_theme}'.";
    }
}
?>