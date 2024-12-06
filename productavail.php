<?php
// Database connection
include("include/config.php");
// Query to fetch product availability data
$current_date = date("Y-m-d");
$query = "SELECT product, availability_status FROM productavailability WHERE Odate = '$current_date'";
$result = mysqli_query($con, $query);
// Check if the query executed successfully
if (!$result) {
    die("Error in SQL query: " . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Product Availability Report</title>
    <style>
        /* Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        h3 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f0f0f0;
        }
        /* Style availability status cells based on their values */
        td.availability-yes {
            background-color: #9fe89f; /* Green */
        }
        td.availability-no {
            background-color: #f29292; /* Red */
        }
    </style>
</head>
<body>
    <h2>Daily Product Availability Report - <?php echo $current_date; ?></h2>
    <h3>Accessed and carried out by Production Manager</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Availability Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through fetched product availability data and display in table rows
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['product']."</td>";
                // Apply different class based on availability status
                if ($row['availability_status'] == 'yes') {
                    echo "<td class='availability-yes'>".$row['availability_status']."</td>";
                } else {
                    echo "<td class='availability-no'>".$row['availability_status']."</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
