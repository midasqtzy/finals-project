<?php
session_start();
require_once '../config/connection.php';
require_once '../classes/User.php';

if (empty($_SESSION['member_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['register_student'])) {
    header('Location: ../index.php');
    exit();
}

$studentId = filter_var($_POST['student_id'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$name = trim($_POST['name'] ?? '');
$course = trim($_POST['course'] ?? '');
$yearSection = trim($_POST['year_section'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($studentId === false || $name === '' || $course === '' || $yearSection === '' || strlen($username) < 4 || strlen($username) > 50 || strlen($password) < 8) {
    header('Location: ../index.php?status=error&msg=' . urlencode('Please provide valid student details.'));
    exit();
}

$user = new User($connect);
if ($user->registerStudent($studentId, $name, $course, $yearSection, $username, $password)) {
    header('Location: ../index.php?status=success&msg=' . urlencode('Student registered with a pending clearance record.'));
    exit();
}

header('Location: ../index.php?status=error&msg=' . urlencode('Registration failed. The Student ID or username may already exist.'));
exit();