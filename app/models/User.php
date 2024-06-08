<?php

class User extends Database{

    public $errors = [];

	public function login ($data) {
        $conn = $this->openConnection();

        if(isset($_POST['login'])) {
            try {
                $password = md5($data['password']);

                $select = $conn->prepare(" SELECT 'SUPERADMIN' as user_type, SUPERAD_ID as user_id, SUPERAD_EMAIL as email, SUPERAD_PASS as password
                    FROM SUPERADMIN
                    WHERE SUPERAD_EMAIL = ? AND SUPERAD_PASS = ?
                    UNION
                    SELECT 'ADMIN' as user_type, ADMIN_ID as user_id, ADMIN_EMAIL as email, ADMIN_PASS as password
                    FROM ADMIN
                    WHERE ADMIN_EMAIL = ? AND ADMIN_PASS = ?"); 
                $select->execute([$data['email'], $password, $data['email'], $password]);
                $row = $select->fetch(PDO::FETCH_ASSOC);

				if($select->rowCount() > 0) {
					$_SESSION['user'] = $row['user_id'];
                    $_SESSION['user_type'] = $row['user_type'];
                    if ($row['user_type'] == 'SUPERADMIN') {
                        redirect('orderssuperadmin');
                    } else {
                        redirect('ordersadmin');
                    }
				} else {
                    $this->errors['message'] = "Incorrect email or password.";
                }

            } catch (PDOException $e) {
                $this->errors['message'] = "Could not login." . $e->getMessage();
            }
        }
    }

}