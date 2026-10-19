<?php
session_start();
require_once 'config/connection.php';
require_once 'classes/User.php';
require_once 'classes/Auth.php';

Auth::requireLogin();

$user = new User($connect);
$students = $user->getAllUsers();
$deficientRecords = [];

foreach ($students as $student) {
    $status = $student->status ?? 'Pending';
    $pending = trim((string)($student->pending_requirements ?? ''));
    if ($status !== 'Cleared' || !empty($pending)) {
        $deficientRecords[] = $student;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deficiencies | OSCMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css?v=20260917">
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand-wrap">
            <div class="brand-logo">O</div>
            <div class="brand-text">
                <strong>OSCMS</strong>
                <span>Portal</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a class="nav-item" href="index.php"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a class="nav-item" href="reports.php"><i class="bi bi-bar-chart"></i> Reports</a>
            <a class="nav-item active" href="deficiencies.php"><i class="bi bi-exclamation-triangle"></i> Deficiencies</a>
        </nav>
    </aside>

    <main class="main-panel">
        <header class="topbar">
            <div class="topbar-title">Student Clearance Management System</div>
            <div class="topbar-right">
                <div class="account-pill">
                    <i class="bi bi-person-circle"></i>
                    <span>My Account</span>
                </div>
                <a href="auth/logout.php" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </header>

        <section class="content-panel">
            <div class="page-header">
                <div>
                    <span class="eyebrow">Deficiency Check</span>
                    <h1>Pending Clearance Requirements</h1>
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table member-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Pending Requirements</th>
                                <th>Officer Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($deficientRecords)): ?>
                                <?php foreach ($deficientRecords as $student): ?>
                                    <?php
                                        $status = $student->status ?? 'Pending';
                                        $statusClass = 'pending-badge';
                                        if ($status === 'Cleared') {
                                            $statusClass = 'cleared-badge';
                                        } elseif ($status === 'In Review') {
                                            $statusClass = 'review-badge';
                                        } elseif ($status === 'Needs Revision') {
                                            $statusClass = 'revision-badge';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars(trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? ''))) ?></td>
                                        <td><?= htmlspecialchars($student->course ?? 'N/A') ?></td>
                                        <td><span class="badge-status <?= $statusClass ?>"><?= htmlspecialchars($status) ?></span></td>
                                        <td><?= htmlspecialchars($student->pending_requirements ?? 'None') ?></td>
                                        <td><?= htmlspecialchars($student->remarks ?? 'No remarks') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No deficiencies recorded.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
