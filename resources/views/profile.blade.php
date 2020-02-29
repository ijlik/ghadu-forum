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
<section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"> 
                      <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">lock</i> Picture & Account</h4>

                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <form class="sidebar-login" action="/profile/update-picture" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <img src="/assets/images/uploads/{{ (is_null(Auth::user()->avatar)) ? 'team_01.jpg' : Auth::user()->avatar }}" alt="" class="avatar img-responsive">
                                            
                                            <div class="upload-btn-wrapper">
                                              <button class="btn btn-custom1">Choose image</button>
                                              <input type="file" name="myfile" />
                                              <button class="btn btn-custom1"><i class="material-icons">save</i></button>
                                            </div>
                                        </form> 

                                   <hr>
                                        <form class="sidebar-login" action="/profile" method="POST">
                                            {{ csrf_field() }}
                                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $user->name }}">
                                            @if ($errors->has('name'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                            @endif
                                            <input type="email" class="form-control" placeholder="Email Address" value="{{ $user->email }}">
                                            @if ($errors->has('email'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                              </span>
                                            @endif
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                            @if ($errors->has('password'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                              </span>
                                            @endif
                                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                            
                                            <button type="submit" class="btn btn-raised btn-info gr">Update</button>
                                        </form> 

                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                    
                   <div class="col-md-8">
                        <div class="widget">
                            <div class="custom-module">
                                <h4 class="module-title"><i class="material-icons">info</i> My Profile</h4>

                                <div class="panel panel-primary">
                                    @if(!is_null($status))
                                    <div class="alert alert-{{ $status }} alert-dismissible">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       {{ $message }}
                                    </div>
                                    @endif
                                    <div class="panel-body">
                                        <form class="sidebar-login" action="/profile/info" method="POST">
                                            {{ csrf_field() }}
                                            <input type="text" class="form-control" placeholder="NIK (Nomor KTP)" name="nik" value="{{ $user->nik }}">
                                            @if ($errors->has('nik'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('nik') }}</strong>
                                              </span>
                                            @endif
                                            <div class="form-group">
                                              <label for="exampleTextarea" class="col-md-4 control-label">Alamat</label>
                                              <textarea class="form-control" id="exampleTextarea" rows="7" name="alamat">{{ $user->alamat }}</textarea>
                                            </div>
                                            @if ($errors->has('alamat'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                              </span>
                                            @endif
                                            <input type="text" class="form-control" placeholder="Nomor Hp" name="no_telp" value="{{ $user->no_telp }}">
                                            @if ($errors->has('no_telp'))
                                              <span class="help-block">
                                                <strong>{{ $errors->first('no_telp') }}</strong>
                                              </span>
                                            @endif
                                            <div class="form-group">
                                              <select class="form-control" id="exampleSelect1" name="pekerjaan">
                                                  <option value="{{ $user->pekerjaan }}">{{ (is_null($user->pekerjaan)) ? "Pilih pekerjaan" : $user->pekerjaan }}</option>
                                                  <option value="Peternak">Peternak</option>
                                                  <option value="Dokter Hewan">Dokter Hewan</option>
                                                  <option value="Distributor Pakan dan Nutrisi">Distributor Pakan dan Nutrisi</option>
                                                  <option value="Penjual Hewan">Penjual Hewan</option>
                                                  <option value="Pengusaha Pengolah hasil Ternak">Pengusaha Pengolah hasil Ternak</option>
                                                  <option value="Bukan dari bidang Peternakan">Bukan dari bidang Peternakan</option>
                                              </select>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-raised btn-info gr">Update</button>
                                        </form> 

                                    </div>
                                </div>
                            </div><!-- end custom-module -->
                        </div><!-- end widget -->
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->
@endsection
