<?php
session_start();
$page = 'lend'; ?>
<?php
include "header.php";
include  "fucntion_query.php";
?>
<?php
$name = $_POST["dat"]; // สม

$sql = "SELECT * FROM tb_book WHERE book_name LIKE '%$name%' ORDER BY book_name ASC";
$result = mysqli_query($conn, $sql);
$countt = mysqli_num_rows($result);
$order = 1;

$sqll = "SELECT * FROM tb_book WHERE book_status ='ปกติ'&&'ถูกยืม';";
$resultt = mysqli_query($conn, $sqll);
$count = mysqli_num_rows($resultt)
?>

<body>
    <!-- Navigation -->
    <?php include "navbar.php"; ?>
    <!-- Page Content -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">

            </div>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><?= "ยินดีต้อนรับ คุณ" . $user->name . " " . $user->lastname ?></li>
            </ol>
        </nav>

        <div class="jumbotron">
            <div class="row">
                <div class="col-lg-12 ">
                    <h2 class="display-5 text-center">ข้อมูลหนังสือทั้งหมด</h2>
                    <br>
                    <?php if ($countt > 0) { ?>

                        <form action="save_history.php" method="post">
                            <div class="container">
                                <?php
                                ?>

                                <table id="example" class="table table-hover table-bordered table-dark" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="table-active">
                                            <th width="5%">ลำดับ</th>
                                            <th width="30%">ชื่อหนังสือ</th>
                                            <th width="20%">ชื่อผู้เขียน</th>
                                            <th width="20%">รหัสหนังสือ</th>
                                            <th width="10%">ปี</th>
                                            <th width="10%">อัปโหลด</th>
                                            <th width="5%">สถานะ</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {

                                        ?>
                                            <?php
                                            while ($rowa = mysqli_fetch_assoc($resultt)) {
                                                $roww = $rowa;
                                                $disabled = '';
                                                if ($roww == 'ปกติ') {
                                                    $status = 'info';
                                                } elseif ($roww == 'ถูกยืม') {
                                                    $status = 'warning';
                                                    $disabled = 'disabled';
                                                } elseif ($roww == 'หาย') {
                                                    $status = 'danger';
                                                    $disabled = 'disabled';
                                                } else {
                                                    $status = 'secondary';
                                                    $disabled = 'disabled';
                                                }
                                                $checked = '';
                                                if ($_SESSION["book_id"] == 'book_id') {
                                                    $checked = 'checked';
                                                }
                                            }

                                            ?>

                                            <tr>
                                                <td>
                                                    <?php echo $order++; ?>
                                                </td>


                                                <td> <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="<?php echo $row["book_id"]; ?>" name="book_id[]" <?= $disabled ?> <?= $checked ?>>
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description"><?php echo $row["book_name"] ?></span>
                                                        <a href="<?php $row["book_name != '' "] ?><?php echo $row["book_name : '#'"]; ?>" target="_blank"><?php echo $row["book_name"] != '' ? '<span class="badge badge-dark"></span>' : ''; ?></a>
                                                    </label></td>
                                                <td><?php echo $row["book_user"]; ?></td>
                                                <td><?php echo $row["book_code"]; ?></td>
                                                <td><?php echo $row["book_year"]; ?></td>
                                                <td><?= DateThai($row["book_date"]) ?></td>

                                                <td>
                                                    <h5><span class="warning badge-<?= $status ?>"><?php echo $row["book_status"]; ?></span></h5>

                                            </tr>


                                        <?php } ?>
                                    </tbody>



                                </table>
                            <?php } else { ?>
                                <div class="alert alert-danger">
                                    <b>ไม่พบข้อมูลที่ค้นหา !!!<b>
                                </div>
                            <?php } ?>
                            </div>

                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-7">
                                    <input type="submit" class="btn btn-success " name="submit" id="submit" value="ยืม">
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.0.0-beta/dt-1.10.16/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                paging: false
            });

            $("form").submit(function() {

                var checked = []
                $("input[name='book_id[]']:checked").each(function() {
                    checked.push(parseInt($(this).val()));
                });

                if (checked.length == 0) {
                    alert("กรุณาเลือกหนังสือที่ต้องการยืม !");
                    return false;
                } else {
                    alert("ทำการยืมเรียบร้อย !");
                    return true;
                }

            });
        });
    </script>
</body>

</html>