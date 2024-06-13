<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            © <script>
            document.write(new Date().getFullYear())
            </script>
            , made with ❤️ by <a href="https://themeselection.com" target="_blank"
                class="footer-link fw-medium">ThemeSelection</a>
        </div>
        <div class="d-none d-lg-inline-block">

            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

            <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank" class="footer-link me-4">Documentation</a>

            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                class="footer-link me-4">Support</a>


        </div>
    </div>
</footer>
<!-- / Footer -->


<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>



<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>


</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js ../assets/vendor/js/core.js -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>


<!-- endbuild -->


<!-- Vendors JS -->
<script src="../assets/vendor/libs/moment/moment.js"></script>
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>


<!-- Main JS -->
<script src="../assets/js/main.js"></script>


<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>
<script src="../assets/js/forms-pickers.js"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->


<!-- dataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<!-- select2 JS -->
<script src="../assets/vendor/libs/select2/select2.js"></script>
<script src="../assets/vendor/libs/select2/forms-selects.js"></script>



<!-- ฟังก์ชั่นเรียกใช้ select2 เมื่อคุณเปลี่ยน pagination ไปหน้าที่ 2 ใน DataTables -->
<script>
$(document).ready(function() {
    let table = $('#myTable').DataTable({
        // ... การกำหนดคอลัมน์ที่ต้องการให้ Select2
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ]
    });


    let table2 = $('#myTable2').DataTable({
        // ... การกำหนดคอลัมน์ที่ต้องการให้ Select2
        "lengthMenu": [
            [5, 25, 50, -1],
            [5, 25, 50, "All"]
        ],
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": false
    });


    let table3 = $('#myTable3').DataTable({
        // ... การกำหนดคอลัมน์ที่ต้องการให้ Select2
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": false
    });


});
</script>


<!-- sweetalert -->
<?php 
if(isset($_SESSION['status_code']) && $_SESSION['status_code'] !=''){
?>

<script>
Swal.fire({
    icon: '<?php echo $_SESSION['status_code'];?>',
    title: '<?php echo $_SESSION['status_title'];?>',
    text: '<?php echo $_SESSION['status_text'];?>'
})
</script>

<?php 
unset($_SESSION['status_code']);
}
?>



<!-- sweetalert status download -->
<?php 
if(isset($_SESSION['status_download']) && $_SESSION['status_download'] !=''){ 
    $status_download  = $_SESSION['status_download']
?>

<script>
window.open("<?php echo $status_download ?>");
</script>

<?php 
unset($_SESSION['status_download']);
}
?>


<!-- sweetalert document download -->
<script>
$(document).on('click', '#document_download', function() {
    let id = $(this).data('id')
    // console.log(id);
    Swal.fire({
        title: 'ดาวน์โหลดไฟล์นี้หรือไม่?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `${id}`;
        }
    })
})
</script>


<!-- sweetalert cancel -->
<script>
$(document).on('click', '#cancel', function() {
    let id = $(this).data('id')
    // console.log(id);
    Swal.fire({
        title: 'ยกเลิกข้อมูลนี้หรือไม่?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `${id}`;
        }
    })
})
</script>



<!-- sweetalert delete -->
<script>
$(document).on('click', '#delete', function() {
    let id = $(this).data('id')
    // console.log(id);
    Swal.fire({
        title: 'ลบข้อมูลนี้หรือไม่?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `${id}`;
        }
    })
})
</script>


<!-- sweetalert delete all -->
<script>
$(document).on('click', '#delete_all', function() {
    let id = $(this).data('id')
    // console.log(id);
    Swal.fire({
        title: 'ลบข้อมูลทั้งหมดนี้หรือไม่?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `${id}`;
        }
    })
})
</script>



<!-- sweetalert log_out -->
<script>
$(document).on('click', '#log_out', function() {
    let id = $(this).data('id')
    // console.log(id);
    Swal.fire({
        title: 'ออกจากระบบหรือไม่?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `../main/index.php`;
        }
    })
})
</script>


<!-- Input add previewImg -->
<script>
let imgInput = document.getElementById('imgInput');
let previewImg = document.getElementById('previewImg');
imgInput.onchange = evt => {
    const [file] = imgInput.files;
    if (file) {
        previewImg.src = URL.createObjectURL(file);
        // console.log(imgInput);
        // console.log(previewImg);
    }
}
</script>


<!-- Input edit previewImg -->
<script>
// เลือกทุกอินพุตและรูปภาพตัวอย่าง
let imgInputs = document.querySelectorAll('[data-input-id]');
let previewImages = document.querySelectorAll('[data-preview-id]');

// กำหนดการเชื่อมโยงอินพุตและรูปภาพตัวอย่าง
for (let i = 0; i < imgInputs.length; i++) {
    let imgInput = imgInputs[i];
    let previewImg = previewImages[i];

    imgInput.onchange = evt => {
        const [file] = imgInput.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file);
            //   console.log(imgInput);
            //   console.log(previewImg);
        }
    }
}
</script>


</body>

</html>

<!-- beautify ignore:end -->