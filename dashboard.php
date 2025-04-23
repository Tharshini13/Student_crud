<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #667eea, #764ba2);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            overflow: hidden;
        }

        .welcome-box {
            text-align: center;
            animation: fadeIn 2s ease-in-out;
        }

        .welcome-box h1 {
            font-size: 3rem;
            animation: slideIn 1.5s ease-out;
        }

        .hello {
            font-size: 4rem;
            font-family: 'Pacifico', cursive;
            animation: floatText 3s ease-in-out infinite;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes slideIn {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes floatText {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>

<div class="welcome-box">
    <?php if ($username): ?>
        <div class="hello">Hello, <?= htmlspecialchars($username) ?> 💫</div>
        <h1>Welcome to the Dashboard</h1>
    <?php else: ?>
        <h1>Please log in first.</h1>
    <?php endif; ?>
    <div class='alert alert-success text-center'>If you already have an account <a href='login.php' class='btn btn-sm btn-primary'>login</a></div>
</div>

</body>
</html>
