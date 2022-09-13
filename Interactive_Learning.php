<?php     
    include "./hf/header.php";
    include "./includes/Connection.php";

    $_SESSION['remaining'];
    $_SESSION['percentage'];
?>
<center>
    <div class="w3-light-grey w3-round mt-5" style="width:900px; height:60px;">
<<<<<<< HEAD
        <div class="w3-container w3-round w3-green" style="height:60px; width:<?php echo("{$_SESSION['percentage']}"."%"); ?>"><?php print_r($_SESSION['percentage']); ?>% Concepts Progress</div>
=======
        <div class="w3-container w3-round w3-green" style="height:55px; width:<?php echo("{$_SESSION['percentage']}"."%"); ?>"><?php print_r($_SESSION['percentage']); ?>%<br>Concepts Progress</div>
>>>>>>> d32b9a08db94467bd58a3d272cbc879457b513b5
    </div>
</center>



<script src="./js/function.js"></script>
<div class="main2 container-fluid  border-dager" style="margin-top:20px;">
    <div class="row">
        <div class="col-10 mx-auto text-center">
        <h3 class="tittle text-captalize" style="font-family:'Calibri'">Interactive Learning - مطالعہ مضامین</h3>
        <div class="row w-25 border-bottom border-warning mx-auto" ></div>
    </div>
</div>    

<div class="row">
    <div class="Concepts_container col-10 mx-auto  borer -warning">
        <div class="content-image w-100">
            <div class="container-fluid coursename border borderdanger " style="background-color:#0F5715; color:#ffff ; height: 65px; font-size: 30px; direction: rtl; text-align:right; font-family: 'Calibri';">
                    <?php
                        $course_id = $_GET['courseID'];
                        $section_id="";
                        $chapter_id="";
                        $stmt="select cc.course_id, cc.course_name,cs.section_name,cs.section_id from Courses cc inner join
                        Sections cs  on cc.course_id=cs.course_id where cc.course_id=".$course_id;
                        $params = array(); 
                        $query = sqlsrv_query( $conn, $stmt,$params); 
                        //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                        while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                            //echo $row['course_name'];  
                            $section_id=$row['section_id'];
                            
                    ?>
                    <p style="margin-top:15px;">مطالعہ سیرت : <?php echo $row['course_name']; ?> </p>
            </div>
            <div class="container-fluid sectionname border borderwarning " style="background-color:#188C21; color:#ffff; height: 55px; direction: rtl; text-align:right; font-family: 'Calibri'; font-size: 30px">        
                <p style="margin-top:10px;"><?php echo $row['section_name'];  }?></p>
            </div>
            <div class="container-fluid chaptername border bordersuccess " style="background-color:#C0EDC0; color:#000; height: 45px; direction: rtl; text-align:right; font-family: 'Calibri'; font-size: 28px">
                <?php
                    $stmt="select cc.course_id,cc.chapter_name,cc.chapter_id from Chapters cc inner join
                    Sections cs on cs.course_id=cc.course_id where cc.course_id=".$course_id;
                    $params = array(); 
                    $query = sqlsrv_query( $conn, $stmt,$params); 
                    //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                    while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                        // echo "<p class='text-style text-justify'>".$row['course_name']."</p>";
                        $chapter_id=$row['chapter_id'];
                ?>
                <p style="margin-top:10px;"><?php echo $row['chapter_name']; }?></p>
            </div>
            <div class="container-fluid conceptsname border borderdanger " style="text-indent: 5px; direction: rtl;text-align:right; font-family:'Calibri'; font-size: 25px; text-decoration: white;" >
                <p class="fw-bold" style="direction: rtl; font-size: 25px; margin-top:10px;">اہم مضامین :</p>
                <?php
                    //$course_id = $_GET['coures_id'];
                    $stmt="select cc.course_id,cc.concept_name from Concepts cc 
                    inner join Chapters ch on cc.course_id=ch.course_id where cc.course_id=".$course_id;
                    $params = array(); 
                    $query = sqlsrv_query( $conn, $stmt); 
                    //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                    $srNO = 1;
                    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) { 


                ?>
                <ol>
                    <li><?php  echo $row['concept_name']; } ?></li>
                </ol>            
            </div>
            <br>
            <div class="container concept borer borderdanger " style="direction: rtl; line-height:50px; font-size: 25px; text-decoration: white;font-family:'Calibri';" >       
                <?php 
                    $stmt="";    
                    if(isset($_GET['concept_id'])){
                        $stmt = "select cp.concept_no,cp.concept_id,cp.concept_name,cp.concept_text from Courses cc inner join Concepts cp on cc.course_id=cp.course_id
                        where cp.concept_id=".$_GET['concept_id']." and  cp.course_id=".$course_id;
                    }else{
                        $stmt = "select cp.concept_no,cp.concept_id,cp.concept_name,cp.concept_text from Courses cc inner join Concepts cp on cc.course_id=cp.course_id
                        where  cp.course_id=".$course_id;    
                    }
                    $params = array(); 
                    $query = sqlsrv_query( $conn, $stmt); 
                    $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                    echo "<p class='text-style text-justify fw-bold' style='font-family:Calibri;'>".$row['concept_name']." : </p>";
                ?>
                
                <p style="direction: rtl; font-size: 25px;text-align: justify;"><?php echo $row['concept_text']; ?></p>
            </div>
            <form method="POST" action="testil.php">  

                <div class="form-check checkbox">    
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="checker" style="margin-left:90px;" />
                    <label class="form-check-label" for="flexCheckDefault" style="padding-right:25px; font-size: 20px; font-family: 'Calibri'; color: #238ecb;" >
                    مضمون کا مطالعہ مکمل ہوا
                    </label>
                </div>
                <div class="container-fluid button mt-1" style="padding-bottom=15px;">   
                               
                    <input type="hidden" name="c" value="<?php echo $course_id?>"/>
                    <input type="hidden" name="sectionid" value="<?php echo $section_id?>"/>
                    <input type="hidden" name="chapterid" value="<?php echo $chapter_id?>"/>

                    <input type="hidden" name="conid" value="<?php echo $row['concept_id']?>"/>
                    <input type="hidden" name="n" value="<?php echo $row['concept_no']?>"/>
                    <button type="submit" class="btn btn-success" style="direction: rtl; font-family: 'Calibri'; width:100%; font-size:20px;">آپ نے کتنا سمجھ لیا آئیے آپ کا جائزہ لیتے ہیں۔</button>
                </div>
            </form>


            <?php
            $user_id = $_SESSION['userID'];
            $completedconcept= getclearedconceptcont($user_id,$course_id,$section_id,$chapter_id);

            $totalconcepts = totalconceptcont($course_id,$section_id,$chapter_id);
                        
            $_SESSION['remaining']= $totalconcepts-$completedconcept;
            $_SESSION['percentage'] = ($completedconcept/$totalconcepts)*100;

           
            
            if($_SESSION['percentage']>100){
                $_SESSION['percentage'] = 100;
            }

            ?>
                
                </div>
                </div>
                </div>

<?php include ('top.html');?>

        </div>
    </div>
</div>





<!--?php 

                            // //showing which concept number you are on
                            // $numberCons = $_GET['c'];
                            // $stmt = "SELECT concept_no from Concepts WHERE concept_no=1";
                            // $params = array();
                            // $query = sqlsrv_query( $conn, $stmt);
                            // while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                            //     echo $row['concept_no'];
                            // }
                
                                                        // $stmt="select cc.course_id, cc.course_name,cs.section_name,ch.chapter_name,cp.concept_name from Courses cc inner join
                        // Sections cs  on cc.course_id=cs.course_id inner join Chapters ch on cs.section_id=ch.section_id inner join
                        // Concepts cp on cp.chapter_id=ch.chapter_id where cc.course_id=".$course_id;

                            // //showing total concept number

                            // $stmt = "SELECT concept_no FROM Concepts";
                            // $params = array();
                            // $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                            // $query = sqlsrv_query( $conn, $stmt,$params,$options); 
                            // $total_cons=sqlsrv_num_rows($query);
                            // if($total_cons === false){
                            //     echo "there is error";
                            // }else{
                            //     echo $total_cons;
                                
                            // }
                        ?>
                    </h3><br>
                    ?php 
                        //showing Concept Text of which you are on
                        $stmt="";    
                        if(isset($_GET['concept_id'])){

                                $stmt = "select cp.concept_no,cp.concept_id , cp.concept_text from Courses cc inner join Concepts cp on cc.course_id=cp.course_id
                                where cp.concept_id=".$_GET['concept_id']." and  cp.course_id=".$course_id;
                            
                            }else{
                                $stmt = "select cp.concept_no,cp.concept_id , cp.concept_text from Courses cc inner join Concepts cp on cc.course_id=cp.course_id
                                where  cp.course_id=".$course_id;
                            
                                
                            }
                            
                        $params = array(); 
                        $query = sqlsrv_query( $conn, $stmt); 
                        $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                        //  while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                    
                            echo "<p class='text-style text-justify'>".$row['concept_text']."</p>";
                    //    }
                    ?-->