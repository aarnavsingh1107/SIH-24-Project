// Example function to send data to Google Sheets
function sendDataToGoogleSheet(data) {
    const scriptURL = 'https://docs.google.com/spreadsheets/d/1_-kC0zBPadYz06x22WfAXhwy9uqBPvTumK_z8-HuglA/edit?gid=0#gid=0'; // Replace with your actual Apps Script URL

    fetch(scriptURL, {
        method: 'POST',
        mode: 'no-cors',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log('Success:', response);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Form submission event listener for login form
document.querySelector('#login-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const data = {
        email: document.querySelector('#email').value,
        password: document.querySelector('#password').value
    };

    sendDataToGoogleSheet(data);
});

// Form submission event listener for sign-up form
document.querySelector('#signup-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const data = {
        name: document.querySelector('#username').value,
        email: document.querySelector('#signup-email').value,
        password: document.querySelector('#signup-password').value
    };

    sendDataToGoogleSheet(data);
});

// Toggle between login and sign-up forms
document.getElementById('signup-link').addEventListener('click', function() {
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('signup-form').style.display = 'block';
});

document.getElementById('login-link').addEventListener('click', function() {
    document.getElementById('signup-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'block';
});
