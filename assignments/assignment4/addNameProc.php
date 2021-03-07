<?php
class addNamesProc {
    public $debug="";

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