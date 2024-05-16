<?php



Trait Database 
{
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->password,
                
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            
          
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;


        
    }

    // private function connect()
    // {
    //     $string = "mysql:hostname=".DB_HOST.";dbname=".DB_NAME;
    //     $con = new PDO($string,DB_USER,DB_PASSWORD); 
    //     return $con;
    // }
    

    public function query($query, $data = [])
    {

        $con = $this->connect();
        $stm =  $con ->prepare($query);
        
        echo $query;
        $check = $stm->execute($data);
        
    
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
        
            if(is_array($result) && count($result))
            {
                return $result;
            }

            
        }
        return false;
    }

    
    public function get_row($query, $data = [])
 {

  $con = $this->connect();
  $stm = $con->prepare($query);

  $check = $stm->execute($data);
  if($check)
  {
   $result = $stm->fetchAll(PDO::FETCH_OBJ);
   if(is_array($result) && count($result))
   {
    return $result[0];
   }
  }

  return false;
 }

}
