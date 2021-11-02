<?php
include('config/constants.php');
?>
<?php
include('templates/header.php')
?>
<?php
// $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
// $path = 'uploads/';
?>

<?php
$name_hw =$require =$time_st = $time_ex  = "";
$name_hw_err =$require_err =$time_st_err = $time_ex_err  = "";
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    // $input_file = trim($_POST["name"]);
    // if(empty($input_file)){
    //     $name_hw_err = "Hãy chọn file";
    // }
    // else{
    //     $name_hw = $input_file;
    // }
    $input_require = trim($_POST["yeucau"]);
    if(empty($input_require)){
        $require_err = "Hãy nhập yêu cầu";
    }
    else{
        $require = $input_require;
    }
    $input_time_ex = trim($_POST["date"]);
    if(empty($input_time_ex)){
        $time_ex_err = "Hãy nhập hạn nộp";
    }
    else{
        $time_ex = $input_time_ex;
    }

if(empty($name_hw_err) && empty($require_err) && empty($time_ex_err)){
    $sql = "INSERT INTO give_hw (name_hw, require, time_st, time_ex) VALUES ('$name_hw', '$require','$time_st' '$time_ex')";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssd", $param_name, $param_require, $param_time_st, $param_time_ex);
    $param_name =$name_hw;
    $param_require = $require;
    $param_time = $time_st;
    $param_time = $time_ex;
    if(mysqli_stmt_execute($stmt)){
        header("location: exercise.php");
        exit();
    } else{
        echo "Thêm thất bại";
    }
}
}
mysqli_close($conn);
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<div class="main-content">
    <div class="wrapper">
        <div class="alert alert-success text-center" role="alert">
            <h2>Thêm bài tập</h2>
        </div>

        <!-- them -->
        <div class="container col-md-12 mx-auto">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" METHOD="POST">
                <div class="col-md-6 mx-auto">
                    <div class="form-group <?php echo(!empty($name_hw_err))? 'has-error':''; ?>">
                        <label>Bài tập</label>
                        <input type="file" class="form-control" name="name" accept="image/*">
                        <span class="help-block"><?php echo $name_hw_err; ?></span>
                    </div>
                    <div class="form-group <?php echo(!empty($require_err))? 'has-error':''; ?>">
                        <label>Yêu cầu</label>
                        <input type="text" class="form-control" name="yeucau" placeholder="Yêu cầu" >
                        <span class="help-block"><?php echo $require_err; ?></span>
                    </div>
                    <div class="form-group <?php echo(!empty($time_ex_err))? 'has-error':''; ?>">
                        <label>Hạn nộp</label>
                        <input type="datetime-local" id="meeting-time" class="form-control" name="date" placeholder="Nhập hạn nộp bài">
                        <span class="help-block"><?php echo $time_ex_err; ?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Thêm">

                </div>
            </form>

        </div>
    </div>
</div>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
echo date('d/m/Y - H:i:s');
?>
<?php
include('templates/footer.php');
?>