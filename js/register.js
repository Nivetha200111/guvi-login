$(document).ready(function() {
  // Bind the registration form submission event
  $("#registerForm").submit(function(event) {
    event.preventDefault(); // Prevent default form submission
    console.log("Button clicked"); // Add this line for debugging
    alert("DETAILS SUBMITTED. YOU CAN GO BACK NOW");
    registerUser(); // Call the registerUser function
  });
});

// Function to handle user registration
function registerUser() {
  $.ajax({
    url: 'php/register.php', // URL to the server-side PHP script handling registration
    type: 'POST', // HTTP method (POST)
    data: $("#registerForm").serialize(), // Serialize the form data including new fields
    success: function(response) {
      // Check for successful registration response
      if (response === 'Registration successful') {
        alert('Your registration was successful!'); // Display a success message
        exit(); // Exit the function
      } else {
        $("#registrationStatus").text(response); // Display the response as text
      }
    },
    error: function(xhr, status, error) {
      $("#registrationStatus").text("Error: " + error); // Display an error message
    }
  });
}
