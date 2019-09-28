<?php require_once('./dao/customerDAO.php'); ?>
<!DOCTYPE html>
<?php
include "header.php";                
?>

            <div id="content" class="clearfix">
                <aside>
                        <h2>Mailing Address</h2>
                        <h3>1385 Woodroffe Ave<br>
                            Ottawa, ON K4C1A4</h3>
                        <h2>Phone Number</h2>
                        <h3>(613)727-4723</h3>
                        <h2>Fax Number</h2>
                        <h3>(613)555-1212</h3>
                        <h2>Email Address</h2>
                        <h3>info@wpeatery.com</h3>
                </aside>
			
				
                <div class="main">
                    <h1>Sign up for our newsletter</h1>
                    <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
                    <form name="frmNewsletter" id="frmNewsletter" method="post" action="contact.php">
                        <table>
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" name="name" id="customerName" size='40'></td>
								
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td><input type="text" name="phone" id="phoneNumber" size='40'></td>
								
								
                            </tr>
                            <tr>
                                <td>Email Address:</td>
                                <td><input type="text" name="email" id="emailAddress" size='40'>
								
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>Newspaper<input type="radio" name="about" id="referralNewspaper" value="newspaper">
                                    Radio<input type="radio" name='about' id='referralRadio' value='radio'>
                                    TV<input type='radio' name='about' id='referralTV' value='TV'>
                                    Other<input type='radio' name='about' id='referralOther' value='other'>
									
                            </tr>
                            <tr>
                                <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                            </tr>
                        </table>
                    </form>

				<?php
				try{
				$customerDAO = new customerDAO();// connection created
				//Tracks errors with the form fields
				$hasError = false; //validation flag
				//Array for our error messages
				$errorMessages = Array(); // contains all the messages from form

            //Ensure all three values are set.
            //They will only be set when the form is submitted.
            //We only want the code that adds an employee to 
            //the database to run if the form has been submitted.
            if(isset($_POST['name']) ||
                isset($_POST['phone']) || 
                isset($_POST['email']) ||
				isset($_POST['about'])){
            
                //We know they are set, so let's check for values
                //EmployeeID should be a number
                

                if($_POST['name'] == ""){
                    $errorMessages['nameError'] = "Please enter a name.";
                    $hasError = true;
					
                }

                if($_POST['phone'] == ""){
                    $errorMessages['phoneError'] = "Please enter a phone number.";
                    $hasError = true;
                }
				if($_POST['email'] == ""){
                    $errorMessages['emailError'] = "Please enter an email address.";
                    $hasError = true;
                }
				if(empty($_POST['about'])){
                    $errorMessages['aboutError'] = "Please choose how you heard about us.";
                    $hasError = true;
                }

                if(!$hasError){
                    $customer = new Customer($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['about']);
                    $addSuccess = $customerDAO->addCustomer($customer);
                    echo '<h3>' . $addSuccess . '</h3>';
                
            }  else {
					if(isset($errorMessages['nameError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['nameError'] . '</span>';
                      }
					if(isset($errorMessages['phoneError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['phoneError'] . '</span>';
                      }
					if(isset($errorMessages['emailError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['emailError'] . '</span>';
                      }
					if(isset($errorMessages['aboutError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['aboutError'] . '</span>';
                      }
					}
			}

			} catch (Exception $e) {
				echo '<h2> Error </h2>';
				echo '<p>' . $e->getMessage() . '</p>';
			} //Returns the Exception message.



				?>
                </div><!-- End Main -->
            </div><!-- End Content -->
<?php
include "footer.php";                 
?>      