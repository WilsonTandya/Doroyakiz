<?php

include 'controller.php';

class Account extends Controller {

    public function __construct()
    {        
        parent::__construct();
    }

    public static function encrypt($string)
    {        
        $ciphering = "AES-128-CTR";
        
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        $encryption_iv = '1234567891011121';
        $encryption_key = "haissemconservative";
        
        $encrypted_string = openssl_encrypt($string, $ciphering,
                    $encryption_key, $options, $encryption_iv);

        return $encrypted_string;
    }

    public function login($username, $password) 
    {
        $encrypted_password = self::encrypt($password);
        $sql =<<<EOF
            SELECT *
            FROM ACCOUNT
            WHERE USERNAME = (?) AND HASHED_PASSWORD = (?)
            ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($username, $encrypted_password));

        $res = $stmt->fetch(PDO::FETCH_OBJ);

        return $res;
    }

    public function register($email, $fullname, $username, $password) 
    {
        $encrypted_password = self::encrypt($password);
        $sql =<<<EOF
            INSERT INTO ACCOUNT (NAME, USERNAME, EMAIL, HASHED_PASSWORD, ISADMIN)
            VALUES ((?), (?), (?), (?), 0)
            ;
        EOF;

        $sql_get_data =<<<EOF
            SELECT *
            FROM ACCOUNT
            WHERE USERNAME = (?)
            ;
        EOF;

        $res = NULL;
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($fullname, $username, $email, $encrypted_password));

            $stmt_get_data = $this->db->prepare($sql_get_data);
            $stmt_get_data->execute(array($username));

            $res = $stmt_get_data->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $res;
    }

    public function isUsernameAvailable($username) 
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            return false;
        }

        $sql =<<<EOF
            SELECT USERNAME
            FROM ACCOUNT
            WHERE USERNAME = (?)
            ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($username));

        $res = $stmt->fetch(PDO::FETCH_OBJ);

        return $res == NULL;
    }
}

?>