<?php include('../component/main/header.php');?>
<?php include('../component/main/aside.php');?>
<?php include('../config/db.php');?>



<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">เมนู /</span> ข่าว/ประกาศ
        </h4>

        <!-- Bordered Table -->
        <div class="card">
            <h5 class="card-header d-flex justify-content-between">รายการข่าว/ประกาศ
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
                    เพิ่มข่าว/ประกาศ
                </button>
            </h5>

            <!-- card-body -->
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <?php include('news_add.php');?>

                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>หัวข้อ</th>
                                <th>คำอธิบาย</th>
                                <th>หมวดหมู่</th>
                                <th>ภาพหน้าปก</th>
                                <th>สถานะ</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <?php 
                            $stmt = $conn->query("SELECT
                            a_news.news_id,
                            a_news.title,
                            a_news.description,
                            a_news.thumbnail_image,
                            a_news.news_category_id,
                            m_status.status_id,
                            m_status.status_name,
                            a_news_category.news_category_id,
                            a_news_category.category_name
                            FROM a_news 
                            LEFT JOIN a_news_category ON a_news.news_category_id = a_news_category.news_category_id
                            LEFT JOIN m_status ON a_news.status_id = m_status.status_id
                            ORDER BY a_news.news_id DESC");  
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            $r = 1 ;
                          ?>
                        <tbody>
                            <?php foreach ($result as $row){
                            $status_id = $row['status_id'];
                            ?>

                            <tr>
                                <td><?= $r++ ?></td>
                                <td class="break-word"><?= nl2br($row['title']); ?></td>
                                <td class="break-word"><?= nl2br($row['description']); ?></td>
                                <td><?= $row['category_name']; ?></td>
                                <td>
                                    <a href="../assets/img/news/<?= $row['thumbnail_image'] ?>" target="_blank">
                                        <img src="../assets/img/news/<?= $row['thumbnail_image'] ?>"
                                            class="preview_img">
                                    </a>
                                </td>
                                


                                <?php if($status_id == 1) {?>
                                <td><span class="badge rounded-pill bg-label-primary"><?= $row['status_name']; ?></span>
                                </td>
                                <td>


                                    <a href="news_edit.php?id=<?= $row['news_id']?>"><button type="button" name="news_edit" class="btn btn-icon btn-outline-primary">
                                        <span class="tf-icons bx bx-edit"></span>
                                    </button></a>


                                    <button type="button" class="btn btn-icon btn-outline-primary" id="cancel"
                                        data-id="./news_db.php?news_id=<?= $row['news_id'] ?>&&news_delete=delete">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                             
                                </td>

                                <?php }elseif($status_id == 2) {?>
                                <td><span
                                        class="badge rounded-pill bg-label-secondary"><?= $row['status_name']; ?></span>
                                </td>
                                <td>


                                    <a href="news_edit.php?id=<?= $row['news_id']?>"><button type="button" name="news_edit" class="btn btn-icon btn-outline-primary">
                                        <span class="tf-icons bx bx-edit"></span>
                                    </button></a>

                                    <button type="button" class="btn btn-icon btn-outline-primary" id="member_delete" disabled>
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                          
                                </td>

                                <?php }else{} ?>

                           
                            </tr>
                            <?php } ?>
                            </tfoot>
                    </table>
                </div>
            </div>
            <!-- card-body -->
        </div>
        <!--/ Bordered Table -->
    </div>
    <!-- / Content -->



    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->



<?php include('../component/main/footer.php');?>