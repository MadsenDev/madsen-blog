<?php

// Database connection settings
require_once '../db.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Delete previous menu items
    $deleteMenuItems = "DELETE FROM dashboard_menu";
    $stmt = $conn->prepare($deleteMenuItems);
    $stmt->execute();

    // Parse menu items from submitted data
    $menuItems = isset($_POST['menu-items']) ? json_decode($_POST['menu-items'], true) : [];

    // Prepare SQL statement for inserting menu items
    $sql = "INSERT INTO dashboard_menu (id, icon, name, url, parent_id, position, custom_class) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Loop through the menu items and insert each one into the database
    foreach ($menuItems as $item) {
        $stmt->bind_param(
            "isssiss",
            $item['id'],
            $item['icon'],
            $item['name'],
            $item['url'],
            $item['parent_id'],
            $item['position'],
            $item['custom_class']
        );
        $stmt->execute();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the menu editor
    header("Location: menus.php");
}
?>