<?php 
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__.'/../core/config.php';
require_once __DIR__.'/../core/Model.php';
class Rent extends Model
{
    protected $table = 'rent';
    function updateStatus(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
        if(isset($_POST['r_id']) && isset($_POST['status'])) {
            $rentalId = $_POST['r_id'];
            $status = $_POST['status'];
            
            $updated = $this->updateRentalStatus($rentalId, $status);
            if ($updated) {
                echo json_encode(['success' => 'Updated']);
                
            } else {
                echo json_encode(['success' => 'Nope']);
            }
        } else {
          
            echo json_encode(['success' => false, 'error' => 'Missing parameters']);
        }
        
    
        exit;
    }
}
}

$rent = new Rent();
$rent -> updateStatus();