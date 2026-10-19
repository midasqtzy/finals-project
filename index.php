<?php
session_start();
require_once 'config/connection.php';
require_once 'classes/User.php';
require_once 'classes/Auth.php';

Auth::requireLogin();

$user = new User($connect);

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$allResult = $user->getAllUsers($search);
$totalMembers = !empty($allResult) ? count($allResult) : 0;
$clearedCount = 0;
$pendingCount = 0;
if (!empty($allResult)) {
    foreach ($allResult as $student) {
        if (($student->status ?? 'Pending') === 'Cleared') {
            $clearedCount++;
        } else {
            $pendingCount++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSCMS | Student Clearance Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css?v=20260917">
</head>
<body>

<?php if (isset($_GET['status']) && in_array($_GET['status'], ['success', 'error'], true)): ?>
    <?php
        $flashType = $_GET['status'];
        $flashMsg = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : ($flashType === 'success' ? 'Action completed successfully.' : 'Something went wrong.');
        $isSuccess = ($flashType === 'success');
    ?>
    <div class="ccs-alert-overlay" onclick="window.location.href='index.php';">
        <div class="ccs-center-banner" onclick="event.stopPropagation();">
            <div class="mb-3">
                <i class="bi <?= $isSuccess ? 'bi-check-circle-fill text-success' : 'bi-x-circle-fill text-danger' ?>" style="font-size: 3.5rem;"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2"><?= $isSuccess ? 'Success!' : 'Notice' ?></h5>
            <p class="text-secondary mb-4 small"><?= $flashMsg ?></p>
            <a href="index.php" class="btn <?= $isSuccess ? 'btn-success' : 'btn-danger' ?> w-100 fw-semibold py-2 text-decoration-none">
                Dismiss
            </a>
        </div>
    </div>
<?php endif; ?>

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
            <a class="nav-item active" href="index.php"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a class="nav-item" href="reports.php"><i class="bi bi-bar-chart"></i> Reports</a>
            <a class="nav-item" href="deficiencies.php"><i class="bi bi-exclamation-triangle"></i> Deficiencies</a>
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
                    <span class="eyebrow">Online Student Clearance Management System</span>
                    <h1>Clearance Dashboard</h1>
                </div>
                <div class="header-actions">
                    <div class="page-user">Signed in as <strong><?= htmlspecialchars($_SESSION['username'] ?? '') ?></strong></div>
                </div>
            </div>

            <div class="toolbar-row">
                <div class="toolbar-right" style="margin-left: auto;">
                    <form method="GET" action="index.php" class="search-box">
                        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search student" aria-label="Search student">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                    <button type="button" class="btn btn-primary add-record-btn" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="bi bi-plus-lg"></i> Register Student
                    </button>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-label">Total Students</div>
                    <div class="stat-value"><?= $totalMembers ?></div>
                </div>
                <div class="stat-card success">
                    <div class="stat-label">Cleared</div>
                    <div class="stat-value"><?= $clearedCount ?></div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-label">Pending</div>
                    <div class="stat-value"><?= $pendingCount ?></div>
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table member-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Year & Section</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allResult)): ?>
                                <?php foreach ($allResult as $index => $student): ?>
                                    <?php 
                                        $studentId = $student->member_id ?? '';
                                        $studentStatus = $student->status ?? 'Pending';
                                        $statusClass = 'pending-badge';
                                        if ($studentStatus === 'Cleared') {
                                            $statusClass = 'cleared-badge';
                                        } elseif ($studentStatus === 'In Review') {
                                            $statusClass = 'review-badge';
                                        } elseif ($studentStatus === 'Needs Revision') {
                                            $statusClass = 'revision-badge';
                                        }
                                    ?>
                                    <tr>
                                        <td class="fw-bold"><?= htmlspecialchars($studentId) ?></td>
                                        <td><?= htmlspecialchars($student->member_id ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars(trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? ''))) ?></td>
                                        <td><?= htmlspecialchars($student->course ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($student->year_section ?? 'N/A') ?></td>
                                        <td><span class="badge-status <?= $statusClass ?>"><?= htmlspecialchars($studentStatus) ?></span></td>
                                        <td class="text-end action-col">
                                            <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#updateModal<?= $studentId ?>">
                                                Update
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $studentId ?>">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>

                                    <?php 
                                        if (file_exists('modals/update.php')) { include 'modals/update.php'; }
                                        if (file_exists('modals/delete.php')) { include 'modals/delete.php'; }
                                    ?>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <?= !empty($search) ? 'No students match your search query.' : 'No student records found.' ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</div>

<?php 
if (file_exists('modals/insert.php')) {
    include 'modals/insert.php'; 
}
?>
</body>
</html>