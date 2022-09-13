<?php

require('./hf/header.php'); //Muallim's Main Header
require('panel-header.php'); //Muallim's Panel Header 

?>
<script src="./js/function.js"></script>
<style>
    .table {
        background-color: green;
        color: white;
    }
</style>
<!-- Muallim's Inner Page Content Start -->
<div class="ip-banner">
    <div class="color-bg"></div>
    <div class="img-bg"></div>
    <div class="container">
        <div class="ip-banner-blurb">
            <div class="courses-btn">
                <a class="ex-btn btn-border" href="#"><i class="fas fa-link"></i> Attempt Test</a><br>
                <!-- <a class="ex-btn btn-border" href="#advance"><i class="fas fa-link"></i> Advanced Learning</a> -->
            </div>
        </div>
    </div>
</div>
<div class="bred-contain">
    <div class="container" id="top">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Test Results</a></li>
        </ol>
    </div>
</div>

<div class="content ip-content">
    <div class="container-fw">
        <?php require('sidebar-panel.php'); //Muallim's Sidebar  
        ?>
        <div class="ip-main">
            <div class="" id="basic">
                <h3>Test Results</h3>
                <?php
                $userid = (int)$_SESSION['userID'];
                $courseID = $_GET['CourseID'];
                $sectionID = $_GET['SectionID'];
                $chapter_id = $_GET['ChapterID'];
                if (!isset($_GET['id'])) {
                    //  show table with all the test of user
                    $baseSql = "SELECT * FROM GradedTest WHERE course_id = " . $courseID . " AND section_id = " . $sectionID . " AND chapter_id = " . $chapter_id;
                    $sql = $_SESSION['userRole'] === "A" ? $baseSql : $baseSql . " AND user_id = ? ORDER BY test_id DESC";
                    $params = array($userid);
                    $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                    $stmt = sqlsrv_query($conn, $sql, $params, $options);
                    $row_count = sqlsrv_num_rows($stmt);
              
             ?>
     
           

  <table class="table ">

                        <thead>
                            <tr>
                                <!-- <th scope="col" class="text-center">Sr. No </th> -->
                                <th scope="col" class="text-center">Course Name</th>
                              
                                <th scope="col" class="text-center">User Name</th>
                                <th scope="col" class="text-center">Score</th>
                                <th scope="col" class="text-center">Correct Answers</th>
                                <th scope="col" class="text-center">Started Date</th>
                                <th scope="col" class="text-center">Start Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($row_count > 0) {
                               
                                $i = 1;
                                while ($row = sqlsrv_fetch_array($stmt)) {

                                    $score = 0;
                                    $correct_answers = 0;
                                    $testid = $row["test_id"];
                                    $start = $row["start_time"];
                                    $courseid = $row["course_id"];
                                    $chapter_id=$row["chapter_id"];
                                    $courseName = getCourseNamer($row['course_id']);
                                    $userName = getuserNameresult($row['user_id']);
                                    $userid = $row["user_id"];
                                    $end = $row["end_time"];
                                    $totalMarks = 0;
                                    $sql = "SELECT * FROM TestResults WHERE test_id = ?";
                                    $params = array($testid);
                                    $stmt2 = sqlsrv_query($conn, $sql, $params, $options);
                                    $row_count = sqlsrv_num_rows($stmt2);

                                    $totalChoices = $row_count;
                                    if ($row_count) {
                                        while ($row1 = sqlsrv_fetch_array($stmt2)) {
                                            $questionId = $row1["question_id"];
                                            $selected = $row1["selected_answer"];

                                            $sql = "SELECT * FROM Questions WHERE question_id = ?";
                                            $params = array($questionId, $selected);
                                            $stmt3 = sqlsrv_query($conn, $sql, $params, $options);
                                            $row_count = sqlsrv_num_rows($stmt3);
                                            if ($row_count) {
                                                while ($row2 = sqlsrv_fetch_array($stmt3)) {
                                                    $totalMarks += $row2['Ques_weightage'];
                                                    if ($row2['answer'] == $selected) {
                                                        $score += $row2['Ques_weightage'];
                                                        $correct_answers++;
                                                    }
                                                }
                                            }
                                        }

                                        if (isset($_GET["saveScore"])) {
                                          
                                            $saveScoreQuery = "UPDATE GradedTest SET score = ?, correct_answers = ?, total_questions = ?, total_marks = ? WHERE test_id = ?";
                                            $stmt4 = sqlsrv_query($conn, $saveScoreQuery, array($score, $correct_answers, $totalChoices, $totalMarks, $testid));
                                        }
                                    }

                                    $newDateTime = explode(" ", $start);
                                    if (isset($_GET["showAll"]) || $i < 2 || $_SESSION['userRole'] === "A") {



                            ?>
                                        <tr style="background-color: #b0bec5; color: #000;">
                                         <!--    <td class="text-center"><?php echo $i; ?></td> -->
                                            <td class="text-center"><?php echo $courseName; ?> </td>
                                            <td class="text-center"><?php echo  $userName  ?> </td>
                                            <td class="text-center"><?php echo $score; ?> </td>
                                            <td class="text-center"><?php echo $correct_answers . " / " . $totalChoices; ?> </td>
                                            <td class="text-center"><?php echo $newDateTime[0]; ?> </td>
                                            <td class="text-center"><?php echo $newDateTime[1]; ?> </td>
                                            <!-- <td class="text-center"><?php //echo $end; 
                                                                            ?> </td> -->
                                        </tr>

                            <?php
                                    }
                                    $i++;
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                    <?php 
                    $userid = (int)$_SESSION['userID'];
                    $courseID = $_GET['CourseID'];
                    $sectionID = $_GET['SectionID'];
                    $chapter_id = $_GET['ChapterID'];
                    $percentage=getGradedTest($courseID,$userid, $sectionID,$chapter_id); ?>
                    <div class="w3-section w3-light-grey">
                        <div class="w3-container w3-padding-large w3-red w3-center " style=" width:<?php echo $percentage. '%'; ?>"><?php echo round($percentage); ?> %</div>
                    </div>
                <?php
                } else {
                    $testid = $_GET['id'];
                }

                ?>
            </div>
            <div>
            </div>
        </div>
       

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>