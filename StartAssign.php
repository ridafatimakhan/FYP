<?php
    include "./hf/header.php";  


    $courseID=$_GET['courseID'];
    $chapterID=$_GET['chapterID'];
    $AssignID=$_GET['AssignID'];
?>
<div class="container-fluid border" style="margin-top:110px;">
    <h3>Assignment Description</h3>
    <?php 
        $stmt="select * from PRASSIGN where assign_id=".$AssignID;
        $params = array(); 
        $query = sqlsrv_query( $conn, $stmt,$params); 
        //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
        while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
            echo "<p class='text-style'>Assignment Tittle: ".$row['assign_tittle']."</p>";
            echo "<p class='text-style '>Assignment Marks: ".$row['assign_marks']."</p>";
            //$chapter_id=$row['chapter_id'];
        }
    ?>
    <div class="row w-25 border-bottom border-warning mx-auto"></div>
    <div class="col5">
        <div class="question row flex-row  border border-success mt-3 ml-3 mr-3">
            <h4 style="direction:ltr; margin-top:10px; text-align:right;">
                سوال نمبر： 
                <?php    
                    //Fetching question # of which you are on
                    $stmt = "Select * from PR_questions where assign_id=$AssignID";
                    $params = array(); 
                    $query = sqlsrv_query( $conn, $stmt); 
                    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                        $questid=$row['quest_id'];
                        echo $row['prques_no'];
                        
                        echo $row['prques_statement'];
                ?><br>
            </h4>
        </div>

        <div class="questioneir row flex-row  border border-success ml-3 mr-3 text-right" style="direction:ltr; ">
            <ul><li><?php
                echo $row['prActivity1']; ?></li><br><li><?php
                echo "  ".$row['prActivity2']; ?></li><br><li><?php
                echo "  ".$row['prActivity3'];   ?></li><br><?php
            }
            ?></ul>
        </div>

        <form action="savePRresponse.php" method="POST">
            
            <input type="text" class="row flex-row mt-3 ml-3" name="answer" style="height:150px; width:98%;" placeholder=""/>            
            
            <input type="hidden" name="courseID" value="<?php echo $courseID; ?>">
            <input type="hidden" name="AssignID" value="<?php echo $AssignID; ?>">
            <input type="hidden" name="AssignQuesID" value="<?php echo $questid; ?>">
            <input type="hidden" name="ChapID" value="<?php echo $chapterID; ?>">
            <button type="submit" class="btn btn-success mt-5 ml-3 mr-3" style="direction: rtl; font-family: 'Calibri'; width:100%; font-size:20px;">Submit</button> 
        </form>
    </div>    
</div>
