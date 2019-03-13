<?php
include 'navigation.php';
?>

<html>
<head></head>
<body>
<br/>
<fieldset>
<legend>Login:</legend>
<form action = "login_proccess.php" method = "post">
Username: <input type="text" name="username"/><br/><br/>
Password: <input type="password" name="password"/><br/><br/>
<input type = "submit" name="submit" value="Log in"/>
</form>
</fieldset>
</body>
</html>