<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>without bootstrap</title>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body class="bg-gradient-white">
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-">
              <h2 class="mb-3 text-center">สมัครเป็นผู้เรียน</h2>
              <div class="row">
                <div class="col">
                  <form role="form" method="post" name="std_regFrm" id="std_regFrm">
                    <div class="form-group">
                      <div class="text-center" id="message" class="col"></div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label class="text-primary">ชือจริง</label>
                          <input style="border: 1px solid; color:grey;" type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="ระบุชื่อจริง" required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label class="text-primary">นามสกุล</label>
                          <input style="border: 1px solid; color:grey;" type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="ระบุนามสกุล" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="text-primary">ชื่อผู้ใช้</label>
                      <input style="border: 1px solid; color:grey;" type="text" name="userName" id="userName" class="form-control input-lg" placeholder="ระบุชื่อผู้ใช้" required>
                    </div>
                    <div class="form-group">
                      <label class="text-primary">ชื่อโปรไฟล์</label>
                      <input style="border: 1px solid; color:grey;" type="text" name="profile_name" id="profile_name" class="form-control input-lg" placeholder="ระบุชื่อโปรไฟล์" required>
                    </div>
                    <div class="form-group">
                      <label class="text-primary">อีเมล</label>
                      <input style="border: 1px solid; color:grey;" type="email" name="email" id="email" class="form-control input-lg" placeholder="ระบุอีเมล" required>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label class="text-primary">รหัสผ่าน</label>
                          <input style="border: 1px solid; color:grey;" type="password" name="passWord" id="passWord" class="form-control input-lg" placeholder="ระบุรหัสผ่าน" required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label class="text-primary">ยืนยันรหัสผ่าน</label>
                          <input style="border: 1px solid; color:grey;" type="passWord" name="confirm_password" id="confirm_password" class="form-control input-lg" placeholder="ยืนยันรหัสผ่าน" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <h5 class="panel-title"><span class="glyphicon glyphicon-pencil"></span>เลือกไฟล์รูปภาพ
                    </div>
                    <div class="row">

                      <div class="col">
                        <div class="form-group">
                          <label for="exampleFormControlFile1">เลือกไฟล์รูปภาพโปรไฟล์</label>
                          <input type="file" class="form-control" name="profile_pic" id="profile_pic" accept="image/png, image/jpeg, image/jpg" required>
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="form-group">
                      <input type="hidden" name="role" id="role" value="Student" required>
                    </div>

                    <div class="row">
                      <div class="col"><input type="submit" name="submit" id="submit" value="สมัครสมาชิก" class="btn btn-primary btn-block btn-lg"></div>
                      <div class="col"><a href="login.php" class="btn btn-success btn-block btn-lg">เข้าสู่ระบบ</a></div>
                    </div>
                    <br>
                  </form>


                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  // include_once "header.php";
  //include_once "includes/reg_ins2db.php";
  ?>
  <div class="row">
    <div class="col-md-12">

      <?php
      display_message(); ?>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
        </div>
        <div class="modal-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <?php
  include_once "footer.php";
  ?>

  <!-- <script src="js/jquery-1.12.4-jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

  <script type="text/javascript">
    $("#submitForm").on("submit", function(e) {
      e.preventDefault()
      addStdUser();
    });

    function addStdUser() {
      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var userName = $('#userName').val();
      var profile_name = $('#profile_name').val();
      var email = $('#email').val();
      var passWord = $('#passWord').val();
      var confirm_password = $('#confirm_password').val();
      var profile_pic = $("#profile_pic").get(0).files[0].name;
      var role = $('#role').val();

      var atpos = email.indexOf('@');
      var dotpos = email.lastIndexOf('.com');

      if (first_name == '') {
        alert('โปรดระบุชื่อจริง !!');
      } else if (last_name == '') {
        alert('โปรดระบุนามสกุล !!');
      } else if (userName == '') {
        alert('โปรดระบุชื่อผู้ใช้ !!');
      } else if (profile_name == '') {
        alert('โปรดระบุชื่อโปรไฟล์ !!');
      } else if (last_name == '') {
        alert('โปรดระบุนามสกุล !!');
      } else if (email == '') {
        alert('โปรดระบุอีเมล !!');
      } else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
        alert('โปรดระบุรูปแบบอีเมลที่ถูกต้อง !!');
      } else if (passWord == '') {
        alert('โปรดระบุรหัสผ่าน !!');
      } else if (passWord.length < 8 && passWord.length <= 16) {
        alert('รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษรและไม่เกิน 16 ตัวอักษร !!');
      } else if (confirm_password == '') {
        alert('โปรดยืนยันรหัสผ่าน !!');
      } else if (confirm_password != passWord) {
        alert('รหัสผ่านไม่ตรงกัน !!');
      } else if (profile_pic == '') {
        alert('โปรดเลือกไฟล์รูปผู้ใช้งาน !!');
      } else {
        $.ajax({
          url: 'std_ins2db.php',
          type: 'post',
          data: {
            first_name: first_name,
            last_name: last_name,
            userName: userName,
            profile_name: profile_name,
            email: email,
            passWord: passWord,
            profile_pic: profile_pic,
            role: role,
          },
          success: function(response) {
            $('#message').html(response);
          }
        });
        uploadfile();
        $('#std_regFrm')[0].reset();
      }
    }

    function uploadfile() {
      var formData = new FormData();
      formData.append("file", $("#profile_pic").get(0).files[0]);
      $.ajax({
        url: "testfile_move.php",
        type: "POST",
        cache: false,
        data: formData,
        contentType: false, // you can also use multipart/form-data replace of false
        processData: false,
        success: function(response) {
          alert(response);
        }
      });
    }
  </script>
</body>

</html>