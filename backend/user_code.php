<?php
session_start();
require_once '../config/connection.php'; 
require_once '../classes/User.php'; 

$user = new User($connect);

if (isset($_POST['save_member'])) {
    $first_name   = trim($_POST['first_name']);
    $last_name    = trim($_POST['last_name']);
    $email        = trim($_POST['email']);
    $gender       = trim($_POST['gender']); 
    $course       = trim($_POST['course'] ?? '');
    
    $year_level   = trim($_POST['year_level'] ?? '');
    $section      = trim($_POST['section'] ?? '');
    $year_section = trim($year_level . ' ' . $section);
    
    $user_address = trim($_POST['address']); 
    $status = trim($_POST['status'] ?? 'Pending');
    $pending_requirements = trim($_POST['pending_requirements'] ?? '');
    $remarks = trim($_POST['remarks'] ?? '');

    if ($user->addMember($first_name, $last_name, $email, $gender, $course, $year_section, $user_address, $status, $pending_requirements, $remarks)) {
        header("Location: ../index.php?status=success&msg=Student clearance record saved successfully!");
        exit();
    } else {
        header("Location: ../index.php?status=error&msg=Failed to enroll student.");
        exit();
    }
}

if (isset($_POST['delete_member'])) {
    $member_id = $_POST['member_id'];

    if ($user->deleteMember($member_id)) {
        header("Location: ../index.php?status=success&msg=Student record deleted!");
        exit();
    } else {
        header("Location: ../index.php?status=error&msg=Failed to delete student.");
        exit();
    }
}

if (isset($_POST['update_member'])) {
    $member_id    = $_POST['member_id'];
    $first_name   = trim($_POST['first_name']);
    $last_name    = trim($_POST['last_name']);
    $email        = trim($_POST['email']);
    $gender       = trim($_POST['gender']); 
    $course       = trim($_POST['course'] ?? '');
    
    $year_level   = trim($_POST['year_level'] ?? '');
    $section      = trim($_POST['section'] ?? '');
    $year_section = trim($year_level . ' ' . $section);
    
    $user_address = trim($_POST['address']); 
    $status = trim($_POST['status'] ?? 'Pending');
    $pending_requirements = trim($_POST['pending_requirements'] ?? '');
    $remarks = trim($_POST['remarks'] ?? '');

    if ($user->updateMember($member_id, $first_name, $last_name, $email, $gender, $course, $year_section, $user_address, $status, $pending_requirements, $remarks)) {
        header("Location: ../index.php?status=success&msg=Student clearance record updated!");
        exit();
    } else {
        header("Location: ../index.php?status=error&msg=Failed to update student.");
        exit();
    }
}
?>