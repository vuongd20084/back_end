<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <!-- Nhúng file quản lý phần HEAD -->
  <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>

<body class="d-flex flex-column h-100">
  <!-- header -->
  <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
  <!-- end header -->

  <div class="container-fluid">
    <div class="row">
      <!-- sidebar -->
      <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
      <!-- end sidebar -->

      <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Sửa sản phẩm</h1>
        </div>

        <?php
        // Truy vấn database
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__ . '/../../../dbconnect.php');

        $sp_ma = $_GET['sp_ma'];

        $sqlSelectSanPham = "select * from sanpham where sp_ma = $sp_ma";
        $resultSanPham = mysqli_query($conn, $sqlSelectSanPham);
        $rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC);


        /* --- 
        --- 2.Truy vấn dữ liệu Loại sản phẩm 
        --- 
        */
        // Chuẩn bị câu truy vấn Loại sản phẩm
        $sqlLoaiSanPham = "select * from loaisanpham";
        // Thực thi câu truy vấn SQL để lấy về dữ liệu
        $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);

        // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
        $dataLoaiSanPham = [];
        while ($rowLoaiSanPham = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
            $dataLoaiSanPham[] = array(
                'lsp_ma' => $rowLoaiSanPham['lsp_ma'],
                'lsp_ten' => $rowLoaiSanPham['lsp_ten'],
                'lsp_mota' => $rowLoaiSanPham['lsp_mota'],
            );
        }
        /* --- End Truy vấn dữ liệu Loại sản phẩm --- */
        
        /* --- 
        --- 3. Truy vấn dữ liệu Nhà sản xuất 
        --- 
        */
        // Chuẩn bị câu truy vấn Nhà sản xuất
        $sqlNhaSanXuat = "select * from nhasanxuat";

        // Thực thi câu truy vấn SQL để lấy về dữ liệu
        $resultNhaSanXuat = mysqli_query($conn, $sqlNhaSanXuat);

        // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
        $dataNhaSanXuat = [];
        while ($rowNhaSanXuat = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)) {
            $dataNhaSanXuat[] = array(
                'nsx_ma' => $rowNhaSanXuat['nsx_ma'],
                'nsx_ten' => $rowNhaSanXuat['nsx_ten'],
            );
        }
        /* --- End Truy vấn dữ liệu Nhà sản xuất --- */

        // Chuẩn bị câu truy vấn Khuyến mãi
        $sqlKhuyenMai = "select * from `khuyenmai`";

        // Thực thi câu truy vấn SQL để lấy về dữ liệu
        $resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);

        // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
        $dataKhuyenMai = [];
        while($rowKhuyenMai = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)){
          $km_tomtat = '';
          if(!empty($rowKhuyenMai['km_ten'])){
            // Sử dụng hàm sprintf() để chuẩn bị mẫu câu với các giá trị truyền vào tương ứng từng vị trí placeholder
            $km_tomtat = sprintf(
                "Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                $rowKhuyenMai['km_ten'],
                $rowKhuyenMai['kh_noidung'],
                // Sử dụng hàm date($format, $timestamp) để chuyển đổi ngày thành định dạng Việt Nam (ngày/tháng/năm)
                // Do hàm date() nhận vào là đối tượng thời gian, chúng ta cần sử dụng hàm strtotime() để chuyển đổi từ chuỗi có định dạng 'yyyy-mm-dd' trong MYSQL thành đối tượng ngày tháng
                date('d/m/Y', strtotime($rowKhuyenMai['kh_tungay'])),
                date('d/m/Y', strtotime($rowKhuyenMai['km_denngay']))
            );
          }
          $dataKhuyenMai[] = array(
            'km_ma' => $rowKhuyenMai['km_ma'],
            'km_tomtat' => $km_tomtat,
        );
        }

        ?>

        <!-- Block content -->
        <form action="" method="post" name="frmCreate" id="frmCreate">
        <div class="form-group">
            <label for="sp_ten">Tên Sản phẩm</label>
            <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm" value="<?= $rowSanPham['sp_ten']?>">
        </div>
        <div class="form-group">
            <label for="sp_gia">Giá Sản phẩm</label>
            <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm" value="<?= $rowSanPham['sp_gia']?>">
        </div>
        <div class="form-group">
            <label for="sp_giacu">Giá cũ Sản phẩm</label>
            <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm" value="<?= $rowSanPham['sp_giacu']?>">
        </div>
        <div class="form-group">
            <label for="sp_mota_ngan">Mô tả ngắn</label>
            <textarea class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" ><?= $rowSanPham['sp_mota_ngan']?></textarea>
        </div>
        <div class="form-group">
            <label for="sp_mota_chitiet">Mô tả chi tiết</label>
            <textarea class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet" ><?= $rowSanPham['sp_mota_chitiet']?></textarea>
        </div>
        <div class="form-group">
            <label for="sp_ngaycapnhat">Ngày cập nhật</label>
            <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm" value="<?= $rowSanPham['sp_ngaycapnhat']?>">
        </div>
        <div class="form-group">
            <label for="sp_soluong">Số lượng</label>
            <input type="text" class="form-control" id="sp_soluong" name="sp_soluong" placeholder="Số lượng Sản phẩm" value="<?= $rowSanPham['sp_soluong']?>">
        </div>
        <div class="form-group">
            <label for="lsp_ma">Loại sản phẩm</label>
            <select name="lsp_ma" id="lsp_ma" class="form-control">
              <?php foreach($dataLoaiSanPham as $lsp):?>
                <option value="<?= $lsp['lsp_ma']?>"><?= $lsp['lsp_ten']?></option>
              <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="nsx_ma">Nhà sản xuất</label>
            <select class="form-control" id="nsx_ma" name="nsx_ma">
                <?php foreach ($dataNhaSanXuat as $nhasanxuat) : ?>
                    <option value="<?= $nhasanxuat['nsx_ma'] ?>"><?= $nhasanxuat['nsx_ten'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="nsx_ma">Khuyến mãi</label>
            <select class="form-control" id="km_ma" name="km_ma">
                <option value="">Chọn loại khuyến mãi...</option>
                <?php foreach ($dataKhuyenMai as $khuyenmai) : ?>
                    <option value="<?= $khuyenmai['km_ma'] ?>"><?= $khuyenmai['km_tomtat'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>
        </form>

        <?php
          // 2. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
          if (isset($_POST['btnSave'])) {
            // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
            $sp_ten = $_POST['sp_ten'];
            $sp_gia = $_POST['sp_gia'];
            $sp_giacu = $_POST['sp_giacu'];
            $sp_mota_ngan = $_POST['sp_mota_ngan'];
            $sp_mota_chitiet = $_POST['sp_mota_chitiet'];
            $sp_ngaycapnhat = $_POST['sp_ngaycapnhat'];
            $sp_soluong = $_POST['sp_soluong'];
            $lsp_ma = $_POST['lsp_ma'];
            $nsx_ma = $_POST['nsx_ma'];
            $km_ma = (empty($_POST['km_ma']) ? 'NULL' : $_POST['km_ma']);

            // Kiểm tra ràng buộc dữ liệu (Validation)
            // Tạo biến lỗi để chứa thông báo lỗi
            $errors = [];

            // Validate Tên  Sản phẩm_____________
            // required
            if(empty($sp_ten)){
              $errors['sp_ten'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $sp_ten,
                'msg' => 'Vui lòng nhập tên sản phẩm'
              ];
            }
            // minlength 5
            if (!empty($sp_ten) && strlen($sp_ten) < 5) {
              $errors['sp_ten'][] = [
                'rule' => 'minlength',
                'rule_value' => 5,
                'value' => $sp_ten,
                'msg' => 'Tên  sản phẩm phải có ít nhất 5 ký tự'
              ];
            }
            // maxlength 50
            if (!empty($sp_ten) && strlen($sp_ten) > 50) {
              $errors['sp_ten'][] = [
                'rule' => 'maxlength',
                'rule_value' => 50,
                'value' => $sp_ten,
                'msg' => 'Tên  sản phẩm không được vượt quá 50 ký tự'
              ];
            }

            // Validate giá________________________
            // required
            if (empty($sp_gia)) {
              $errors['sp_gia'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $sp_gia,
                'msg' => 'Vui lòng nhập giá sản phẩm'
              ];
            }
            
            // Là số
            if (!empty($sp_gia) && !is_numeric($sp_gia)) {
              $errors['sp_gia'][] = [
                'rule' => 'number',
                'rule_value' => true,
                'value' => $sp_gia,
                'msg' => 'Giá sản phẩm phải là số'
              ];
            }

            //Lớn hơn 0
            if (!empty($sp_gia) && $sp_gia <= 0 && is_numeric($sp_gia)) {
              $errors['sp_gia'][] = [
                'rule' => 'required',
                'rule_value' => 0,
                'value' => $sp_gia,
                'msg' => 'Giá sản phẩm phải lớn hơn 0'
              ];
            }
            
            // Validate giá cũ___________________
            // required
            if (empty($sp_giacu)) {
              $errors['sp_giacu'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $sp_giacu,
                'msg' => 'Vui lòng nhập giá cũ sản phẩm'
              ];
            }   

            // Là số
            if (!empty($sp_giacu) && !is_numeric($sp_giacu)) {
              $errors['sp_giacu'][] = [
                'rule' => 'number',
                'rule_value' => true,
                'value' => $sp_giacu,
                'msg' => 'Giá cũ sản phẩm phải là số'
              ];
            }

            //Lớn hơn 0
            if (!empty($sp_giacu) && $sp_giacu <= 0) {
              $errors['sp_giacu'][] = [
                'rule' => 'required',
                'rule_value' => 0,
                'value' => $sp_giacu,
                'msg' => 'Giá cũ sản phẩm phải lớn hơn 0'
              ];
            }
            
            // Validate mô tả ngắn Sản phẩm___________________
            // required
            if(empty($sp_mota_ngan)){
              $errors['sp_mota_ngan'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $sp_mota_ngan,
                'msg' => 'Vui lòng nhập mô tả ngắn sản phẩm'
              ];
            }
            // minlength 5
            if (!empty($sp_mota_ngan) && strlen($sp_mota_ngan) < 5) {
              $errors['sp_mota_ngan'][] = [
                'rule' => 'minlength',
                'rule_value' => 5,
                'value' => $sp_mota_ngan,
                'msg' => 'Mô tả ngắn sản phẩm phải có ít nhất 5 ký tự'
              ];
            }
            // maxlength 50
            if (!empty($sp_mota_ngan) && strlen($sp_mota_ngan) > 100) {
              $errors['sp_mota_ngan'][] = [
                'rule' => 'maxlength',
                'rule_value' => 100,
                'value' => $sp_mota_ngan,
                'msg' => 'Mô tả ngắn sản phẩm không được vượt quá 100 ký tự'
              ];
            }


            // Validate mô tả chi tiết  Sản phẩm
            // required
            if(empty($sp_mota_chitiet)){
              $errors['sp_mota_chitiet'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $sp_mota_chitiet,
                'msg' => 'Vui lòng nhập mô tả chi tiết  sản phẩm'
              ];
            }
            // minlength 5
            if (!empty($sp_mota_chitiet) && strlen($sp_mota_chitiet) < 5) {
              $errors['sp_mota_chitiet'][] = [
                'rule' => 'minlength',
                'rule_value' => 5,
                'value' => $sp_mota_chitiet,
                'msg' => 'mô tả chi tiết  sản phẩm phải có ít nhất 5 ký tự'
              ];
            }
            // maxlength 5000
            if (!empty($sp_mota_chitiet) && strlen($sp_mota_chitiet) > 5000) {
              $errors['sp_mota_chitiet'][] = [
                'rule' => 'maxlength',
                'rule_value' => 5000,
                'value' => $sp_mota_chitiet,
                'msg' => 'mô tả chi tiết  sản phẩm không được vượt quá 5000 ký tự'
              ];
            }

            // Validate ngày cập nhật___________________
            // required
            if (empty($sp_ngaycapnhat)) {
              $errors['sp_ngaycapnhat'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $sp_ngaycapnhat,
                'msg' => 'Vui lòng nhập ngày cập nhật sản phẩm'
              ];
            }

            // Validate số lượng___________________
            // required
            if (empty($sp_soluong)) {
              $errors['sp_soluong'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $sp_soluong,
                'msg' => 'Vui lòng nhập số lượng sản phẩm'
              ];
            }  
            
            // Là số
            if (!empty($sp_soluong) && !is_numeric($sp_soluong)) {
              $errors['sp_soluong'][] = [
                'rule' => 'number',
                'rule_value' => true,
                'value' => $sp_soluong,
                'msg' => 'Số lượng sản phẩm phải là số'
              ];
            }

            //Lớn hơn hoặc bằng 0
            if ($sp_soluong < 0) {
              $errors['sp_soluong'][] = [
                'rule' => 'required',
                'rule_value' => 0,
                'value' => $sp_soluong,
                'msg' => 'Vui lòng nhập số lượng sản phẩm lớn hơn hoặc bằng 0'
              ];
            }
          }
          ?>

          <!-- Nếu có lỗi VALIDATE dữ liệu thì hiển thị ra màn hình 
          - Sử dụng thành phần (component) Alert của Bootstrap
          - Mỗi một lỗi hiển thị sẽ in theo cấu trúc Danh sách không thứ tự UL > LI
          -->
          <?php if (
            isset($_POST['btnSave'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
            && isset($errors)         // Nếu biến $errors có tồn tại
            && (!empty($errors))      // Nếu giá trị của biến $errors không rỗng
          ) : ?>
            <div id="errors-container" class="alert alert-danger face my-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <ul>
                <?php foreach ($errors as $fields) : ?>
                  <?php foreach ($fields as $field) : ?>
                    <li><?php echo $field['msg']; ?></li>
                  <?php endforeach; ?>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>


          <?php
                    // 2. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
          // Nếu không có lỗi VALIDATE dữ liệu (tức là dữ liệu đã hợp lệ)
            // Tiến hành thực thi câu lệnh SQL Query Database
            // => giá trị của biến $errors là rỗng
            if (isset($_POST['btnSave'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
            && (!isset($errors) || (empty($errors))) // Nếu biến $errors không tồn tại Hoặc giá trị của biến $errors rỗng
          ) {
            // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
            
            // Câu lệnh Update
            $sql = <<<EOT
            UPDATE sanpham
            SET		
              sp_ten='$sp_ten',
              sp_gia=$sp_gia,
              sp_giacu=$sp_giacu,
              sp_mota_ngan='$sp_mota_ngan',
              sp_mota_chitiet='$sp_mota_chitiet',
              sp_ngaycapnhat='$sp_ngaycapnhat',
              sp_soluong=$sp_soluong,
              lsp_ma=$lsp_ma,
              nsx_ma=$nsx_ma,
              km_ma=$km_ma
            WHERE sp_ma=$sp_ma;
EOT;
            // var_dump($sql);die;
            // Thực thi INSERT
            mysqli_query($conn, $sql);

            // Đóng kết nối
            mysqli_close($conn);

            // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
            echo "<script>location.href = 'index.php';</script>";
          
          }
        ?>

        <!-- End block content -->
      </main>
    </div>
  </div>

  <!-- footer -->
  <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
  <!-- end footer -->

  <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
  <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

  <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
  <!-- <script src="..."></script> -->

  <script>
  $(document).ready(function() {
    $("#frmCreate").validate({
      rules: {
        sp_ten: {
          required: true,
          minlength: 5,
          maxlength: 50
        },
        sp_gia: {
          required: true,
          number: true,
          min: 0
        },
        sp_giacu: {
          required: true,
          number: true,
          min: 0
        },
        sp_mota_ngan: {
          required: true,
          minlength: 5,
          maxlength: 50
        },
        sp_mota_chitiet: {
          required: true,
          minlength: 5,
          maxlength: 5000
        },
        sp_ngaycapnhat: {
          required: true
        },
        sp_soluong: {
          required: true,
          number: true,
          min: 0
        }
      },
      messages: {
        sp_ten: {
          required: "Vui lòng nhập tên sản phẩm",
          min: "Tên sản phẩm phải có ít nhất 5 ký tự",
          maxlength: "Tên sản phẩm không được vượt quá 50 ký tự"
        },
        sp_gia: {
          required: "Vui lòng nhập giá sản phẩm",
          number: "Giá sản phẩm phải là số",
          min: "Vui lòng nhập giá sản phẩm lớn hơn 0"
        },
        sp_giacu: {
          required: "Vui lòng nhập giá cũ sản phẩm",
          number: "Giá cũ sản phẩm phải là số",
          min: "Giá cũ sản phẩm phải lớn hơn 0"
        },
        sp_mota_ngan: {
          required: "Vui lòng nhập mô tả sản phẩm",
          minlength: "Mô tả ngắn sản phẩm phải có ít nhất 5 ký tự",
          maxlength: "Mô tả ngắn sản phẩm không được vượt quá 100 ký tự"
        },
        sp_mota_chitiet: {
          required: "Vui lòng nhập mô tả chi tiết sản phẩm",
          minlength: "Mô tả chi tiết sản phẩm phải có ít nhất 5 ký tự",
          maxlength: "Mô tả chi tiết sản phẩm không được vượt quá 5000 ký tự"
        },
        sp_ngaycapnhat: {
          required: "Vui lòng nhập ngày cập nhật sản phẩm"
        },
        sp_soluong: {
          required: "Vui lòng nhập số lượng sản phẩm",
          number: "Số lượng sản phẩm phải là số",
          min: "Số lượng sản phẩm phải lớn hơn 0"
        }
      },
      errorElement: "em",
      errorPlacement: function(error, element) {
        // Thêm class `invalid-feedback` cho field đang có lỗi
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("label"));
        } else {
          error.insertAfter(element);
        }
      },
      success: function(label, element) {},
      highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
      }
    });
  });
</script>

</body>

</html>