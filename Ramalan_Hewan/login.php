<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Ramalan Hewan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #8B4513, #D2691E);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: #fff;
            width: 380px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.25);
            text-align: center;
        }

        .login-card h2 {
            margin-bottom: 10px;
            color: #8B4513;
        }

        .login-card p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 20px;
        }

        .animal-icons {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .animal-icons i {
            margin: 0 8px;
        }

        .fox { color: #8B4513; }
        .dove { color: #228B22; }
        .fly { color: #4B0082; }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            font-size: 0.9rem;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
        }

        input:focus {
            outline: none;
            border-color: #D2691E;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #8B4513;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background: #A0522D;
        }

        .footer-text {
            margin-top: 15px;
            font-size: 0.75rem;
            color: #999;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="animal-icons">
        <i class="fas fa-paw fox"></i>
        <i class="fas fa-dove dove"></i>
        <i class="fas fa-bug fly"></i>
    </div>

    <h2>Login</h2>
    <p>Ramalan Hewan</p>

    <form action="proses_login.php" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">
            <i class="fas fa-sign-in-alt"></i> Login
        </button>
    </form>

    <div class="footer-text">
        &copy; Ramalan Hewan
    </div>
</div>

</body>
</html>
