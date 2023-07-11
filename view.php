<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
	exit();
}
?>

<?php
// including the database connection file
include_once("connection.php");

// fetching data in descending order (latest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE login_id=" . $_SESSION['id'] . " ORDER BY id DESC");
?>

<html>
<head>
	<title>Homepage</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		$(document).ready(function () {
			$("#exportButton").click(function () {
				// Fetch data from the table
				var tableData = [];
				$("table tbody tr").each(function (rowIndex, tr) {
					var rowData = [];
					$(tr).find('td').each(function (colIndex, td) {
						rowData.push($(td).text());
					});
					tableData.push(rowData);
				});

				// Convert data to JSON string
				var jsonData = JSON.stringify(tableData);

				// Create a temporary link element to trigger the file download
				var link = document.createElement('a');
				link.href = 'data:application/json;charset=utf-8,' + encodeURIComponent(jsonData);
				link.download = 'table_data.json';
				link.style.display = 'none';
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			});
		});
	</script>
</head>

<body>
	<a href="index.php">Home</a> | <a href="add.html">Add New Data</a> | <a href="logout.php">Logout</a>
	<br/><br/>

	<button id="exportButton">Export JSON</button>
	<br/><br/>

	<table width='80%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td>Name</td>
			<td>Quantity</td>
			<td>Price (euro)</td>
			<td>Update</td>
		</tr>
		<?php
		while ($res = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $res['name'] . "</td>";
			echo "<td>" . $res['qty'] . "</td>";
			echo "<td>" . $res['price'] . "</td>";
			echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
			echo "</tr>";
		}
		?>
	</table>
</body>

</html>
