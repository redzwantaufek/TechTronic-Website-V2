<html>
<head>
<title>eLeave Management System</title>
</head>

<body>
    <?php
    //call file to connect server elaeve
    include("db.php");
    ?>

    <form action="userFound.php" method="post">

    <h1>Search Employee Record</h1>
    <p><label class="label" for="userName">Employee Name:</label>
    <input id="userName" name="userName" type="text" size="30" maxlength="50" value="<?php if (isset($_POST['userName']))
    echo $_POST ['userName']; ?>" /></p>

    <input id ="submit" type="submit" name="submit" value="Search" /></p>
    </form>
</body>
</html>