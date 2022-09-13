<?php 
    //including header
    include "header.php";
    //include sidebar panel
    //include "panel-head-option.php";
if(!isset($_SESSION))
    session_start();

?>
<script src="./js/function.js"></script>

<div class="contest">
<?php
        if(isset($_SESSION['message'])){
    ?>
        <div class="alert alert-info text-center" role="alert">
            <?php print_r( $_SESSION['message']);?>
    </div>
    <?php
        unset($_SESSION['message']);
        }
    ?>
    <div class="border  mx-auto text-center">
        <h3>
            Test of Concept
            <?php
                $conceptid = $_GET['conid'];
                $courseid= $_GET['c'];
                $conceptnumber = $_GET['n'];
            ?>
        </h3>
    </div>
    <div class="row w-25 border-bottom border-success mx-auto"></div>
    
    <div class="question row flex-row  border border-success mt-3 ml-3 mr-3">
        <h4>
            Question: 
            <?php    
                //Fetching question # of which you are on
                $questionNo;
                if(isset($_GET['question_no']))
                    $questionNo=$_GET['question_no'];
                else
                    $questionNo=1;
                $stmt = "Select qq.ques_no from Concepts C inner join Questions qq on C.concept_id=qq.concept_id where C.concept_no=".$conceptnumber."AND qq.ques_no=".$questionNo;
                $params = array(); 
                $query = sqlsrv_query( $conn, $stmt); 
                while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                    echo $row['ques_no'];
                }
            ?>
        of
            <?php
            //Fetching total question number of ongoing concept
            $stmt = "SELECT ques_no FROM Questions WHERE concept_id=$conceptid";
            $params = array(); 
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $query = sqlsrv_query( $conn, $stmt,$params,$options); 
            $total_ques=sqlsrv_num_rows($query);
                
            if($total_ques ===false){
                echo "there is error in getting the total question number from db";
            }else{
                echo "$total_ques";
            }
            ?>
        </h4>
    </div>

    <div class="questioneir row flex-row  border border-success ml-3 mr-3 text-right">
    
    <?php
    
    //FETCHING QUESTION statement of which Question # & Concept # you are On 
        $stmt ="Select qq.ques_statement from Concepts C inner join Questions qq on C.concept_id=qq.concept_id where C.concept_no=".$conceptnumber."AND qq.ques_no=".$questionNo;
        $params = array(); 
        $query = sqlsrv_query( $conn, $stmt); 
        while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
            echo "<h2 class='text-dark m-1'>".$row['ques_statement']."</h2><br>";
        }
    ?>
    
    <?php
        if(isset($_SESSION['hint'])){
    ?>
        <div class="alert alert-warning" role="alert">
            <?php print_r( $_SESSION['hint']);?>
    </div>
    <?php
        unset($_SESSION['hint']);
        }
    ?>
    <form action="process.php" method="POST">
    <div class="row ">
    
    <?php 
        //FETCHING Option-1 from DB
        $sql = "Select qq.option1,qq.option2,qq.option3,qq.option4 from Concepts C inner join Questions qq on C.concept_id=qq.concept_id where C.concept_no=".$conceptnumber."AND qq.ques_no=".$questionNo;
        $params=array(); 
        $options = sqlsrv_query($conn,$sql);
        while($row=sqlsrv_fetch_array( $options, SQLSRV_FETCH_ASSOC )){
    ?>
    <div class="row w-100">
        <div class="col-2">
            <input type="radio" id="option1" name="option1" value="<?php echo $row['option1']."xxx1" ?>" />
        </div>
        <div class="col-10">
            <?php echo $row['option1'];?>
        </div>
    </div>
    
    <div class="row w-100">
        <div class="col-2">
            <input type="radio" id="option1" name="option1" value="<?php echo $row['option2']."xxx2" ?>" />
        </div>
        <div class="col-10">
            <?php echo $row['option2'];?>
        </div>
    </div>
    <div class="row w-100">
        <div class="col-2">
            <input type="radio" id="option1" name="option1" value="<?php echo $row['option3']."xxx3" ?>" />
        </div>
        <div class="col-10">
            <?php echo $row['option3'];?>
        </div>
    </div>
    <div class="row w-100">
        <div class="col-2">
            <input type="radio" id="option1" name="option1" value="<?php echo $row['option4']."xxx4" ?>" />
        </div>
        <div class="col-10">
            <?php echo $row['option4'];}?>
        </div>
    </div>

    </div>
    <!-- sending Values and submitting form -->
    <input type="hidden" name="conceptnumber" value="<?php echo $conceptnumber ?>" />
    <input type="hidden" name="conceptid" value="<?php echo $conceptid ?>" />
    <input type="hidden" name="courseid" value="<?php echo $courseid ?>" />      
    <input type="hidden" name="currentQuesno" value="<?php echo $questionNo?>" />      
    <input type="submit" name="submit" value="Submit" />    

    <!-- <button type="button" class="btn btn-success" value="submit" >Submit</button> -->
    <!-- <input type="submit" value="Submit" onclick=""/> -->

    </form>

    </div>
    
</div> 