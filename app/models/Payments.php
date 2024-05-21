<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__.'/../core/config.php';
require_once __DIR__.'/../core/Model.php';

class Payments extends Model {
    protected $table = 'payment';

    public function getPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? null;

            if ($action === 'getPayment') {
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
            } elseif ($action === 'addPayment') {
                print_r($_POST);
                $transactionId = $_POST['transaction_id'] ?? null;
                $customerId = $_POST['customer_id'] ?? null;
                $amountTendered = $_POST['amount_tendered'] ?? null;
                $amountToBePaid = $_POST['amount_to_be_paid'] ?? null;
                
                if ($transactionId && $customerId && $amountTendered && $amountToBePaid) {
                    try {
                        $updated = $this->addPayment($transactionId, $customerId, $amountTendered, $amountToBePaid);
                        if ($updated) {
                            echo json_encode(['success' => true]);
                        } else {
                            echo json_encode(['success' => false, 'error' => 'Failed to add payment and update status.']);
                        }
                    } catch (PDOException $e) {
                        // Handle SQL error
                        echo json_encode(['success' => false, 'error' => 'SQL error: ' . $e->getMessage()]);
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing parameters.']);
                }
            }
        }
    }
}

$payments = new Payments();
$payments->getPayment();
?>