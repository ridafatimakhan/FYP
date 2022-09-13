<?php

require('./hf/header.php'); //Muallim's Main Header

require('panel-header.php'); //Muallim's Panel Header ...

$courseID = $_GET['CourseID'];
$sectionID = $_GET['SectionID'];
$chapter_id = $_GET['ChapterID'];

?>
<script src="./js/function.js"></script>
<style>
    .question-wrapper .question .choice .choices {
        cursor: pointer;
    }

    .choice :hover {
        color: blue;
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
            <li class="breadcrumb-item active"><a href="#">Attempt Test</a></li>
        </ol>
    </div>
</div>

<div class="content ip-content">
    <div class="container-fw">
        <?php require('sidebar-panel.php'); //Muallim's Sidebar  
        ?>
        <div class="ip-main">
            <div class="" id="basic">
                <h3>Attempt Test</h3>
            </div>
            <div>
                <?php
                if (isset($_GET["ShowError"]) && $_GET["ShowError"]) {
                ?>
                    <p class="btn btn-danger" style="width:105%; " href="#"> You have Already Attempted this Test</p>.
                <?php
                }
                ?>


                <center>

                    <div style="display:flex;">
                        <div class="card" style="width: 14rem; height:18rem; margin-left:80px;">
                            <img class="card-img-top" src="images/checklist.png" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"> <a class="btn btn-primary" style="width:95%; " href="#" id="open-attempted-test">Attempt Practice Test</a></p>.
                            </div>
                        </div>

                        <div class="card" style="width: 14rem; height:18rem; margin-left:275px;">
                            <img class="card-img-top" src="images/gradedtest.png" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"> <a class="gradedTestBtn disabled btn btn-warning" style="width:95%;" href="AttemptGradedTest.php?CourseID=<?php echo $courseID; ?>&SectionID=<?php echo $sectionID; ?>&ChapterID=<?php echo $chapter_id; ?>">Attempt Graded Test</a></p>
                            </div>
                        </div>
                    </div>
            </div>
            </center>
            <div class="overlay"></div>
            <div class="attempt-practicetest popup">
                <input type="hidden" value="1" id="current-practice-questions" />
                <a class="btn btn-danger close-popup" href="#">close</a>

                <?php

                $sql = "SELECT * FROM Questions WHERE chapter_id = '" . $chapter_id . "' AND section_id = '" . $sectionID . "' AND course_id = '" . $courseID . "'";
                $params = array();
                $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);

                $stmt = sqlsrv_query($conn, $sql, $params, $options);
                $row_count = sqlsrv_num_rows($stmt);
                /*   echo "row count ??";
                    echo $sectionID; */
                ?>
                <input type="hidden" value="<?php echo $row_count; ?>" id="total-practice-questions" />
                <?php
                if ($row_count > 0) {
                    $i = 1;
                    while ($row = sqlsrv_fetch_array($stmt)) {
                        $allQuestions[] = $row;
                    }

                    shuffle($allQuestions);

                    foreach ($allQuestions as $row) {

                ?>
                        <div class="question-wrapper wow bounceInUp" question-number="<?php echo $i; ?>">
                            <div class="question">
                                <h4 style="display: block; background: green; padding: 10px; color: #fafafa;"><?php echo $i; ?> سوال نمبر</h4>
                                <h5 class="urduFont"><?php echo $row['ques_statement']; ?></h5>
                            </div>
                            <div class="choices">
                                <p class="choice" data-choice="1">
                                    <span class="urduFont" style="float: left; width: 95%;">
                                        <?php echo $row['option1']; ?>
                                    </span>
                                    <span class="option-dot" style="float: right; width: 5%; ">
                                        <span>- 1</span>
                                    </span>
                                </p>
                                <br>
                                <p class="choice" data-choice="2">
                                    <span class="urduFont" style="float: left; width: 95%;">
                                        <?php echo $row['option2']; ?>
                                    </span>
                                    <span class="option-dot" style="float: right; width: 5%;">
                                        <span>- 2</span>
                                    </span>
                                </p>
                                <br>
                                <p class="choice" data-choice="3">
                                    <span class="urduFont" style="float: left; width: 95%;">
                                        <?php echo $row['option3']; ?>
                                    </span>
                                    <span class="option-dot" style="float: right; width: 5%;">
                                        <span>- 3</span>
                                    </span>
                                </p>
                                <br>
                                <p class="choice" data-choice="4">
                                    <span class="urduFont" style="float: left; width: 95%;">
                                        <?php echo $row['option4']; ?>
                                    </span>
                                    <span class="option-dot" style="float: right; width: 5%;">
                                        <span>- 4</span>
                                    </span>
                                </p>
                                <br />
                            </div>
                        </div>
                <?php
                        $i++;
                    }
                }

                ?>
                <div class="controls-wrapper">
                    <a href="#" class="control next-question-practice btn btn-success" style="float:centre; width:850px">Next</a>
                    <br>
                    
                    <a href="#" class="control prev-question-practice btn btn-blue" style="float:centre; width:850px; background-color:#6ca3d9; color:#fafafa  ">Previous</a>
                </div>
            </div>

        </div>
    </div>

    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        toggleGradedTest();
        function toggleGradedTest(){
            var donePracticeTest = localStorage.getItem("practice");
            if(donePracticeTest) {
                $(".gradedTestBtn").removeClass("disabled");
            }else {
                $(".gradedTestBtn").addClass("disabled");
            }    
        }
        
        $('.reg-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'Are you sure to register this Course',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

        var openCurrentQuestion = () => {
            var currentQuestion = parseInt($("#current-practice-questions").val());
            $(".question-wrapper[question-number=" + currentQuestion + "]").show();
            return currentQuestion;
        }

        function checkPracticeAttempt(currentQuestion, totalQuestions){
            if(currentQuestion >= totalQuestions) {
                localStorage.setItem("practice", true);
            }
        }

        $("#open-attempted-test").click(function() {
            toggleGradedTest();
            var totalQuestions = parseInt($("#total-practice-questions").val());
            $(".question-wrapper").hide();
            var currentQuestion = openCurrentQuestion();
            $(".next-question-practice").click(function() {
                currentQuestion = currentQuestion < totalQuestions ? currentQuestion + 1 : 1;
                $(".question-wrapper").hide();
                checkPracticeAttempt(currentQuestion, totalQuestions);
                toggleGradedTest();
                $("#current-practice-questions").val(`${currentQuestion}`);
                currentQuestion = openCurrentQuestion();
            });
            $(".prev-question-practice").click(function() {
                currentQuestion = currentQuestion > 1 ? currentQuestion - 1 : totalQuestions;
                $(".question-wrapper").hide();
                $("#current-practice-questions").val(`${currentQuestion}`);
                currentQuestion = openCurrentQuestion();
                checkPracticeAttempt(currentQuestion, totalQuestions)
                toggleGradedTest();
            });
            $(".choice").click(function() {
                // var dataChoiceSelected = $(this).attr("data-choice");
                currentQuestion = currentQuestion < totalQuestions ? currentQuestion + 1 : 1;
                $(".question-wrapper").hide();
                $("#current-practice-questions").val(`${currentQuestion}`);
                currentQuestion = openCurrentQuestion();
                checkPracticeAttempt(currentQuestion, totalQuestions)
                toggleGradedTest();
            });
            $(".attempt-practicetest").addClass("active");
            $(".overlay").addClass("active");
        });




        $(".close-popup").click(function() {
            $(".attempt-practicetest").removeClass("active");
            $(".overlay").removeClass("active");
        });
    </script>
    <script>
        <?php if (isset($_SESSION['successMsg'])) {
            $msg = $_SESSION['successMsg'];
        ?>
            event.preventDefault();
            swal({
                title: 'Success Message?',
                text: '<?php echo $msg; ?>',
                icon: 'warning',
                buttons: ["OK", "Yes!"],
            }).then(function(value) {
                if (value) {
                    // window.location.href = url;
                }
            });
        <?php
            unset($_SESSION['successMsg']);
        } ?>
    </script>
</div>
</div>
</div>


<?php require('./hf/footerNOMAN.php'); ?>