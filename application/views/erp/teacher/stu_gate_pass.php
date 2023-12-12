
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>teacher-data">Teacher</a></li>
              <li class="breadcrumb-item active">Student Gate Pass</li>
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
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              <h3 class="card-title float-right">
                
                <a href="<?=base_url();?>teacher-data" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
             <div class="col-md-11">
                 <div class="form-group mb-0">
                     <input type="text" class="form-control input-sm" name="search" id="search"  placeholder="Search..." />
                 </div>
             </div>
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show" >
              <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered" id="data-table">
                  <thead>
                  <tr>

                    <th>Student ID</th>
                    <th>Enrollment / SRNo</th>
                    <th>Student Name</th>
                    <th>Section</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Father No</th>
                    <th>Action</th>
                  </tr>
                  </thead>  
                  <tbody>
                  </tbody>
                </table>
              </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
        $(document).ready(function() {
            loadData();

            $("#search").on('input', function() {
                loadData();
            });
        });

        function loadData() {
            var searchTerm = $("#search").val();

            $.ajax({
                url: "<?php echo base_url('teacher-student-gate-pass/search_data'); ?>",
                type: "POST",
                dataType: "json",
                data: { searchTerm: searchTerm },
                success: function(data) {
                    var table = $('#data-table').find('tbody');
                    table.empty();
                    
                    $.each(data, function(index, record) {
                        var row = "<tr><td>" + record.stu_id + "</td><td>" + record.enrollment + "</td><td>" + record.fname + record.lname + "</td><td>" + record.section_name + "</td><td>" + record.father + "</td><td>" + record.mother + "</td><td>" + record.father_no + "</td><td><a href='<?=base_url("teacher-student-gate-pass/createpass/");?>"+ record.id +"' class='btn btn-sm btn-primary'>Create GatePass</a></td></tr>";
                        table.append(row);
                    });
                }
            });
        }
    </script>

