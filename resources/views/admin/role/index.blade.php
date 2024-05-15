@extends('layouts.main')

@section('title', config('global.COMPANY').' Dashboard | Role')
<style>
    
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #d12323;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: #fff;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #4CAF50; /* Green for "live" */
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #4CAF50;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
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
            <h1>Role page</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Role</li>
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
          @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
          @if(session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
          @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Role data</h3>
                    @if(auth()->user()->hasPermission('create_roles'))
                      <a class="float-right" href="{{ route('role.create') }}" >
                          <button type="button" class="btn btn-block btn-primary btn-sm">Add New</button>
                      </a>
                    @endif
                  
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Live</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php
                        $i = 1;
                      @endphp

                      @foreach($results as $result)
                      <tr>
                        
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->name_slug }}</td>
                        
                        
           
                        <td>
                          
                          <form action="{{ route('role.activeStatus', $result->id) }}" method="POST">
                              @csrf
                              <label class="switch">
                                  <input type="checkbox" onchange="this.form.submit()" {{ $result->is_active === 1 ? 'checked' : '' }}>
                                  <span class="slider round"></span>
                              </label>
                          </form>

                        </td>
                        <td>{{ $result->created_at }}</td>
                        <td>
                          @if(auth()->user()->hasPermission('show_roles'))
                            <a href="{{ route('role.show', $result->id) }}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></a> 
                          @endif

                          @if(auth()->user()->hasPermission('edit_roles'))
                            |
                            <a href="{{ route('role.edit', $result->id) }}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></a>
                            
                          @endif

                          @if(auth()->user()->hasPermission('delete_roles'))
                            |
                              <form action="{{ route('role.destroy', $result->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this records?')"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                            </form>
                          @endif
                          
                        </td>
                      </tr>
                      @php
                          $i++;
                      @endphp
                      @endforeach                
                      
                      
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    @if ($previousPage)
                        <li class="page-item">
                            <a class="page-link" href="?page={{ $previousPage }}">&laquo;</a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $results->lastPage(); $i++)
                        <li class=" page-item {{ $i == $results->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Forward button --}}
                    @if ($nextPage)
                        <li class="page-item">
                            <a class="page-link" href="?page={{ $nextPage }}">&raquo;</a>
                        </li>
                    @endif
                </ul>

                
              </div>
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