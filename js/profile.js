$(document).ready(function() {
    // Load user data when the page is ready
    loadUserData();

    // Handle the click event for the "Edit Profile" button
    $("#editProfileButton").click(function() {
        // Populate the edit form fields with current user data
        $("#editFirstName").val($("#firstName").text()); 
        $("#editLastName").val($("#lastName").text());
        $("#editEmail").val($("#email").text());
        $("#editPhoneNumber").val($("#phoneNumber").text());
        $("#editAge").val($("#age").text());
            
        // Toggle the visibility of the edit profile form
        $("#editProfileForm").toggle();
    });

    // Handle the click event for the "Save Changes" button in the edit form
    $("#saveProfileButton").click(function() {
        // Call the updateProfile function to save changes
        updateProfile();
    });

    // Handle the click event for the "Logout" link
    $("#logoutLink").click(function() {
        // Send an AJAX GET request to log the user out
        $.get('php/profile.php?logout=1', function() {
            // Redirect the user to the index.html page after logout
            window.location.href = 'index.html';
        });
    });
});

// Function to load user data and populate the user profile
function loadUserData() {
    $.ajax({
        url: 'php/profile.php', // URL to the server-side PHP script for fetching user data
        type: 'GET', 
        dataType: 'json', // Expect JSON response
        success: function(response) {
            if (response.error) {
                console.error("Error:", response.error); // Log the error
            } else {
                // Populate the user data container with fetched data
                $("#userDataContainer").html(
                    "<p>First Name: " + response.first_name + "</p>" +  
                    "<p>Last Name: " + response.last_name + "</p>" +
                    "<p>Email: " + response.email + "</p>" +
                    "<p>Phone Number: " + response.phone_number + "</p>" +  
                    "<p>Age: " + response.age + "</p>"
                );
            }
        },
        error: function(xhr, status, error) {
            console.error("Error loading user data: " + error); // Log loading errors
        }
    });
}

// Function to update the user's profile
function updateProfile() {
    // Create an object with the edited profile data
    var formData = {
        firstName: $("#editFirstName").val(),
        lastName: $("#editLastName").val(),
        email: $("#editEmail").val(),
        phone_number: $("#editPhoneNumber").val(),
        age: $("#editAge").val()
    };

    // Send an AJAX POST request to update the user's profile
    $.ajax({
        url: 'php/profile.php', // URL to the server-side PHP script for profile update
        type: 'POST', 
        data: formData, // Send the edited data as POST data
        dataType: 'json', // Expect JSON response
        success: function(response) {
            if (response.success) {
                // Display a success message and reload user data on success
                alert("Profile updated successfully.");
                $("#editProfileForm").hide();
                loadUserData(); // Reload user data after successful update
            } else {
                // Display an error message on update failure
                alert("Error updating profile: " + response.error);
            }
        },
        error: function(xhr, status, error) {
             console.error("An error occurred: " + error); // Log update errors
        }
    });
}
