<?php
session_start();
?>
<div class="modal fade" id="md_search_user" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="md_search_user" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ค้นหาผู้ใช้</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #ffffff; min-height: 500px; max-height: 500px;">
                <div class="container p-0" style="background-color: #ffffff; border-radius: 10px; ">
                <?= (!isset($_SESSION['username']) ? '<p class="text-center"><span class="text-secondary" style="font-size: 0.55rem;">กรุณาเข้าสู่ระบบหากต้องการค้นหาทั้งติวเตอร์และผู้เรียน</span></p>' : '')?>
                    <div class="input-group m-0 p-0">
                        <input type="text" class="form-control form-control-sm  text-dark" id="search-box" placeholder="ค้นหาด้วยชื่อหรือ username" value="">
                        <div class="input-group-append">
                            <span class="mdi mdi-magnify input-group-text" style="font-size:1.5rem;"></span>
                        </div>
                    </div>
                    <div id="suggesstion-box" class="pt-3"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    //AJAX call for autocomplete 
    $(document).ready(function() {
        $("#search-box").keyup(function() {
            $.ajax({
                type: "POST",
                url: "ajax/output/get_search_user.php",
                data: 'keyword=' + $(this).val(),
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data) {
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        });
    });
    //To select a country name
    function selectCountry(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
    }
</script>