@extends('layouts.main')

@section('title', config('global.COMPANY').' Dashboard | Role Permission Add')

<style>

/* Add this CSS in your style block or external stylesheet */
.loader {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -25px;
    margin-left: -25px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>
@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role Permission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Role Permission</li>
              <li class="breadcrumb-item active">Create New</li>
       


            </ol>
            

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
          
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Role Permission</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('permission_role.store') }}" method="POST">
              @csrf
                <!-- /.card-header -->
                <div class="card-body">
                  <!-- Loader element -->
                  <div id="loader" class="loader"></div>

                  <div class="form-group">
                    <label>Select Role</label>
                    <select class="form-control select2 select2-danger" name="role_id" id="role_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="" >Select Role</option>
                        @foreach($roles as $item)
                              <option value="{{ $item->id }}" {{ old('role_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>All Permissions</label>
                    <div class="row" id="permission-list">
                        
                    </div>
                  </div>
                

                  

                  

              </div>
                <!-- /.card-body -->              
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form>
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          
        </div>
        
        
        
        








      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->




        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function () {
          $("#loader").hide();
            // Fetch permissions based on role selection
            $('#role_id').change(function () {
                $("#loader").show();
                var list = $('#permission-list');
                list.empty();
                var roleId = $(this).val();
                $.ajax({
                    url: '/get-permissions/'+ roleId,
                    type: 'GET',
                    success: function (data) {
                        console.log("LOG = ", data);
                        $("#loader").hide();
                        

                        list.append('<div class="col-md-12">')
                        var count = 1;
                        $.each(data, function (index, permission) {
                            var checkboxId = "checkbox_" + permission.id;
                            var isChecked = permission.role_permission.length > 0 ? true : false;
                            
                            var checkboxElement = '<div class="col-md-4 icheck-primary d-inline"> '+count+'. <input type="checkbox" id="' + checkboxId + '" name="permission[]" value="' + permission.id + '" class="form-control"' + (isChecked ? ' checked' : '') + '>';
                            var labelElement = '<label for="' + checkboxId + '">' + permission.name.name + '</label><br>';
                            
                            // Append the checkbox and label to a container (e.g., a div with ID "checkboxes-container")
                            list.append(checkboxElement + labelElement);
                            count++;
                        });
                        list.append('</div></div>');
                    },
                    error: function() {
                        $("#loader").hide();
                    }
                });
            });
        });
    </script>