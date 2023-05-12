<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="toggle-sidebar-btn">
                <button onclick="toggleSidebar()">Toggle Sidebar</button>
            </div>
            <!-- Main content -->
            <h1>Dashboard</h1>
            <p>Welcome to the Dashboard!</p>
        </div>
    </div>
    <script src="dashboard.js"></script>
</body>
</html>