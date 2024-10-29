<?php require("class/index.class.php");
$slider = new sliders();
$id = $_GET['id'];
$sliders = $slider->getAllSliders();

?>
<?php require('components/header.php') ?>
<?php require('components/nav.php') ?>
<?php require('components/sidebar.php') ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</li></a>
                <li class="breadcrumb-item active">Edit Slider</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="modal-body">
                        <form id="updateForm" enctype="multipart/form-data">
                            <input type="text" class="form-control" aria-label="id" name="id" id="id" aria-describedby="basic-addon1" size="20" value="<?php echo $id; ?>" hidden>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Make</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Title" aria-label="title" name="title" id="title" aria-describedby="basic-addon1" size="20" value="<?php echo $sliders[0]['title']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">Model</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Description" aria-label="description" name="description" id="description" aria-describedby="basic-addon1" size="20" value="<?php echo $sliders[0]['description']; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend ml-5">
                                    <span class="input-group-text" id="basic-addon1" style="width: 150px;">New Banner</span>
                                </div>
                                <input type="file" class="form-control input-control submit" placeholder="Images" aria-label="Images" name="images[]" aria-describedby="basic-addon3" multiple>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-4 text-center my-3" >
                                    <img src="assets/img/welcome-hero/<?php echo $sliders[0]['banner']  ?>" class="rounded" height="auto" width="100%" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary submitbtn">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

</div>
</div>

</main>
<?php require('components/footer.php') ?>

</body>

</html>


<?php require('components/script.php') ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script>
   
    $(document).ready(function() {
        $('#updateForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Use 'this' to refer to the form

            $.ajax({
                url: "actions/edit_slider.php",
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: true,
                            customClass: {
                                confirmButton: 'button btn btn-primary app_style'
                            }
                        }).then(function() {
                            window.location.href = 'sliders.php';
                        });
                    } else if (response.status === 'error') {
                        Swal.fire({
                            icon: 'warning',
                            title: response.message,
                            showConfirmButton: true,
                            customClass: {
                                confirmButton: 'button btn btn-primary app_style'
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error Response:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred',
                        text: 'Please try again later',
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style'
                        }
                    });
                }
            });
        });
    });
</script>