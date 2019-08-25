<?php 
require_once("phplib/header.php");
require_once("phplib/classes/VideoDetailsFormProvider.php");


if(!User::isLoggedIn()) {
    echo"<script>alert('You must be signed in to perform this action')</script>";
}

?>


<div class="column">

    <?php
    $formProvider = new VideoDetailsFormProvider($con);
    echo $formProvider->createUploadForm();
    ?>

</div>

<script>
$("form").submit(function() {
    $("#loadingModal").modal("show");
});
</script>



<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body" style="color:violet;">
        Please wait. This might take a while.
        <img src="designer/images/icons/loading-spinner.gif">
      </div>

    </div>
  </div>
</div>




<?php require_once("phplib/footer.php"); ?>
                