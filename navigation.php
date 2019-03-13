<style>
* {box-sizing: border-box}
body {
	font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  width: 100%;
  background-color: #555;
  overflow: auto;
}

.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
  width: 25%; /* Four links of equal widths */
  text-align: center;
  border: 1px solid white;
}

.navbar a:hover {
  background-color: #000;
}



@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
    width: 100%;
    text-align: left;
	
  }
}

.center{
	display: block;
	margin-left:50%;
}


</style>

<img src="image/Singapore_Police_Force_crest.png" alt="Sg Police logo" height="100" width="100" class="center">
<h2><b>Police Emergency Service System</b></h2>
<div class="navbar">
  <a class="active" href="logcall.php">Log Call</a> 
  <a href="update.php">Update</a> 
  <a href="login.php">Login</a> 
  <a href="logout.php">Log Out</a>
</div>
<br>

