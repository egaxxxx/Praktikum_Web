<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'password123') {
        session_regenerate_id(true); 
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        $error_message = 'Username atau password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi RT 05</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .notification {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: var(--border-radius);
            font-weight: 600;
        }
        
        .notification.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        body.dark-mode .notification.success {
            background-color: #284d28;
            color: #d4edda;
            border-color: #3d7a3d;
        }

        .login-container {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .login-form {
            width: 100%;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-color);
        }
        
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: var(--border-radius);
            font-size: 1rem;
            background-color: var(--background-color);
            color: var(--text-color);
        }
        
        .login-button {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .login-button:hover {
            background-color: #0056b3;
        }
        
        .error-message {
            color: #dc3545;
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .back-link {
            text-align: center;
            margin-top: 1rem;
        }
        
        .back-link a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        body.dark-mode .form-group input {
            background-color: #333;
            border-color: #555;
        }
        
        body.dark-mode .form-group input::placeholder {
            color: #888;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="index.php" class="logo"><strong>Info Warga RT 05</strong></a>
                <ul>
                    <li><button id="theme-toggle" class="theme-button">🌙</button></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="login-container">
            <h2 style="text-align: center; margin-bottom: 1.5rem; color: var(--primary-color);">Login Admin</h2>
            
            <?php if ($error_message): ?>
                <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            
            <?php 
            if (isset($_GET['action']) && $_GET['action'] == 'success' && isset($_GET['message'])) {
                echo '<div class="notification success" style="margin-bottom: 1rem;">' . htmlspecialchars($_GET['message']) . '</div>';
            }
            ?>

            <form method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required placeholder="Masukkan username">
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Masukkan password">
                </div>
                
                <button type="submit" class="login-button">Login</button>
            </form>
            
            <div class="back-link">
                <a href="index.php">← Kembali ke Beranda</a>
            </div>
            
            <div style="margin-top: 1.5rem; padding: 1rem; background-color: #f8f9fa; border-radius: var(--border-radius); font-size: 0.9rem; text-align: center;">
                <strong>Demo Credentials:</strong><br>
                Username: <code>admin</code><br>
                Password: <code>password123</code>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Pengurus RT 05. Semua Hak Cipta Dilindungi.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>