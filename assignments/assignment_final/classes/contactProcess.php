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
        echo("Name I want to insert is ".$contactName);

		//CREATE AN INSTANCE OF THE PDOMETHODS CLASS
		$pdo = new PdoMethods();

        		// CREATE THE SQL 
		$sql = "insert into  contacts values ( :contact_name) ";
        $bindings = [
            [':contact_name',$contactName,'str'] 
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




    public function getNotes(){

        
        // PARSE START DATE from selection box 
        $startTimeStamp = strtotime($_POST['begDate']);
        if ($startTimeStamp) {
          $startTimeStr = date('Y-m-d', $startTimeStamp);
          $this->debug .=  "startTimeStr=".$startTimeStr. " ";
        } else {
           return('Invalid Begin Date: ' . $_POST['begDate']);
        } 

        
        // PARSE END DATE from selection box 
        $endTimeStamp = strtotime($_POST['endDate']);
        if ($endTimeStamp) {
          $endTimeStr = date('Y-m-d', $endTimeStamp);
          $this->debug .=  "endTimeStr=".$endTimeStr. " ";
        } else {
           return('Invalid End Date: ' . $_POST['endDate']);
        } 
        
               



		
		//CREATE AN INSTANCE OF THE PDOMETHODS CLASS
		$pdo = new PdoMethods();

        
		// CREATE THE SQL 
		$sql = "SELECT * FROM notes where time_stamp >= :start_time_stamp and time_stamp <= :end_time_stamp  order by time_stamp";
        $bindings = [
			[':start_time_stamp',$startTimeStamp,'int'] ,
            [':end_time_stamp',$endTimeStamp,'int'] 
		];


		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectBinded($sql,$bindings);

		// IF THERE WAS AN ERROR DISPLAY MESSAGE 
		if($records == 'error'){
			return 'There has been and error processing your request';
		}
		else {
			if(count($records) != 0){
			
				return $this->getNotesTable($records);	
			}
			else {
				return 'No notes found for date range selected';
			}
		}
      
	}


    private function getNotesTable($records){
        
		$output = "<table class='table table-bordered table-striped'> <thead> <tr>";
		$output .= "<th>Date and Time</th> <th>Note</th> <tbody>";
		foreach ($records as $row){

            $d = $row['time_stamp'];
            $ds = date("n\/d\/Y h:i a", $d );

			$output .= "<tr> <td> {$ds} </td>";
            //$output .= "<tr> <td> {$row['time_stamp']} </td>";
			$output .= "<td> {$row['note']} </td> </tr>";
		}
		
		$output .= "</tbody></table>";
		return $output;
	}


    /* Utility Function to Flip first and last name */
    public function flipName($inName) {
        
        $nameSplitArr = explode(" ", $inName);
        if (sizeof($nameSplitArr)===2) {
            $flippedName = $nameSplitArr[1].", ".$nameSplitArr[0];
        }
        else {
            $flippedName=""; 
        }

        return( $flippedName);
    }

    /*
        Event handler for form.  handles clearing name list if clearNames button hit and
        appending to name list if addName button hit 
    */
    public function addClearNames () {

        /* user has selected adding a name to our list */
        if(isset($_POST['addName'])){

            /*
            $arrlen=0;
            $nameList = $_POST['listOfNames'];
            $lenNameList = strlen( $nameList);
            $nameListArr = explode("\r\n",$nameList);
            $arrlen = sizeof($nameListArr);
            */

            /*
            $inString="";
            for ($i=0;$i<$lenNameList;$i++) {
                $inString=$inString.(string)ord($nameList[$i])." ";
            }
            */

            /* make our life a little easier by putting $_POST variables into meaningful variables */
            $nameList = $_POST['listOfNames'];
            $newName = $_POST['fullName'];
                    
            /* look for carriage return line feed in textArea form control.  This will indicat it has names in it */
            $strPosCount=0;
            $pos =strpos($nameList,  "\r\n");
            $posList = "";
            $nameArr=array();

            /* if there are names in text area, parse them out and put in an array */
            if ($pos) {
                array_push($nameArr,substr($nameList,0,$pos));

                while ($pos) {
                    $strPosCount=$strPosCount+2; 
                    $posList=$posList.(string)$pos." ";
                    $oldPos = $pos;
                    
                    $pos =strpos($nameList, "\r\n",$oldPos+1);
                    if ($pos) {
                        array_push($nameArr,substr($nameList,$oldPos+2,$pos-($oldPos+2)));
                    }
                }
            }

            /* get the name that was added to the list and flip it so last name is first and first name is last. add this to the prior names in the text area */
            array_push($nameArr,$this->flipName($newName));

            /* sort array of names */
            sort($nameArr);

            /*return($_POST['listOfNames'].$_POST['fullName'] .$lenNameList.' '.$inString.'&#10' );*/

            $this->debug=$this->flipName($newName);
            /*
            $this->debug="";
            $debString="";
            $this->debug = "strPosCount=".(string)$strPosCount." posList=".$posList." sizeof(nameArr)=".(string)sizeof($nameArr)."\n";
            for($i=0;$i<sizeof($nameArr);$i++) {
                $debString=$debString."<".$nameArr[$i].">\n";
            }
            $this->debug = $this->debug.$debString;
            /*
            $debug = "\n arrlen = ".(string)$arrlen."\n";
            for ($i=0;$i<$arrlen;$i++) {
                $debug=$debug."nameList[i]=".$nameList[$i]." ";
            }
            */

            /* create the text of all names (old and new ) so it can be displayed in text area control on form */
            $output="";
            for($i=0;$i<sizeof($nameArr);$i++) {
                $output=$output.$nameArr[$i]."\n";
            }
            return($output);
           
        }
        /* user has selected clearing our list of names */   
        else if(isset($_POST['clearNames']))
            return("");
        
        
        
    }
}
?>