<div id="wrapper">
    <?PHP include "include/header.php"; ?>
    <?PHP include "include/menu.php"; ?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <div class="menu-button-mini">
                    <i class="fa fa-file-text"></i>
                    <p>รายงาน</p>
                </div>
            </div>

            <?PHP
            $yy = date("Y");
            $mm = date("m");
            if (isset($_GET['yy']) && isset($_GET['mm'])) {
                $yy = $_GET['yy'];
                $mm = $_GET['mm'];
            }
            ?>

            <div class="col-lg-12">
                <hr>

                <div style="background: #fff; padding: 20px; min-height: 300px">
                    <?PHP include 'include/menu_report.php'; ?>

                    <div style="padding: 20px">
                        <form action="" method="get">
                            <input type="hidden" name="module" value="report">
                            <input type="hidden" name="action" value="report_alert_report">
                            <div class="form-group">
                                <label class="col-md-2 control-label"
                                       style="font-size: 18px; text-align: right; padding-top: 10px;">เดือน</label>

                                <div class="col-md-3" style="padding-top: 4px;">
                                    <select name="mm" class="form-control" required>
                                        <option <?= $mm == 1 ? "selected" : ""; ?> value="1">
                                            มกราคม
                                        </option>
                                        <option <?= $mm == 2 ? "selected" : ""; ?> value="2">
                                            กุมภาพันธ์
                                        </option>
                                        <option <?= $mm == 3 ? "selected" : ""; ?> value="3">
                                            มีนาคม
                                        </option>
                                        <option <?= $mm == 4 ? "selected" : ""; ?> value="4">
                                            เมษายน
                                        </option>
                                        <option <?= $mm == 5 ? "selected" : ""; ?> value="5">
                                            พฤษภาคม
                                        </option>
                                        <option <?= $mm == 6 ? "selected" : ""; ?> value="6">
                                            มิถุนายน
                                        </option>
                                        <option <?= $mm == 7 ? "selected" : ""; ?> value="7">
                                            กรกฎาคม
                                        </option>
                                        <option <?= $mm == 8 ? "selected" : ""; ?> value="8">
                                            สิงหาคม
                                        </option>
                                        <option <?= $mm == 9 ? "selected" : ""; ?> value="9">
                                            กันยายน
                                        </option>
                                        <option <?= $mm == 10 ? "selected" : ""; ?> value="10">
                                            ตุลาคม
                                        </option>
                                        <option <?= $mm == 11 ? "selected" : ""; ?> value="11">
                                            พฤศจิกายน
                                        </option>
                                        <option <?= $mm == 12 ? "selected" : ""; ?> value="12">
                                            ธันวาคม
                                        </option>
                                    </select>
                                </div>

                                <label class="col-md-1 control-label"
                                       style="font-size: 18px; text-align: center;  padding-top: 10px;">ปี</label>


                                <div class="col-md-3" style="padding-top: 4px;">
                                    <select name="yy" class="form-control" required>
                                        <?PHP for ($y = 2000; $y < 2100; $y++) { ?>
                                            <option <?= $yy == $y ? "selected" : ""; ?>
                                                value="<?= $y; ?>"><?= $y; ?></option>
                                        <?PHP } ?>
                                    </select>
                                </div>


                                <div class="col-md-2 " style="padding-top: 4px; padding-left: 20px">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>

                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>

                        <?PHP
                        $sql = "SELECT * FROM tb_report where month(report_date) = '{$mm}' and year(report_date) = '{$yy}' ";
                        $list = result_array($sql);
                        ?>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="50" class="text-center">ลำดับ</th>
                                <th class="text-center">หัวข้อ</th>
                                <th class="text-center">รายละเอียด</th>
                                <th class="text-center">วันที่</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?PHP foreach ($list as $key => $_list) { ?>
                                <tr>
                                    <td class="text-center"><?= $key + 1; ?></td>
                                    <td class="text-center"><?= $_list['report_topic']; ?></td>
                                    <td class="text-center"><?= $_list['report_detail']; ?></td>
                                    <td class="text-center"><?= $_list['report_date']; ?></td>
                                </tr>
                            <?PHP } ?>

                            <?PHP if (count($list) == 0) { ?>
                                <tr>
                                    <td colspan="7" style="color: red; text-align: center;">ไม่พบข้อมูล</td>
                                </tr>
                            <?PHP } ?>
                            </tbody>
                        </table>

                        <hr>

                        <center>
                            <a href="modules/print/print_report_alert_report.php"
                               target="_blank" class="btn btn-lg btn-primary ">
                                พิมพ์รายงาน
                            </a>
                        </center>

                    </div>

                </div>


            </div>


        </div>


    </div>

</div>



