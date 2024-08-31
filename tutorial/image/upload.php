<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve POST data
    $imageData = $_POST['imageData'];
    $location = $_POST['location'];
    $time = $_POST['time'];

    // Check if the required POST data is present
    if (empty($imageData) || empty($location) || empty($time)) {
        die('Required data missing.');
    }

    // Decode the base64 image data
    if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
        $imageData = substr($imageData, strpos($imageData, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif

        // Validate image type
        if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
            die('Invalid image type');
        }

        // Decode the base64 image data
        $imageData = base64_decode($imageData);
        if ($imageData === false) {
            die('Base64 decode failed');
        }

        // Generate a unique file name
        $fileName = uniqid() . '.' . $type;
        $targetDir = 'uploads/';
        $targetFilePath = $targetDir . $fileName;

        // Check if the upload directory exists, if not create it
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0755, true)) {
                die('Failed to create upload directory');
            }
        }

        // Save the image file
        if (file_put_contents($targetFilePath, $imageData) === false) {
            die('Failed to save file');
        } else {
            // Save image details to database
            if (saveImageDetails($fileName, $location, $time)) {
                echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";
            } else {
                echo "Failed to save image details to the database.";
            }
        }
    } else {
        die("Invalid image data.");
    }
}

function saveImageDetails($fileName, $location, $time) {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'hackathon');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query
    $sql = "INSERT INTO images (file_name, location, upload_time) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $fileName, $location, $time);

    // Execute query
    if ($stmt->execute()) {
        // Close connections
        $stmt->close();
        $conn->close();
        return true;
    } else {
        // Handle error
        echo "Execute failed: " . $stmt->error;
        $stmt->close();
        $conn->close();
        return false;
    }
}
?>


