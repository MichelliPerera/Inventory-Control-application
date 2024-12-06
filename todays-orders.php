<?php
// Database connection
include("include/config.php");
// Query to fetch orders for the current day
$current_date = date("Y-m-d"); // Get current date
$query = "SELECT name, email, ordered_products, grand_total FROM orderRepo WHERE order_date = '$current_date'"; // SQL query to fetch orders for the current day
$result = mysqli_query($con, $query); // Execute the query
// Check if the query executed successfully
if (!$result) {
    die("Error in SQL query: " . mysqli_error($con)); // Display error message if query fails
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Orders Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5; /* Set background color */
        }
        h2 {
            text-align: center;
            margin-top: 20px; /* Set margin for h2 */
        }
        h3 {
            text-align: center;
            margin-top: 20px; /* Set margin for h3 */
        }
        table {
            width: 80%; /* Set table width */
            margin: 20px auto; /* Center align table */
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add box shadow */
            background-color: #fff; /* Set background color */
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Add border bottom */
        }
        th {
            background-color: #f2f2f2; /* Set background color for th */
            font-weight: bold;
            color: #333; /* Set text color */
        }
        tr:nth-child(even) {
            background-color: #f0f0f0; /* Set background color for even rows */
        }
        tr:hover {
            background-color: #ddd; /* Set background color on hover */
        }
    </style>
</head>
<body>
    <h2>Daily Orders Report - <?php echo $current_date; ?></h2>
    <h3>Accessed and carried out by Production Manager</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Ordered Products</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through fetched orders and display in table rows
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['ordered_products']."</td>";
                echo "<td>".$row['grand_total']."</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
