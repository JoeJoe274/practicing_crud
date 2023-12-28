<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>

    <!-- container -->
    <div>
        <div>
            <h1>Read Product</h1>
        </div>
        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verfy if a value is there or not
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found. ');

        // include database
        include 'config/database.php';

        // read current record data
        try {
            // prepare select query
            $query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            // this is the first question mark
            $stmt->bindParam(1, $id);
            // execute our query
            $stmt->execute();
            //store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // values to fill up our form
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
        }
        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <!-- HTML read one table will be here -->
        <!-- We have our HTML table here where the record will be displayed -->
        <table>
            <tr>
                <td>Name</td>
                <td>
                    <?php
                    echo htmlspecialchars($name, ENT_QUOTES);
                    ?>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <?php
                    echo htmlspecialchars($description, ENT_QUOTES);
                    ?>
                </td>
            </tr>
            <tr>
                <td>Price</td>
                <td>
                    <?php
                    echo htmlspecialchars($price, ENT_QUOTES);
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="training_read.php" class='btn btn-danger'>Back to read products</a>
                </td>
            </tr>
        </table>

    </div>
    <!-- end container -->
    <!-- jQuery necessary for Bootstrap's JavaScript plugins  -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</body>
</html>