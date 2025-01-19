<?php 
include_once('layouts/header.php');
session_start(); 
if(isset($_SESSION['data'])){
    $data = $_SESSION['data'];
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto mt-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Student</h3>
                </div>
                <?php 
                    if(isset($_GET['msg'])){ ?>
                        <h4 class="text-danger"><?= $_GET['msg']; ?></h4>
                    <?php }
                    if(isset($_SESSION['success_msg'])){ ?>
                        <h4 class="text-primary"><?= $_SESSION['success_msg']; ?></h4>
                  <?php session_destroy();  }
                ?>
                <div class="card-body">
                    <div class="form">
                        <form action="crud/crud.php" method="POST" enctype="multipart/form-data">
                            <div>
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="fname" value="<?php echo @$data['fname'];  ?>">
                            </div>
                            <div>
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="lname" value="<?php echo @$data['lname']; ?>">
                            </div>
                            <br>
                            <div>
                                <label for="">Photo</label>
                                <input type="file" name="photo" class="formk-control">
                            </div>
                            <br>
                            <button class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php') ?>