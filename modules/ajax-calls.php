<?php 
						//======================================================================//
								// AJAX Functions //
						//======================================================================//
require('connection/connect-open.php');
require('global-functions.php');

if(isset($_SESSION) && !empty($_SESSION) && !empty($_SESSION['userid']) ){
 	$current_user_id = $_SESSION['userid'];
 	$user_data = ml_get_user_data($current_user_id);
}else{
	$user_data = '';
}

// Login Form Ajax Session
if(isset($_POST['action']) && $_POST['action'] == 'formValidation'){

	if(!empty($_POST['username']) && !empty($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$password = md5($password);
 			$mesage = array();
 			
			$login_con = new ML_CONNECTION();
			$login = $login_con->connection_db();
			$loginquery = "SELECT user_id FROM users WHERE user_name = '$username' and user_password ='$password'";
			$result = $login->query($loginquery);
			$mesage = null;
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$cur_user_id = $user['user_id'];
				$_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['userid'] = $cur_user_id;
				
				$mesage = array('message' => 'You Are Successfully Logged In', 'response_type' => 'success');	
			}else{
				$mesage = array('message' => 'One or more info is incorrect please try again', 'response_type' => 'failed');
			}
			echo json_encode($mesage); die;
		}
}

// SignUp Form Ajax Session
if(isset($_POST['action']) && $_POST['action'] == 'validationSignup'){

	if(!empty($_POST['sign-name']) && !empty($_POST['sign-pass']) && !empty($_POST['sign-email'])){
		$sign_username = $_POST['sign-name'];
		$sign_password = $_POST['sign-pass'];
		$sign_email = $_POST['sign-email'];

		$sign_fname = $_POST['first-name'];
		$sign_lname = $_POST['last-name'];
		$father_name = $_POST['father-name'];
		$contact_number = $_POST['contact-no'];  
		$cnic_number = $_POST['cnic-no'];
		$do_birth = $_POST['dob'];
		$u_addres = $_POST['address'];
		$l_qualification = $_POST['last-qualification'];
		$u_gender = $_POST['gender'];
		$sign_password = md5($sign_password);
		// $u_level = $_POST['level'];

		$sign_role = $_POST['role'];

		$reg_date = date("d/m/Y");
		
	
		// echo (json_encode($final_image)); die;
		
		// $u_pic = $_POST['user-pic'];
		// echo '<pre>'; print_r('i am here'); die;
			
		$signup_con = new ML_CONNECTION();
		$signup = $signup_con->connection_db();


		$check_user_query = "SELECT user_id FROM users WHERE user_name = '$sign_username'";

		$user_checked = $signup->query($check_user_query);

		if(empty($user_checked->num_rows)){
			 

			if($_POST['user-verified'] != 'yes'):

				$regNumb = $_SESSION['email-registion-number'];
				$message = 'Please Enter '.$regNumb .' code to verify your account';
				$headers = 'From: nomi.spyko@gmail.com';
				mail($sign_email, 'Email Verification From Muallim', $message,$headers);
				$sigupMesage = array('message' => 'Please Check Your email and enter the code in verfication field', 'response_type' => 'email-verification'); 

				echo json_encode($sigupMesage); die;

			endif;


			$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
			$path = dirname(__DIR__) . '\images\users/'; // upload directory
			if( isset($_FILES['user-pic']) )
			{
				$img = $_FILES['user-pic']['name'];
				$tmp = $_FILES['user-pic']['tmp_name'];

				// get uploaded file's extension
				$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
				// can upload same image using rand function
				$final_image = rand(1000,1000000).$img;
				// check's valid format
				if(in_array($ext, $valid_extensions)) { 
					$path = $path.strtolower($final_image); 
					if(move_uploaded_file($tmp,$path)) {

					}else{
						$final_image = null; 
					}
				}
			}
		
			$signupquery = "INSERT INTO users (user_name, user_password, user_email, user_role, firstName, lastName, fatherName, gender, birthDate, regDate, cnicNo, contactNo, address, lastQualification, user_image) VALUES ('$sign_username', '$sign_password', '$sign_email', '$sign_role', '$sign_fname', '$sign_lname', '$father_name', '$u_gender', '$do_birth', '$reg_date', '$cnic_number', '$contact_number', '$u_addres', '$l_qualification', '$final_image');";
			$result = $signup->query($signupquery);
			
				// $sigupMesage = 'signup successful';	
				$sigupMesage = array('message' => 'You Are Successfully Signed Up', 'response_type' => 'success');	
			
		}else{
			$sigupMesage = array('message' => 'Sorry, '.$sign_username.' have already joined Muallim', 'response_type' => 'error');
		}
		echo json_encode($sigupMesage); die;
		
	}
}

// AddSurah Form Ajax Session
if(isset($_POST['action']) && $_POST['action'] == 'addSurahForm'){

	if(!empty($_POST['surah-numb']) && !empty($_POST['surah-name']) && !empty($_POST['surah-title'])){
		$surah_numb = $_POST['surah-numb'];
		$surah_name = $_POST['surah-name'];
		$surah_title = $_POST['surah-title'];

		$revealed_at = $_POST['revealed-at'];
		$total_ayaats = $_POST['total-ayaats'];
		$total_rukuhaat = $_POST['total-rukuhaat'];

		$surah_con = new ML_CONNECTION();
		$surahs = $surah_con->connection_db();

		$surahquery = "INSERT INTO surahs (SurahNo, SurahName, surahTitle, TotalAyaats, TotalRukuhaat, RevealedAt) VALUES ('$surah_numb', '$surah_name', '$surah_title', '$total_ayaats', '$total_rukuhaat', '$revealed_at');";
			$result = $surahs->query($surahquery);

			if ($surahs->query($surahquery) === TRUE) {
				 $SurahMesage = 'Surah Added Successfully';
				} 
			else
			{
				$SurahMesage = 'Something Went Wrong, Please Try Again After Refreshing The Page';
			}		
				
			
		
		echo $SurahMesage; die;
		
	}
}

// verify code
if(isset($_POST['action'])  && $_POST['action'] == 'verify-code'){
	$userCode = $_SESSION['email-registion-number'];
	$code = $_POST['code'];

	if($userCode == $code){
		$msg = array('message' => 'You Are Successfully Verified', 'response_type' => 'success');	
	}
	else{	
		$msg = array('message' => "Can't verify you, Please try again", 'response_type' => 'error');
	}
	echo json_encode($msg); die;
}

// echo '<pre>'; print_r(session_id()); exit;

// Logout Ajax Session
if(isset($_POST['action'])  && $_POST['action'] == 'logout'){
	 $destroyed = session_destroy();
	echo  $destroyed; die;
}

// delete Ajax Session
if(isset($_POST['action'])  && $_POST['action'] == 'deleteAyaat'){
	$ayaatNum = $_POST['ayaatNo'];
	$surahNum = $_POST['surahNo'];

	$surah_con = new ML_CONNECTION();
	$del = $surah_con->connection_db();

	$delQuery = "DELETE FROM ayaat WHERE SurahNo='$surahNum' AND AyatNo='$ayaatNum'";

	$result = $del->query($delQuery);

	if ($result === TRUE) {
		 $DelMesage = array('message' => 'Successfully Deleted', 'response_type' => 'success', 'id'=> $surahNum.$ayaatNum);	
		} 
	else
	{
		$DelMesage = array('message' => 'Something went wrong please try again', 'response_type' => 'failed');	
	}		
		
	echo json_encode($DelMesage); die;

}

// delete Question
if(isset($_POST['action'])  && $_POST['action'] == 'deleteQuestion'){
	$quesId = $_POST['qID'];
	$surahNo = $_POST['surahNo'];

	


	$surah_con = new ML_CONNECTION();
	$del = $surah_con->connection_db();

	$delQuery = "DELETE FROM questions WHERE ID='$quesId' AND SurahNo='$surahNo'";
// echo $delQuery; die;
	$result = $del->query($delQuery);

	if ($result === TRUE) {
		 $DelMesage = array('message' => 'Successfully Deleted', 'response_type' => 'success', 'id'=> $quesId.$surahNo);	
		} 
	else
	{
		$DelMesage = array('message' => 'Something went wrong please try again', 'response_type' => 'failed');	
	}		
		
	echo json_encode($DelMesage); die;

}


// Search Keywords
if(isset($_POST['action'])  && $_POST['action'] == 'search'){
	$keyWord = $_POST['search_keyword'];
	// $surahNum = $_POST['surahNo'];
	// echo '<pre>'; print_r($keyWord); exit;

	$con = new ML_CONNECTION();
	$con = $con->connection_db();

	$searchKQuery = "SELECT classification FROM keywords WHERE keyword LIKE '%$keyWord%'";


	// echo $searchKQuery;

	$result = $con->query($searchKQuery);

	// $result = $result->fetch_assoc();
	$html = null;
	$select_query = null;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$classification = $row['classification'];

			// $select_query = "SELECT * FROM Keywords WHERE classification = '$classification' ORDER BY 'AyatNo' DESC";

			$select_query = "SELECT  k.*
								FROM    keywords k
							        INNER JOIN 
							        (
							            SELECT  SurahName, classification, COUNT( * ) totalCount
							            FROM    keywords
							            Where classification = '$classification'
							            GROUP BY SurahName
							            Order by totalCount Desc
							        ) b ON  k.SurahName = b.SurahName
							        Where k.classification = '$classification'
							        ORDER   BY b.totalCount DESC ";

			$select_query = $con->query($select_query);

		}
	}		
	if(isset($select_query->num_rows)){
	if ($select_query->num_rows > 0) {
				    // output data of each row
	    $i = null;
	    
		$checkVar = '0'; 
	   $html = '<div class="verses-block">';
	    while($row = $select_query->fetch_assoc()) { 
	    	$html .='<div class="surah-'. $row["SurahNo"] .' verses id-' . $row["AyatNo"] .'">';
						
						if($checkVar != $row["SurahNo"]){ 
						 	
						 	$html .=' <div class="v-numb">
								<h4></h4>
								<h4>'. $row["SurahName"] .'</h4>
								<a href="'. ml_get_option('site_url') .'/courses-detail.php?ID='. $row["SurahNo"].'" class="cta-link"><i class="fas fa-book"></i> Learn</a>
							
							</div>';
						
						 }else{

						}
						$checkVar = $row["SurahNo"];

						$html .=' <div class="v-blurb">
							<div class="a-txt blurb">
								'. $row["ArabicText"] .'
							</div>
							<div class="e-txt blurb">

								<p>'. $row["keyword"] .'</p>
							</div>
							<div class="u-txt blurb">
								<p>'. $row["UrduTranslation"] .'</p>
							</div>
						</div>
					</div>';
	    } 
	    $html .= '</div>';
	} }else {
	    echo "0 results";
	}


	echo $html; die;

}

// Select Surah
if(isset($_POST['action'])  && $_POST['action'] == 'selectSurah'){
	$userId = $_POST['userID'];
	$surahNo = $_POST['surahNo'];

	
	$surah_con = new ML_CONNECTION();
	$addQ = $surah_con->connection_db();

	$check_suarh_query = "SELECT user_id FROM learningresources WHERE SurahNo = '$surahNo' AND user_id = '$userId'";

	$check_suarh_query = $addQ->query($check_suarh_query);

	if(!empty($check_suarh_query->num_rows)){
		$AddMesage = array('message' => 'Surah is already added', 'response_type' => 'failed');	
	}
	else{



	$insQuery = "INSERT INTO learningresources (user_id, SurahNo) VALUES ('$userId', '$surahNo');";

	$result = $addQ->query($insQuery);

	if ($result === TRUE) {
		 $AddMesage = array('message' => 'Successfully Added', 'response_type' => 'success', 'id'=> $userId.$surahNo);	
		} 
		else
		{
			$AddMesage = array('message' => 'Something went wrong please try again', 'response_type' => 'failed');	
		}	

	}	
		
	echo json_encode($AddMesage); die;

}
// Request Test
if(isset($_POST['action']) && $_POST['action'] == 'requestTest'){
	if(isset($_POST['surah-no']) && isset($_POST['user-id'])):

		$surah_nums = $_POST['surah-no'];
		$user_id = $_POST['user-id'];
		$test_lang = $_POST['lang'];
		$test_level = $_POST['test-level'];
		$testType = $_POST['test-type'];
		$searl_arr = null;
		$counter = 0;

		if(isset($surah_nums)):
			foreach($surah_nums as $surah_num):
				if( $counter == count( $surah_nums ) - 1) { 
					$searl_arr .= $surah_num;
				}else{
					$searl_arr .= $surah_num.',';
				}	
				
				$counter++;
			endforeach;

		endif;
			
		$surah_con = new ML_CONNECTION();
		$getQ = $surah_con->connection_db();

		$get_ques_ids = "SELECT * FROM questions WHERE SurahNo in ($searl_arr) AND Type = '$testType' AND testlevel = '$test_level' AND Lang = '$test_lang' ORDER BY RAND()";
		$get_ques_ids = $getQ->query($get_ques_ids);
		$ques_ids = null;
		 while($row = $get_ques_ids->fetch_assoc()) { 
		 	$ques_ids .= $row['ID'].',';
		 }

		$total_questions = $get_ques_ids->num_rows;
		$total_score = 	2 * $total_questions;
		$total_duration = 	0.5 * $total_questions;	
		$resource_id  = 'sdds';
		// $total_sec = time - minutes * 60;

		 
	
			$test_detail = "INSERT INTO test (user_id, TestType, TotalQuestions, TotalScore, Duration, Question_ids, testlevel, Lang) VALUES ('$user_id', '$testType', '$total_questions', '$total_score', '$total_duration', '$ques_ids', '$test_level', '$test_lang')";

 			// echo $test_detail; die;
			if ($getQ->query($test_detail) === TRUE) {

				$del_con = new ML_CONNECTION();
				$del_res = $del_con->connection_db();

				if(isset($surah_nums)):
					foreach($surah_nums as $surah_num):
						$delResource = "DELETE FROM learningresources WHERE SurahNo='$surah_num' AND user_id='$user_id'";
						// echo $delResource; die;
						$delResource = $del_res->query($delResource);
					endforeach;

				endif;

		    	$last_id = $getQ->insert_id;
		    	$test_url = ml_get_option('site_url').'/test.php?mti='.$last_id;
		    	$start_btn = '<a href="'.$test_url.'"><i class="fas fa-play"></i> Start Test Now</a>';

		    	$message = 'Please use the following link to start your test <br>'.$test_url;
				$headers = 'From: nomi.spyko@gmail.com';
				$user_data = ml_get_user_data($user_id);
				$user_email = $user_data['user_email'];
				mail($user_email, 'Test URL from Mualim', $message,$headers);
		    	// echo $test_url; die();
		    	$Mesage = array('message' => 'Your test is ready, Please check your email best of luck', 'response_type' => 'success', 'btn' => $start_btn, 'time' => $total_duration);

		   	 
			} else {
			    $Mesage = array('message' => 'Something went wrong please try again', 'response_type' => 'failed');
			}

	

	endif;	


	echo json_encode($Mesage); die;

}		

// Add Answer from test
if(isset($_POST['action']) && $_POST['action'] == 'addQuestionDetail'){

	if(!empty($_POST['answer']) && !empty($_POST['question_num']) && !empty($_POST['question_id'])){
		$answer = $_POST['answer'];
		$question_id = $_POST['question_id'];
		$question_num = $_POST['question_num'];
		$test_id = $_POST['test_id'];
		$total_question = $_POST['total_question'];
		$current_user_id = $_POST['current_user_id'];
		$question_ids = $_POST['question_ids'];
		 // echo $question_num; die;
		$surah_con = new ML_CONNECTION();
		$surahs = $surah_con->connection_db();

		$surahquery = "INSERT INTO candidateanswers (user_id, TestID, QID, QuestionOrder, GivenAnswer) VALUES ('$current_user_id', '$test_id', '$question_id', '$question_num', '$answer');";
			$result = $surahs->query($surahquery);

			if ($result === TRUE) {
				 $SurahMesage = array('msg'=>'Successfully Submitted', 'status'=> 'success');

				 	if($question_num == 1):
				 		$surahquery = "UPDATE test SET status = 'started' WHERE TestNo = '$test_id'";
						$result = $surahs->query($surahquery);
				 	endif;	

				 	if($question_num == $total_question):
				 		$surahquery = "UPDATE test SET status = 'completed' WHERE TestNo = '$test_id'";
				 		// $delTestList = "DELETE FROM learningresources SET status = 'completed' WHERE TestNo = '$test_id'";
						$result = $surahs->query($surahquery);

						$question_ids =  explode(",",$question_ids);

						if($question_ids)
						foreach($question_ids as $key=>$value):
						    if(is_null($value) || $value == '')
						        unset($question_ids[$key]);
						endforeach;

						$real_answers_arr = array();

						if($question_ids)
							foreach($question_ids as $question_id):
									 // echo "<pre>"; print_r($question_id);exit();
									$select_quest = "SELECT AnswerOption FROM questions WHERE ID = '$question_id'";

									$select_quest = $surahs->query($select_quest);
									$question = $select_quest->fetch_assoc();
									$real_answers_arr[$question_id] = $question['AnswerOption'];
									
							endforeach;		


							$select_answers = "SELECT * FROM candidateanswers WHERE TestID = '$test_id'";

							$select_answers = $surahs->query($select_answers);

							$given_answers_arr = array();

							while ($answer = $select_answers->fetch_assoc()) {
								$q_id = $answer['QID'];
								$given_answers_arr[$q_id] = $answer['GivenAnswer'];
								
							}

							$final_results_arr = array();

							if($real_answers_arr)
							foreach ($real_answers_arr as $key => $real_answer):
								$cand_answer =  $given_answers_arr[$key];

								if($real_answer == $cand_answer){
									$final_results_arr[$key] = 'true';
								}else{
								$final_results_arr[$key] = 'false';
								}
									
							endforeach;
						 $total_quest = count($final_results_arr);

						 $right_answers = count(array_filter($final_results_arr,function($a) {return $a=='true';}));
						 $false_answers = count(array_filter($final_results_arr,function($a) {return $a=='false';}));

						 $total_marks = $total_quest * 2;
						 $obtained_marks = $right_answers * 2;
						 $percent = ($obtained_marks / $total_marks) * 100;

						 $resultsquery = "INSERT INTO results (user_id, TestID, TotalScore, obtained_markes, percentage, rightAnswers, falseAnswers) VALUES ('$current_user_id', '$test_id', '$total_marks', '$obtained_marks', '$percent', '$right_answers', '$false_answers');";
						$result = $surahs->query($resultsquery);

				 	endif;	
				} 
			else
			{
				$SurahMesage = array('msg'=>'Something Went Wrong', 'status'=> 'failed');
			}		
				
			
		
		echo json_encode($SurahMesage); die;
		
	}
}