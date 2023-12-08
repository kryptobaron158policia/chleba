<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>
<body>
    <h2>Todo List</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="todo_item">Todo Item:</label>
        <input type="text" name="todo_item" required>
        <input type="submit" value="Add Todo">
    </form>

    <br>
</body>
</html>



<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayassignment($conn) {
    $sql = "SELECT id, todo_items FROM assignment";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Todo Items</th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["todo_items"] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $todoItem = $_POST["todo_item"];

    $sql = "INSERT INTO assignment (todo_items) VALUES ('$todoItem')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

displayassignment($conn);

$conn->close();
?>

