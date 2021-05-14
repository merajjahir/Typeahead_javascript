<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
try{
    $pdo = new PDO("mysql:host=localhost;dbname=to-do", "root", "");
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 //the lame shit function 

    
 function the_lame_shit ($pdo,$input,$input_choice,$input_param)
 {
    
        $the_query  = "SELECT `Choice_date` FROM `todo` WHERE $input_choice LIKE $input_param;";
        //prepareing the query with the statement
        $stmt = $pdo->prepare($the_query);

        //for emergency's only bindValue
        $stmt->bindValue($input_param,$input);
        

        $stmt->execute();
        $row = $stmt->fetch();
        

        if($stmt->rowCount() > 0)
        { 
            foreach ($row as $key => $value) 
            {
                if(!empty($value))
                {
                    print_r( "<p> $value </p> ");

                }  
            
            }   

        }else{
            echo "<p>No matches found</p> ";
        }
        
        // print_r(json_encode($row));
 }
// Attempt search query execution
try{
    echo "server loaded";
    $input;
    $input_choice;
    $input_param;
    $execute_parameter;
    $return_value;
    if(isset($_REQUEST['Choice_date']))
    {
        $input='%'.$_REQUEST['Choice_date'].'%';
        $input_choice = 'Choice_date';
        $input_param = ':Choice_date';

        $return_value = the_lame_shit($pdo,$input,$input_choice,$input_param);
    
    }
    else{
        echo "the error is in the first part seem's like i can't even read the god damn input";
    }

 
        // echo "            connected with the server";
    
  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $the_query. " . $e->getMessage());
}



// Close statement
unset($stmt);
 
// Close connection
unset($pdo);
?>