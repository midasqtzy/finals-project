<?php
session_start();
require_once '../config/connection.php';
require_once '../classes/User.php';
require_once '../classes/Auth.php';

$user = new User($connect);

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $member = $user->findByUsername($username);

    if ($member && !empty($member->password) && password_verify($password, $member->password)) {
        Auth::login($member);
        header('Location: ../index.php');
        exit();
    }

    header('Location: ../auth/login.php?error=' . urlencode('Invalid username or password.'));
    exit();
}

if (isset($_POST['register'])) {
    $fields = ['first_name', 'last_name', 'email', 'gender', 'course', 'section', 'address', 'username', 'password', 'confirm_password'];
    foreach ($fields as $field) {
        if (empty(trim($_POST[$field] ?? ''))) {
            header('Location: ../auth/register.php?error=' . urlencode('Please complete all fields.'));
            exit();
        }
    }

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    if (strlen($password) < 8) {
        header('Location: ../auth/register.php?error=' . urlencode('Password must be at least 8 characters.'));
        exit();
    }

    if ($password !== $confirmPassword) {
        header('Location: ../auth/register.php?error=' . urlencode('Passwords do not match.'));
        exit();
    }

    $username = trim($_POST['username']);
    if ($user->findByUsername($username)) {
        header('Location: ../auth/register.php?error=' . urlencode('Username is already taken.'));
        exit();
    }

    $created = $user->createAccount(
        trim($_POST['first_name']), trim($_POST['last_name']), trim($_POST['email']),
        trim($_POST['gender']), trim($_POST['course']), trim($_POST['section']),
        trim($_POST['address']), $username, $password
    );

    header('Location: ' . ($created ? '../auth/login.php?registered=1' : '../auth/register.php?error=' . urlencode('Could not create account. Check if the email is already used.')));
    exit();
}

header('Location: ../auth/login.php');
exit();