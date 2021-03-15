<?php
class directories {
    public $debug="";
    
    private $directoryName="directoryName not set.";
    private $fileContents = "fileContents not set";
    private $errorMessage = "";

    private $directoryRoot = "./directories";
    private $baseURL = "http://178.128.157.194/CPS276_REPOSITORY/assignments/assignment5/directories/";
    private $fileURL = "";

    public function getDebug() {
        return("debug=<".$this->debug."> \n errorMesasge=".$this->errorMessage.">");

    }

    public function getError() {
        return($this->errorMessage);

    }

    public function getFileURL() {
        return($this->fileURL);

    }


    /*
        Event handler for form.  
        When submit button is pressed, create a new 
    */
    public function createDirectoryAndFile () {

        $this->errorMessage = "Unexpected Error Encountered";
        $this->fileURL="";

        /* user has selected adding a name to our list */
        if(isset($_POST['submit'])){

            // get the directory name - if not set, return with error
            if(isset($_POST['directoryName'])) {

                // make sure there is something in the directory name text box
                if (strlen(trim($_POST['directoryName']))<=0) {
                    $this->errorMessage = "No directory name provided!";
                    return($this->errorMessage);
                }
                $this->directoryName = $this->directoryRoot."/".$_POST['directoryName'];
            }
            else {
                $this->errorMessage = "directoryName Not Set";
                return($this->errorMessage);
            }
$this->errorMessage = "Past get directory and filename";
            // get the file contents - if not set, return with error
            if(isset($_POST['fileContents'])) {
 
                $this->fileContents = $_POST['fileContents'];
            }
            else {
                $this->errorMessage = "No Text Provided to Be Written To File.";
                return($this->errorMessage);
            }
$this->errorMessage = "Past get file contents";

            //create directory
            if (!file_exists($this->directoryName)) {
                mkdir( $this->directoryName, 0777, true);  
                chmod($this->directoryName, 0777);              
            }
            else {
                $this->errorMessage = "A directory already exists with that name.";
                return($this->errorMessage);
            }
 $this->errorMessage = "Past create directory";

            // write message to file          
            $fileName = $this->directoryName."/readme.txt";

            $fp = fopen($fileName, "w");
            if ( !$fp ) { 
                $this->errorMessage = "Unable to open file for write!";
                return($this->errorMessage);       
            }
            else {
                fwrite($fp,$this->fileContents);
                fclose( $fp);
            }            

        }        


        $this->fileURL = $this->baseURL.$_POST['directoryName']."/readme.txt";
        
$this->debug = "fileURL=".$this->fileURL;    

        $this->errorMessage = "";
        return($this->errorMessage);
        
    }
}
?>