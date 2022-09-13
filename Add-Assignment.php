<?php include "./hf/header.php";
    if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
        $_SESSION['errors'] = array();
    }
    $Question_no =$Questionstatement =$chapter_id= $sectionID = $courseID="";


    if( $_GET['courseID'] != ""  &&  $_GET['chapter_id'] != "" && $_GET['sectionID'] != "" ){
    
        $courseID = $_GET['courseID'];
    
        $chapter_id = $_GET['chapter_id'];
    
        $sectionID = $_GET['sectionID'];
    
        // $concept_id = $_GET['concept_id'];
    
    
    }else{
    
        header("location:Concept-details.php?sectionID=".$sectionID."&courseID=".$courseID."&chapter_id=".$chapter_id."&concept_id=".$concept_id);
                        
        exit();
    }
?>
<div class="container" style="margin-top:10%;">
                <?php 
                    if(isset($_SESSION['Qstatus']))
                    {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                                <strong></strong> <?php echo $_SESSION['Qstatus']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['Qstatus']);
                    }
                ?>
    <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4> Create Peer-Review Assignment!
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="saveAssign.php" method="POST">
                            <input type="text" name="total_questions" value="0" id="total_question_bank" hidden>

                            <div class="card-body border">
                                <div class="main-form mt-3 ">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group mb-2">
                                                <label for="" style="font-family:Calibri; font-size:20px;">Assignment Tittle</label>
                                                <input type="text" name="assignt" class="form-control" required placeholder="Assignment Tittle">
                                            </div>
                                        </div>
                                        <div class="col-md-10"> 
                                            <div class="form-group mb-2">
                                                <label for="" style="font-family:Calibri; font-size:20px;">Assignment Marks</label>
                                                <input type="text" name="assignm" class="form-control" required placeholder="Assignment Marks">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group mb-10">
                                                <label for="" style="font-family:Calibri; font-size:20px;">Set Deadline</label>
                                                <input type="date" name="assignd" class="form-control" required placeholder="Choice 1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="paste-new-forms"></div> -->

                            <div class="card-body">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4 style="font-family:Calibri; font-size:25px;"> Create Assignment Question!
                                            <a href="javascript:void(0)" class="add-more-form float-end btn btn-success ml-5"> <i class="fa fa-plus" aria-hidden="true"></i>Add  Question</a>
                                        </h4>
                                    </div>
                                    <div class="card-body" style="box-sizing:border-box; float:center; display:flex; font-family:Calibri">
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                                        <!-- QUESTIONS STARTS FROM HERE -->
                         
                                            <div class="main-form mt-3 border " style="width:50%;">
                                                <center><h5 style="font-size:25px; margin-top:7px;">Questions</h5><br></center>
                                                <div class="row w-25 border-bottom border-warning mx-auto"></div>
                                                <div class="row" style="margin-left:10px;">
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2" >
                                                            <label for=""> Question no </label>
                                                            <input type="number" name="questionNO_0[]" class="form-control" required placeholder="Question no">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Question Statement</label>
                                                            <input type="text" name="questionState_0[]" class="form-control" required placeholder="Question statement">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Activity 1</label>
                                                            <input type="text" name="Activity1_0[]" class="form-control" required placeholder="Activity 1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Activity-1 Marks</label>
                                                            <input type="number" name="Activity1m_0[]" class="form-control" required placeholder="Activity-1 Marks">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Activity 2</label>
                                                            <input type="text" name="Activity2_0[]" class="form-control" required placeholder="Activity 2">
                                                        </div>  
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Activity-2 Marks</label>
                                                            <input type="number" name="Activity2m_0[]" class="form-control" required placeholder="Activity-2 Marks">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Activity 3</label>
                                                            <input type="text" name="Activity3_0[]" class="form-control" required placeholder="Activity 3">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Activity-3 Marks</label>
                                                            <input type="number" name="Activity3m_0[]" class="form-control" required placeholder="Activity-3 Marks">
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <!-- <div class="paste-new-forms"></div> -->


                                            <!-- QUESTIONS ENDS HERE -->
<!------------------------------------------------------------------------------------------------------------------------------------->
                                            <!-- RUBRIC STARTS FROM HERE -->



                                            <div class="main-form mt-3 border" style=" margin-left:10px; width:50%;">
                                                <center><h5 style="font-size:25px; margin-top:7px;">Rubric</h5><br></center>
                                                <div class="row w-25 border-bottom border-warning mx-auto"></div>
                                                <div class="row" style="margin-left:10px;">
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for=""> Question no </label>
                                                            <input type="text" name="RQues_no_0[]" class="form-control" required placeholder="Question no">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Answer</label>
                                                            <input type="text" name="RAnswer_0[]" class="form-control" required placeholder="Answer">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Question Max Points</label>
                                                            <input type="text" name="RQues_max_p_0[]" class="form-control" required placeholder="Question Max Points">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Question Avg. Points</label>
                                                            <input type="text" name="RQues_avg_p_0[]" class="form-control" required placeholder="Question Avg. Points">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-2">
                                                            <label for="">Question Min. Points</label>
                                                            <input type="text" name="RQues_min_p_0[]" class="form-control" required placeholder="Question Min. Points">
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            





                                            <!-- RUBRIC ENDS HERE -->
<!-------------------------------------------------------------------------------------------------------------------------------------->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="box-sizing:border-box; float:center; display:flex; font-family:Calibri">
                                <div class="paste-new-forms"></div>
                                <div class="paste-new-forms2"></div>
                            </div>
                            
                            <input type="hidden" name="courseID" value="<?php echo $courseID; ?>"/> 
                            <input type="hidden" name="chapterID" value="<?php echo $chapter_id; ?>"/>
                            <input type="hidden" name="sectionID" value="<?php echo $sectionID; ?>"/>


                            <button type="submit" name="save_multiple_data" class="btn btn-success">Save Assignment</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
            let question_count=0;

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                question_count=question_count+1;
                $('#total_question_bank').prop({'value':question_count});

            $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                                <center><h5 style="font-size:25px; margin-top:7px;">Questions</h5><br></center>\
                                <div class="row w-25 border-bottom border-warning mx-auto"></div>\
                                <div class="row">\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Questionno</label>\
                                            <input type="text" name="Ques_no_'+question_count+'[]" class="form-control" required placeholder="Ques_no">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">QuestionStatement</label>\
                                            <input type="text" name="Ques_statement_'+question_count+'[]" class="form-control" required placeholder="Ques_statement">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Activity 1</label>\
                                            <input type="text" name="Activty1_'+question_count+'[]" class="form-control" required placeholder="Activity 1">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Activity 1 marks</label>\
                                            <input type="text" name="Activty1m_'+question_count+'[]" class="form-control" required placeholder="Activity 1 marks">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Activity 2</label>\
                                            <input type="text" name="Activty2_'+question_count+'[]" class="form-control" required placeholder="Activity 2 ">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Activity 2 marks</label>\
                                            <input type="text" name="Activty2m_'+question_count+'[]" class="form-control" required placeholder="Activity2 marks">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Activity 3</label>\
                                            <input type="text" name="Activty3_'+question_count+'" class="form-control" required placeholder="Activity 3 ">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Activity 3 marks</label>\
                                            <input type="text" name="Activty3m_'+question_count+'[]" class="form-control" required placeholder="Activity 3 marks">\
                                        </div>\
                                    </div>\
                                    </div>\
                                </div>\
                            </div>');
            $('.paste-new-forms2').append('<div class="main-form mt-3 border-bottom">\
                                <center><h5 style="font-size:25px; margin-top:7px;">Rubric</h5><br></center>\
                                <div class="row w-25 border-bottom border-warning mx-auto"></div>\
                                <div class="row">\
                                <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Question no</label>\
                                            <input type="text" name="RQues_no_'+question_count+'[]" class="form-control" required placeholder="Ques_no">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Answer</label>\
                                            <input type="text" name="RAnswer_'+question_count+'[]" class="form-control" required placeholder="Answer">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Ques. Max points</label>\
                                            <input type="text" name="RQues_max_p_'+question_count+'[]" class="form-control" required placeholder="Max Points">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Ques. Avg. points</label>\
                                            <input type="text" name="RQues_avg_p_'+question_count+'[]" class="form-control" required placeholder="Avg. Points">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-10">\
                                        <div class="form-group mb-2">\
                                            <label for="">Ques. Min points</label>\
                                            <input type="text" name="RQues_min_p_'+question_count+'[]" class="form-control" required placeholder="Minimum Points">\
                                        </div>\
                                    </div>\
                                    </div>\
                                </div>\
                            </div>');
            });


            
    });
</script>




<!-- Extra material that maybe used later

<a href="javascript:void(0)" class="add-more-form float-end btn btn-success ml-5"> <i class="fa fa-plus" aria-hidden="true"></i>Add  Question</a> -->
