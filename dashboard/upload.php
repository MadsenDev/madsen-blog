<?php
// Configure the upload directory
$upload_dir = '../uploads/';

// Check if a file is uploaded
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Generate a unique file name
    $filename = uniqid() . '_' . basename($file['name']);

    // Move the uploaded file to the upload directory
    if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
        // Return the file URL
        $file_url = $upload_dir . $filename;
        echo json_encode(['location' => $file_url]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to upload the file.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No file was uploaded.']);
}
?>