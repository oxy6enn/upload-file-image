<?php include('../component/main/header.php');?>
<?php include('../component/main/aside.php');?>
<?php include('../config/db.php');?>


<?php 
if (isset($_GET['id'])) { 
    
    $id = $_GET['id'];

    $stmt = $conn->query("SELECT
                            a_news.news_id,
                            a_news.title,
                            a_news.description,
                            a_news.news_category_id,
                            a_news.thumbnail_image,
                            a_news.status_id,
                            a_news_category.category_name,
                            m_status.status_name
                            FROM a_news 
                            LEFT JOIN m_status ON a_news.status_id = m_status.status_id
                            LEFT JOIN a_news_category ON a_news.news_category_id = a_news_category.news_category_id
                            WHERE  a_news.news_id = $id");  
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>



<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">เมนู /</span> ข่าว/ประกาศ
        </h4>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 ">
                    <h5 class="card-header">ฟอร์มแก้ไขข่าว/ประกาศ</h5>
                    <div class="card-body">

                        <form action="news_db.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="news_id" id="news_id" value="<?= $row['news_id'] ?>">
                            <input type="hidden" name="thumbnail_image_old" id="thumbnail_image_old"
                                value="<?= $row['thumbnail_image'] ?>">

                            <div class="row g-2">
                                <div class="col mb-2">
                                    <label for="title" class="form-label fs-6">หัวข้อ</label>
                                    <input type="text" id="title" name="title" value="<?= $row['title'] ?>"
                                        class="form-control" placeholder="หัวข้อ" required>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-2">
                                    <label for="description" class="form-label fs-6">คำอธิบาย</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                        placeholder="คำอธิบาย" required><?= $row['description'] ?></textarea>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col mb-2">
                                    <label for="news_category_id" class="form-label fs-6">หมวดหมู่</label>
                                    <select id="news_category_id<?= $row['news_id']?>" name="news_category_id"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option selected value="<?= $row["news_category_id"]; ?>">
                                            <?= $row["category_name"]?>
                                        </option>
                                        <?= $news_category_id = $row["news_category_id"]; ?>
                                        
                                        <?php 
                                $stmt = $conn->query("SELECT news_category_id, category_name FROM a_news_category WHERE news_category_id <> $news_category_id");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ( $result as $row1){
                                ?>
                                        <option value="<?php echo $row1['news_category_id'];?>">
                                            <?php echo $row1['category_name'];?></option>
                                        <?php  } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col mb-2">
                                    <label for="thumbnail_image" class="form-label fs-6">ภาพหน้าปก <span
                                            style="color : purple; font-size:10px">(JPG,JPEG,PNG)</span></label>
                                    <input type="file" name="thumbnail_image" id="imgInput" class="form-control"
                                        data-input-id="imgInput" accept="image/*">
                                </div>
                                <img width="100%" id="previewImg" alt="" class="rounded mx-auto d-block mb-2">
                            </div>

                            <a href="../assets/img/news/<?= $row['thumbnail_image'] ?>" target="_blank">
                                <img width="100%" id="previewImg" data-preview-id="previewImg"
                                    src="../assets/img/news/<?= $row['thumbnail_image'] ?>" alt=""
                                    class="rounded mx-auto d-block mb-2">
                            </a>

                            
                            <div class="row g-2">
                            <div class="col mb-2">
                                <label for="status_id" class="form-label fs-6">สถานะ</label>
                                <select id="status_id<?= $row['news_id']?>" name="status_id"
                                    class="select2 form-select form-select-lg" data-allow-clear="true" required>
                                    <option selected value="<?= $row['status_id']?>"><?= $row['status_name']?></option>
                                    <?= $status_id =  $row['status_id']?>
                                    <?php 
                                            $stmt = $conn->query("SELECT status_id,status_name FROM m_status WHERE status_id <> $status_id");
                                            $stmt->execute();
                                            $result = $stmt->fetchAll();
                                            foreach ( $result as $row1){
                                      
                                            ?>
                                    <option value="<?php echo $row1['status_id'];?>"><?php echo $row1['status_name'];?>
                                    </option>
                                    <?php  } ?>
                                </select>
                            </div>
                            </div>


                    </div>

                    <div class="modal-footer">
                        <a href="news.php"><button type="button" class="btn btn-outline-secondary mx-2"
                                data-bs-dismiss="modal">ย้อนกลับ</button></a>
                        <button type="submit" name="news_edit" class="btn btn-primary">บันทึก</button>
                    </div>
                    </form>

                </div>
            </div>


            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">อัปโหลดไฟล์</h5>
                    <div class="card-body">

                        <form action="news_db.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="news_id" id="news_id" value="<?= $row['news_id'] ?>">

                            <div class="row g-2">
                                <div class="col mb-2">
                                    <label for="file_name" class="form-label fs-6">ไฟล์<span style="color : purple; font-size:10px">
                                            (PDF,
                                            Word, Excel, PowerPoint)</span></label>
                                    <input type="file" name="file_name[]" id="imgInput2" class="form-control"
                                        multiple="multiple" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx"
                                        required>
                                </div>
                                <!-- <img width="100%" id="previewImg2" alt="" class="rounded mx-auto d-block mb-2"> -->
                            </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" name="news_filename_upload" class="btn btn-primary">อัปโหลด</button>
                    </div>
                    </form>

                </div>


                <div class="card mb-4">
                    <h5 class="card-header d-flex justify-content-between">รายการไฟล์
                        <button type="button" class="btn btn-danger" id="delete_all"
                            data-id="./news_db.php?news_filename_delete_id=<?= $_GET['id'] ?>&&news_filename_delete_all=delete">
                            ลบทั้งหมด
                        </button>
                    </h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table id="myTable3" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="white-space:pre-wrap;">#</th>
                                        <th style="white-space:pre-wrap;">ไฟล์</th>
                                        <th style="white-space:pre-wrap;">ตัวเลือก</th>
                                    </tr>
                                </thead>
                                <?php 
                                    $stmt = $conn->query("SELECT
                                    a_news_filename.news_filename_id,
                                    a_news_filename.news_id,
                                    a_news_filename.news_filename
                                    FROM a_news_filename 
                                    LEFT JOIN a_news ON a_news_filename.news_id = a_news.news_id
                                    WHERE a_news_filename.news_id = $id
                                    ORDER BY a_news_filename.news_filename_id DESC");  
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    $r = 1 ;
                                ?>
                                <tbody class="table-border-bottom-0">
                                    <?php foreach ($result as $row2){?>
                                    <tr>
                                        <td>
                                            <?= $r ++ ?>
                                        </td>
                                        <td>
                                            <a href="../assets/file/news/<?= $row2['news_filename'] ?>"
                                                target="_blank">
                                                <?= $row2['news_filename'] ?>
                                            </a>
                                        </td>
                                        <td>

                                                <button type="button" class="btn btn-icon btn-outline-primary" id="delete"
                                        data-id="news_db.php?news_filename_id=<?= $row2['news_filename_id']?>&&news_id_delete=<?= $row2['news_id']?>&&news_filename=<?= $row2['news_filename']?>">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                             
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        <!-- / Content -->

        <?php } else {

$_SESSION['status_code'] = "error";
$_SESSION['status'] = "เกิดข้อผิดพลาด";
header("location: news.php");


 } ?>


        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->



    <?php include('../component/main/footer.php');?>