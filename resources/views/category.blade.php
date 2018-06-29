@extends('layouts.app')

@section('menu')

@guest
  <li><a href="/">Home</a></li>
  <li><a href="/topics">Support Topics</a></li>
  <li><a href="/register">Create Account</a></li>
  <li><a href="#" data-toggle="modal" data-target="#LoginModal"><i class="material-icons">lock</i> Login</a></li>
@else
  <li><a href="/">Home</a></li>
  <li><a href="/topics">Support Topics</a></li>
  <li><a href="/my-ticket">Submit Tickets</a></li>
  <li class="dropdown active">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
      {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
      <li><a href="/notification" ><i class="material-icons">notifications</i> Notifications</a></li>
      <li><a href="/profile" ><i class="material-icons">person</i> Profile</a></li>
      @if(Auth::user()->id == 1)
      <li><a href="/category" ><i class="material-icons">category</i> Category</a></li>
      @endif
      <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="material-icons">exit_to_app</i>  Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </li>
    </ul>
  </li>
@endguest

@endsection

@section('content')
        <section class="section">
            <div class="container">
                <div class="page-title text-center">
                    <h1>List Category</h1>
                    <ul class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">Category</li>
                    </ul>
                </div><!-- end title -->
            </div><!-- end container -->
        </section><!-- end section -->
        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> 
                      <div class="widget">
                            <a class="btn btn-raised btn-info gr" href="#" data-toggle="modal" data-target="#AddCategory"><i class="material-icons">add</i> Add New</a>
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Category</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no = 1; ?>
                                @foreach($category as $data)
                                <tr>
                                  <td style="vertical-align: middle;">{{ $no++ }}</td>
                                  <td style="vertical-align: middle;">{{ $data->nama }}</td>
                                  <td>
                                    <div class="upload-btn-wrapper">
                                      <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#UpdateCategory{{ $data->id }}"><i class="material-icons">edit</i></a>
                                      <a href="/category/delete/{{ $data->id }}" onclick="confirm()" class="btn btn-danger"><i class="material-icons">delete</i></a>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->
        <div id="AddCategory" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Enter New Category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-body">

                                    <form class="sidebar-login" method="POST" action="/category">
                                        {{ csrf_field() }}
                                        <input type="text" name="nama" class="form-control" placeholder="Category" required>
                                        <button type="submit" class="btn btn-raised">Submit</button>
                                    </form> 
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>
                </div>
            </div>
        </div>
        <script> 
          function confirm() {
            alert("Category has ben deleted");
          }
          
        </script>
        @foreach($category as $data)
        <div id="UpdateCategory{{ $data->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Category Category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-body">

                                    <form class="sidebar-login" method="POST" action="/category/update">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="text" name="nama" class="form-control" placeholder="Category" value="{{ $data->nama }}" required>
                                        <button type="submit" class="btn btn-raised">Submit</button>
                                    </form> 
                                </div>
                            </div>
                        </div><!-- end widget -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
@endsection
