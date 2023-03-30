<html>
<head>
<title>Admin Panel</title>
</head>

<body>
    <?php
    //call file to connect server
    include("./includes/db.php");
    ?>

    <form action="productFound.php" method="post">
        <h1>Search Product Name</h1>
        <p>
            <label class="label" for="product_title">Product Name:</label>
            <input id="product_title" name="product_title" type="text" size="30" maxlength="50" value="<?php if (isset($_POST['product_title'])) echo $_POST ['product_title']; ?>" />
        </p>
        <input id ="submit" type="submit" name="submit" value="Search" />
    </form>
</body>
</html>
