<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normal CRUD</title>
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <script src="../assets/bootstrap.min.js"></script>
</head>

<body>
  
    <div class="center-form">
        <div class="container">
            <div class="row">

                <div class="col-md-6 offset-md-3">

                <h1>Normal Website</h1>
    <div id="items">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "performance";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = $_POST["first_name"];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];

            // Insert data into database
            $sql = "INSERT INTO items (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">
  A simple success alert—check it out!</div>';

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }


        ?>
    </div>

                    <form id="addItemForm" method="post" action="index.php">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="exampleFormControlInput1" placeholder="Nzullo">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="exampleFormControlInput1" placeholder="Dee">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="nzullo@email.com">
                        </div>

                        <!-- <input type="text" id="itemName" name="add_text" placeholder="Enter item name" required> -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit">Add Item</button>

                        </div>
                    </form>

                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>

                        <?php
                    // Fetch items from database
                    $sql = "SELECT * FROM items ORDER BY id DESC ";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) 
                        while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row["first_name"]  ?></td>
                            <td> <?php echo $row["last_name"]  ?></td>
                            <td><?php echo $row["email"]  ?></td>
                        </tr>
                        <?php endwhile; ?>
                    
                <?php
                $conn->close();

                ?>
                    </table>

                         
                   
                </div>


            </div>
        </div>
    </div>

</body>

</html>