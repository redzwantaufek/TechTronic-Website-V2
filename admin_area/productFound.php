<html>
<head>
    <title>Admin Panel</title>
</head>

<body>
    <?php
    // call file to connect server
    include("./includes/db.php");

    // check if 'product_title' is set in $_POST superglobal and sanitize the input value
    $in = '';
    if(isset($_POST['product_title']) && !empty($_POST['product_title'])) {
        $in = mysqli_real_escape_string($con, $_POST['product_title']); // escape values to prevent SQL injection
    }
    ?>

    <h2>Search Result</h2>

    <?php
    // check if connection is established successfully
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(!empty($in)) { // only run the query if there is a valid input value
        //make the query
        $q = "SELECT * FROM products WHERE product_title = '$in' ORDER BY product_title";

        //run the query and assign it to the variables $result
        $result = mysqli_query($con, $q);

        if($result && mysqli_num_rows($result) > 0) // check if the query result has rows
        {
            //table heading
            echo'<table border ="2">
            <tr>
            <td align = "center\"><strong>#</strong></td>
            <td align = "center\"><strong>Title</strong></td>
            <td align = "center\"><strong>Image</strong></td>
            <td align = "center\"><strong>Price</strong></td>
            <td align = "center\\\"><strong>Keywords</strong></td>
            <td align = "center\"><strong>Date Added</strong></td>
            <td align = "center\"><strong>Delete</strong></td>
            <td align = "center\"><strong>Edit</strong></td>
            </tr>';

            //fetch and display the result
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '
                <tr>
                    <td>'.$row['product_id'].'</td>
                    <td>'.$row['product_title'].'</td>
                    <td><img src="data:image/webp;base64,'.base64_encode($row['product_img1']).'" alt="Product Image" width="100" height="100"></td>
                    <td>'.$row['product_price'].'</td>
                    <td>'.$row['product_keywords'].'</td>
                    <td>'.$row['date'].'</td>
                    <td>
                        <a href="index.php?delete_product=<?php echo $pro_id; ?>">
                            <i class="fa fa-trash-o"></i> Delete
                        </a>
                    </td>
                    <td>
                        <a href="index.php?edit_product=<?php echo $pro_id; ?>">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>';
            }

            //close the table
            echo'</table>';

            //free up the resource
            mysqli_free_result($result);
        }
        else
        {
            //error message
            echo '<p class ="error"> If no record is shown, this is because you had an incorrect or missing entry in search form.<br>Click the back button on the browser and try again.</p>';

            //debugging message
            echo '<p>'.mysqli_error($con).'<br><br>Query: '.$q.'</p>';
        }
    }
    else {
        echo '<p class ="error"> Please enter a search term.</p>';
    }
    //close the database connection
    mysqli_close($con);
    ?>
    <br>
    <button><a href="view_products.php">Back To Product List</a></button>
</body>
</html>
