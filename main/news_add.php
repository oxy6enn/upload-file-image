<!-- Large Modal -->
<div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">ฟอร์มเพิ่มข่าว/ประกาศ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="news_db.php" method="POST" enctype="multipart/form-data">

                    <div class="row g-2">
                        <div class="col mb-2">
                            <label for="title" class="form-label fs-6">หัวข้อ</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="หัวข้อ"
                                required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-2">
                            <label for="description" class="form-label fs-6">คำอธิบาย</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="คำอธิบาย"
                                required></textarea>
                        </div>
                    </div>


                    <div class="row g-2">
                        <div class="col mb-2">
                            <label for="news_category_id" class="form-label fs-6">หมวดหมู่</label>
                            <select id="news_category_id_news" name="news_category_id" required
                                class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option value=""></option>
                                <?php 
                                $stmt = $conn->query("SELECT news_category_id, category_name FROM a_news_category");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ( $result as $row){
                                ?>
                                <option value="<?php echo $row['news_category_id'];?>">
                                    <?php echo $row['category_name'];?></option>
                                <?php  } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-2">
                            <label for="thumbnail_image" class="form-label fs-6">ภาพหน้าปก <span
                                    style="color : purple; font-size:10px"> (JPG,JPEG,PNG)</span></label>
                            <input type="file" name="thumbnail_image" id="imgInput" class="form-control"
                                accept="image/*" >
                        </div>
                        <img width="100%" id="previewImg" alt="" class="rounded mx-auto d-block mb-2">
                    </div>


                    <div class="row g-2">
                                <div class="col mb-2">
                                    <label for="file_name" class="form-label fs-6">ไฟล์ <span style="color : purple; font-size:10px">(PDF,
                                    Word, Excel, PowerPoint)</span></label>
                                    <input type="file" name="file_name[]" id="imgInput2" class="form-control"
                                        multiple="multiple" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx" required>
                                </div>
                                <!-- <img width="100%" id="previewImg2" alt="" class="rounded mx-auto d-block mb-2"> -->
                            </div>
                     </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="submit" name="news_add" class="btn btn-primary">บันทึก</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Extra Large Modal -->