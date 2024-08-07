<?php
// Include the header
include 'layout/header.php';

// Check if a file has been uploaded
if(isset($_FILES['file'])) {
    $errors = array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    
    // Split the file name to get the extension
    $file_parts = explode('.', $_FILES['file']['name']);
    $file_ext = strtolower(end($file_parts));
    
    // Define allowed file extensions
    $extensions = array("jpeg", "jpg", "png", "pdf", "doc", "docx");

    // Check if the file extension is allowed
    if(in_array($file_ext, $extensions) === false) {
        $errors[] = "Extension not allowed, please choose a JPEG, PNG, PDF, DOC, or DOCX file.";
    }

    // Check if the file size is within the limit (5MB)
    if($file_size > 5242880) {
        $errors[] = 'File size must be less than 5 MB';
    }

    // If no errors, move the file to the uploads directory
    if(empty($errors) == true) {
        // Check if the uploads directory exists, if not, create it
        if(!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        
        if(move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
            echo "Success: File uploaded!";
        } else {
            echo "Failed to upload file.";
        }
    } else {
        foreach($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload File</h1>
    </div>

    <div class="container">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Choose file to upload</label>
                <input type="file" class="form-control" name="file" id="file">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<!-- Footer -->
<?php include 'layout/footer.php'; ?>
<!-- End of Footer -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>
