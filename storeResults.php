<?php require('includes/Connection.php');

/*
* Write your logic to manage the data
* like storing data in database
*/
// POST Data
try {
    $response = array();
    $results = json_decode(json_encode($_POST['results']));
    $userid = (int)$_POST['userid'];
    $courseid = (int)$_POST['courseid'];
    $sectionid = (int)$_POST['sectionid'];
    $chapterid = (int)$_POST['chapterid'];

    $start = $_POST['start'];
    $end = $_POST['end'];

    // section_id
    $addGradedTest = "INSERT INTO GradedTest (user_id, start_time, end_time, course_id, section_id, chapter_id) VALUES(" . $userid . ", '" . $start . "', '" . $end . "', " . $courseid . ", " . $sectionid . ", " . $chapterid . ")";

    $param = array();

    $response["query"] = $addGradedTest;

    $_results = sqlsrv_query($conn, $addGradedTest, $param);

    $response["res"] = $_results;

    if ($_results) {
        $q = "SELECT MAX(test_id) AS LastID FROM GradedTest";
        $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $p = array();
        $r = sqlsrv_query($conn, $q, $p, $options);
        $lastId = sqlsrv_fetch_array($r);
        $response['test_id'] = $lastId['LastID'];
        foreach ($results as &$res) {
            $testAnswerInsert = "INSERT INTO TestResults (question_id, selected_answer, test_id) VALUES(?, ?, ?)";
            $question = $res->question;
            $choice = $res->choice;
            $param = array($question, $choice, $response['test_id']);
            $_results = sqlsrv_query($conn, $testAnswerInsert, $param);
        }

        echo json_encode($response);
        die();
    } else {
        $response["error"] = sqlsrv_errors();
        echo json_encode($response);
        die();
    }

    echo json_encode($response);
}

//catch exception
catch (Exception $e) {
    $error = ["error" => $e->getMessage()];
    echo json_encode($error);
}

exit;
