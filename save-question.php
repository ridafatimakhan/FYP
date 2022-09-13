<?php
include "./includes/Connection.php";
if(!isset($_SESSION))
    session_start();


if(isset($_POST['save_multiple_data']))
{
    $sectionID=$_GET['sectionID'];
    $courseID=$_GET['courseID'];
    $chapter_id =$_GET['chapter_id'];
    $concept_id  =$_GET['concept_id'];
    
    if(empty($_POST['Ques_no'])){ 
        array_push($_SESSION['errors'],'Ques No is Required');
        }else{
        $Ques_no = $_POST['Ques_no'];
        $_SESSION['Ques_no'] = $Ques_no;
    }
    if(empty($_POST['Ques_statement'])){ 
        array_push($_SESSION['errors'],'Ques Statement is Required');
        }else{
        $Ques_statement = $_POST['Ques_statement'];
        $_SESSION['Ques_statement'] = $Ques_statement;
    }
    

    if(empty($_POST['answer'])){ 
        array_push($_SESSION['errors'],'Correct answer is Required');
    }else{
        $answer = $_POST['answer'];
        $_SESSION['answer'] = $answer;
    }
    if(empty($_POST['Ques_weightage'])){ 
        array_push($_SESSION['errors'],'Ques Weightage is Required');
    }else{
        $Ques_weightage = $_POST['Ques_weightage'];
        $_SESSION['Ques_weightage'] = $Ques_weightage;
    }

    foreach($Ques_statement as $index => $value)
   {
   /*      $Ques_statement= $names;
        $Ques_weightag = $Ques_weightag[$index];
        // $s_otherfiled = $empid[$index]; */
    
        $query = "INSERT INTO Questions (section_id,course_id,chapter_id,concept_id,ques_no,ques_statement,option1,option2,option3,option4,hint1,answer,Ques_weightage) VALUES ('$sectionID','$courseID'
        ,'$chapter_id','$concept_id','{$Ques_no[$index]}','{$Ques_statement[$index]}','".$_REQUEST['choice'][0]."'
        ,'".$_REQUEST['choice'][1]."','".$_REQUEST['choice'][2]."','".$_REQUEST['choice'][3]."','".$_REQUEST['hint']."',
        '{$answer[$index]}','{$Ques_weightage[$index]}')";
    

    if(count($_SESSION['errors']) == 0){

    
        $result =sqlsrv_query($conn,$query);
					
			if($result){

                $sqlID = "SELECT @@IDENTITY AS question_id";
				$params = array();
				$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				$stmt = sqlsrv_query( $conn, $sqlID , $params, $options );
				$result =sqlsrv_query($conn,$sqlID);
			//	$row = sqlsrv_fetch_array( $stmt); $query_run = sqlsrv_query($conn, $query);


            }
        }
    }//End of For each loop

    if($query)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location:Add-Questions.php?courseID=". $courseID. "&sectionID=".$sectionID."&chapter_id=".$chapter_id."&concept_id=".$concept_id);
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location:Add-Questions.php?courseID=". $courseID. "&sectionID=".$sectionID."&chapter_id=".$chapter_id."&concept_id=".$concept_id);
        exit(0);
    }
}//End of if statement 

