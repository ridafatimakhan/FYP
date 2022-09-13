<?php
    //include "./includes/Connection.php";  
    include "./hf/header.php";  
    $courseID=$_GET['courseID'];
?>
<center>
<div class="borderimage w-50">
    <div class="container-fluid" >
        <div class="row border-warning" style="height:25px;">
            <div class="container-fluid chaptername border bordersuccess " style="background-color:#C0EDC0; color:#000; height: 45px; direction: rtl; text-align:right; font-family: 'Calibri'; font-size: 28px">
                <?php
                    $stmt="select cc.course_id,cc.chapter_name,cc.chapter_id from Chapters cc inner join
                    Sections cs on cs.course_id=cc.course_id where cc.course_id=".$courseID;
                    $params = array(); 
                    $query = sqlsrv_query( $conn, $stmt,$params); 
                    //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                    while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                        // echo "<p class='text-style text-justify'>".$row['course_name']."</p>";
                        $chapter_id=$row['chapter_id'];
                ?>
                <p style="margin-top:10px;"><?php echo $row['chapter_name']; }?></p>
            </div>
            <div class="row w-10">
                <div class="col-8 border">
                    <h3 style="margin-top:10px;">Assignment Tittle</h3>
                    <?php 
                        $stmt="select cc.course_id,cc.chapter_name,cc.chapter_id,cs.assign_tittle,cs.assign_id,cs.assign_marks,cs.deadline
                        from Chapters cc inner join
                        PRASSIGN cs on cs.course_id=cc.course_id where cc.chapter_id=".$chapter_id;

                        $params = array(); 
                        $query = sqlsrv_query( $conn, $stmt,$params); 
                        //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                        while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                            // echo "<p class='text-style text-justify'>".$row['course_name']."</p>";"]

                    ?>
                    <a href="StartAssign.php?courseID=<?php echo $courseID; ?>&chapterID=<?php echo $chapter_id; ?>&AssignID=<?php echo $row['assign_id'];?> " 
                    style="margin-top:10px;"><?php echo $row['assign_tittle'];?><br><br><?php }?></a>
                </div>
                <div class="col-4 border ">
                    <h3 style="margin-top:10px;">Marks</h3>
                    <?php 
                        $stmt="select cc.course_id,cc.chapter_name,cc.chapter_id,cs.assign_tittle,cs.assign_marks,cs.deadline
                        from Chapters cc inner join
                        PRASSIGN cs on cs.course_id=cc.course_id where cc.chapter_id=".$chapter_id;
                        $params = array(); 
                        $query = sqlsrv_query( $conn, $stmt,$params); 
                        //$row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC );
                        while($row=sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC )) {
                            // echo "<p class='text-style text-justify'>".$row['course_name']."</p>";"]

                    ?>
                    <p style="margin-top:0px;"><?php echo $row['assign_marks'];?><br><br><?php } ?></p>
                </div>

            </div>
        </div>
    </div>
</div>
<center>