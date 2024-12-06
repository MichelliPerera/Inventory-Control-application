<?php
// Database connection
include("include/config.php");

// Get the current month and year
$current_month = date("m");
$current_year = date("Y");

// Get the number of days in the current month
$num_days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);

// Initialize total income
$total_income = 0;

// Array to store income data for each day
$income_data = array();

// Loop through each day of the month and initialize with zero income
for ($day = 1; $day <= $num_days; $day++) {
    $income_data[sprintf("%02d", $day)] = 0; // Initialize income for the day
}

// Query to fetch income data for the current month
$query = "SELECT DATE_FORMAT(date, '%d') AS day, SUM(income) AS income FROM income WHERE MONTH(date) = '$current_month' AND YEAR(date) = '$current_year' GROUP BY DATE_FORMAT(date, '%d')";
$result = mysqli_query($con, $query);

// Check if the query executed successfully
if (!$result) {
    die("Error in SQL query: " . mysqli_error($con));
}

// Fetch income data and update the income_data array
while ($row = mysqli_fetch_assoc($result)) {
    // Update income for the day
    $income_data[$row['day']] = $row['income'];
    
    // Add income to total income
    $total_income += $row['income'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Income Report</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Monthly Income Report - <?php echo date("F Y"); ?></h2>
    <h3>Accessed and carried out by Chief Accountant</h3>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Income</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each day of the month and display income
            foreach ($income_data as $day => $income) {
                echo "<tr>";
                echo "<td>{$current_year}-{$current_month}-" . $day . "</td>";
                echo "<td>{$income}</td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td>Total income</td>
                <td><?php echo $total_income; ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
