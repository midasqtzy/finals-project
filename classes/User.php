<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllUsers($search = '') {
        try {
            if (!empty($search)) {
                $query = "SELECT * FROM members 
                          WHERE first_name LIKE :search 
                             OR last_name LIKE :search 
                             OR email LIKE :search 
                             OR course LIKE :search 
                             OR year_section LIKE :search 
                             OR address LIKE :search
                          ORDER BY member_id DESC";
                $stmt = $this->conn->prepare($query);
                $searchTerm = "%{$search}%";
                $stmt->bindParam(':search', $searchTerm);
            } else {
                $query = "SELECT * FROM members ORDER BY member_id DESC";
                $stmt = $this->conn->prepare($query);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function addMember($firstName, $lastName, $email, $gender, $course, $section, $address, $status = 'Pending', $pendingRequirements = '', $remarks = '') {
        try {
            $this->conn->beginTransaction();
            $query = "INSERT INTO members (first_name, last_name, email, gender, course, year_section, address, status, pending_requirements, remarks) 
                      VALUES (:first_name, :last_name, :email, :gender, :course, :section, :address, :status, :pending_requirements, :remarks)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':course', $course);
            $stmt->bindParam(':section', $section);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':pending_requirements', $pendingRequirements);
            $stmt->bindParam(':remarks', $remarks);

            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            return false;
        }
    }

    public function updateMember($id, $firstName, $lastName, $email, $gender, $course, $section, $address, $status = 'Pending', $pendingRequirements = '', $remarks = '') {
        try {
            $this->conn->beginTransaction();
            $query = "UPDATE members 
                      SET first_name = :first_name, 
                          last_name = :last_name, 
                          email = :email, 
                          gender = :gender, 
                          course = :course, 
                          year_section = :section, 
                          address = :address,
                          status = :status,
                          pending_requirements = :pending_requirements,
                          remarks = :remarks 
                      WHERE member_id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':course', $course);
            $stmt->bindParam(':section', $section);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':pending_requirements', $pendingRequirements);
            $stmt->bindParam(':remarks', $remarks);

            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            return false;
        }
    }

    public function deleteMember($id) {
        try {
            $query = "DELETE FROM members WHERE member_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createAccount($firstName, $lastName, $email, $gender, $course, $section, $address, $username, $password) {
        $this->conn->beginTransaction();
        try {
            $userStmt = $this->conn->prepare("INSERT INTO users_table (username, password, role)
                                              VALUES (:username, :password, 'member')");
            $userStmt->execute([
                ':username' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT)
            ]);

            $memberStmt = $this->conn->prepare("INSERT INTO members
                      (first_name, last_name, email, gender, course, year_section, address, user_id)
                      VALUES (:first_name, :last_name, :email, :gender, :course, :section, :address, :user_id)");
            $memberStmt->execute([
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':email' => $email,
                ':gender' => $gender,
                ':course' => $course,
                ':section' => $section,
                ':address' => $address,
                ':user_id' => $this->conn->lastInsertId()
            ]);

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            return false;
        }
    }

    public function findByUsername($username) {
        $stmt = $this->conn->prepare("SELECT u.user_id, u.username, u.password, u.role,
                             m.member_id, m.first_name, m.last_name
                                      FROM users_table u
                                      LEFT JOIN members m ON m.user_id = u.user_id
                                      WHERE u.username = :username
                                      LIMIT 1");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

}
?>