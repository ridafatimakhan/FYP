<?php include('./hf/header.php');
    $userid=$_SESSION['userID'];
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $Cname= $_POST['cname'];
    $ptage= $_POST['ptage'];
?>


<section class=" ">

    <div class="container">
<div class="row mx-auto">
    <div class="col-9 mx-auto">
    <button class="btn btn-primary btn-sm btn-block mb-2" onclick="printCertificate()">Export</button>

    </div>
</div>

    <div class="card p-3" id="print_area">
<div class="card" style="border: solid; border-color: green;" >
<div class="card " style="border: solid; border-color: green;">

<div class="card  m-1 p-2" style="border: solid; border-color: green;">


<div class="row mx-auto text-center">
    <div class="col-12 mx-auto">
    <img src="<?php echo base?>/images/certificate.jpeg" width="220" height="120"> </img>
    </div>
</div>
<div class="row mx-auto text-center" style="font-family:courier;">
    <div class="col-12 mx-auto">
        <h1 class="mt-3 font-weight-bold text-success">CERTIFICATE OF COMPLETTION</h1>
    <h4 class="mt-3">This is to certify that</h4>
    <h4 class="font-weight-bold"><?php echo $fname; echo " "; echo $lname; ?></h4>

    <h4 class="mt-3" >has completed the course</h5>
    <h4 class="font-weight-bold"><?php echo $Cname;?></h4>

    <h4 class="mt-3" >with a consolidated percentage of </h5> 
    <h4 class="font-weight-bold"><?php echo $ptage; ?></h4>

    <h4 class="mt-3" >Awarded Date </h5> 
    <h4 class="font-weight-bold" ><?php echo date('d F, Y');  ?> </h5> 

    </div>
    
</div>
</div>


</div>
</div>

</div>

</div>
    <!-- 
//=================================================================== 
                    Course Group Section_content end here                        
-->
</section>

<?php include('../../../templates/admin/footer.php') ?>