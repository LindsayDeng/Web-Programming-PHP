<?php
require_once('abstractDAO.php');
require_once('./model/customer.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of employeeDAO
 *
 * @author Matt
 */
class customerDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();// you are calling the constructor of abstractdao
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    
    /*
     * This is an example of how to use the query() method of a mysqli object.
     * 
     * Returns an array of <code>Employee</code> objects. If no employees exist, returns false.
     */
    public function getCustomers(){
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM mailinglist');
        $customers = Array(); // array to hold employees
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new employee object, and add it to the array.
                $customer = new Customer($row['customerName'], $row['phoneNumber'], $row['emailAddress'], $row['referrer']);
                $customers[] = $customer;
            }
            $result->free();
            return $customers;
        }
        $result->free();
        return false;
    }
    
    /*
     * This is an example of how to use a prepared statement
     * with a select query.
     */
	 /*
    public function getCustomer($name){
        $query = 'SELECT * FROM mailinglist WHERE name = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $customer = new Customer($temp['name'], $temp['phone'], $temp['email'], $temp['about']);
            $result->free();
            return $customer;
        }
        $result->free();
        return false;
    }
*/
    public function addCustomer($customer){ // accpets employee object, comes from the browser, 
	// when this method is called, we add employee to the database, accepts employee object
        
        if(!$this->mysqli->connect_errno){
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            $query = 'INSERT INTO mailinglist VALUES (?,?,?,?,?)';
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
            $stmt = $this->mysqli->prepare($query); // bind the 3 ? into 3 parameters, insert the values into the 3 parameters later in the code
            //The first parameter of bind_param takes a string
            //describing the data. In this case, we are passing 
            //three variables: an integer(employeeId), and two
            //strings (firstName and lastName).
            //
            //The string contains a one-letter datatype description
            //for each parameter. 'i' is used for integers, and 's'
            //is used for strings.
            $stmt->bind_param('issss', // integer, string, string my our lab ssss (four times)
					$customer->getCustomerID(),
				    $customer->getName(), 
                    $customer->getPhone(), 
                    $customer->getEmail(),
					$customer->getAbout());
            //Execute the statement
            $stmt->execute(); // that actually execute the code
            //If there are errors, they will be in the error property of the
            //mysqli_stmt object.
            if($stmt->error){
                return $stmt->error;
            } else {
                return $customer->getCustomerID() . ' ' . $customer->getName() . ' ' . $customer->getPhone() . ' was added successfully!';
            }
        } else {
            return 'Could not connect to Database.';
        }
    }
    
}

?>
