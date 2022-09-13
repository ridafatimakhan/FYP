<?php 

include "./hf/header.php";

    if(!isset($_SESSION))
        session_start();



?>
<script src="./js/function.js"></script>

<div class="contest">
    <div class="  mx-auto text-center">
            <?php

                if(isset($_GET['conid'])){
                    
                    $courseid= $_GET['c'];
                    $sectionid=$_GET['section_id'];
                    $chapterid=$_GET['chapter_id'];
                    $conceptid = $_GET['conid'];
                    $conceptnumber = $_GET['n'];
                    // $checker = $_POST['checker'];
                    $user_id = $_SESSION['userID'];
                }else{
                    //print_r($_REQUEST);
                    
                   //print_r($_POST);
                    $courseid= $_POST['c'];
                    $sectionid=$_POST['sectionid'];
                    $chapterid=$_POST['chapterid'];
                    $conceptid = $_POST['conid'];
                    $conceptnumber = $_POST['n'];
                    $checker = $_POST['checker'];
                    $createdDate=date('Y-m-d');
                    if($checker=='on'){
                        $user_id = $_SESSION['userID'];
                        

                        $sql = " INSERT 
                                    INTO ilsessions
                                    ( user_id, 
                                    course_id,
                                    section_id,
                                    chapter_id,
                                    concept_id,
                                    completion_status,defined_dated)
                                    VALUES('".$user_id."','".$courseid."','".$sectionid."','".$chapterid."','".$conceptid."','done','$createdDate')";
                        $options = sqlsrv_query($conn , $sql);
                        
                    }else{?>
                        <br><br><?php echo "ERROR!!!!!";?><br><br>
                       <?php echo"MARK THE CHECKBOX PLEASE..!!!";
                        exit();
                        die;
                    }

                                
                }

            ?>
        <h3>
            <?php
                $stmt="select cc.course_id,cc.chapter_name from Chapters cc inner join
                Sections cs on cs.course_id=cc.course_id where cc.course_id=".$courseid;
                $params = array(); 
                $query = sqlsrv_query( $conn, $stmt,$params); 
                //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                    // echo "<p class='text-style text-justify'>".$row['course_name']."</p>";
            ?>
            Test of Chapter   <?php echo $row['chapter_name']; } ?> 
        </h3>
    </div>
    <div class="row w-25 border-bottom border-warning mx-auto"></div>
    
    <div class="question row flex-row  border border-success mt-3 ml-3 mr-3">
        <h4 style="direction:rtl; margin-top:10px; text-align:right;">
            سوال نمبر： 
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
            تا
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

    <div class="questioneir row flex-row  border border-success ml-3 mr-3 text-right" style="direction:rtl;">
    
        <?php
        
            //FETCHING QUESTION statement of which Question # & Concept # you are On 
            $stmt ="Select qq.ques_statement from Concepts C inner join Questions qq on C.concept_id=qq.concept_id where C.concept_no=".$conceptnumber."AND qq.ques_no=".$questionNo;
            $params = array(); 
            $query = sqlsrv_query( $conn, $stmt); 
            while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                echo "<h2 class='text-dark m-3' style='font-family:'Calibri'; font-size:35px;'>".$row['ques_statement']."</h2><br>";
            }
        ?>
        <?php
            if(isset($_SESSION['message'])){
        ?>
        <div class="alert alert-success" role="alert">
            <?php print_r( $_SESSION['message']);?>
        </div>
        <?php
            unset($_SESSION['message']);
            }
        ?>
        <?php
            if(isset($_SESSION['message2'])){
        ?>
        <div class="alert alert-danger" role="alert">
            <?php print_r( $_SESSION['message2']);?>
        </div>
        <?php
            unset($_SESSION['message2']);
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
        <form action="processil.php" method="POST" ;>
            <div class="row" style="direction:rtl; padding:20px; line-height:50px; font-family:Jameel Noori Nastaleeq;">
                <?php 
                    //FETCHING Option-1 from DB
                    $sql = "Select qq.option1,qq.option2,qq.option3,qq.option4 from Concepts C inner join Questions qq on C.concept_id=qq.concept_id where C.concept_no=".$conceptnumber."AND qq.ques_no=".$questionNo;
                    $params=array(); 
                    $options = sqlsrv_query($conn,$sql);
                    $result=[];
                    while($row=sqlsrv_fetch_array( $options, SQLSRV_FETCH_ASSOC )){
                        // die;    
                ?>
                <div class="row w-100" style="font-family:Calibri;">
                    <div class="col-1 opt1">
                        <input type="radio" id="option1" name="option1" value="<?php echo $row['option1']."xxx1" ?>" />
                    </div>
                    <div class="col-10  d-flex justify-conent-end">
                        <?php echo $row['option1'];?>
                    </div>
                </div>             
                <div class="row w-100" style="font-family:Calibri;">
                    <div class="col-1 opt1">
                        <input type="radio" id="option1" name="option1" value="<?php echo $row['option2']."xxx2" ?>" />
                    </div>
                    <div class="col-8  d-flex justify-conent-end" >
                        <?php echo $row['option2'];?>
                    </div>
                </div>
                <div class="row w-100" style="font-family:Calibri;">
                    <div class="col-1 opt1">
                        <input type="radio" id="option1" name="option1" value="<?php echo $row['option3']."xxx3" ?>" />
                    </div>
                    <div class="col-10  d-flex justify-conent-end">
                        <?php echo $row['option3'];?>
                    </div>
                </div>
                <div class="row w-100" style="font-family:Calibri;">
                    <div class="col-1 opt1">
                        <input type="radio" id="option1" name="option1" value="<?php echo $row['option4']."xxx4" ?>" />
                    </div>
                    <div class="col-10 d-flex justify-conent-end" >
                        <?php echo $row['option4'];}?>
                    </div>
                </div>

            </div>
            <!-- sending Values and submitting form -->
            <input type="hidden" name="conceptnumber" value="<?php echo $conceptnumber ?>" />
            <input type="hidden" name="conceptid" value="<?php echo $conceptid ?>" />
            <input type="hidden" name="courseid" value="<?php echo $courseid ?>" />      
            <input type="hidden" name="section_id" value="<?php echo $sectionid ?>" />      
            <input type="hidden" name="chapter_id" value="<?php echo $chapterid ?>" />      

            <input type="hidden" name="currentQuesno" value="<?php echo $questionNo?>" />      
            <!-- <input type="submit" name="submit" value="Submit" style="padding-top:10px;"/>  -->
            <button type="submit" class="btn btn-success" value="Submit" style="direction: rtl; font-family: 'Calibri'; width:100%; font-size:22px; margin-bottom:10px; ">Submit</button>   

            <!-- <button type="button" class="btn btn-success" value="submit" >Submit</button> -->
            <!-- <input type="submit" value="Submit" onclick=""/> -->

        </form>

        <?php
     //       $user_id = $_SESSION['userID'];
       //     $completedconcept= getclearedconceptcont($user_id,$courseid,$sectionid,$chapterid);

         //   $totalconcepts = totalconceptcont($courseid,$sectionid,$chapterid);
                        
           // $remaining = $totalconcepts-$completedconcept;
            //$percentage = ($completedconcept/$totalconcepts)*100;

            //if($percentage>100){
              //  $percentage = 100;
           // }


        ?>
        <!-- <div class="w3-light-grey w3-round">
            <div class="w3-container w3-round w3-blue" style="width:<?php echo $percentage.'%'; ?>"><?php echo $percentage; ?>%</div>
        </div> -->

    </div>
    
</div> 