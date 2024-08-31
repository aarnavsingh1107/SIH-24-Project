document.getElementById('register-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Getting the values from the form fields
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Simple form validation (additional checks can be added)
    if (username === '' || email === '' || password === '') {
        alert('All fields are required.');
        return;
    }

    // TODO: Handle form submission logic here (e.g., sending data to a server or storing in a database)

    alert('Registration successful!');
});
