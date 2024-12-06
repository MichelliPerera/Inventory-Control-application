<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Control</title>

    <!-- CSS Styles -->
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/fin.jpg'); /* Background image */
            background-size: cover;
            background-position: center;
            text-align: center;
        }

        /* Styles for the main container */
        .container {
            margin-top: 250px; /* Adjusting top margin */
        }

        /* Styles for the access label */
        .access-label {
            font-weight: bold;
            margin-bottom: 60px;
            color: #333; /* Dark text color */
            font-size: 50px;
            display: block;
        }

        /* Styles for radio buttons */
        .radio-label {
            margin-right: 20px;
            color: #000; /* Black text */
            font-size: 30px;
        }

        .radio-group {
            margin-bottom: 20px;
        }

        /* Styles for buttons */
        .button {
            padding: 15px 30px;
            margin-right: 10px;
            cursor: pointer;
            background-color: #ffc0cb; /* Light pink */
            border: none;
            border-radius: 8px;
            color: #333; /* Dark text color */
            font-size: 30px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #ff7eb9; /* Darker pink on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Access Level Label -->
        <label class="access-label">Access Level</label>

        <!-- Radio Buttons for Different Access Types -->
        <div class="radio-group">
            <input type="radio" id="daily-orders" name="access-type" class="radio-button" value="Daily Orders Report">
            <label class="radio-label" for="daily-orders">Daily Orders Report</label>

            <input type="radio" id="daily-availability" name="access-type" class="radio-button" value="Daily Product Availability">
            <label class="radio-label" for="daily-availability">Daily Product Availability</label>

            <input type="radio" id="monthly-income" name="access-type" class="radio-button" value="Monthly Income Report">
            <label class="radio-label" for="monthly-income">Monthly Income Report</label>
        </div>

        <!-- Buttons for Different Access Levels -->
        <button class="button" onclick="redirectToLoginPage('report')">Report Only</button>
        <button class="button" onclick="redirectToLoginPage('update')">Update Only</button>
        <button class="button" onclick="redirectToLoginPage('update-delete')">Update and Delete</button>
        <button class="button" onclick="redirectToLoginPage('complete-access')">Complete System Access</button>
    </div>

    <!-- JavaScript for Redirecting to Login Page -->
    <script>
        function redirectToLoginPage(accessType) {
            // Get the selected radio button
            var selectedRadio = document.querySelector('input[name="access-type"]:checked');
            if (selectedRadio) {
                var reportType = selectedRadio.value; // Get the value of the selected radio button
                var accessLevel = '';

                // Determine the access level based on the button clicked
                switch (accessType) {
                    case 'report':
                        accessLevel = 'Report Only';
                        break;
                    case 'update':
                        accessLevel = 'Update Only';
                        break;
                    case 'update-delete':
                        accessLevel = 'Update and Delete';
                        break;
                    case 'complete-access':
                        accessLevel = 'Complete System Access';
                        break;
                }

                // Redirect to the login page with parameters
                window.location.href = 'admi.php?type=' + reportType + '&access=' + accessLevel;
            } else {
                alert('Please select a report type.'); // Alert if no radio button is selected
            }
        }
    </script>
</body>
</html>
