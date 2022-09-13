<?php 
//Including connection file
include './includes/Connection.php';
    // echo "<pre>";
    // print_r($_REQUEST);
    // die;
	//For first question, score will not be there.
if(!isset($_SESSION)){
    session_start();
}
    if(!isset($_SESSION['score'])){
        $_SESSION['score'] = 0;
	}
    if($_POST){
        $count=isset($_SESSION['message2']) ? $_SESSION['message2'] : 1;
        
        $count=$count+1;
        
        //We need to capture the question number from where form was submitted
        $Connumber = $_POST['conceptnumber'];
        $ConID = $_POST['conceptid'];
        $courseID = $_POST['courseid'];     
        $currentQuesno=$_POST['currentQuesno'];
        $section_id=$_POST['section_id'];
        $chapter_id=$_POST['chapter_id'];


        
        //case 1: if user has not selected any answer
        if(!isset($_POST['option1'])){
            $_SESSION['message']="Please select any value";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        
        $selected_choice = explode("xxx",$_POST['option1'])[1];

        /*
        * Check User Anwer against Question
        */
        $ans_query="select answer  from Questions where 
        concept_id=$ConID and ques_no=$currentQuesno";
        $ans_sql = sqlsrv_query($conn,$ans_query);
        $row=$row=sqlsrv_fetch_array( $ans_sql, SQLSRV_FETCH_ASSOC );
        $ansewer=$row['answer'];
    
        if($ansewer == $selected_choice ){
            // case 2: User given answer is after that
            // two more cases will be executed

            // counting Total Question against this concept_no
            $count_sql = "SELECT count(ques_no) as total from Questions WHERE  
            concept_id=$ConID";
            
            $params=array(); 
            $total_question_exe = sqlsrv_query($conn,$count_sql);
            $finalresult=array();
            $row=sqlsrv_fetch_array( $total_question_exe, SQLSRV_FETCH_ASSOC );
            $total_no_of_question=$row['total'];
            
            //Case 2.1 checking if there exist more question for 
            // this Concept or not

            if($currentQuesno<$total_no_of_question ){
                //case there are more question
                $currentQuesno+=1;
                $section_id="";
                        $chapter_id="";
                        echo $stmt="select cc.course_id, cc.course_name,cs.section_name,cs.section_id from Courses cc inner join
                        Sections cs  on cc.course_id=cs.course_id where cc.course_id=".$courseID;
                        // die;
                        $params = array(); 
                        $query = sqlsrv_query( $conn, $stmt,$params); 
                        //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                        while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                            //echo $row['course_name'];  
                            $section_id=$row['section_id']; }

                            $stmt2="select cc.course_id,cc.chapter_name,cc.chapter_id from Chapters cc inner join
                            Sections cs on cs.course_id=cc.course_id where cc.course_id=".$courseID;
                            $params2 = array(); 
                            $query2 = sqlsrv_query( $conn, $stmt2,$params2); 
                            //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                            while($row=sqlsrv_fetch_array( $query2, SQLSRV_FETCH_ASSOC )) {
                                // echo "<p class='text-style text-justify'>".$row['course_name']."</p>";
                                $chapter_id=$row['chapter_id']; }
                $_SESSION['message']="شاباش!! آۓ آگے بھرتے ہیں";
                header( "LOCATION: testil.php?n=".$Connumber."&c=".$courseID."&question_no=".$currentQuesno."&conid=".$ConID."&section_id=".$section_id."&chapter_id=".$chapter_id);
                
            }else{
                //last question 
                

                $Consql = "SELECT concept_id from Concepts where concept_id=(select min(concept_id) from Concepts where concept_id>$ConID)";
                $params=array(); 
            
                $coptions = sqlsrv_query($conn,$Consql);
                $crow=sqlsrv_fetch_array( $coptions, SQLSRV_FETCH_ASSOC );
                $next_concept=$crow['concept_id'];
                
                if(isset($next_concept)){
                    header( "LOCATION: Interactive_Learning.php?courseID=".$courseID."&concept_id=".$next_concept);
                    
                }else{
                    header( "LOCATION: courses-detail2.php");
                }
                
                
            }
            //$count=0;

        }else{
            /* case 3: user given answer is incorrect
            Return back to previous page with hint */

            // case 3.1 question first attemp wrong
            if(!isset($_SESSION['hint_count'])){
                //initlize session and increment 1 
                $_SESSION['hint_count']=1;

                // $count=isset($_SESSION['message2']) ? $_SESSION['message2'] : 1;
                $sql = "SELECT hint1 from Questions WHERE  concept_id=$ConID AND ques_no=$currentQuesno";
                $params=array(); 
                
                $options = sqlsrv_query($conn,$sql);
                $finalresult=array();
                $row=sqlsrv_fetch_array( $options, SQLSRV_FETCH_ASSOC );
                
                //$hc=2;
                $_SESSION['hint']=$row['hint1'];
                $_SESSION['message2'];
                // die;
                // header('Location: ' . $_SERVER['HTTP_REFERER']);
                header( "LOCATION: testil.php?n=".$Connumber."&c=".$courseID."&question_no=".$currentQuesno."&conid=".$ConID."&section_id=".$section_id."&chapter_id=".$chapter_id);

                die;
        
            
            }else if(isset($_SESSION['hint_count']) && $_SESSION['hint_count']+1==2  ){
                $_SESSION['hint_count']=$_SESSION['hint_count']+1;

                
                $sql = "SELECT hint1 from Questions WHERE  concept_id=$ConID AND ques_no=$currentQuesno";
                $params=array(); 
                
                $options = sqlsrv_query($conn,$sql);
                $finalresult=array();
                $row=sqlsrv_fetch_array( $options, SQLSRV_FETCH_ASSOC );
                
                //$hc=2;
                $_SESSION['hint']=$row['hint1'];
                $_SESSION['message2'];
                // die;
                // header('Location: ' . $_SERVER['HTTP_REFERER']);
                header( "LOCATION: testil.php?n=".$Connumber."&c=".$courseID."&question_no=".$currentQuesno."&conid=".$ConID."&section_id=".$section_id."&chapter_id=".$chapter_id);

                die;
        

            }else{
                unset($_SESSION['hint_count']);
                //send proces start here -------------------------------------------------------------------------
                // case 3.2: User given answer is after that
            // two more cases will be executed

            // counting Total Question against this concept_no
            $count_sql = "SELECT count(ques_no) as total from Questions WHERE  
            concept_id=$ConID";
            
            $params=array(); 
            $total_question_exe = sqlsrv_query($conn,$count_sql);
            $finalresult=array();
            $row=sqlsrv_fetch_array( $total_question_exe, SQLSRV_FETCH_ASSOC );
            $total_no_of_question=$row['total'];
            
            //Case 3.2.1 checking if there exist more question for 
            // this Concept or not
            if($currentQuesno<$total_no_of_question ){
                //case there are more question
                $currentQuesno+=1;
                $section_id="";
                        $chapter_id="";
                        $stmt="select cc.course_id, cc.course_name,cs.section_name,cs.section_id from Courses cc inner join
                        Sections cs  on cc.course_id=cs.course_id where cc.course_id=".$courseID;
                        $params = array(); 
                        $query = sqlsrv_query( $conn, $stmt,$params); 
                        //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                        while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                            //echo $row['course_name'];  
                            $section_id=$row['section_id']; }

                            $stmt2="select cc.course_id,cc.chapter_name,cc.chapter_id from Chapters cc inner join
                            Sections cs on cs.course_id=cc.course_id where cc.course_id=".$courseID;
                            $params2 = array(); 
                            $query2 = sqlsrv_query( $conn, $stmt2,$params2); 
                            //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                            while($row=sqlsrv_fetch_array( $query2, SQLSRV_FETCH_ASSOC )) {
                                // echo "<p class='text-style text-justify'>".$row['course_name']."</p>";
                                $chapter_id=$row['chapter_id']; }
                $_SESSION['message2']="مزید پڑھنے کی ضرورت ہے۔";
                header( "LOCATION: testil.php?n=".$Connumber."&c=".$courseID."&question_no=".$currentQuesno."&conid=".$ConID."&section_id=".$section_id."&chapter_id=".$chapter_id);
                
            }else{
                //last question 
                

                $Consql = "SELECT concept_id from Concepts where concept_id=(select min(concept_id) from Concepts where concept_id>$ConID)";
                $params=array(); 
            
                $coptions = sqlsrv_query($conn,$Consql);
                $crow=sqlsrv_fetch_array( $coptions, SQLSRV_FETCH_ASSOC );
                $next_concept=$crow['concept_id'];
                
                if(isset($next_concept)){
                    header( "LOCATION: Interactive_Learning.php?courseID=".$courseID."&concept_id=".$next_concept);
                    
                }else{
                    header( "LOCATION: courses-detail2.php");
                }
                
                
            }

                //ending here   ----------------------------------------------------------------------------------             


            } 
       
        }
    }
        
?>
<script src="./js/function.js"></script>
<!-- ."&co ". $correct_option -->