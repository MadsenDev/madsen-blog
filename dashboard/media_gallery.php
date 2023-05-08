<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Media Gallery</title>
  <style>
    /* Add your custom CSS styles for the media gallery */
  </style>
</head>
<body>
  <h1>Media Gallery</h1>
  <div>
    <!-- Display images in the media gallery -->
    <!-- You can use PHP to generate this list from your uploads directory -->
<?php
$upload_dir = '../uploads/';
$allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

if ($handle = opendir($upload_dir)) {
    while (($file = readdir($handle)) !== false) {
        $file_info = pathinfo($file);
        if (isset($file_info['extension']) && in_array(strtolower($file_info['extension']), $allowed_extensions)) {
            $file_url = $upload_dir . $file;
            echo '<img src="' . $file_url . '" alt="' . $file_info['filename'] . '" onclick="selectImage(\'' . $file_url . '\', \'' . $file_info['filename'] . '\');" />';
        }
    }
    closedir($handle);
}
?>
  </div>

  <script>
    function selectImage(url, alt) {
      // Send the selected image back to TinyMCE
      window.parent.postMessage({
        mceAction: 'selectImage',
        url: url,
        alt: alt
      }, '*');
    }
  </script>
</body>
</html>