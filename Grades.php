<?php 
    include "./hf/header.php";
    $userId=$_GET['userID'];
    $courseID=$_GET['courseID'];

?>
<div class="col-12 border" style="margin-top:110px; text-align:center; ">
    <h3 style="font-family: 'Calibri'; font-size:35px; font-weight: 600;color:darkgreen;">Final Grades</h3>
</div>
<div class="row border border-danger" style="padding:10px;">
        <?php
            if($_SESSION['percentage']>=100){
                $_SESSION['percentage'] = 100;
                $_SESSION['ILcompleted']="true";
        ?>
    <div class="col-3" style="height:70px; text-align:center;">
        <img src="./images/check-mark.png" alt="check mark">
        <!-- <span class="oi" data-glyph="check" title="check" aria-hidden="true"></span>  -->
    </div>
    <div class="col-8">
        <h3>Interactive Learning is completed</h3>
    </div>
    <?php } //End of if Statement
    else{ 
        $_SESSION['ILcompleted']="false";
        ?>
        <div class="col-3 border border-warning">
            <img src="./images/wrong.png" alt="check mark">
        </div>
        <div class="col-9 border border-success">
            <h3>Interactive Learning is not completed</h3>
        </div>
    <?php
    } //End of ELse staement
    
    $sql="Select chapter_id from Chapters where course_id=$courseID";
    $params = array(); 
    $query = sqlsrv_query( $conn, $sql); 
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
        $chapterID=$row['chapter_id']; 
    }

    $sql2="Select assign_id from PRASSIGN where chapter_id=$chapterID";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $query = sqlsrv_query( $conn, $sql2,$params,$options); 
    $_SESSION['total_asgs']=sqlsrv_num_rows($query);

    $sql5="Select assign_id from PRresponses where userID=$userId";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $query = sqlsrv_query( $conn, $sql5,$params,$options); 
    $_SESSION['solved_asgs']=sqlsrv_num_rows($query);

    if( $_SESSION['solved_asgs'] == $_SESSION['total_asgs'] ){ ?>
        <div class="row">
            <div class="col-3">
                <img src="./images/check-mark.png" alt="check mark">
            </div>
            <div class="col-9">
                <h3>Peer Review is completed</h3>
            </div>
        </div>
    <?php 
    }
    else{ ?>

        <div class="row" style="margin-top:20px;">
            <div class="col-3" style="height:70px; text-align:center;">
                <img src="./images/wrong.png" alt="wrong mark">
            </div>
            <div class="col-9">
                <h3>Peer Review is  not completed</h3>
            </div>
        </div>
    <?php 
    }

    $sql="Select * from PR_results where asgUserID=$userId";
    $params = array(); 
    $query = sqlsrv_query( $conn, $sql); 
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
        if(!isset($_SESSION['tObtainPRMarks'])){
            $_SESSION['tObtainPRMarks']=0;
        }else{

            $_SESSION['tObtainPRMarks']+=$row['marks'];
        }


    }

    $sql="Select * from GradedTest where user_id=$userId";
    $params = array(); 
    $query = sqlsrv_query( $conn, $sql); 
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
        if(!isset($_SESSION['tObtainGTMarks'])){
            $_SESSION['tObtainGTMarks']=0;
        }else{

            $_SESSION['tObtainGTMarks']+=$row['score'];
        }
    }


    $TOTAL_OBATAINED_MARKS = $_SESSION['tObtainGTMarks']+$_SESSION['tObtainPRMarks'];


    $Total_MARKS=100;
    
    $_SESSION['Total_Percentage'] = ($TOTAL_OBATAINED_MARKS/$Total_MARKS)*100 ;

    ?>
    <div class="row" style="margin-top:20px;">
        <div class="col-3" style="height:70px; text-align:center;">
            <img src="./images/test2.png" alt="RESULT mark">
        </div>
        <div class="col-9">
            <h3>TOTAL RESULT</h3>
        </div>
    </div>
    <?php
        $sql="Select * from users where user_id=$userId";
        $params = array(); 
        $query = sqlsrv_query( $conn, $sql); 
        while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
            $fname= $row['user_firstName'];
            $lname= $row['user_ lastName'];
        }

        $sql="Select * from Courses where course_id=$courseID";
        $params = array(); 
        $query = sqlsrv_query( $conn, $sql); 
        while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
            $Cname= $row['course_name'];
        }
        
        
        ?>

        <form action="certificate.php" method="POST">
            <input type="hidden" name="firstN" value="<?php echo $fname;?>" />
            <input type="hidden" name="lastN" value="<?php echo $lname;?>" />
            <input type="hidden" name="cname" value="<?php echo $Cname;?>" />
            <input type="hidden" name="ptage" value="<?php echo $_SESSION['Total_Percentage'];?>" />
        <?php
        if( $_SESSION['Total_Percentage'] >= 40){ ?>
            <button type="submit" class="btn btn-success" value="Submit" style="direction: rtl; font-family: 'Calibri'; width:100%; font-size:22px; margin-bottom:10px; ">Get your E-Certificate</button>
        </form>
        <?php 
        }else{ ?>
            <h3>Percentage Below 40% you are not Eligible for certificate</h3>
            <!-- <button type="submit" href="certificate.php" class="btn btn-success" value="Submit" style="direction: rtl; font-family: 'Calibri'; width:100%; font-size:22px; margin-bottom:10px; disabled">Get your E-Certificate</button> -->
        <?php
        }


    ?>




    
    
    
    
    
    
</div>