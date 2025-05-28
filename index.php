<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #7b2ff7, #f107a3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            width: 350px;
        }

        .box h1 {
            margin-bottom: 30px;
            color: #7b2ff7;
        }

        .box button {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn {
            background-color: #7b2ff7;
            color: white;
        }

        .signup-btn {
            background-color: #f107a3;
            color: white;
        }

        .login-btn:hover {
            background-color: #5916c7;
        }

        .signup-btn:hover {
            background-color: #c20682;
        }
    </style>
</head>
<body>
    <div class="box">
        <form action="login.php" method="get">
            <button class="login-btn" type="submit">Login</button>
        </form>
        <form action="register.php" method="get">
            <button class="signup-btn" type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>
