<footer id="footer">
    <div class="container">
        <nav class="navbar navbar-light bg-transparent navbar-expand footer-navbar d-block d-sm-flex text-center">
            <span class="navbar-text">&copy; TiWDERR. All rights reserved.</span>
            <div class="navbar-nav ml-auto justify-content-center">
		<a class="nav-link hover-pointer" href="https://docs.google.com/forms/d/e/1FAIpQLSenkC6Hy8-gfbKCgD-ON4EYsiG2sF0Axo4suF9UR52SxjoPlw/viewform" >สำรวจการใช้งาน</a>
                <span class="nav-link hover-pointer" onclick="showModalFooter('md_contact')">ติดต่อเรา</span>
                <span class="nav-link hover-pointer" onclick="showModalFooter('md_terms')">ข้อกำหนดการให้บริการ</span>
                <span class="nav-link hover-pointer" onclick="showModalFooter('md_privacy')">นโยบายความเป็นส่วนตัว</span>
            </div>
        </nav>
    </div>
</footer>
<div id="forFooter">

</div>
<script>
    function showModalFooter(path) {
        $.ajax({
            type: "post",
            url: "ajax/a-tiwderr/" + path + ".php",
            data: {

            },
            success: function(response) {
                $("#forFooter").html(response);
                $("#" + path).modal("toggle");

            }
        });
    }
</script>