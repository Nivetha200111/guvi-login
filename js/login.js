$(document).ready(function(){ 
    // Bind the form submission event for the login form
    $("#loginForm").submit(function(event){
        event.preventDefault(); // Prevent the default form submission
        
        // Send an AJAX POST request to the server-side login script
        $.ajax({
            url: 'php/login.php', // URL of the login script
            type: 'post', // HTTP method (POST)
            data: $(this).serialize(), // Serialize the form data for submission
            
            success: function(response){
                // Check the response from the server
                if (response.trim() === "Login successful") {
                    // Redirect to the user's profile page upon successful login
                    window.location.href = "/guvi_login_page/profile.html";
                } else {
                    // Display other server responses as alerts (e.g., login error messages)
                    alert(response);
                }
            }
        });
    });
});
