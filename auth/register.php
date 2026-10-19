<?php
session_start();
require_once '../config/connection.php';

if (!empty($_SESSION['member_id'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | OSCMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/style.css?v=20261019-auth">
</head>
<body class="auth-page">
    <main class="auth-layout auth-register-layout">
        <header class="auth-page-heading">
            <span class="auth-kicker">ONLINE STUDENT CLEARANCE MANAGEMENT SYSTEM</span>
            <h1>Create your account</h1>
            <p>Register a new student clearance account</p>
        </header>
        <section class="auth-card auth-register-card">
            <?php if (!empty($_GET['error'])): ?><div class="alert alert-danger py-2"><?= htmlspecialchars($_GET['error']) ?></div><?php endif; ?>
            <form action="../backend/auth_code.php" method="POST">
                <div class="auth-bento-grid register-bento-grid">
                    <div class="auth-field"><label class="form-label">First Name</label><input class="form-control" name="first_name" placeholder="e.g. Juan" required></div>
                    <div class="auth-field"><label class="form-label">Last Name</label><input class="form-control" name="last_name" placeholder="e.g. Dela Cruz" required></div>
                    <div class="auth-field"><label class="form-label">Email</label><input class="form-control" type="email" name="email" placeholder="you@example.com" required></div>
                    <div class="auth-field"><label class="form-label">Gender</label><select class="form-select" name="gender" required><option value="" selected disabled>Select gender</option><option>Male</option><option>Female</option></select></div>
                    <div class="auth-field"><label class="form-label">Course</label><input class="form-control" name="course" placeholder="e.g. BSIT" required></div>
                    <div class="auth-field"><label class="form-label">Year & Section</label><input class="form-control" name="section" placeholder="e.g. 3A" required></div>
                    <div class="auth-field auth-field-wide"><label class="form-label">Address</label><input class="form-control" name="address" placeholder="Enter complete address" required></div>
                    <div class="auth-field"><label class="form-label">Username</label><input class="form-control" name="username" placeholder="At least 4 characters" required minlength="4" autocomplete="username"></div>
                    <div class="auth-field"><label class="form-label">Password</label><input class="form-control" type="password" id="register-password" name="password" placeholder="At least 8 characters" required minlength="8" autocomplete="new-password"></div>
                    <div class="auth-field auth-field-wide"><label class="form-label">Confirm Password</label><input class="form-control" type="password" id="confirm-password" name="confirm_password" placeholder="Re-enter your password" required minlength="8" autocomplete="new-password"></div>
                </div>
                <button class="btn btn-primary w-100 auth-submit" type="submit" name="register">Create Account</button>
            </form>
            <p class="auth-footer">Already registered? <a href="login.php">Log in</a></p>
        </section>
    </main>
</body>
</html>