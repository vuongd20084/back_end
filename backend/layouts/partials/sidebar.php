<nav class="col-md-2 d-none d-md-block sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <!-- #################### Menu các trang Quản lý #################### -->
      <li class="nav-item sidebar-heading"><span>Quản lý</span></li>
      <li class="nav-item">
        <a href="/back_end/backend/pages/dashboard.php">Bảng tin <span class="sr-only">(current)</span></a>
      </li>
      <hr style="border: 1px solid red; width: 80%;" />
      <!-- #################### End Menu các trang Quản lý #################### -->

      <!-- #################### Menu chức năng Danh mục #################### -->
      <li class="nav-item sidebar-heading">
        <span>Danh mục</span>
      </li>
      <!-- Menu Loại sản phẩm -->
      <li class="nav-item">
        <a href="#LoaiSanPhamSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          Loại sản phẩm
        </a>
        <ul class="collapse" id="LoaiSanPhamSubMenu">
          <li class="nav-item">
            <a href="/back_end/backend/functions/loaisanpham/index.php">Danh sách</a>
          </li>
          <li class="nav-item">
            <a href="/back_end/backend/functions/loaisanpham/create.php">Thêm mới</a>
          </li>
        </ul>
      </li>
      <!-- End Menu Sản phẩm -->
      <!-- Menu Sản phẩm -->
      <li class="nav-item">
        <a href="#SanPhamSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          Sản phẩm
        </a>
        <ul class="collapse" id="SanPhamSubMenu">
          <li class="nav-item">
            <a href="/back_end/backend/functions/sanpham/index.php">Danh sách</a>
          </li>
          <li class="nav-item">
            <a href="/back_end/backend/functions/sanpham/create.php">Thêm mới</a>
          </li>
        </ul>
      </li>
      <!-- End Menu Sản phẩm -->
      <!-- Menu Hình Sản phẩm -->
      <li class="nav-item">
        <a href="#hinhsanphamSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          Hình Sản phẩm
        </a>
        <ul class="collapse" id="hinhsanphamSubMenu">
          <li class="nav-item">
            <a href="/back_end/backend/functions/hinhsanpham/index.php">Danh sách</a>
          </li>
          <li class="nav-item">
            <a href="/back_end/backend/functions/hinhsanpham/create.php">Thêm mới</a>
          </li>
        </ul>
      </li>
      <!-- End Sản phẩm -->
      <!-- #################### End Menu chức năng Danh mục #################### -->
    </ul>
  </div>
</nav>