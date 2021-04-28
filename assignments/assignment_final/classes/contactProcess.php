<?php

require 'Pdo_methods.php';

class contactProcess  extends PdoMethods {
    public $debug="In addContact";


    public function addContact(){

        /*
        
        // PARSE NOTE DATE from selection box 
        $noteTimeStamp = strtotime($_POST['dateTime']);
        if ($noteTimeStamp) {
          $noteTimeStampStr = date('Y-m-d', $noteTimeStamp);
          $this->debug .=  "noteTimeStampStr=".$noteTimeStampStr. " ";
        } else {
           return('Invalid or Missing Date.' . $_POST['dateTime']);
        } 
     
        $noteText = $_POST['noteText'];
        if (strlen($noteText)>0) {
            $this->debug .=  "noteText=".$noteText. " "; 
        }
        else {
             return('Missing Note.');
        } 
         
                    
        $noteText = $_POST['noteText'];
		//CREATE AN INSTANCE OF THE PDOMETHODS CLASS
		$pdo = new PdoMethods();
        
		// CREATE THE SQL 
		$sql = "insert into  notes values ( :note_time_stamp,:note_text) ";
        $bindings = [
			[':note_time_stamp',$noteTimeStamp,'int'] ,
            [':note_text',$noteText,'str'] 
		];


        

		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->otherBinded($sql,$bindings);
*/

        // Get Data to be inserted - at this point all fields should be verifiec and we just need to get them from
        // the $_POST array.
        $contactName = $_POST['name'];
        $streetAddress = $_POST['address'];   
        $city = $_POST['city'];    
        $state = $_POST['state'];  
        $phone = $_POST['phone'];   
        $emailAddress = $_POST['email'];   
        $birthDate = $_POST['dob'];  
        $ageBracket = $_POST['ageBracket'];    
        echo("Name I want to insert is ".$contactName);

		//CREATE AN INSTANCE OF THE PDOMETHODS CLASS
		$pdo = new PdoMethods();

        /*
        // CREATE THE SQL 
		$sql = "insert into contacts (contact_name,street_address, city,state, phone,email, birth_date  ) values (:contact_name,:street_address, :city,:state, :phone,:email :birth_date  ) ";
        $sql = "insert into contacts (contact_name,street_address, city,state, phone,email, birth_date  ) values (:contact_name,:street_address, :city,:state, :phone,:email :birth_date  ) ";
        $bindings = [
            [':contact_name',$contactName,'str'] ,
            [':street_address',$streetAddress,'str'] ,
            [':city',$city,'str'] ,
            [':state',$state,'str'] ,
            [':phone',$phone,'str'] ,
            [':email',$emailAddress,'str'] ,         
            [':birth_date',$birthDate,'str'] 
		];
*/

        		// CREATE THE SQL 
                $sql = "insert into  contacts (contact_name,street_address,city,state,phone,email, birth_date,age_range) values ( :contact_name, :street_address, :city,:state,:phone,:email,:birth_date,:age_range) ";
                $bindings = [
                    [':contact_name',$contactName,'str'] ,
                    [':street_address',$streetAddress,'str'] ,
                    [':city',$city,'str'] ,
                    [':state',$state,'str'] ,     
                    [':phone',$phone,'str'] ,
                    [':email',$emailAddress,'str']  ,
                    [':birth_date',$birthDate,'str']  ,
                    [':age_range',$ageBracket,'str']                              
                ];
        


		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->otherBinded($sql,$bindings);

		// IF THERE WAS AN ERROR DISPLAY MESSAGE 
		if($records == 'error'){
			return 'There was an error adding the record';
		}
		else {
				return 'Contact has been added - For Sure!';
			
		}
   
      
	}




    public function getContacts(){

        
		//CREATE AN INSTANCE OF THE PDOMETHODS CLASS
		$pdo = new PdoMethods();

        
		// CREATE THE SQL 
		$sql = "SELECT * FROM contacts";


		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectNotBinded($sql);

		// IF THERE WAS AN ERROR DISPLAY MESSAGE 
		if($records == 'error'){
			return 'There has been and error processing your request';
		}
		else {
			if(count($records) != 0){
			
				return $this->getContactsTable($records);	
			}
			else {
				return 'No contacts available in database.';
			}
		}
      

      
	}


    private function getContactsTable($records){
  
		$output = "<table class='table table-bordered table-striped'> <thead> <tr>";
		$output .= "<th>Name</th> <th>Delete</th> </thead><tbody>";
		foreach ($records as $row){


			$output .= "<tr> <td> {$row['contact_name']} </td>";
            //$output .= "<tr> <td> {$row['time_stamp']} </td>";
			$output .= "<td><input type='checkbox' name='inputDeleteChk[]' value='{$row['contact_name']}'></td></tr>";
		}
		
		$output .= "</tbody></table>";
		return $output;

	}


  

    /*
        Event handler for form.  handles deleting of contacts list if delete button hit
    */
    public function deleteContacts () {

		//CREATE AN INSTANCE OF THE PDOMETHODS CLASS
		$pdo = new PdoMethods();
    
		// CREATE THE SQL 
		$sql = "DELETE FROM contacts";

		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->otherNotBinded($sql);

		// IF THERE WAS AN ERROR DISPLAY MESSAGE 
		if($records == 'error'){
			return 'There has been and error processing your request';
		}
		else {

				return 'Records successfully deleted.';
		
        }
      

        
    }


	public function deleteContacts2($post){
		$error = false;
		if(isset($post['inputDeleteChk'])){
			foreach($post['inputDeleteChk'] as $id){
				$pdo = new PdoMethods();

				$sql = "DELETE FROM contacts WHERE contact_name=:id";
				
				$bindings = [
					[':id', $id, 'str'],
				];


				$result = $pdo->otherBinded($sql, $bindings);

				if($result === 'error'){
					$error = true;
					break;
				}
			}
			if($error){
				return "There was an error in deleting a name or names";
			}
			else {
				return "All names deleted";
			}

		}
		else {
			return "No names selected to delete";
		}
	}


}
?>