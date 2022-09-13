<?php require('./hf/header.php'); //Muallim's Main Header
    include './includes/Connection.php';

if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
	$_SESSION['errors'] = array();
}

function unsetSessions(){
			
    unset($_SESSION['Ques_statement']);
    unset($_SESSION['Ques_weightage']);
  

}
$Question_no =$Questionstatement =$choice=$answer=$concept_id=$chapter_id= $sectionID = $courseID=$Quesweightage="";


if( $_GET['courseID'] != ""  &&  $_GET['chapter_id'] != "" && $_GET['sectionID'] != "" && $_GET['concept_id'] != "" ){
 
    $courseID = $_GET['courseID'];
 
    $chapter_id = $_GET['chapter_id'];
 
    $sectionID = $_GET['sectionID'];
  
    $concept_id = $_GET['concept_id'];
 
  
}else{
  
    header("location:Concept-details.php?sectionID=".$sectionID."&courseID=".$courseID."&chapter_id=".$chapter_id."&concept_id=".$concept_id);
					
    exit();
}

?>


<script src="./js/function.js"></script>




<div class="container mt-5 bg-secondary">
</div>

<div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>

                <div class="card mt-5">
                    <div class="card-header">
                        <h4> Create Question Bank!
               
                        <a href="javascript:void(0)" class="add-more-form float-end btn btn-success ml-5"> <i class="fa fa-plus" aria-hidden="true"></i>Add  Question</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="save-question.php?courseID=<?php echo $courseID; ?>&sectionID=<?php echo $sectionID;?>&concept_id=<?php echo $concept_id;?> &chapter_id=<?php echo $chapter_id;?>" method="POST">
                        
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for=""> Question no </label>
                                            <input type="text" name="Ques_no[]" class="form-control" required placeholder="Question no">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for="">Question Statement</label>
                                            <input type="text" name="Ques_statement[]" class="form-control" required placeholder="Ques_statement">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for="">Choice 1</label>
                                            <input type="text" name="choice[]" class="form-control" required placeholder="Choice 1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for="">Choice 2</label>
                                            <input type="text" name="choice[]" class="form-control" required placeholder="Choice 2">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for="">Choice 3</label>
                                            <input type="text" name="choice[]" class="form-control" required placeholder="Choice 3">
                                        </div>  
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for="">Choice 4</label>
                                            <input type="text" name="choice[]" class="form-control" required placeholder="Choice 4">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for="">Hint</label>
                                            <input type="text" name="hint" class="form-control" required placeholder="Hint">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for="">answer</label>
                                            <input type="text" name="answer[]" class="form-control" required placeholder="correct Answer">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label for=""> Ques_weightage </label>
                                            <input type="text" name="Ques_weightage[]" class="form-control" required placeholder="Ques_weightage">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                            <button type="submit" name="save_multiple_data" class="btn btn-success">Save All Question</button>
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

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                                <div class="row">\
                                <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Questionno</label>\
                                            <input type="text" name="Ques_no[]" class="form-control" required placeholder="Ques_no">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">QuestionStatement</label>\
                                            <input type="text" name="Ques_statement[]" class="form-control" required placeholder="Ques_statement">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Choice 1</label>\
                                            <input type="text" name="choice[]" class="form-control" required placeholder="Choice 1">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Choice 2</label>\
                                            <input type="text" name="choice[]" class="form-control" required placeholder="Choice 2">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Choice 3</label>\
                                            <input type="text" name="choice[]" class="form-control" required placeholder="Choice 3">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Choice 4</label>\
                                            <input type="text" name="choice[]" class="form-control" required placeholder="Choice 4">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Hint</label>\
                                            <input type="text" name="hint" class="form-control" required placeholder="Hint">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Answer</label>\
                                            <input type="text" name="answer[]" class="form-control" required placeholder="Answer">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <label for="">Ques weightage</label>\
                                            <input type="text" name="Ques_weightage[]" class="form-control" required placeholder="Ques_weightage">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-3">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn btn btn-danger">Remove</button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>');
            });

        });
    </script>

</body>
</html>
