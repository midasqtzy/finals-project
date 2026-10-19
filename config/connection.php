<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$db_name    = "member_list";

try {
    $connect = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userColumns = $connect->query("SHOW COLUMNS FROM users_table")->fetchAll(PDO::FETCH_COLUMN);
    if (in_array('password', $userColumns, true)) {
        $connect->exec("ALTER TABLE users_table MODIFY password VARCHAR(255) NULL");
    }

    if (in_array('date_created', $userColumns, true)) {
        $connect->exec("UPDATE users_table SET date_created = CURRENT_TIMESTAMP WHERE date_created IS NULL");
        $connect->exec("ALTER TABLE users_table MODIFY date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
    }

    $memberColumns = $connect->query("SHOW COLUMNS FROM members")->fetchAll(PDO::FETCH_COLUMN);
    if (!in_array('status', $memberColumns, true)) {
        $connect->exec("ALTER TABLE members ADD status VARCHAR(20) NOT NULL DEFAULT 'Pending' AFTER address");
    }
    if (!in_array('pending_requirements', $memberColumns, true)) {
        $connect->exec("ALTER TABLE members ADD pending_requirements TEXT NULL AFTER status");
    }
    if (!in_array('remarks', $memberColumns, true)) {
        $connect->exec("ALTER TABLE members ADD remarks TEXT NULL AFTER pending_requirements");
    }

    if (in_array('username', $memberColumns, true) && in_array('password_hash', $memberColumns, true)) {
        $connect->exec("INSERT INTO users_table (username, password, role)
                        SELECT m.username, m.password_hash, 'member'
                        FROM members m
                        LEFT JOIN users_table u ON u.username = m.username
                        WHERE m.username IS NOT NULL
                          AND m.username <> ''
                          AND m.password_hash IS NOT NULL
                          AND m.password_hash <> ''
                          AND u.user_id IS NULL");
        $connect->exec("UPDATE members m
                        INNER JOIN users_table u ON u.username = m.username
                        SET m.user_id = u.user_id
                        WHERE m.user_id IS NULL");
        $connect->exec("ALTER TABLE members DROP COLUMN password_hash, DROP COLUMN username");
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>