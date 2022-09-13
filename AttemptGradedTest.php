<?php require('./hf/header.php'); //Muallim's Main Header
?>
<script src="./js/function.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?php require('panel-header.php'); //Muallim's Panel Header 

$courseID = $_GET['CourseID'];
$sectionID = $_GET['SectionID'];
$chapter_id = $_GET['ChapterID'];


$userRole = $_SESSION["userRole"];
if ($userRole !== "A") {
    $newQuery = "SELECT * from GradedTest WHERE course_id = ? AND section_id = ? AND chapter_id = ? AND user_id = ?";
    $params = array($courseID, $sectionID, $chapter_id, (int)$_SESSION['userID']);
    $stmt = sqlsrv_query($conn, $newQuery, $params, $options);
    $row_count = sqlsrv_num_rows($stmt);
    if ($row_count > 0) {
?>

        <script>
            window.location.href = "test-list.php?ShowError=1&CourseID=<?php echo $courseID; ?>&SectionID=<?php echo $sectionID; ?>&ChapterID=<?php echo $chapter_id; ?>";
        </script>

<?php
        exit();
    }
}

?>

<style>
    #gt {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 60%;
        margin-left: auto;
        margin-right: auto;
        margin-top: 5%;
    }

    #gt td,
    #gt th {
        border: 1px solid green;
        padding: 8px;
    }

    #gt tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #gt tr:hover {
        background-color: #ddd;
    }

    #gt th {
        padding-top: 5px;
        padding-bottom: 10px;
        text-align: left;
        background-color: green;
        color: white;


    }

    h1 {
        text-align: center;
        margin: 0;
        padding-bottom: 5px;
    }

    #time-remaining {
        position: relative;
        width: 150px;
        background-color: green;
        color: #fafafa;
        padding-bottom: 10px;
        padding-top: 10px;
        font-weight: 600;
        float: center;
        padding-right: 50px;
        padding-left: 50px;


    }

    #time-remaining .hour {
        align-text: center;
    }

    #time-remaining .minute {
        align-self: center;
    }

    #time-remaining .second {
        align-self: center;
    }

    .questionnaire-wrapper {
        display: block;
        width: 100%;
        margin-left: 0%;
        text-align: right;
        padding: 40px;
        background-color: white;
        border: 1px solid #212121;
    }

    .questionnaire-wrapper .question {
        display: block;
        color: black;
        background: transparent;
    }


    .questionnaire-wrapper .question .question-number {
        font-weight: bold;
        font-size: 30px;
        padding: 10px;
        color: white;
        display: block;
        width: 100%;
        background-color: green;
    }

    .questionnaire-wrapper .question .question-details {
        padding: 1px;
        background-color:#a7b5ae;
        color: black;
    }


    .questionnaire-wrapper .question .choices {
        padding: 10px;
        list-style-type: circle;

    }

    .questionnaire-wrapper .question .choices .choice {
        cursor: pointer;


    }

    .questionnaire-wrapper .question .choices .choice :hover {
        color: green;
        font-size: 19px;

    }

    .completed-success {
        display: none;

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
            <li class="breadcrumb-item active"><a href="#">Graded Test</a></li>
        </ol>
    </div>
</div>

<div class="content ip-content">
    <div class="container-fw">
        <?php require('sidebar-panel.php'); //Muallim's Sidebar 
        ?>
        <div class="ip-main">

            <div class="">
                <center>
                    <div class="graded-test-wrapper" id="blur" style="display: block;">
                        <h1> Welcome to Graded Test </h1>
                        <table id="gt">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                            <tr>
                                <td>Test Name</td>
                                <td>Chapter 1</td>
                            </tr>
                            <tr>
                                <td>Test category</td>
                                <td>Seerat-un-Nabi(PBUH)</td>
                            </tr>
                            <tr>
                                <td>Test Type</td>
                                <td> MCQS</td>
                            </tr>

                            <tr>

                                <td>Total no of questions</td>
                                <td>14</td>

                            </tr>
                            <tr>

                                <td>Total Time</td>
                                <td>60 Seconds</td>
                            </tr>
                        </table>

                        <a class="btn btn-success" href="#" style="margin-top: 10px; margin-bottom: 10px; width:500px" id="startTestBtn">Start Test</a>
                    </div>
                    <input type="hidden" id="cheating" value="false" />
                    <input type="hidden" id="starttime" value="" />
                    <!-- time alloted in minutes -->
                    <input type="hidden" id="timeAllotted" value="-1" />
                </center>

                <div class="graded-test-show" style="display: none;">
                    <h3 style="color:black; padding-bottom: 10px; text-align: center;">Graded Test <br> <br> <small id="time-remaining"></small></h3>
                    <!--      <div class="progress" style="color:#8ec3eb">
                        <div class="progress-bar"  id='pbar' role="progressbar" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100" style="width:5%">
                            
                        </div>
                        </div> -->
                    <div class="w3-section w3-light-grey">
                        <div class="w3-container w3-padding-large w3-green w3-center " id='pbar' role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:5%" </div>
                        </div>



                    </div>
                    <div class="questionnaire-wrapper">

                        <input type="hidden" id="current-questions" value="1">
                        <?php
                        $sql = "SELECT * FROM Questions WHERE chapter_id = '" . $chapter_id . "' AND section_id = '" . $sectionID . "' AND course_id = '" . $courseID . "' ORDER BY RAND()";
                        $params = array();
                        $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);

                        $stmt = sqlsrv_query($conn, $sql, $params, $options);
                        $row_count = sqlsrv_num_rows($stmt);

                        $allQuestions = array();


                        ?>
                        <input type="hidden" id="total-questions" value="<?php echo $row_count; ?>">
                        <?php
                        if ($row_count > 0) {
                            $i = 1;
                            while ($row = sqlsrv_fetch_array($stmt)) {
                                $allQuestions[] = $row;
                            }

                            shuffle($allQuestions);

                            foreach ($allQuestions as $row) {
                        ?>

                                <div class="question" question-number="<?php echo $i; ?>" question-id="<?php echo $row['question_id']; ?>">
                                    <div class="question-number"> <?php echo $i; ?>سوال نمبر</div>
                                    <div class="question-details urduFont">
                                        <h5><?php echo $row['ques_statement']; ?></h5>
                                    </div>

                                    <div class="choices">
                                        <p class="choice" choice="1">
                                            <span class="urduFont" style="float: left; width: 95%;">
                                                <?php echo $row['option1']; ?>
                                            </span>
                                            <span class="option-dot" style="float: right; width: 5%;">
                                                <span>- 1</span>
                                            </span>
                                        </p>
                                        <p class="choice" choice="2">
                                            <span style="float: left; width: 95%;">
                                                <?php echo $row['option2']; ?>
                                            </span>
                                            <span class="option-dot" style="float: right; width: 5%;">
                                                <span>- 2</span>
                                            </span>
                                        </p>
                                        <p class="choice" choice="3">
                                            <span style="float: left; width: 95%;">
                                                <?php echo $row['option3']; ?>
                                            </span>
                                            <span class="option-dot" style="float: right; width: 5%;">
                                                <span>- 3</span>
                                            </span>
                                        </p>
                                        <p class="choice" choice="4">
                                            <span style="float: left; width: 95%;">
                                                <?php echo $row['option4']; ?>
                                            </span>
                                            <span class="option-dot" style="float: right; width: 5%;">
                                                <span>- 4</span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                        <?php
                                $i++;
                            }
                        }

                        ?>




                        <input type="hidden" value="0" id="totAttempts" />

                        <input id="courseid" type="hidden" value="<?php echo $courseID; ?>" />
                        <input id="sectionid" type="hidden" value="<?php echo $sectionID; ?>" />
                        <input id="chapterid" type="hidden" value="<?php echo $chapter_id; ?>" />

                        <textarea id="data" style="opacity: 0;"></textarea>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script type="text/javascript">
                            var openCurrentQuestion = () => {
                                var currentQuestion = parseInt($("#current-questions").val());
                                $(".question[question-number=" + currentQuestion + "]").show();
                                return currentQuestion;
                            }

                            var sendAjaxCall = (data, start, end) => {
                                var results = [];

                                var ids = {
                                    courseid: $("#courseid").val(),
                                    sectionid: $("#sectionid").val(),
                                    chapterid: $("#chapterid").val(),
                                };


                                $.ajax({
                                    type: "POST",
                                    url: 'storeResults.php',
                                    data: {
                                        results: data,
                                        userid: "<?php echo $_SESSION['userID']; ?>",
                                        courseid: ids.courseid,
                                        sectionid: ids.sectionid,
                                        chapterid: ids.chapterid,
                                        start,
                                        end
                                    },
                                    success: function(data) {
                                        results = data;
                                        $(".completed-success").show();
                                        setTimeout(function() {
                                            window.location.href = "result.php?CourseID=" + ids.courseid + "&SectionID=" + ids.sectionid + "&ChapterID=" + ids.chapterid + "&saveScore=1";
                                        }, 30);

                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr);
                                    }
                                });
                            };

                            $("#startTestBtn").click(function() {

                                $(".graded-test-show").show();
                                var totalQuestion = $("#total-questions").val();
                                var startTime = moment(new Date()).unix();
                                var startdate = moment(new Date()).format("DD-MM-YYYY HH:mm:ss");
                                var duration = parseInt($("#timeAllotted").val());
                                var endTime = moment().add(duration, 'm').unix();
                                $(".graded-test-wrapper").hide();
                                var diffTime = endTime - startTime;
                                var duration = moment.duration(diffTime * 1000, 'milliseconds');
                                var interval = 1000;
                                var inactive = false;
                                // $(".graded-test-show").mouseover(function() {
                                //     inactive = false;
                                // });
                                // $(".graded-test-show").mouseout(function() {
                                //     inactive = true;
                                // });
                                var myTimer = setInterval(function() {
                                    if (inactive === false && (duration - interval) > 0) {
                                        duration = moment.duration(duration - interval, 'milliseconds');
                                        $('#time-remaining').html('<span class="hour">' + duration.hours() + "</span>:<span class='minute'>" + duration.minutes() + "</span>:<span class='second'>" + duration.seconds() + '</span>')
                                    } else {

                                        alert("Time over"); 
                                    }
                                }, interval);
                                

                                $(".question").hide();
                                var current = openCurrentQuestion();
                                $(".choice").click(function() {
                                    console.log($("#total-questions").val());
                                    var dataDiv = $("#data").val();
                                    console.log("data is", dataDiv);
                                    dataDivQues = 0;
                                    total = $("#total-questions").val();

                                    totAttempts = parseInt($("#totAttempts").val());
                                    if (totAttempts == 0) {
                                        percentage = (1 / total) * 100;
                                        $('#pbar').css('width', percentage + '%');


                                        $("#totAttempts").val(1);
                                    } else {
                                        totAttempts += 1;
                                        $("#totAttempts").val(totAttempts);
                                        percentage = (totAttempts / total) * 100;
                                        $('#pbar').css('width', percentage + '%');


                                    }

                                    $('#pbar').html(parseInt(percentage) + '%');


                                    console.log(percentage);
                                    var data = dataDiv == "" ? [] : JSON.parse(dataDiv);
                                    var selectedChoice = $(this).attr("choice");
                                    var questionId = $(".question[question-number = " + current + "]").attr("question-id");
                                    data.push({
                                        question: questionId,
                                        choice: selectedChoice
                                    });

                                    $("#data").val(JSON.stringify(data));

                                    if (current < totalQuestion) {
                                        current++;
                                        $("#current-questions").val(current);
                                        $(".question").hide();
                                        openCurrentQuestion();
                                    } else {
                                        clearInterval(myTimer);
                                        $(".question").hide();

                                        var startTimeIn = startdate;
                                        var endTimeIn = moment().format("DD-MM-YYYY HH:mm:ss");

                                        sendAjaxCall(data, startTimeIn, endTimeIn);
                                        $('#time-remaining').text("00:00:00")
                                    }
                                });
                            });

                            window.addEventListener('blur', (e) => {
                                console.log("changed the browser");
                                $("#cheating").val("true");
                            });

                            $("#open-attempted-test").click(function() {
                                var totalQuestions = parseInt($("#total-practice-questions").val());
                                $(".question-wrapper").hide();
                                var currentQuestion = openCurrentQuestion();
                                $(".next-question-practice").click(function() {
                                    currentQuestion = currentQuestion < totalQuestions ? currentQuestion + 1 : 1;
                                    $(".question-wrapper").hide();
                                    $("#current-practice-questions").val(`${currentQuestion}`);
                                    currentQuestion = openCurrentQuestion();
                                });
                                $(".prev-question-practice").click(function() {
                                    currentQuestion = currentQuestion > 1 ? currentQuestion - 1 : totalQuestions;
                                    $(".question-wrapper").hide();
                                    $("#current-practice-questions").val(`${currentQuestion}`);
                                    currentQuestion = openCurrentQuestion();
                                });
                                $(".attempt-practicetest").addClass("active");
                                $(".overlay").addClass("active");
                            });
                            $(".close-popup").click(function() {
                                $(".attempt-practicetest").removeClass("active");
                                $(".overlay").removeClass("active");
                            });
                        </script>
                        </div>
      