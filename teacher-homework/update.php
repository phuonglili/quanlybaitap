<?php
include('config/constants.php')
?>
<?php
include('templates/header.php')
?>
<?php
$name_hw = $require = $time_st = $time_ex  = "";
$name_hw_err = $require_err = $time_st_err = $time_ex_err  = "";
if (isset($_POST['id_hw']) && empty($_POST["id_hw"])) {
    $id_hw = $_POST["id_hw"];
    // $input_file = trim($_POST["name"]);
    // if(empty($input_file)){
    //     $name_hw_err = "Hãy chọn file";
    // }
    // else{
    //     $name_hw = $input_file;
    // }
    $input_require = trim($_POST["yeucau"]);
    if (empty($input_require)) {
        $require_err = "Hãy nhập yêu cầu";
    } else {
        $require = $input_require;
    }
    $input_time_ex = trim($_POST["date"]);
    if (empty($input_time_ex)) {
        $time_ex_err = "Hãy nhập hạn nộp";
    } else {
        $time_ex = $input_time_ex;
    }
    if (empty($name_hw_err) && empty($require_err) && empty($time_ex_err)) {
        $sql = "UPDATE give_hw set name_hw='$name_hw', require='$require', time_ex='$time_ex' where id_hw = '$id_hw'";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_require, $param_time_st, $param_time_ex, $param_id_hw);
            $param_name = $name_hw;
            $param_require = $require;
            $param_time = $time_st;
            $param_time = $time_ex;
            $param_id_hw = $id_hw;
            if (mysqli_stmt_execute($stmt)) {
                header("location: exercise.php");
                exit();
            } else {
                echo "Sửa thất bại";
            }
        }
    }
    mysqli_close($conn);
} else {
    if (isset($_GET["id_hw"]) && !empty(trim($_GET["id_hw"]))) {
        $id_hw = trim($_GET["id_hw"]);
        $sql = "SELECT * FROM give_hw WHERE id_hw = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id_hw);
            $param_id_hw = $id_hw;
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $name_hw = $row["name_hw"];
                    $require_hw = $row["require"];
                    $time_st = $row["time_st"];
                    $time_ex = $row["time_ex"];
                }
            } else {
                header("location: exercise.php");
                exit();
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
            <h2>Sửa thông tin bài tập</h2>
        </div>

        <!-- sửa -->
        <div class="container col-md-12 mx-auto">
            <form action="<?php echo htmlspecialchars(basename($_SERVER["REQUEST_URI"]));?>" METHOD="POST">
                <div class="col-md-6 mx-auto">
                    <div class="form-group <?php echo(!empty($name_hw_err))? 'has-error':''; ?>">
                        <label><b>Bài tập</b></label>
                        <input type="file" class="form-control" name="name" accept="image/*">
                        <span class="help-block"><?php echo $name_hw_err; ?></span>
                    </div>
                    <div class="form-group <?php echo(!empty($require_err))? 'has-error':''; ?>">
                        <label><b>Yêu cầu</b></label>
                        <input type="text" class="form-control" name="yeucau" placeholder="Yêu cầu" >
                        <span class="help-block"><?php echo $require_err; ?></span>
                    </div>
                    <div class="form-group <?php echo(!empty($time_ex_err))? 'has-error':''; ?>">
                        <label><b>Hạn nộp</b></label>
                        <input type="datetime-local" id="meeting-time" class="form-control" name="date" placeholder="Nhập hạn nộp bài">
                        <span class="help-block"><?php echo $time_ex_err; ?></span>
                    </div>
                    <input type="hidden" name = "id_hw" value = "<?php echo $id_hw; ?>"/>
                    <input type="submit" class="btn btn-primary" name="submit" value="Sửa">

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