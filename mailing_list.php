<!DOCTYPE html>
<?php
		
		require_once ('./dao/customerDAO.php');
        require_once('./dao/adminusersDAO.php');
		require_once ('./model/Customer.php');
		require_once('WebsiteUser.php');
		session_start();
		session_regenerate_id(false);
		
				
		if(isset($_SESSION['websiteUser'])){
			if(!$_SESSION['websiteUser']->isAuthenticated()){
			   header('Location:userlogin.php'); 
			}
		} else {
			header('Location:userlogin.php');
		}
		include "header.php"; 
?>
<h1>Mailing List</h1>
<a href="userlogout.php">Logout!</a> <br>
	<?php
	
		
		echo '<p>Session ID: ' . session_id() . '</p>';
       // echo '<p>Last Login Date = '.$adminuser->getLastlogin() . '</p>';
	
		
		try{
        $customerDAO = new customerDAO();
        //Tracks errors with the form fields
        $hasError = false;
        //Array for our error messages
        $errorMessages = Array();
		
		}
		catch(Exception $e){
		    echo '<h3>Error on page 3.</h3>';
            echo '<p>' . $e->getMessage() . '</p>';
		}
		
			$result = $customerDAO->getCustomers();

            if($result){
                //We only want to output the table if we have employees.
                //If there are none, this code will not run.
                echo '<table border=\'1\'>';
                echo "<tr><th>Customer Name</th><th>Phone Number</th><th>Email Address</th><th>Referrer</th></tr>";
                foreach($result as $customer){
                    echo '<tr>';
					
                    echo '<td>' . $customer->getName() . '</td>';
                    echo '<td>' . $customer->getPhone() . '</td>';
					echo '<td>' . $customer->getEmail() . '</td>';
					echo '<td>' . $customer->getAbout() . '</td>';
                    echo '</tr>';
					}
				}
				
	?>
