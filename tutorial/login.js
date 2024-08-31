// Initialize Google Sign-In API
function initializeGoogleSignIn() {
    google.accounts.id.initialize({
        client_id: 'YOUR_GOOGLE_CLIENT_ID',
        callback: handleCredentialResponse
    });

    // Render Google Sign-In button in the login form
    google.accounts.id.renderButton(
        document.querySelector("#login-form .google-btn"),
        { theme: "outline", size: "large" }
    );

    // Render Google Sign-In button in the signup form
    google.accounts.id.renderButton(
        document.querySelector("#signup-form .google-btn"),
        { theme: "outline", size: "large" }
    );
}

// Handle Google Sign-In response
function handleCredentialResponse(response) {
    const id_token = response.credential;
    console.log('Google ID Token:', id_token);

    // Example: Send the ID token to your backend for verification and further processing
    fetch('YOUR_BACKEND_URL/verify-token', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_token: id_token })
    })
    .then(response => response.json())
    .then(data => {
        console.log('User authenticated:', data);
        // Redirect user or handle authenticated user data
    })
    .catch(error => {
        console.error('Error during authentication:', error);
    });
}

// Toggle between login and signup forms
function setupFormToggle() {
    document.getElementById('signup-link').addEventListener('click', function() {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('signup-form').style.display = 'block';
    });

    document.getElementById('login-link').addEventListener('click', function() {
        document.getElementById('signup-form').style.display = 'none';
        document.getElementById('login-form').style.display = 'block';
    });
}

// Initialize all functions on window load
window.onload = function() {
    initializeGoogleSignIn();
    setupFormToggle();
}
