<?php
// PHP code to store form data in the database
$host = "localhost";
$user = "root";
$pass = "";
$db = "webtech_db";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
$successMessage = $errorMessage = "";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $successMessage = "🎉 Registration successful!";
    } else {
        $errorMessage = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg,rgb(244, 220, 240),rgb(248, 238, 239));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color:rgb(248, 204, 227);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 3 14px 25px rgba(0, 0, 0, 0.15);
            width: 350px;
            text-align: center;
        }

        h2 {
            color:rgb(24, 22, 22);
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #fff;
        }

        button {
   <!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Submit button - Green */
        button.submit-btn {
            background-color: #28a745;
            color: white;
        }

        button.submit-btn:hover {
            background-color: #218838;
        }

        /* Reset button - Red */
        button.reset-btn {
            background-color: #dc3545;
            color: white;
        }

        button.reset-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- Your form goes here -->
</body>
</html>

    </style>
</head>
<body>
    <form action="" method="post">
        <h2> User Registration </h2>

        <?php if ($successMessage): ?>
            <div class="message success"><?= $successMessage ?></div>
        <?php elseif ($errorMessage): ?>
            <div class="message error"><?= $errorMessage ?></div>
        <?php endif; ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <button type="reset">Reset</button>
        <button type="submit" name="submit">Submit</button>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</body>
</html>
