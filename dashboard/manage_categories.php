<?php
// Database connection
require_once '../db.php';

// Fetch all categories
$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

function buildCategoryOptions($categories, $parentId = 0, $indent = "") {
    $html = "";

    foreach ($categories as $category) {
        if ($category['parent_id'] == $parentId) {
            $html .= '<option value="' . $category['id'] . '">' . $indent . $category['name'] . '</option>';
            $html .= buildCategoryOptions($categories, $category['id'], $indent . "--");
        }
    }

    return $html;
}

$categoryOptions = buildCategoryOptions($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <h2>Manage Categories</h2>
            
            <!-- Form to add a new category -->
            <form action="add_category.php" method="post">
                <input type="text" name="name" placeholder="Category Name">
                <textarea name="description" placeholder="Category Description"></textarea>
                <select name="parent_id">
                    <option value="">Select Parent Category</option>
                    <?php echo $categoryOptions; ?>
                </select>
                <button type="submit">Add Category</button>
            </form>

            <!-- List of existing categories -->
            <?php foreach($categories as $category): ?>
                <div>
                    <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p><?php echo htmlspecialchars($category['description']); ?></p>
                    
                    <!-- Form to edit a category -->
                    <form action="edit_category.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                        <input type="text" name="name" placeholder="New Category Name">
                        <textarea name="description" placeholder="New Category Description"></textarea>
                        <select name="parent_id">
                            <option value="">Select New Parent Category</option>
                            <?php echo $categoryOptions; ?>
                        </select>
                        <button type="submit">Edit Category</button>
                    </form>

                    <!-- Form to delete a category -->
                    <form action="delete_category.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                        <button type="submit">Delete Category</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>