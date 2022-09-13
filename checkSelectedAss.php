<?php 
    include "./hf/header.php"; 
    $userID=$_GET['userID'];
    $AsgID=$_GET['asgID'];


    if(!isset($_SESSION['ChkcountPR'])){
        $_SESSION['ChkcountPR']=0;
    }else{
        $_SESSION['ChkcountPR']++;
    }


    

    $sql="select * from PRresponses where userID=$userID";
    $params = array();
    $query = sqlsrv_query( $conn, $sql); 
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
        $ans= $row['answer'];
    }
     
?>
<div class="container-fluid border border-danger" style="margin-top:120px;">
    <div class="row">
        <?php 
            $sql="select * from PR_questions where assign_id=$AsgID";
            $params = array();
            $query = sqlsrv_query( $conn, $sql); 
            while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                $questID=$row['quest_id'];
        ?>
        
        <div class="col-4 border mt-3" style="font-family:Calibri; background-color:#e6f8e68e; font-size:25px;">
            <h2 style="font-size:20px; color:red; text-align: center;">User Answer</h2>
            <div class="row w-25 border-bottom border-warning mx-auto" ></div>  
            <h2 style="font-size:22px;">Question #:<?php echo $row['prques_no']; echo " ",$row['prques_statement'];?><br>A) <?php echo " ",$row['prActivity1']; ?>
                <br>B) <?php echo " ",$row['prActivity2']; ?>
                <br>C) <?php echo " ",$row['prActivity3']; }?>
            </h2>
            <h3>Answer: <?php echo $ans; ?></h3>
        </div>
        
        <div class="col-3 border mt-3" style="">
            <h2 style="font-size:20px; color:red; text-align: center;">Rubric</h2>
            <div class="row w-25 border-bottom border-warning mx-auto" ></div>
            <?php
                $sql="select * from PR_rubric where quest_id=$questID";
                $params = array();
                $query = sqlsrv_query( $conn, $sql); 
                while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                    $maxp=$row['ques_maxp']; $avgp=$row['ques_avgp']; $minp=$row['ques_minp'];
            ?>
            <h3>Correct Answer is: <br><br><?php     echo $row['answer'];  ?></h3>
            <h3>Question Max. Points are: <?php     echo $row['ques_maxp'];  ?></h3>
            <h3>Question Avg. Points are: <?php     echo $row['ques_avgp'];  ?></h3>
            <h3>Question Min. Points are: <?php     echo $row['ques_minp'];  }?></h3>

        </div><br>
        
        <div class="col-5 border mt-3" style="">
            <h2 style="font-size:20px; color:red; text-align: center;">Marks</h2>
            <div class="row w-25 border-bottom border-warning mx-auto" ></div>            
            <div class="row">
                <div class="col-1">
                    <form method="POST" action="SavecheckedAsg.php">
                        <input type="radio" id="option1" name="option1" value="25" />
                </div>
                <div class="col-10">
                    <p><?php echo $maxp;?> If All The Activities are Done</p>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <input type="radio" id="option2" name="option2" value="25" />
                </div>
                <div class="col-10">
                    
                    <p><?php echo $avgp;?> If 2 Activities are Done</p>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <input type="radio" id="option3" name="option3" value="25" />
                </div>
                <div class="col-10">
                    <p><?php echo $minp;?> If 1 or 0 Activities are Done</p>
                </div>
            </div>


        </div>
    </div>
    <?php $lgnUID=$_SESSION['userID'];  ?>
    
    <input type="hidden" name="AsgID" value="<?php echo $AsgID;  ?>"/>
    <input type="hidden" name="chkeruserID" value="<?php echo $lgnUID;  ?>"/>
    <input type="hidden" name="AsguserID" value="<?php echo $userID;  ?>"/>
    
    <input type="hidden" name="questID" value="<?php echo $questID;  ?>"/>
    
    <button type="submit" class="btn btn-success" value="Submit" style="direction: rtl; font-family: 'Calibri'; width:100%; font-size:18px; margin-top:20px; margin-bottom:10px; ">Submit Results</button>   
                </form>
</div>