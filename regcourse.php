
<?php require('./hf/header.php'); //Muallim's Main Header ?>
<?php require('./panel-header.php'); //Muallim's Panel Header ?>
<script src="./js/function.js"></script>
<?php

if(isset($_GET['courseID']))
{
    $courseID = $_GET['courseID'];
    $userID = $_SESSION['userID']; 

    $userName = $_SESSION['userName'];
    $courseName = getCourseName($courseID);
    $notiTitle = $userName ." Send New Course :".$courseName." Registration Request";
    $notiFor = "A";
    $notiForID = getAdminID();
    $notiStatus = '0';



    
    if(checkRegistrationNoExist($courseID,$userID)==0)
    {

        $date = date('Y-m-d');
        $status='Pending';

     $query= "INSERT INTO RegistrationCourse(reg_userid,reg_course,reg_date,reg_status)VALUES('$userID','$courseID','$date','$status')";

              $result =sqlsrv_query($conn,$query);

            if($result){
               echo $sqlID = "SELECT @@IDENTITY AS reg_id";
               
                $params = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt = sqlsrv_query( $conn, $sqlID , $params, $options );
                $result =sqlsrv_query($conn,$sqlID);
                $row = sqlsrv_fetch_array( $stmt);
                $notiTypeID = $row['reg_id'];
                
            $notiType = "CR";
                $_SESSION['successMsg'] = "Registered Successfully";
                
                $q="INSERT INTO  Notification(  noti_title,
                                                noti_for,
                                                noti_for_id,
                                                noti_type,
                                                noti_type_id
                                                ,noti_status)VALUES('$notiTitle',
                                                                    '$notiFor',
                                                                    '$notiForID',
                                                                    '$notiType',
                                                                    '$notiTypeID',
                                                                    '$notiStatus')";
              $r =sqlsrv_query($conn,$q);

                header("location:showlearnercourses.php");
                exit();
        
            }

    }   
            else
            {
                    
            }
        }
            ?>    
            
