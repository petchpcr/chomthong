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

    <?PHP
    if (empty($_GET['module'])) {
        $module = "home";
        $action = "index";
    } else {
        $module = $_GET['module'];
        $action = $_GET['action'];
    }

    include("modules/$module/$action.php");

    ?>

    <script>
        $(document).ready(function() {
            $("#hrefModal").on("show.bs.modal", function(e) {
                var link = $(e.relatedTarget);
                $(this).find(".modal-body").load(link.attr("href"));
                $("#table-js_wrapper").remove();
            });

            $('#hrefModal').on('hidden.bs.modal', function() {
                location.reload();
            })

            $('#dorm_room_floor').on('change', function() {
                var floor = this.value;
                window.location.href = "index.php?module=dorm&action=see_dorm_room&dorm_id=<?= $dorm_id; ?>&floor=" + floor;
            });

            $('#booking_dorm_room_floor').on('change', function() {
                var floor = this.value;
                window.location.href = "index.php?module=dorm&action=booking_dorm_room&dorm_id=<?= $dorm_id; ?>&floor=" + floor;
            });

            $('#list_dorm_room_floor').on('change', function() {
                var floor = this.value;
                window.location.href = "index.php?module=dorm&action=list_dorm_room&dorm_id=<?= $dorm_id; ?>&floor=" + floor;
            });
        });
    </script>

    <?PHP include "function/js_function.php"; ?>

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

    <?PHP include "include/script_js.php"; ?>
</body>

</html>