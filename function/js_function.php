<script>
  // ======================================== Main ========================================
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
      var dorm_id = $(this).data("dorm");
      window.location.href = "index.php?module=dorm&action=see_dorm_room&dorm_id=" + dorm_id + "&floor=" + floor;
    });

    $('#booking_dorm_room_floor').on('change', function() {
      var floor = this.value;
      var dorm_id = $(this).data("dorm");
      window.location.href = "index.php?module=dorm&action=booking_dorm_room&dorm_id=" + dorm_id + "&floor=" + floor;
    });

    $('#list_dorm_room_floor').on('change', function() {
      var floor = this.value;
      var dorm_id = $(this).data("dorm");
      window.location.href = "index.php?module=dorm&action=list_dorm_room&dorm_id=" + dorm_id + "&floor=" + floor;
    });

  });

  function DisableDropify() {
    $('.dropify').attr("disabled", "disabled");
    $('.dropify-wrapper').addClass("disabled");
    $('.dropify-clear').remove();
  }

  function AlertConSubmit(Title, Text, Color, Name) {
    swal({
      title: Title,
      text: Text,
      type: "question",
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonColor: Color,
      confirmButtonText: 'ตกลง',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      submit(Name);
    })
  }

  function AlertConLink(Title, Text, Color, Link) {
    swal({
      title: Title,
      text: Text,
      type: "question",
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonColor: Color,
      confirmButtonText: 'ตกลง',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      window.location.href = Link;
    })
  }

  function AlertError(Title, Text, Type) {
    swal({
      title: Title,
      text: Text,
      type: Type,
      showConfirmButton: true,
      confirmButtonColor: "#4e73df",
      confirmButtonText: 'ตกลง'
    })
  }

  function AlertOnly(Title, Text, Type) {
    swal({
      title: Title,
      text: Text,
      type: Type,
      showConfirmButton: false,
      timer: 1500
    }).catch(function(timeout) {});
  }

  // ======================================== Dorm ========================================
  function get_floor() {
    var dorm = $("#xdorm_id").val();

    var data = {
      'dorm': dorm,
      'STATUS': 'get_floor'
    };
    senddata(JSON.stringify(data));
  }

  function Evidence_pay(dorm_pay_id) {
    var data = {
      'dorm_pay_id': dorm_pay_id,
      'STATUS': 'Evidence_pay'
    };
    senddata(JSON.stringify(data));
  }

  function Evidence_save(dorm_pay_id) {
    if ($("#Evd_img").val() != null && $("#Evd_img").val() != "") {
      var FileData = $("#Evd_img").prop("files")[0];
      var form_data = new FormData();
      var Data = JSON.stringify({
        'dorm_pay_id': dorm_pay_id,
        'STATUS': 'Evidence_save'
      });
      form_data.append("file", FileData);
      form_data.append("DATA", Data);
      $.ajax({
        url: 'process/js_process.php',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(result) {
          $("#btn_save_evd").hide();
          var Title = "อัพโหลดรูปการชำระเงินเรียบร้อย";
          var Text = "";
          var Type = "success";
          AlertOnly(Title, Text, Type);
          DisableDropify();
        }
      });
    }
  }

  function Evidence_view (img) {
    $("#lg_body").empty();
    var Str = "<div class='thumbnail' style='width: 50%; height: auto; margin:0 auto;'";
    Str += "<div class='caption'>";
    Str += "<span id='img0'>";
    Str += "<a href='uploads/"+img+"' data-fancybox='photo'>";
    Str += "<img src='uploads/"+img+"' width='100%' />";
    Str += "</a>";
    Str += "</span>";
    Str += "</div>";
    Str += "</div>";


    $("#lg_body").append(Str);
    $("#lg_modal").modal('show');
  }

  // ======================================== Car ========================================
  function get_car_by_type() {
    var Type = $("#slc_car_type").val();

    var data = {
      'Type': Type,
      'STATUS': 'get_car_by_type'
    };
    senddata(JSON.stringify(data));
  }

  function sh_car_report() {
    var Type = $("#slc_car_type").val();
    var Car = $("#slc_car").val();
    var Start = $("#slc_car_start").val();
    var End = $("#slc_car_end").val();

    if (End >= Start) {
      window.location.href = "index.php?module=report&action=report_booking_car";
    }
  }

  function submit(name) {
    var id = "#smt_" + name;
    $(id).click();
  }

  // ======================================== Equipment ========================================
  function get_qeuip_type() {
    var type = $("#xequip_type").val();

    var data = {
      'type': type,
      'STATUS': 'get_qeuip_type'
    };
    senddata(JSON.stringify(data));
  }

  // ======================================== Signature ========================================
  function user_sign() {
    var idcard = $("#sign_idcard").val();

    if (idcard.length < 13) {
      var Title = "กรอกข้อมูลไม่ครบ";
      var Text = "รหัสบัตรประชาชนต้องไม่ต่ำกว่า 13 หลัก";
      var Type = "warning";
      AlertError(Title, Text, Type);

    } else {
      var data = {
        'idcard': idcard,
        'STATUS': 'user_sign'
      };
      senddata(JSON.stringify(data));
    }
  }

  function user_sign2(idcard) {
    var data = {
      'idcard': idcard,
      'STATUS': 'user_sign'
    };
    senddata(JSON.stringify(data));
  }

  function del_sign(idcard) {
    swal({
      title: "ยืนยันการลบ",
      text: "ต้องการลบลายเซ็นหรือไม่ ?",
      type: "question",
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'ตกลง',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      var data = {
        'idcard': idcard,
        'STATUS': 'del_sign'
      };
      senddata(JSON.stringify(data));
    })

  }

  function To_signature(idcard) {
    window.location.href = "modules/sign/signature.php?idcard=" + idcard;
  }

  // display
  function senddata(data) {
    var form_data = new FormData();
    form_data.append("DATA", data);
    var URL = 'process/js_process.php';
    $.ajax({
      url: URL,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(result) {
        try {
          var temp = $.parseJSON(result);
        } catch (e) {
          console.log('Error#542-decode error');
        }

        if (temp["status"] == 'success') {
          if (temp["form"] == 'logout') {
            window.location.href = '../index.html';
          } else if (temp["form"] == 'get_floor') {
            $("#xFloor").empty();
            $("#xFloor").append("<option value=''>ทุกชั้น</option>");
            for (var i = 0; i < temp['cnt']; i++) {
              var Str = "<option value='" + temp['xFloor'][i] + "'>ชั้น " + temp['xFloor'][i] + "</option>";
              $("#xFloor").append(Str);
            }
          } else if (temp["form"] == 'Evidence_pay') {
            $("#lg_body").empty();
            var Str = "<div class='text-center mb-2'>รูปภาพหลักฐานการชำระเงินค่าหอพัก</div>";
            Str += "<input type='file' id='Evd_img' accept='image/x-png,image/jpeg' class='dropify' />";
            Str += "<div class='col-12 text-center mt-3'><button id='btn_save_evd' onclick='Evidence_save(" + temp['dorm_pay_id'] + ")' class='btn btn-primary'>บันทึก</button></div>";
            $("#lg_body").append(Str);
            $('.dropify').dropify({
              height: 800,
              defaultFile: "uploads/"+temp['evidence_img']
            });
            $("#lg_modal").modal('show');

          } else if (temp["form"] == 'get_car_by_type') {
            $("#slc_car").empty();
            $("#slc_car").append("<option value=''>ทุกคัน</option>");
            for (var i = 0; i < temp['cnt']; i++) {
              var Str = "<option value='" + temp['car_id'][i] + "'>" + temp['car_licence'][i] + "</option>";
              $("#slc_car").append(Str);
            }
          } else if (temp["form"] == 'get_qeuip_type') {
            $("#xEquip").empty();
            $("#xEquip").append("<option value=''>ทุกรายการ</option>");
            for (var i = 0; i < temp['cnt']; i++) {
              var Str = "<option value='" + temp['xEquip'][i] + "'>" + temp['nEquip'][i] + "</option>";
              $("#xEquip").append(Str);
            }
          } else if (temp["form"] == 'user_sign') {
            $("#img_user").attr("src", "uploads/" + temp['picture']);
            $("#sign_name").text(temp['sign_name'] + " " + temp['sign_Lname']);

            if (temp['signature'] == null || temp['signature'] == "") {
              $("#btn_add_sign").attr("onclick", "To_signature(\"" + temp['idcard'] + "\")");
              $("#btn_edit_sign").hide();
              $("#btn_del_sign").hide();
              $("#btn_add_sign").show();
              $("#show_sign").prop("hidden", true);
            } else {
              $("#btn_edit_sign").attr("onclick", "To_signature(\"" + temp['idcard'] + "\")");
              $("#btn_del_sign").attr("onclick", "del_sign(\"" + temp['idcard'] + "\")");
              $("#btn_edit_sign").show();
              $("#btn_del_sign").show();
              $("#btn_add_sign").hide();
              var sign = temp['signature'];
              $("#show_sign").html(sign);
              $("svg").css("width", "100%");
              $("svg").css("height", "100%");
              $("#show_sign").prop("hidden", false);
            }

            $("#show_user").prop("hidden", false);
          } else if (temp["form"] == 'del_sign') {
            user_sign();
          }

        } else if (temp['status'] == "failed") {
          if (temp["form"] == 'user_sign') {
            var Title = "ไม่พบข้อมูล";
            var Text = "";
            var Type = "info";
            AlertOnly(Title, Text, Type);
            $("#show_user").prop("hidden", true);
            $("#show_sign").prop("hidden", true);

          } else if (temp["form"] == 'Evidence_pay') {
            $("#lg_body").empty();
            var Str = "<div class='text-center mb-2'>รูปภาพหลักฐานการชำระเงินค่าหอพัก</div>";
            Str += "<input type='file' id='Evd_img' accept='image/x-png,image/jpeg' class='dropify' />";
            Str += "<div class='col-12 text-center mt-3'><button id='btn_save_evd' onclick='Evidence_save(" + temp['dorm_pay_id'] + ")' class='btn btn-primary'>บันทึก</button></div>";
            $("#lg_body").append(Str);
            $('.dropify').dropify({
              height: 800
            });
            $("#lg_modal").modal('show');
          }
        } else {
          console.log(temp['msg']);
        }
      }
    });
  }
  // end display
</script>