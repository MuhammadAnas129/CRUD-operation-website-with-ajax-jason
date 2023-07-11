<html>
<head>
    <title>Display Data</title>
    
</head>

<body>
<a href="index.php">Home</a> | <a href="register.php">Register</a> | <a href="logout.php">Logout</a>
    <br/><br/>
<?php
include("connection.php");

// Retrieve data from the database
$result = mysqli_query($mysqli, "SELECT id,name,email,username FROM login");

// Create an empty array to store the table data
$data = array();

// Loop through the result and add each row to the data array
while($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}
?>
    <!-- Display the table headers -->
    <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Update</th>
        </tr>

    <!-- Loop through the data array and display each row as a table row -->
    <?php
    foreach($data as $row) {
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td><a href=\"edit2.php?id=$row[id]\">Edit User</a> | <a href=\"delete2.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </table>

    <!-- Add a button to download JSON file -->
    <br>
    <form action="download_json.php" method="post">
        <input type="hidden" name="json_data" value='<?php echo json_encode($data); ?>'>
        <input type="submit" value="Download JSON">
    </form>

</body>
</html>
