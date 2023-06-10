<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head.php'; ?>
  <style>
    /* Custom CSS styles for the media gallery */
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
      grid-gap: 10px;
    }
    
    .gallery img {
      width: 100px; /* Thumbnail size */
      height: 100px; /* Thumbnail size */
      object-fit: cover; /* Resizes the image to fit the thumbnail dimensions */
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="content">
      <h1>Media Gallery <a href="add_media.php">Add New</a></h1>
      <div class="gallery">
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
    </div>
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