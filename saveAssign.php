<?php 
    $assignID="";
    $questID="";
<<<<<<< HEAD
=======

>>>>>>> d32b9a08db94467bd58a3d272cbc879457b513b5
    include "includes/Connection.php";
    if(!isset($_SESSION)){
        session_start();
    }
        

    if(isset($_POST['save_multiple_data']))
    {
        $courseID  =$_POST['courseID'];
        $chapterID =$_POST['chapterID'];
        $sectionID =$_POST['sectionID'];
        
        $Assign_tittle = $_POST['assignt'];
        $_SESSION['assignt'] = $Assign_tittle;

        $Assign_marks = $_POST['assignm'];
        $_SESSION['assignm'] = $Assign_marks;

        $Assign_deadline = $_POST['assignd'];
        $_SESSION['assignd'] = $Assign_deadline;

        $query="SELECT assign_id from PRASSIGN where chapter_id=$chapterID";

        $params = array();
        //$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $query , $params );
       
        while( $row=sqlsrv_fetch_array($stmt)){
            $assignID=$row['assign_id'];
        }
        // echo $assignID;
        // die;

        $sqL = "INSERT INTO PRASSIGN(course_id
                                    ,section_id
                                    ,chapter_id
                                    ,assign_tittle
                                    ,assign_marks
                                    ,deadline)VALUES ('$courseID','$sectionID','$chapterID','$Assign_tittle','$Assign_marks','$Assign_deadline' ) ";
        
        $result =sqlsrv_query($conn,$sqL);



        $total_question=$_REQUEST['total_questions']+1;
        // print_r($_REQUEST);
        for($i=0; $i<$total_question; $i++){

            $sql_Ques=" INSERT INTO  PR_questions(assign_id
                                ,prques_no
                                ,prques_statement
                                ,prActivity1
                                ,prActivity1m
                                ,prActivity2
                                ,prActivity2m
                                ,prActivity3
                                ,prActivity3m)
                                VALUES( '$assignID', '{$_REQUEST['questionNO_'.$i][0]}', '{$_REQUEST['questionState_'.$i][0]}',
                                '{$_REQUEST['Activity1_'.$i][0]}', '{$_REQUEST['Activity1m_'.$i][0]}', '{$_REQUEST['Activity2_'.$i][0]}',
                                '{$_REQUEST['Activity2m_'.$i][0]}', '{$_REQUEST['Activity3_'.$i][0]}','{$_REQUEST['Activity3m_'.$i][0]}' )";
            
            $result2 =sqlsrv_query($conn,$sql_Ques);

            
            $query = "SELECT quest_id FROM PR_questions where assign_id=$assignID";
            $params = array();
            //$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_query( $conn, $query , $params );
            while( $row=sqlsrv_fetch_array($stmt)){
                $questID=$row['quest_id'];
            }//End of While loopies 

            $sql_rubric="INSERT INTO PR_rubric(quest_id
                                            ,prques_no
                                            ,answer
                                            ,ques_maxp
                                            ,ques_avgp
                                            ,ques_minp)
                                        VALUES('$questID','{$_REQUEST['RQues_no_'.$i][0]}',
                                        '{$_REQUEST['RAnswer_'.$i][0]}', '{$_REQUEST['RQues_max_p_'.$i][0]}',
                                        '{$_REQUEST['RQues_avg_p_'.$i][0]}', '{$_REQUEST['RQues_min_p_'.$i][0]}' ) " ;
            
            $result2 =sqlsrv_query($conn,$sql_rubric);


        }//End of For Loop

        if($sqL && $sql_Ques && $sql_rubric)
        {
            $_SESSION['Qstatus'] = "Multiple Data Inserted Successfully";
            header("Location:Add-Assignment.php?courseID=". $courseID. "&sectionID=".$sectionID."&chapter_id=".$chapter_id);
            exit(0);
        }
        else
        {
            $_SESSION['Qstatus'] = "Data Not Inserted";
            header("Location:Add-Questions.php?courseID=". $courseID. "&sectionID=".$sectionID."&chapter_id=".$chapter_id);
            exit(0);
        }
        // if($sql_Ques){
        //     echo "done ques Successfully";
        // }else{
        //     echo "2 Failed";
        // }
        // if($sql_rubric){
        //     echo "done Rubric Successfully";
        // }else{
        //     echo "2 Failed";
        // }







    }
?>