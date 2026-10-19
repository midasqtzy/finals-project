<?php
session_start();
require_once '../config/connection.php';
require_once '../classes/User.php';

if (!empty($_SESSION['member_id'])) {
    header('Location: ../index.php');
    exit();
}

$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | OSCMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/style.css?v=20261019-auth">
</head>
<body class="auth-page">
    <main class="auth-layout auth-login-layout">
        <header class="auth-page-heading">
            <span class="auth-kicker">ONLINE STUDENT CLEARANCE MANAGEMENT SYSTEM</span>
            <h1>Welcome back</h1>
            <p>Log in to continue</p>
        </header>
        <section class="auth-card auth-login-card">
            <?php if ($error): ?><div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <?php if (isset($_GET['registered'])): ?><div class="alert alert-success py-2">Account created. You can now log in.</div><?php endif; ?>
            <form action="../backend/auth_code.php" method="POST">
                <div class="auth-bento-grid login-bento-grid">
                    <div class="auth-field">
                        <label class="form-label" for="username">Username</label>
                        <input class="form-control" id="username" name="username" placeholder="Enter your username" required autocomplete="username">
                    </div>
                    <div class="auth-field">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                    </div>
                </div>
                <button class="btn btn-primary w-100 auth-submit" type="submit" name="login">Log In</button>
            </form>
            <p class="auth-footer">No account yet? <a href="register.php">Create an account</a></p>
        </section>
    </main>
</body>
</html>