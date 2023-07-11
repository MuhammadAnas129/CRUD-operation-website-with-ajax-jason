<?php session_start(); ?>
<html>
<head>
	<title>Homepage</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="header">
		Welcome to my page!
	</div>
	<?php
	if(isset($_SESSION['valid'])) {			
		include("connection.php");					
		$result = mysqli_query($mysqli, "SELECT * FROM login");
	?>
				
		Welcome <?php echo $_SESSION['name'] ?> ! <a href='logout.php'>Logout</a><br/>
		<br/>
		<a href='view.php'>View and Add Products</a>
		<a href='viewregister.php'>View and Add User</a>
		<br/><br/>
	<?php	
	} else {
		echo "You must be logged in to view this page.<br/><br/>";
		echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a> | <a href='viewregister.php'>View Register</a>";
	}
	?>
	
	<br><br>

	<button  onclick="showTC()"> Terms and Conditions </button>

<p> 
        <span id="tc_statement"> </span>
    </p>

<script>function showTC()
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);

          document.getElementById("tc_statement").innerHTML = this.responseText;
      }
    };

    xmlhttp.open("GET","terms.txt", true);

    xmlhttp.send();
}
</script>
	<!-- <div id="footer">
		Created by <a href="http://blog.chapagain.com.np" title="Mukesh Chapagain">Mukesh Chapagain</a>
	</div> -->
</body>
</html>