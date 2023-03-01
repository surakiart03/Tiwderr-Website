function alertApprove() {
  Swal.fire({
    title: "ไม่สามารถใช้งานฟังก์ชันนี้ได้ !",
    html: "คุณจำเป็นต้องยืนยันตัวตนด้วยบัตรประชาชน<br/>โดยเพิ่มการยืนยันตัวตนที่หน้าโปรไฟล์<br/>หากดำเนินการแล้ว กรุณารอการตรวจสอบจากเรา",
    icon: "info",
    //showCancelButton: true,
    confirmButtonColor: "#3085d6",
    //cancelButtonColor: '#d33',
    confirmButtonText: "เข้าใจแล้ว !",
    //cancelButtonText: 'ตกลง'
  });
}
