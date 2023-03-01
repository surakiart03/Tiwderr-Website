<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>without bootstrap</title>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body>
  <div class="form-group">
    <label for="file">Select File</label>
    <input type="file" class="form-control" name="profile_pic" id="profile_pic" required="">
  </div>
  <button type="button" onclick="uploadfile();">คลิกชั้นสิ</button>
  <script src="../src/vendors/jquery/dist/jquery.min.js"></script>
  <script src="../src/vendors/popper.js/dist/umd/popper.min.js"></script>
  <script src="../src/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <script>
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