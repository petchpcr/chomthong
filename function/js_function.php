<script>
  // ======================================== Main ========================================
  function AlertError(Title, Text, Type) {
    swal({
      title: Title,
      text: Text,
      type: Type,
      showConfirmButton: true,
      confirmButtonText: 'ตกลง'
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
              var Str = "<option value='"+temp['xFloor'][i]+"'>ชั้น "+temp['xFloor'][i]+"</option>";
              $("#xFloor").append(Str);
            }
          } else if (temp["form"] == 'get_car_by_type') {
            $("#slc_car").empty();
            $("#slc_car").append("<option value=''>ทุกคัน</option>");
            for (var i = 0; i < temp['cnt']; i++) {
              var Str = "<option value='"+temp['car_id'][i]+"'>"+temp['car_licence'][i]+"</option>";
              $("#slc_car").append(Str);
            }
          }
        } else if (temp['status'] == "failed") {
          swal({
            title: '',
            text: '',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showConfirmButton: false,
            timer: 2000,
            confirmButtonText: 'Error!!'
          })
        } else {
          console.log(temp['msg']);
        }
      }
    });
  }
  // end display
</script>