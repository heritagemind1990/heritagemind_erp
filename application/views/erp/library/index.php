<style>
  .subheading{
 font-size:0.9rem ;
 color:#000;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4 pb-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>library-data">Home</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

       <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>library-student-master">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Master</span>
                <span class="info-box-text subheading">Total Student  :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
           <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>add-author">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-user-tie"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Author Master</span>
                <span class="info-box-text subheading">Total Author  :- <?=$total_author;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>add-publishers">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-user-tie"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Publishers Master</span>
                <span class="info-box-text subheading">Total Publishers  :- <?=$total_publishers;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
           <!-- col -->
           <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>book-category-master">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-paste"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Book Category Master</span>
                <span class="info-box-text subheading">Total Category  :- <?=$total_category;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>books-master">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Books Master</span>
                <span class="info-box-text subheading">Total Books  :- <?=$total_book;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-book-assign">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fa-solid fa-book-open-reader"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Book Assign</span>
                <span class="info-box-text subheading">Total student  :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>teacher-book-assign">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-book-open-reader"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Teacher Book Assign</span>
                <span class="info-box-text subheading">Total Teacher  :- <?=$total_teacher;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>teacher-assigned-books">
            <div class="info-box">
              <span class="info-box-icon bg-secondary "><i class="fa-solid fa-book-open-reader "></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Teacher Assigned Books</span>
                <span class="info-box-text subheading">Total Teacher  :- <?=$total_teacher;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
        </div>
      </div><!-- /.container-fluid -->

  </div>
  <!-- /.content-wrapper -->
