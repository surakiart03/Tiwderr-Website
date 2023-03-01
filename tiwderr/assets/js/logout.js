function logoutFunc() {
    Swal.fire({
        title: 'ออกจากระบบ ?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "logout.php",
                data: {
                   
                },
                success: function(response) {
                    window.location=response;
                },
                error: function(error) {
                    console.log('AJAX Error: ' + error);
                }
            });
        }
    })
}