<?php
require_once '../core/Database.php';
require_once '../core/config.php';
require_once '../core/Model.php';
class Payments extends Model {

  
    protected $table = 'payment';


    public function __construct() {
        $connection = new Database();
        $this->conn = $connection->connect();
    }

 
    public function processRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['transaction_id'])) {
                $transactionId = $_POST['transaction_id'];
                $result = $this->transactQuery($transactionId);
                if ($result) {
                    echo json_encode($result);
                } else {
                    echo json_encode(['mess' => 0]);
                }
            } else {
                echo json_encode(['error' => 'Transaction ID not provided.']);
            }
        } else {
            echo json_encode(['error' => 'Invalid request method.']);
        }
    }

    
}    
// Instantiate the Payments class and call the processRequest method
$payments = new Payments();
$payments->processRequest();

?>
