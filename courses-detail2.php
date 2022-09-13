<?php 
    include "./hf/header.php";

?>
<script src="./js/function.js"></script>
 <link rel="stylesheet" href="css/styles.css" />
   <!-- Latest compiled and minified CSS -->
   <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"></script>
  
     <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="./js/function.js"></script> <?php
include('top.html');?>
<!-- sidebar -->
<?php if ($_SESSION['userRole'] == "L") { ?>
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:18%; margin-top:0%;">
    <div class="cimg" style="width:40px; height:40px; justify-content: center; font-size:30px; color:dark-green;  margin-left: 25px;margin-top: 25px;">
    <img src="images/book.png" alt=""  width="90" height="85" style="margin-left:35px; margin-bottom:140px;">
    </div>
   
    <!-- <div class="dropdown-divider"></div> -->
    <button style="margin-top:45px;"  onclick="myFunction('demoAcc')" class="w3-button w3-block w3-left-align">
        Overview</button>
    <div id="demoAcc" class="w3-bar-block w3-hide w3-white w3-card-4">
        <ul class="w3-ul">
            <li>
                <a id="atag"href="#" class="w3-bar-item w3-button">Week 1</a>
            </li>
            <li>
                <a href="#" class="w3-bar-item w3-button">Week 2</a>
            </li>
            <li>
                <a href="#" class="w3-bar-item w3-button">Week 3</a>
            </li>
            <li>
                <a href="#" class="w3-bar-item w3-button">Week 4</a>
            </li>
            
        </ul>
        
    </div>
    <button  id="learningresource"onclick="toggleHidee()" href="#" class="w3-bar-item w3-button">Learning Resources</button>
    <button href="#" id="resource" onclick="toggleHideee()"class="w3-bar-item w3-button">Resources</button>
    <button href="" id="FinalGrades" onclick="toggleHide()"class="w3-bar-item w3-button">Grades</button>
    <!-- <button href="#" id="btn" onclick="toggleHide()"class="w3-bar-item w3-button">Grades</button> -->
 
</div>

<!-- Page Content -->
<div style="margin-left:20%; margin-top: 10%;">

<div class="">


<div id="LearningResource" style="font-size:30px; font-weight: 600; color:darkgreen" class="accordiong">Learning Resources
    <div class="panel">
    <h4> <a href="yourcourse.php">Learn Seerat-Un-Nabi with Muallim </a> </h4> 
    </div>


  
    
    <button class="accordion">Courses</button>
    <div class="panel">
 
<div class="courses-list" id="basic">
			
				
				<ul>
					<?php
                        $courses_no=0;

		                  if(isset($_SESSION['userID']))
                      {
                        
                          
                        $userID = $_SESSION['userID']; 
                      
                      }
  $sql = "SELECT * FROM users u
  INNER JOIN RegistrationCourse r on r.reg_userid=u.user_id 
  INNER JOIN Courses c on r.reg_course=c.course_id WHERE u.user_id='$userID' AND r.reg_status = 'approved'" ;

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$result =sqlsrv_query($conn,$sql);
$row_count = sqlsrv_num_rows( $stmt );
                           
if($row_count>0){
  $courses_no=$row_count;

				    // output data of each row
				 while ( $row = sqlsrv_fetch_array( $stmt) ){
						$_SESSION['courseID']=$row['course_id'];
							
	            ?>
				        <li>
	<div class="list-inner">
							<a class="list-blurb" href="courses-details.php?courseID=<?php echo $row['course_id']; ?>">
								<img class="card-img-top" src="images/courseslogo.jpeg" alt="">
			
                <h3 style="font-weight:normal; font-family:Calibri; align-items:center;"><?php echo $row['course_name']; ?></h3>
        
       
							</a>
						</div>
					</li>
				<?php    }
				} else {
        ?>  <a style="display: inline-block;width: 100%;text-align: center; border-radius:5px; background: red;color: #ffffff;padding: 5px;float:center;margin-left: 5px;">No Course Registered</a>
			<?php	}

				?>
	</ul>
			</div>
      </div> 
<<<<<<< HEAD
=======
<div id ="grade" style="font-size:30px; font-weight: 600;color:darkgreen"class="accordiong">Register Your Course
    <div class="panel">
      <p>Lorem ipsum...</p>
    </div>
>>>>>>> d32b9a08db94467bd58a3d272cbc879457b513b5

    <button class="accordion">View Offer Courses</button>
    <div class="panel">

<<<<<<< HEAD


      <div id ="grade" style="font-size:30px; font-weight: 600;color:darkgreen"class="accordiong">Register Your Course
    <div class="panel">
      <p>Lorem ipsum...</p>
    </div>

    <button class="accordion">View Offer Courses</button>
    <div class="panel">

=======
>>>>>>> d32b9a08db94467bd58a3d272cbc879457b513b5
<div class="courses-list" id="basic">
<a style="color:green; font-size:14px; text-decoration:none;"href="showlearnercourses.php" style ="text-decoration:none;"> Register Course</a> <br>
    </div>
</div>

<<<<<<< HEAD








<div id ="grade" style="font-size:30px; font-weight: 600;color:darkgreen"class="accordiong">Grades

    <button class="accordion">View Course Grades</button>
    <div class="panel">

<div class="courses-list" id="basic">
<a style="color:green; font-size:14px; text-decoration:none;" href="Grades.php?userID=<?php echo $userID;?>&courseID=<?php echo $_SESSION['courseID']; ?>  ">Check your Grades by Clicking Here</a> <br>
    </div>
</div>











=======
>>>>>>> d32b9a08db94467bd58a3d272cbc879457b513b5
<!-- 
      <button class="accordion">Chapters</button>
<a>
  <table class="table table-sm table-success" style="font-family:Calibri; font-size:15px;">
<thead>
  <tr>
    <th scope="col"> Download PDF Files</th>
    <th scope="col">Chapter Name</th>
  </tr>
</thead>
<tbody>
  
<?php 
 
  $sql= "Select c.course_id ,ch.chapter_pdf,ch.chapter_name
  from Courses c INNER JOIN Chapters ch
  ON c.course_id=ch.course_id";
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $stmt = sqlsrv_query( $conn, $sql , $params, $options );
  //$result =sqlsrv_query($conn,$sql);
  while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC )){ ?>
    <tr>
<?php          $chapter_pdf = $row['chapter_pdf']; ?>
    <td> <img src="images/download.svg" style="height:30px; width:25px;"></img><a target="_blank"  href="<?php echo  $chapter_pdf ?> "> Download File</i></a></td>
    <td style="text-decoration:none" colspan="2"><?php echo $row['chapter_name'];?></td>
    





<?php 
 } ?>
 </tr>
 </tbody>
</table>

</div>
</div>


	
</a> -->
</div>

<div id="Course" style="font-size:30px; font-weight: 600; color:darkgreen" class="accordiong">Courses Outcome 
    <div class="panel">
    <h4> <a href="yourcourse.php">Learn Seerat-Un-Nabi with Muallim </a> </h4> 
    </div>










    <button class="accordion">Interactive Learning</button>
    <div class="panel">
      <?php
        if($courses_no>=1){
      ?>
      <div class="courses-list" id="basic">
        <h3>Select Course </h3>
        <ul>
              <?php
                $courses_no=0;
                if(isset($_SESSION['userID'])){
                  $userID = $_SESSION['userID']; 
                }
                $sql = "SELECT * FROM users u
                INNER JOIN RegistrationCourse r on r.reg_userid=u.user_id 
                INNER JOIN Courses c on r.reg_course=c.course_id WHERE u.user_id='$userID'" ;
                $params = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                $result =sqlsrv_query($conn,$sql);
                $row_count = sqlsrv_num_rows( $stmt );
                
                if($row_count>0){
                  // output data of each row
                  $courses_no=$row_count;
                  while ( $row = sqlsrv_fetch_array( $stmt) ){	
              ?>
              <li style="width:150px; height:200px;">
                <div class="list-inner" >
                  <a class="list-blurb" href="Interactive_Learning.php?courseID=<?php echo $row['course_id']; ?>">
                    <img class="card-img-top" src="images/courseslogo.jpeg" alt="">
                    <h3 style="font-weight:normal; font-family:Calibri; align-items:center;"><?php echo $row['course_name']; ?></h3>
                  </a>
                </div>
              </li>
              <?php    }//end of while loop
                } else {
                  echo "0 results";
                }
              ?>
        </ul>
      </div>
      <? }else{ ?>
          <!-- <p>here is noting</p> -->
        <?php } ?>
    </div>      









<!-- <a href="Interactive_Learning.php?coures_id=1017"  style ="text-decoration:none;"><p style="font-size:15px; color:blue;">Learn Concepts & Test Your Knowledge </p> </div> <a> -->
    











      <button class="accordion">Graded/Practice Test</button>
      <div class="panel">
      <a style="color:green; font-size:14px; text-decoration:none;" href="test-list.php">Read Chapters First to Attempt Test</a> <br> 
      </div>
    
      <button class="accordion">Peer Review Based Assignment</button>
      <div class="panel">
        <?php
          if($courses_no>=1){
        ?>
        <div class="courses-list" id="basic">
          <h3>Select Course </h3>
          <ul>
                <?php
                  $courses_no=0;
                  if(isset($_SESSION['userID'])){
                    $userID = $_SESSION['userID']; 
                  }
                  $sql = "SELECT * FROM users u
                  INNER JOIN RegistrationCourse r on r.reg_userid=u.user_id 
                  INNER JOIN Courses c on r.reg_course=c.course_id WHERE u.user_id='$userID'" ;
                  $params = array();
                  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                  $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                  $result =sqlsrv_query($conn,$sql);
                  $row_count = sqlsrv_num_rows( $stmt );
                  
                  if($row_count>0){
                    // output data of each row
                    $courses_no=$row_count;
                    while ( $row = sqlsrv_fetch_array( $stmt) ){	
                ?>
                <li style="width:150px; height:200px;">
                  <div class="list-inner" >
                    <a class="list-blurb" href="prAssignment.php?courseID=<?php echo $row['course_id']; ?>">
                      <img class="card-img-top" src="images/courseslogo.jpeg" alt="">
                      <h3 style="font-weight:normal; font-family:Calibri; align-items:center;"><?php echo $row['course_name']; ?></h3>
                    </a>
                  </div>
                </li>
                <?php    }//end of while loop
                  } else {
                    echo "0 results";
                  }
                ?>
          </ul>
        </div>
        <?php 
          }
          $sql = "SELECT * from PRASSIGN";
        ?>
        <!-- <p  style="font-size:15px; color:blue;">Start Subject Based Peer Review Assignments.</p> -->
      </div>
      


<!-- over all progress of concepts-->

<div id ="grade" style="font-size:30px; font-weight: 600;color:darkgreen"class="accordiong">Overall Progress
    <div class="panel">
      <p>Lorem ipsum...</p>
    </div>

    <button class="accordion">Your Progress</button>
    <div class="panel">

<div class="courses-list" id="basic">
<a style="color:green; font-size:14px; text-decoration:none;"href="overallprogress.php" style ="text-decoration:none;">Progress</a> <br>
    </div>
</div>
<!--Resources-->


<div id ="resourceauthentify" style="font-size:30px; font-weight: 600; color:darkgreen"class="accordiong">Resources
    <div class="panel">
      <p>Lorem ipsum...</p>
    </div>

    <button class="accordion">Resources</button>
    <div class="panel">
    <h4><i class="fas fa-book-open"></i> Authenticity of the Learning Resources</h4>
			<!--<h3>Quranic Text</h3>-->
		<h2>	source(s): <b>Al Raheeq Al Makhtoom</b>  </h2>
		<p style="font-size:20px ;color:black;">	A complete Authentic book on the life of the Prophet (ﷺ).<b>	Maulana Safi Ur Rehman Mubarkpuri </b> is the author of the book <b>Al Raheeq Al Makhtoom .</b>
			 This book was originally written in Arabic language and then, translated into Urdu and english on the demands of the readers.
			  This book is on Seerah of Muhammad ﷺ includes lifespan, childhood, prophethood, good deeds, and much more. .</p>
			<ul class="au-img">
				<li  style=" margin-left:120px "><img src="images/bookfront.jpeg" alt=""></li>
				<li style=" margin-left:120px "><img src="images/bookback.jpeg" alt=""></li>
				
			</ul>
			&nbsp;  
	
			</ul>
			&nbsp;  
	</div>
</div>
</div>
</div>
<?php } 
else if ($_SESSION['userRole'] == "A") { ?>
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:18%; margin-top:0%;">
    <div class="cimg" style="width:40px; height:40px; justify-content: center; font-size:30px; color:dark-green;  margin-left: 25px;margin-top: 25px;">
    <img src="images/book.png" alt=""  width="90" height="85" style="margin-left:35px; margin-bottom:140px;">
    </div>

  <div class="dropdown-divider"></div>
  <button  onclick="myFunction('demoAcc')" style="margin-top:45px;" class="w3-button w3-block w3-left-align">
     Course Managment</button>
  <div id="demoAcc" class="w3-bar-block w3-hide w3-white w3-card-4">
      <ul class="w3-ul">
          <li>
              <a id="atag"href="#" class="w3-bar-item w3-button">Add New Course</a>
          </li>
          <li>
              <a href="#" class="w3-bar-item w3-button">Offer New Course</a></a>
          </li>
          <li>
              <a href="#" class="w3-bar-item w3-button">Verify Courses Registration</a>
          </li>
          <li>
              <a href="#" class="w3-bar-item w3-button">Course Registration Statistics</a>
          </li>
          <li>
              <a href="#" class="w3-bar-item w3-button">View All Offered Courses</a>
          </li>
          
      </ul>
      
  </div>
  <button  id="learningresource"onclick="toggleHidee()" href="#" class="w3-bar-item w3-button">Learners Record Management</button>

  <button id="btn" onclick="toggleHide()"class="w3-bar-item w3-button">Performance Evaluation</button>

</div>

<!-- Page Content -->
<div style="margin-left:20%; margin-top: 10%;">

<div class="">


<div id="LearningResource" style="font-size:30px; font-weight: 600; color:darkgreen" class="accordiong">Courses
  <div class="panel">
  <h4> <a href="yourcourse.php">Learn Seerat-Un-Nabi with Muallim </a> </h4> 
  </div>


  
  <button class="accordion">Courses Record Management</button>
  <div class="panel">

<div class="courses-list" id="basic">
<a style="color:green; font-size:14px; text-decoration:none;"href="Add-Course.php" style ="text-decoration:none;">Add New Course</a> <br>
<a style="color:green; font-size:14px; text-decoration:none;"href="OfferCourses.php" style ="text-decoration:none;">Offer New Course</a><br>
<a style="color:green; font-size:14px; text-decoration:none;"href="coursereg.php" style ="text-decoration:none;">Course Registration Statistics</a> <br>
<a style="color:green; font-size:14px; text-decoration:none;"href="Courses.php" style ="text-decoration:none;">View ALL Courses</a><br>
    </div>


</div>



</div>



<div id="Course" style="font-size:30px; font-weight: 600; color:green;" class="accordiong">Learners 
  <div class="panel">
  <h4> <a href="yourcourse.php"></a> </h4> 
  </div>

  <button class="accordion">Learners Record Management</button>
  <div class="panel">
  <div class="courses-list" id="basic">
  <a style="color:green; font-size:14px; text-decoration:none;" href="learners.php">View All Learners </a> <br> 
  <a style="color:green; font-size:14px; text-decoration:none;" href="learnercoursereg.php">Leaners Course Registraion </a> <br> 
<<<<<<< HEAD
  <a style="color:green; font-size:14px; text-decoration:none;" href="learnersprogress.php" >Learner's Progress Monitoring </a>
=======
  <a style="color:green; font-size:14px; text-decoration:none;" href="learnersprogress.php" >Interactive Learning Progress Monitoring </a>
>>>>>>> d32b9a08db94467bd58a3d272cbc879457b513b5
  </div>
</div>
  <!-- Interactive Learning-->
  

<div id="LearningResource" style="font-size:30px; font-weight: 600; color:darkgreen" class="accordiong">Progress Monitoring
  <div class="panel">
  <h4> <a href="yourcourse.php">Interactive Learning </a> </h4> 
  </div>


  
  <!-- <button class="accordion">Interactive Learning Progress</button>
  <div class="panel">

<div class="courses-list" id="basic">
<a style="color:green; font-size:14px; text-decoration:none;"href="ILprogress.php" style ="text-decoration:none;">Muallim User's Interactive Learning Progress</a> <br>

    </div> -->


</div>

<button class="accordion">Graded Tests Progress</button>
  <div class="panel">

<div class="courses-list" id="basic">
<a style="color:green; font-size:14px; text-decoration:none;"href="Gradedprogress.php" style ="text-decoration:none;">Graded Tests Progress</a> <br>

</div>

</div>

<button class="accordion">Peer Review Based Assignment Progress</button>
  <div class="panel">

  <div class="courses-list" id="basic">
<a style="color:green; font-size:14px; text-decoration:none;"href="#" style ="text-decoration:none;">Peer Review Based Progress</a> <br>

    </div>

</div>



</div>

  <!-- Grades-->
<!--
grades -->

<div id ="grade" style="font-size:30px; font-weight: 600;color:darkgreen"class="accordiong">Learners Performance Evaulation
  <div class="panel">
    <p></p>
  </div>

  <button class="accordion">Graded & Practice Test Scoring</button>
  <div class="panel">
  <div class="courses-list" id="basic">
  <a href="viewscoring.php"  style ="text-decoration:none; font-size:14px; color:green;">View Scoring </a> </div> 
  




  </div>
   

</div>
</div>
</div>

<?php } ?>


</div>

    
    <script>

function toggleHidee() {
        let learningresource= document.getElementById("learningresource");
        let LearningResource= document.getElementById("LearningResource");
        if (LearningResource.style.display != "none") {
          LearningResource.style.display = "none";
        } else {
          LearningResource.style.display = "block";
        }
      }


function toggleHide() {
        let btn = document.getElementById("btn");
        let grade = document.getElementById("grade");
        if (grade.style.display != "none") {
          grade.style.display = "none";
        } else {
          grade.style.display = "block";
        }
      }
     
      
function toggleHideee() {
        let resource = document.getElementById("resource");
        let resourceauthentify= document.getElementById("resourceauthentify");
        if (resourceauthentify.style.display != "none") {
          resourceauthentify.style.display = "none";
        } else {
          resourceauthentify.style.display = "block";
        }
      }
     
      
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
          /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
          this.classList.toggle("active");

          /* Toggle between hiding and showing the active panel */
          var panel = this.nextElementSibling;
          if (panel.style.display === "block") {
            panel.style.display = "none";
          } else {
            panel.style.display = "block";
          }
        });
      }
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
          this.classList.toggle("active");
          var panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          }
        });
      }
    </script>
  </body>
</html>
    </div>
    </div>
    </div>
    
    


