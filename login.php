<?php
session_start();

// Connect to the database
$host = "localhost";
$user = "root";
$pass = "";
$db = "webtech_db";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Look for user with this email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Correct login → store user info in session
            $_SESSION['user'] = $user;
            header("Location: landing.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No user found with this email.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg,rgb(246, 230, 236),rgb(240, 195, 229));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color:rgb(252, 217, 247);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 6 14px 25px rgba(0, 0, 0, 0.15);
            width: 350px;
            text-align: center;
        }

        h2 {
            color:rgb(10, 5, 4);
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

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
        <h2> User Login</h2>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <button type="reset">Reset</button>
        <button type="submit" name="submit">Submit</button>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
</body>
</html>
