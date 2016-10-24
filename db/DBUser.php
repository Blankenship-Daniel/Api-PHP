<?php
class DBUser {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Inserts a new user into the user table.
     * @param  string $email    the user's email address.
     * @param  string $password the user's password.
     * @return boolean          true, if the insert was successfull, false
     *                                otherwise.
     */
    function registerUser($email, $password) {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $pass);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
