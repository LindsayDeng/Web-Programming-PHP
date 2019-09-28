<?php
require_once('abstractDAO.php');
require_once('./model/adminuser.php');

class adminusersDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    
    /*
     * Returns an array of <code>adminuser</code> objects. If no adminuser exist, returns false.
     */
    public function getAdminusers(){
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM adminusers');
        $adminusers = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new customer object, and add it to the array.
                $adminuser = new Adminuser($row['AdminID'], $row['Lastlogin'],$row['Password'],$row['Username']);
                $adminusers[] = $adminuser;
            }
            $result->free();
            return $adminusers;
        }
        $result->free();
        return false;
    }
	
	/* return how many records are found*/
	public function getNumberOfAdminusersByUserName($userName){
        $existed = false;
        $query = 'SELECT * FROM adminusers WHERE Username = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $userName);
        $stmt->execute();
        $result = $stmt->get_result();
		return ($result->num_rows);
    }
    
    /*
     * This is an example of how to use a prepared statement
     * with a select query.
     */
    public function getAdminuserByUserName($userName){
        $query = 'SELECT * FROM adminusers WHERE Username = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $adminuser = new Adminuser($row['AdminID'], $row['Lastlogin'],$row['Password'],$row['Username']);
            $result->free();
            return $adminuser;
        }
        $result->free();
        return false;
    }
	
	/** update last login**/
	public function updateLastLogin($userName){
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE adminusers SET Lastlogin = now() WHERE Username = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('s', $userName);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}

?>
