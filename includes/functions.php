<?php
function checkCourseCode($course_code,$course_id=""){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM Courses WHERE course_code = '$course_code' AND course_id != '$course_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}
function checkCourseoffer($offercourse,$ocid=""){
    global $conn;
    
    $sql = "SELECT COUNT(*) AS tot FROM OfferCourse WHERE offercourse = '$offercourse' AND ocid != '$ocid'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}
function CheckCourseExist($course_id){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM Sections WHERE course_id='$course_id";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $result =sqlsrv_query($conn,$sql);

    $row_count = sqlsrv_num_rows( $stmt );
    if($row_count == 0){
       
    $sql = "DELETE FROM Courses WHERE course_id = '$course_id'";

    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $result =sqlsrv_query($conn,$sql);

    $row = sqlsrv_num_rows($stmt);
}
else{
    echo "Delete Sections first";
}}
function getCourseName($course_id){
    global $conn;
    $sql = "SELECT course_name FROM Courses WHERE course_id = '$course_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['course_name'];
    }
}

function getuserNameresult($userid){
    global $conn;
    $sql = "SELECT user_name FROM users WHERE user_id = '$userid'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['user_name'];
    }
}
function getCourseNamer($courseid){
    global $conn;
    $sql = "SELECT course_name FROM Courses WHERE course_id = '$courseid'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['course_name'];
    }
}
function checkCourseName($course_name,$course_id=""){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM Courses WHERE course_name = '$course_name' AND course_id != '$course_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}


function getSectionName($section_id){
    global $conn;
    if($section_id == '0'){
        return "NO PREREQUISITE";
    }else{
        $sql = "SELECT section_name FROM Sections WHERE section_id = '$section_id'";
        $result =sqlsrv_query($conn,$sql);
        if ( $row = sqlsrv_fetch_array( $result) ){
            return $row['section_name'];
        }
    }
}
function checkSectionNoExist($section_no,$section_id=""){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM Sections WHERE section_id != '$section_id' AND section_no = '$section_no'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}
function checkConceptNoExist($concept_no,$concept_id=""){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM Concepts WHERE concept_id != '$concept_id' AND concept_no = '$concept_no'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}
function checkChapterNoExist($chapter_no,$chapter_id=""){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM Chapters chapter_id != '$chapter_id' AND chapter_no = '$chapter_no'";
    $result =sqlsrv_query($conn,$sql);
    if ($row = sqlsrv_fetch_array($result) ){
        return $row['tot'];
    }
}
function checkUserNameExist($userName,$user_id=""){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM users WHERE user_name = '$userName' AND user_id != '$user_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}

function getUserName($user_id){
    global $conn;
    $sql = "SELECT user_firstName,user_lastName FROM users WHERE user_id = '$user_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['user_firstName'].' '.$row['user_lastName'];
    }
}

function getUseremail($user_id){
    global $conn;
    $sql = "SELECT user_email FROM users WHERE  user_id = '$user_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['user_email'];
    }
}



function checkEmailExist($userEmail,$user_id=""){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM users WHERE user_email = '$userEmail' AND user_id != '$user_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}

function checkCnicNoExist($userCNIC,$user_id=""){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM users WHERE cnicNo = '$userCNIC' AND user_id != '$user_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}


function getAdminID(){
    global $conn;
    $sql = "SELECT user_id FROM users WHERE user_role ='A' AND user_status = 'A' ORDER BY user_id DESC";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['user_id'];
    }
}

function checkLogin(){
    if(isset($_SESSION['userID']) && $_SESSION['userID'] != "" && isset($_SESSION['userName']) && $_SESSION['userName'] != "" && isset($_SESSION['userRole']) && $_SESSION['userRole'] != "" && isset($_SESSION['userFullName']) && $_SESSION['userFullName'] !=""){
        return true;       
    }else{
        return false;
    }
}

function getGenderTitle($gender)
{
    if($gender=='M'){
        echo "Male";

    }
    else{
        echo "Female";
    }
}
function getUserTypeTitle(){
    if(checkLogin() == true){
        if($_SESSION['userRole'] == "A"){
            return "Admin";
        }else if($_SESSION['userRole'] == "L"){
            return "Learner";
        }/* else if($_SESSION['userRole'] == "R"){
            return "Resource Person";
        } */else{
            return "N/A";
        }
    }   
}

function ml_current_url(){
	return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}


function checkoldpassword($currentpassword){
    global $conn;
    $user_id=$_SESSION['userID'];

    $sql = "SELECT * FROM users WHERE user_password = HASHBYTES('SHA1','$currentpassword') AND user_id = '$user_id' ";

    $result =sqlsrv_query($conn,$sql);


    if($result){
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );

		$row_count = sqlsrv_num_rows( $stmt );
        if($row_count == 1)
        {
            return true;
        }
        else{
            return false;
        }

    }
}

function checkRegistrationNoExist($course_id,$user_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM RegistrationCourse WHERE reg_course= '$course_id' AND reg_userid= '$user_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}

function checkCourseRegExist($regCourseID,$user_id){
    global $conn;
   

   $sql = "SELECT * FROM RegistrationCourse WHERE reg_course = '$regCourseID' AND reg_userid='$user_id'";
						$params = array();
						$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
						$stmt = sqlsrv_query( $conn, $sql , $params, $options );

						$row_count = sqlsrv_num_rows( $stmt );
    if($row_count>0){
        if ( $row = sqlsrv_fetch_array( $stmt) ){
            if($row['reg_status'] == "Pending"){
                return "P";
            }else if($row['reg_status'] == "approved"){
                return "A";
            }else if($row['reg_status'] == "reject"){
                return false;
            }
        }
    }else{
        return false;
    }
}

//Learners Progress Monitoring


function getTotLearners($user_status=""){
    global $conn;

    if($user_status!="")
{
    $sql = "SELECT * FROM users WHERE user_status = '$user_status' ";
}
else{
    $sql = "SELECT * FROM users";
}

    $result =sqlsrv_query($conn,$sql);

    if($result){
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );

		$row_count = sqlsrv_num_rows( $stmt );
       return $row_count;
    }
}

//Learners Course Progress Monitoring

function getTotCourse(){
    global $conn;
    $totRegLearnerInCourse = array();

    $sql = "SELECT * FROM Courses";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );

    $row_count = sqlsrv_num_rows( $stmt );
    
    if($row_count>0){
        $keyValue = "";
        $flag = 1;
        while ( $row = sqlsrv_fetch_array( $stmt) ){
            $courseName = $row['course_name'];
            $courseID = $row['course_id'];

            $sql1 = "SELECT * FROM RegistrationCourse WHERE reg_course = '$courseID'";
            $params1 = array();
            $options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt1 = sqlsrv_query( $conn, $sql1 , $params1, $options1 );

            $row_count = sqlsrv_num_rows( $stmt1 );
            // if($row_count<=$flag){
            //     $keyValue .=  '"'.$courseName.'"=>"'.$row_count.'",';
            // }else{
            //     $keyValue .=  '"'.$courseName.'"=>"'.$row_count.'"';
            // }

            $totRegLearnerInCourse[$courseName] = $row_count; 

            

            //$flag++;
            
           // array_push($totRegLearnerInCourse,$keyValue);

        }
    }
   // array_push($totRegLearnerInCourse,$keyValue);

    return $totRegLearnerInCourse;

    }




//interactive learning progress
function getclearedconceptcont($user_id,$course_id,$section_id,$chapter_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM ilsessions WHERE user_id = '$user_id' AND course_id = '$course_id' AND section_id = '$section_id' AND chapter_id = '$chapter_id'";
    
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}


function totalconceptcont($course_id,$section_id,$chapter_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM Concepts WHERE course_id = '$course_id' AND section_id = '$section_id' AND chapter_id = '$chapter_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}

//progress admin side
function gettotcourseconcepts($course_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM Concepts  WHERE course_id = '$course_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}

function getclearedconcepts($course_id,$user_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM ilsessions WHERE course_id = '$course_id' AND user_id = '$user_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}


function checkConceptAttempt($courseID,$sectionID,$chapter_id,$conceptID,$user_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM ilsessions 
    WHERE course_id = '$courseID' 
        AND user_id = '$user_id' 
        AND section_id = '$sectionID'
        AND chapter_id = '$chapter_id'
        AND concept_id = '$conceptID'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}




function getGradedTest($courseID,$userid,$sectionID,$chapter_id){
    global $conn;


    $sql = "SELECT score ,total_marks from GradedTest where course_id='$courseID' AND user_id='$userid' AND section_id='$sectionID ' AND chapter_id='$chapter_id'";

    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        $percentage=0;
        $total_marks =  $row['total_marks'];
        $score =  $row['score'];

         $percentage = ($score/$total_marks)*100;

      
        return $percentage;

    }
}
    //Monitoring Of GradedTest
//////


function checkGradedAttempt($courseID,$sectionID,$chapter_id,$user_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM GradedTest 
    WHERE course_id = '$courseID' 
        AND user_id = '$user_id' 
        AND section_id = '$sectionID'
        AND chapter_id = '$chapter_id'";
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}    
    
function checkChapterReadStatus($chapter_id,$user_id){
    global $conn;
    $sql = "SELECT COUNT(*) AS tot FROM chapterreadstatus
    WHERE chapter_id = '$chapter_id' 
        AND user_id = '$user_id' "
      ;
    $result =sqlsrv_query($conn,$sql);
    if ( $row = sqlsrv_fetch_array( $result) ){
        return $row['tot'];
    }
}    
?>
