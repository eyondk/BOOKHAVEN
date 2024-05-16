<?php

class Profile extends Controller
{
    public function index()
    {
        $user = new User;
        
        $user_id = $_SESSION['user'] ?? null;
        $userData = $user_id ? $this->getUserData($user_id) : null;
        
        $data['user_fname'] = $userData ? $userData['CUS_FNAME'] : 'User';
        $data['user_lname'] = $userData ? $userData['CUS_LNAME'] : 'User';
        $data['user_email'] = $userData ? $userData['CUS_EMAIL'] : 'User';
        $data['user_address'] = $userData ? $userData['CUS_ADDRESS'] : 'User';
        $data['user_contact_num'] = $userData ? $userData['CUS_CONTACT_NUM'] : 'User';
        $data['user_id'] = $user_id;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array_merge($data, $_POST);
            // show($_POST);
            if (isset($_POST['edit'])) {
                if ($user->edit_user_info($data)) {
                    $data['message'] = "Edit information sucessful!";
                    redirect('profile');
                } else {
                    $data['error_message'] = $user->errors['message'];
                }
            }
    
            if (isset($_POST['delete_user'])) {
                if ($user->delete_user($data)) {
                    $data['message'] = "User deleted successfully!";
                    redirect('home');
                } else {
                    $data['error_message'] = $user->errors['message'];
                }
            }

            if (isset($_POST['changepass'])) {
                if ($user->validate_change_pass($data, $user_id)) {
                    if ($user->change_pass($data, $user_id)) {
                        $data['message'] = "Password changed successfully!";
                        redirect('profile');
                    } else {
                        $data['error_message'] = $user->errors['message'];
                    }
                } else {
                    $data['error_message'] = $user->errors;
                }
            }
        
        }

        // show($data);
        $data['errors'] = $user->errors;
        $this->view('user/profile', $data);
    }

    private function getUserData($user_id)
    {
        $user = new User();
        return $user->getUserById($user_id);
    }
}
