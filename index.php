<!DOCTYPE html>

<head>
    <?PHP include "include/script.php"; ?>
    <style>
        /* .thumbnail {
            overflow: hidden;
        } */


        /* @media (min-width: 320px) and (max-width: 767px) {
            .menu-in-top {
                position: absolute;
                top: 0px;
                left: 100px;
            }

            #wrapper{
                margin-top: 60px !important;
            }

            .alert_index{
                right: 40% !important;
            }
        } */
    </style>
</head>

<body class="bg-gradient-warning">

    <?PHP include "function/js_function.php"; ?>

    <?PHP
    if (!($_SESSION['status'] >= 0)) {
        echo "<script>window.location.href='login.php';</script>";
    }
    if (empty($_GET['module'])) {
        $module = "home";
        $action = "index";
    } else {
        $module = $_GET['module'];
        $action = $_GET['action'];
    }

    include("modules/$module/$action.php");

    ?>

    <div class="modal fade" id="hrefModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -10px;"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>

    <div id="lg_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div id="lg_body" class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <?PHP include "include/script_js.php"; ?>
</body>
<script>
</script>

</html>