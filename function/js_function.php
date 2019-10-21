<script>
  // ======================================== Main ========================================
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
      confirmButtonText: 'ตกลง',
      timer: 1500
    })
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
          }
        } else {
          console.log(temp['msg']);
        }
      }
    });
  }
  // end display
</script>