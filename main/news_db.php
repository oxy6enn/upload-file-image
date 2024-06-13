<?php ob_start(); ?>
<?php session_start();?>
<?php include('../config/db.php');?>


<?php 
if (isset($_POST['news_add'])) {
    
   
            $title = $_POST["title"];
            $description = $_POST["description"];
            $news_category_id = $_POST["news_category_id"];
            $thumbnail_image = $_FILES["thumbnail_image"];
            $upload1 = $_FILES["thumbnail_image"]["name"];
            $file_name = $_FILES["file_name"];


           
            if($upload1) {

                $file = $_FILES['thumbnail_image']['tmp_name'];
                $sourceProperties = getimagesize($file);
                $imageType = $sourceProperties[2];
    
    
                //อนุญาติเฉพาะไฟล์
                $allow1 = array('jpg', 'jpeg', 'png');
    
                //ตัดเอาเฉพาะนามสกุล
                $extension1 = explode(".",$thumbnail_image['name']);
                $fileActExt1 = strtolower(end($extension1));
    
                //ตัดเอาเฉพาะชื่อไฟล์
                $fileActExt5 = pathinfo($thumbnail_image['name'], PATHINFO_FILENAME);
    
                //ใช้ _ แทน เว้นวรรค
                $fileActExt6 = str_replace(' ','_',$fileActExt5);
    
                //ตั้งชื่อไฟล์ใหม่
                ini_set('date.timezone', 'Asia/Bangkok');
                $currentDate1 = date("Ymd_His"); // ดึงวันปัจจุบันในรูปแบบ ปี-เดือน-วัน
                $fileNew1 = $currentDate1 . "_" . $fileActExt6 . "." . $fileActExt1;
    
                //pathfolder
                $filePath = "../assets/img/news/";
    
                //ฟังก์ชั่นลดขนาดรูป
                function imageResize($imageResourceId,$width,$height) {
                    $targetWidth = $width < 1280 ? $width : 1280 ;
                    $targetHeight = ($height/$width)* $targetWidth;
                    $tagetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
                    imagecopyresampled($tagetLayer,$imageResourceId, 0,0,0,0, $targetWidth, $targetHeight, $width, $height);
                    return $tagetLayer;
                }

            switch ($imageType) {

                case IMAGETYPE_PNG:
                    $imageResourceId = imagecreatefrompng($file);
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagepng($targetLayer, $filePath . $currentDate1 . "_" . $fileActExt6 . "." . $fileActExt1);
                    break;

                case IMAGETYPE_GIF:
                    $imageResourceId = imagecreatefromgif($file);
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagegif($targetLayer,$filePath . $currentDate1 . "_" . $fileActExt6 . "." . $fileActExt1);
                    break;

                case IMAGETYPE_JPEG:
                    $imageResourceId = imagecreatefromjpeg($file);
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagejpeg($targetLayer, $filePath . $currentDate1 . "_" . $fileActExt6 . "." . $fileActExt1);
                    break;

                    default: 
                    $_SESSION['status_code'] = "warning";
                    $_SESSION['status_title'] = "Warning";
                    $_SESSION['status_text'] = "Invalid image type";
                    header("location: news.php");
                    exit;
                    break;

            }

        }

    if($thumbnail_image['size'] > 0){

        if(in_array($fileActExt1, $allow1)){

            if($thumbnail_image['size'] > 0 && $thumbnail_image['error'] == 0){

                            $stmt = $conn->prepare("INSERT INTO a_news 
                            (title,description,news_category_id,thumbnail_image) 
                            VALUES (:title,:description,:news_category_id,:thumbnail_image)");
                            $stmt->bindParam(":title",$title);
                            $stmt->bindParam(":description",$description);
                            $stmt->bindParam(":news_category_id",$news_category_id);
                            $stmt->bindParam(":thumbnail_image",$fileNew1);
                            $stmt->execute();

                            if($stmt){
                                
                                $_SESSION['status_code'] = "success";
                                $_SESSION['status_title'] = "Success";
                                $_SESSION['status_text'] = "บันทึกข้อมูลเรียบร้อย";
                                header("location: news.php");
                                    
                            }else{
                                $_SESSION['status_code'] = "error";
                                $_SESSION['status_title'] = "Error";
                                $_SESSION['status_text'] = "ล้มเหลว";
                                header("location: news.php");
                            }
            
        }else{
            $_SESSION['status_code'] = "warning";
            $_SESSION['status_title'] = "Warning";
            $_SESSION['status_text'] = "รูปแบบไฟล์ภาพไม่ถูกต้อง";
            header("location: news.php");
        }


    }

    }else{

                //กรณีไม่ได้อัพโหลดรูป Thumbaill
                $stmt = $conn->prepare("INSERT INTO a_news 
                (title,description,news_category_id) 
                VALUES (:title,:description,:news_category_id)");
                $stmt->bindParam(":title",$title);
                $stmt->bindParam(":description",$description);
                $stmt->bindParam(":news_category_id",$news_category_id);
                $stmt->execute();

    }
           

         // Query หา ID สุดของ Table News เพื่อจะเอา ID ล่าสุด 
         $stmt = $conn->query("SELECT
         MAX(a_news.news_id) AS news_id
         FROM a_news ");  
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         $news_id = $result['news_id'];



         foreach($_FILES['file_name']['name'] as $key => $value){ 

            //=========== file name =============

            //ตัวแปร Array File name
            $file_name = $_FILES['file_name']['name'][$key];


            //อนุญาติเฉพาะไฟล์
            $allow2 = array('pdf', 'doc', 'docx','xls','xlsx','ppt','pptx');

            //ตัดเอาเฉพาะนามสกุลไฟล์
            $fileActExt2 = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            //ตัดเอาเฉพาะชื่อไฟล์
            $fileActExt3 = pathinfo($file_name, PATHINFO_FILENAME);

            //ใช้ _ แทน เว้นวรรค
            $fileActExt4 = str_replace(' ','_',$fileActExt3);

            //เพิ่มสามตัวอักษรสุ่ม
            $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 3); 

            //ตั้งชื่อไฟล์ใหม่
            ini_set('date.timezone', 'Asia/Bangkok');
            $currentDate2 = date("Ymd_His"); // ดึงวันปัจจุบันในรูปแบบ ปี-เดือน-วัน
            $fileNew2 =  $currentDate2 . "_" .  $fileActExt4 . "." . $fileActExt2;

            //ตั้งชื่อไฟล์ใหม่
            $filePath2 = "../assets/file/news/".$fileNew2;



            if(in_array($fileActExt2, $allow2)){
                if($_FILES['file_name']['size'][$key] > 0 && $_FILES['file_name']['error'][$key] == 0){
                    if(move_uploaded_file($_FILES['file_name']['tmp_name'][$key], $filePath2)){

        
                        $stmt = $conn->prepare("INSERT INTO a_news_filename 
                        (news_id,news_filename) 
                        VALUES (:news_id,:news_filename)");
                        $params = array(
                            'news_id' => $news_id,
                            'news_filename' => $fileNew2
                        );
                        $stmt->execute($params);

                        if($stmt){
                

                            $_SESSION['status_code'] = "success";
                            $_SESSION['status_title'] = "Success";
                            $_SESSION['status_text'] = "บันทึกข้อมูลเรียบร้อย";
                            header("location: news.php");


                        }else{
                            $_SESSION['status_code'] = "error";
                            $_SESSION['status_title'] = "Error";
                            $_SESSION['status_text'] = "Query File Name ล้มเหลว";
                            header("location: news.php");

                        }
                    

                    }else{
                            $_SESSION['status_code'] = "warning";
                            $_SESSION['status_title'] = "Warning";
                            $_SESSION['status_text'] = "รูปแบบไฟล์เอกสาร move_uploaded_file ไม่ถูกต้อง";
                            header("location: news.php");
                        }

                    
                }else{
                    $_SESSION['status_code'] = "warning";
                    $_SESSION['status_title'] = "Warning";
                    $_SESSION['status_text'] = "รูปแบบไฟล์เอกสาร size และ error ไม่ถูกต้อง";
                    header("location: news.php");
                }
    

            }else{
                $_SESSION['status_code'] = "warning";
                $_SESSION['status_title'] = "Warning";
                $_SESSION['status_text'] = "รูปแบบไฟล์เอกสารไม่ถูกต้อง";
                header("location: news.php");
            }


        
        }

            
   

} elseif(isset($_POST['news_edit'])) {


            $news_id = $_POST["news_id"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $news_category_id = $_POST["news_category_id"];
            $thumbnail_image_old = $_POST["thumbnail_image_old"];
            $thumbnail_image = $_FILES["thumbnail_image"];
            $upload1 = $_FILES["thumbnail_image"]["name"];
            $status_id = $_POST["status_id"];

          
        
                if($upload1){

                    
                    // echo "มีการอัพโหลดรูป แต่ไม่อัพโหลดไฟล์";

                            //ตัวแปรเพื่อไม่ให้ลบรูป No_Image_Available
                            $No_Image_Available = "No_Image_Available.jpg";

                                        
                            $file = $_FILES['thumbnail_image']['tmp_name'];
                            $sourceProperties = getimagesize($file);
                            $imageType = $sourceProperties[2];


                            //อนุญาติเฉพาะไฟล์
                            $allow1 = array('jpg', 'jpeg', 'png');

                            //ตัดเอาเฉพาะนามสกุล
                            $extension1 = explode(".",$thumbnail_image['name']);
                            $fileActExt1 = strtolower(end($extension1));

                            //ตัดเอาเฉพาะชื่อไฟล์
                            $fileActExt5 = pathinfo($thumbnail_image['name'], PATHINFO_FILENAME);

                            //ใช้ _ แทน เว้นวรรค
                            $fileActExt6 = str_replace(' ','_',$fileActExt5);

                            //ตั้งชื่อไฟล์ใหม่
                            ini_set('date.timezone', 'Asia/Bangkok');
                            $currentDate1 = date("Ymd_His"); // ดึงวันปัจจุบันในรูปแบบ ปี-เดือน-วัน
                            $fileNew1 = $currentDate1 . "_" . $fileActExt6 . "." . $fileActExt1;

                            //path folder
                            $filePath = "../assets/img/news/";

                            //ฟังก์ชั่นลดขนาดรูป
                            function imageResize($imageResourceId,$width,$height) {
                                $targetWidth = $width < 1280 ? $width : 1280 ;
                                $targetHeight = ($height/$width)* $targetWidth;
                                $tagetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
                                imagecopyresampled($tagetLayer,$imageResourceId, 0,0,0,0, $targetWidth, $targetHeight, $width, $height);
                                return $tagetLayer;
                            }


                            switch ($imageType) {

                                case IMAGETYPE_PNG:
                                    $imageResourceId = imagecreatefrompng($file);
                                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                                    imagepng($targetLayer, $filePath . $currentDate1 . "_" . $fileActExt6 . "." . $fileActExt1);
                                    break;

                                case IMAGETYPE_GIF:
                                    $imageResourceId = imagecreatefromgif($file);
                                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                                    imagegif($targetLayer,$filePath . $currentDate1 . "_" . $fileActExt6 . "." . $fileActExt1);
                                    break;

                                case IMAGETYPE_JPEG:
                                    $imageResourceId = imagecreatefromjpeg($file);
                                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                                    imagejpeg($targetLayer, $filePath . $currentDate1 . "_" . $fileActExt6 . "." . $fileActExt1);
                                    break;

                                    default: 
                                    $_SESSION['status_code'] = "warning";
                                    $_SESSION['status_title'] = "Warning";
                                    $_SESSION['status_text'] = "Invalid image type";
                                    header("location: news.php");
                                    exit;
                                    break;

                            }


                    if(in_array($fileActExt1, $allow1)){
                        if($thumbnail_image['size'] > 0 && $thumbnail_image['error'] == 0){
                       
        
                                            //เงื่อนไขข้ามการลบรูป Defaluft No_Image_Available
                                            if($thumbnail_image_old != $No_Image_Available){

                                            // echo "ไม่มีรูป No_Image_Available";
                                            // return;
                                            //ลบรูปภาพออกจาก Path เมื่อมีการอัปโหลดรูปภาพใหม่เข้ามา 
                                            $isRemovieImg = unlink("../assets/img/news/".$thumbnail_image_old);

                                            }

                                            // echo "มีรูป No_Image_Available จริง";
                                            // return;

                                            $stmt = $conn->prepare("UPDATE a_news SET 
                                            title = :title,
                                            description = :description,
                                            news_category_id = :news_category_id,
                                            thumbnail_image = :thumbnail_image,
                                            status_id = :status_id
                                            WHERE news_id = :news_id");
                                            $stmt->bindParam(':news_id',$news_id);
                                            $stmt->bindParam(':title',$title);
                                            $stmt->bindParam(':description',$description);
                                            $stmt->bindParam(':news_category_id',$news_category_id);
                                            $stmt->bindParam(':thumbnail_image',$fileNew1);
                                            $stmt->bindParam(':status_id',$status_id);
                                            $stmt->execute();
    
        
                                        if($stmt){
                                            $_SESSION['status_code'] = "success";
                                            $_SESSION['status_title'] = "Success";
                                            $_SESSION['status_text'] = "แก้ไขข้อมูลเรียบร้อย";
                                            header("location: news_edit.php?id=$news_id");
                                        }else{
                                            $_SESSION['status_code'] = "error";
                                            $_SESSION['status_title'] = "error";
                                            $_SESSION['status_text'] = "ล้มเหลว";
                                            header("location: news_edit.php?id=$news_id");
        
                                        }
        
                                        



                                }else{
                                $_SESSION['status_code'] = "warning";
                                $_SESSION['status_title'] = "Warning";
                                $_SESSION['status_text'] = "รูปแบบไฟล์รูปภาพ size และ error ไม่ถูกต้อง";
                                header("location: news_edit.php?id=$news_id");
                                }
        
        


                            }else{
                                $_SESSION['status_code'] = "warning";
                                $_SESSION['status_title'] = "Warning";
                                $_SESSION['status_text'] = "รูปแบบไฟล์รูปภาพไม่ถูกต้อง";
                                header("location: news_edit.php?id=$news_id");
                               }
        
        
                }else{

                    // echo "ไม่อัพโหลดรูป";
                    
                    $stmt = $conn->prepare("UPDATE a_news SET 
                    title = :title,
                    description = :description,
                    news_category_id = :news_category_id,
                    status_id = :status_id
                    WHERE news_id = :news_id");
                    $stmt->bindParam(':news_id',$news_id);
                    $stmt->bindParam(':title',$title);
                    $stmt->bindParam(':description',$description);
                    $stmt->bindParam(':news_category_id',$news_category_id);
                    $stmt->bindParam(':status_id',$status_id);
                    $stmt->execute();


                    if($stmt){
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_title'] = "Success";
                        $_SESSION['status_text'] = "แก้ไขข้อมูลเรียบร้อย";
                        header("location: news_edit.php?id=$news_id");
                    }else{
                        $_SESSION['status_code'] = "error";
                        $_SESSION['status_title'] = "Error";
                        $_SESSION['status_text'] = "ล้มเหลว";
                        header("location: news_edit.php?id=$news_id");

                    }


                }



           
}elseif(isset($_GET['news_id']) && ($_GET['news_delete'])) { 


 $news_id = $_GET['news_id'];
 $status_id = 2;

 try {

    $stmt = $conn->prepare("UPDATE a_news SET status_id = :status_id  WHERE news_id = :news_id ");
    $stmt->bindParam(":status_id",$status_id);
    $stmt->bindParam(":news_id",$news_id);
    $stmt->execute();

    $_SESSION['status_code'] = "success";
    $_SESSION['status_title'] = "Success";
    $_SESSION['status_text'] = "ยกเลิกข้อมูลเรียบร้อย";
    header("location: news.php");

    } catch( Exception $e ){

    echo " <b> Message Error : </b>".$e->getMessage();

    }


}elseif(isset($_POST['news_filename_upload'])){ 


    $news_id = $_POST['news_id'];
    $created_by = $_SESSION['admin_login'];

    foreach($_FILES['file_name']['name'] as $key => $value){ 

        //=========== file name =============

        //ตัวแปร Array File name
        $file_name = $_FILES['file_name']['name'][$key];

        //อนุญาติเฉพาะไฟล์
        $allow2 = array('pdf', 'doc', 'docx','xls','xlsx','ppt','pptx');

        //ตัดเอาเฉพาะนามสกุลไฟล์
        $fileActExt2 = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        //ตัดเอาเฉพาะชื่อไฟล์
        $fileActExt3 = pathinfo($file_name, PATHINFO_FILENAME);

        //ใช้ _ แทน เว้นวรรค
        $fileActExt4 = str_replace(' ','_',$fileActExt3);

        //เพิ่มสามตัวอักษรสุ่ม
        $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 3); 

        //ตั้งชื่อไฟล์ใหม่
        ini_set('date.timezone', 'Asia/Bangkok');
        $currentDate2 = date("Ymd_His"); // ดึงวันปัจจุบันในรูปแบบ ปี-เดือน-วัน
        $fileNew2 =  $currentDate2 . "_" .  $fileActExt4 . "." . $fileActExt2;

        //ตั้งชื่อไฟล์ใหม่
        $filePath2 = "../assets/file/news/".$fileNew2;


        if(in_array($fileActExt2, $allow2)){
            if($_FILES['file_name']['size'][$key] > 0 && $_FILES['file_name']['error'][$key] == 0){
                if(move_uploaded_file($_FILES['file_name']['tmp_name'][$key], $filePath2)){

    
                    $stmt = $conn->prepare("INSERT INTO a_news_filename 
                    (news_id,news_filename) 
                    VALUES (:news_id,:news_filename)");
                    $params = array(
                        'news_id' => $news_id,
                        'news_filename' => $fileNew2
                    );
                    $stmt->execute($params);

                    if($stmt){
            

                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_title'] = "Success";
                        $_SESSION['status_text'] = "บันทึกข้อมูลเรียบร้อย";
                        header("location: news_edit.php?id=$news_id");


                    }else{
                        $_SESSION['status_code'] = "error";
                        $_SESSION['status_title'] = "Error";
                        $_SESSION['status_text'] = "Query File Name ล้มเหลว";
                        header("location: news_edit.php?id=$news_id");

                    }
                

                }else{
                        $_SESSION['status_code'] = "warning";
                        $_SESSION['status_title'] = "Warning";
                        $_SESSION['status_text'] = "รูปแบบไฟล์เอกสาร move_uploaded_file ไม่ถูกต้อง";
                        header("location: news_edit.php?id=$news_id");
                    }

                
            }else{
                $_SESSION['status_code'] = "warning";
                $_SESSION['status_title'] = "Warning";
                $_SESSION['status_text'] = "รูปแบบไฟล์เอกสาร size และ error ไม่ถูกต้อง";
                header("location: news_edit.php?id=$news_id");
            }


        }else{
            $_SESSION['status_code'] = "warning";
            $_SESSION['status_title'] = "Warning";
            $_SESSION['status_text'] = "รูปแบบไฟล์เอกสารไม่ถูกต้อง";
            header("location: news_edit.php?id=$news_id");
        }


    
    }



}elseif(isset($_GET['news_filename_delete_id']) && ($_GET['news_filename_delete_all'])){


    $news_id = $_GET['news_filename_delete_id'];


    $stmt = $conn->prepare("SELECT news_id , news_filename FROM a_news_filename WHERE news_id = :news_id");
    $stmt->bindParam(":news_id",$news_id);
    $stmt->execute();
    $result = $stmt->fetchAll();


    foreach ($result as $row) {

        $news_filename = $row['news_filename'];


         //ลบรูปภาพออกจาก Path เมื่อมีการอัปโหลดรูปภาพใหม่เข้ามา 
         $isRemovieImg = unlink("../assets/file/news/".$news_filename);
    }

       
    try {

        $stmt = $conn->prepare("DELETE FROM a_news_filename WHERE news_id = :news_id ");
        $stmt->bindParam(":news_id",$news_id);
        $stmt->execute();

        $_SESSION['status_code'] = "success";
        $_SESSION['status_title'] = "Success";
        $_SESSION['status_text'] = "ลบข้อมูลเรียบร้อย";
        header("location: news_edit.php?id=".$news_id);

        } catch( Exception $e ){

        echo " <b> Message Error : </b>".$e->getMessage();

        }


}elseif(isset($_GET['news_filename_id']) && ($_GET['news_filename'])){


    $news_filename_id = $_GET['news_filename_id'];
    $news_id_delete = $_GET['news_id_delete'];
    $news_filename = $_GET['news_filename'];

    try {

            //ลบรูปภาพออกจาก Path เมื่อมีการอัปโหลดรูปภาพใหม่เข้ามา 
            $isRemovieImg = unlink("../assets/file/news/".$news_filename);


            $stmt = $conn->prepare("DELETE FROM a_news_filename WHERE news_filename_id = :news_filename_id ");
            $stmt->bindParam(":news_filename_id",$news_filename_id);
            $stmt->execute();

            $_SESSION['status_code'] = "success";
            $_SESSION['status_title'] = "Success";
            $_SESSION['status_text'] = "ลบข้อมูลเรียบร้อย";
            header("location: news_edit.php?id=".$news_id_delete);

            } catch( Exception $e ){

            echo " <b> Message Error : </b>".$e->getMessage();

            }

}else{

$_SESSION['status_code'] = "error";
$_SESSION['status_title'] = "Error";
$_SESSION['status_text'] = "เกิดข้อผิดพลาด";
header("location: news.php");

} ?>