<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webcam Image Capture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        video {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        canvas {
            display: none;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        #capturedImage {
            display: none;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Capture and Upload Image</h2>
        <video id="video" width="640" height="480" autoplay></video>
        <canvas id="canvas" width="640" height="480"></canvas>
        <br>
        <button id="capture" class="btn">Capture Image</button>
        <img id="capturedImage" width="640" height="480" alt="Captured Image">
        <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="location" id="location">
            <input type="hidden" name="time" id="time">
            <input type="hidden" name="imageData" id="imageData">
            <button type="submit" class="btn">Upload</button>
        </form>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        const captureButton = document.getElementById('capture');
        const imageDataInput = document.getElementById('imageData');
        const capturedImage = document.getElementById('capturedImage');

        // Start video stream
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(mediaStream => {
                video.srcObject = mediaStream;
            })
            .catch(error => {
                console.error('Error accessing webcam:', error);
            });

        // Capture image from video
        captureButton.addEventListener('click', () => {
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/png');
            imageDataInput.value = dataURL;

            // Display the captured image
            capturedImage.src = dataURL;
            capturedImage.style.display = 'block';
        });

        // Set location and time
        navigator.geolocation.getCurrentPosition(position => {
            document.getElementById('location').value = `${position.coords.latitude},${position.coords.longitude}`;
        });

        document.getElementById('time').value = new Date().toISOString();
    </script>
</body>
</html>





