<?php

 $con=mysqli_connect('localhost','username','passward','databasename');
// Define the valid API key
$valid_api_key = "987654321";

// Get the API key from the request headers
$headers = getallheaders();
$api_key = isset($headers['API-Key']) ? $headers['API-Key'] : '';

// Verify the API key
if ($api_key !== $valid_api_key) {
    http_response_code(403); // Forbidden
    echo "Invalid API key.";
    exit;
}

// Define the directories to store uploaded images and videos
$image_target_dir = "uploads/images/";
$video_target_dir = "uploads/videos/";

// Create the uploads directories if they don't exist
if (!is_dir($image_target_dir)) {
    mkdir($image_target_dir, 0755, true);
}
if (!is_dir($video_target_dir)) {
    mkdir($video_target_dir, 0755, true);
}

// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_FILES['image']) || isset($_FILES['video']))) {
    // Handle image upload
    if (isset($_FILES['image'])) {
        $target_file = $image_target_dir . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            echo "File is an image - " . $check['mime'] . ".\n";
            $uploadOk = 1;
        } else {
            echo "File is not an image.\n";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.\n";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES['image']['size'] > 5000000) {
            echo "Sorry, your file is too large.\n";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.\n";
        // Try to upload file
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES['image']['name'])) . " has been uploaded.\n";
            } else {
                echo "Sorry, there was an error uploading your file.\n";
            }
        }
    }

    // Handle video upload
    if (isset($_FILES['video'])) {
        $target_file = $video_target_dir . basename($_FILES['video']['name']);
        $uploadOk = 1;
        $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size (limit to 50MB)
        if ($_FILES['video']['size'] > 50000000) {
            echo "Sorry, your file is too large.\n";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($videoFileType != "mp4" && $videoFileType != "avi" && $videoFileType != "mov" && $videoFileType != "wmv") {
            echo "Sorry, only MP4, AVI, MOV & WMV files are allowed.\n";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.\n";
        // Try to upload file
        } else {
            if (move_uploaded_file($_FILES['video']['tmp_name'], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES['video']['name'])) . " has been uploaded.\n";
            } else {
                echo "Sorry, there was an error uploading your file.\n";
            }
        }
    }
} else {
    echo "No file was uploaded.\n";
}
?>
