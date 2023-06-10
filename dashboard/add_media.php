<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
    <script>
        // Function to handle the upload response
        function handleUploadResponse(response) {
            if (response.location) {
                alert('File uploaded successfully.');
                // Optionally, you can do something with the file URL (response.location)
            } else {
                alert('File upload failed: ' + response.error);
            }
        }
    </script>
</head>
<body>

<div class="wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="content">
    <h1>Add Media</h1>

    <!-- Form for uploading files -->
    <form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="event.preventDefault(); uploadFile(this);">
        <input type="file" name="file" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <script>
        // Function to upload file using AJAX
        function uploadFile(form) {
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();

            xhr.open('POST', form.action, true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    handleUploadResponse(JSON.parse(xhr.responseText));
                } else {
                    handleUploadResponse({ error: 'Server responded with status ' + xhr.status });
                }
            };

            xhr.send(formData);
        }
    </script>
    </div>
</div>

</body>
</html>