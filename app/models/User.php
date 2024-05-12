<?php 



class User extends Model
{
    // protected $table = 'user';

    // protected $allowedColumns = [
    //     'CUS_FNAME',
    //     'CUS_LNAME',
    //     'CUS_ADDRESS',
    //     'CUS_CONTACT_NUM',
    //     'CUS_EMAIL',
    //     'CUS_PASS'
    // ];

    public function validate($data) {

        $this->errors = [];

        if (empty($data['fname'])) {
            $this->errors['fname'] = "Firstname is required.";
        }

        if (empty($data['lname'])) {
            $this->errors['lname'] = "Lastname is required.";
        }

        if (empty($data['address'])) {
            $this->errors['address'] = "Address is required.";
        }

        if (empty($data['contact_num'])) {
            $this->errors['contact_num'] = "Contact number is required.";
        }

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required.";
        } else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "Email is not valid";            
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password number is required.";
        } 
        else if (empty($data['cpassword'])) {
            $this->errors['cpassword'] = "Confirm your password.";
        } 
        else if ($data['password'] != $data['cpassword']) {
            $this->errors['confirm'] = "Password does not match.";
        }

        $conn = $this->openConnection();
        $select = $conn->prepare("SELECT * FROM user WHERE CUS_EMAIL = ?");
        $select->execute([$data['email']]);
        if ($select->rowCount() > 0) {
            $this->errors['email'] = 'User email already exists!';
        }

    return empty($this->errors);


        if(empty($this->errors))
		{
			return true;
		}
        
        return false;
        
    }
    
}