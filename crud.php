<?php
$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "db_AppDev";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];

    $sql = "INSERT INTO products (name, Description, Price, Quantity) VALUES ('$name', '$Description', '$Price', '$Quantity')";
    $conn->query($sql);
}
//taga delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id=$id";
    $conn->query($sql);
}

// taga update
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];

    $sql = "UPDATE products SET name='$name', Description='$Description', Price='$Price', Quantity='$Quantity' WHERE id=$id";
    $conn->query($sql);
}

// taga retrieve
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple CRUD</title>
</head>
<body>
    <h1>Product Management</h1>
    <form action="crud.php" method="POST">
        <input type="text" name="name" placeholder="name" required>
        <input type="text" name="Description" placeholder="Description">
        <input type="text" name="Price" placeholder="Price">
        <input type="text" name="Quantity" placeholder="Quantity">
        <button type="submit" name="create">Create</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['Description']; ?></td>
            <td><?php echo $row['Price']; ?></td>
            <td><?php echo $row['Quantity']; ?></td>
            <td><?php echo $row['Create_at']; ?></td>
            <td><?php echo $row['Update_at']; ?></td>
            <td>
                <a href="crud.php?delete=<?php echo $row['id']; ?>">Delete</a>
                <form action="crud.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                    <input type="text" name="Description" value="<?php echo $row['Description']; ?>">
                    <input type="text" name="Price" value="<?php echo $row['Price']; ?>">
                    <input type="text" name="Quantity" value="<?php echo $row['Quantity']; ?>">
                    <button type="submit" name="edit">Edit</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
