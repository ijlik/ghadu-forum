<!doctype html>
<!--[if IE 9]> <html class="no-js ie9 fixed-layout" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js " lang="en"> <!--<![endif]-->
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- Site Metas -->
    <title>Forum - Ghadu Indonesia</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="/assets/images/favicon-alt.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon-alt.png">
    
    <!-- Material Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-material-design.css">
    <link rel="stylesheet" href="/assets/css/ripples.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    
    <!-- Site CSS -->
    <link rel="stylesheet" href="/style.css">
    <!-- Colors CSS -->
    <link rel="stylesheet" href="/assets/css/colors_01.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="home_alt">

    <!-- LOADER -->
    <div id="preloader">
        <img class="preloader" src="/assets/images/loader-alt.gif" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->
    
    <div id="wrapper">
        <header class="header">
            <div class="container-fluid">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index-alt.html"><i class="material-icons">chat</i> Ghadu Forum</a>
                        </div>
                        <div class="navbar-collapse collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                @yield('menu')
                            </ul>
                        </div>
                    </div>
                </nav>
            </div><!-- end container -->
        </header><!-- end header -->

        @yield('content')

        <div class="stickyfooter">
            <div id="sitefooter" class="container">
                <div id="copyright" class="row">
                    <div class="col-md-6 col-sm-12 text-left">
                        <p>Ghadu Forum is a part of <a href="https://ghadu.id">Ghadu Indonesia</a></p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="list-inline text-right">
                            <li><a href="#">Terms of Usage</a></li>
                            <li><a href="#">Copyrights</a></li>
                            <li><a href="#">License</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- CHAT -->
        <div class="chat-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading" id="chatcordion">
                    <a class="open-support btn btn-raised btn-info" data-toggle="collapse" data-parent="#chatcordion" href="#chatcordion1">
                        <i class="material-icons">chat</i>
                    </a>
                </div>
                <div class="panel-collapse collapse" id="chatcordion1">
                    <span class="chat-logo"><i class="material-icons">announcement</i> Helper Support Chat</span>
                    <div class="panel-body">
                        <ul class="chat">
                            <li class="left clearfix">
                                <span class="chat-img">
                                    <img src="/assets/images/uploads/team_05.jpg" alt="" class="avatar img-circle img-responsive alignleft">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="chat-header">
                                        <strong class="primary-font">Jenny DOE</strong> <small class="pull-right text-muted">
                                        <span class="fa fa-clock-o"></span>12 mins ago</small>
                                    </div>
                                    <p>Hello anyone here? I need to purchase web hosting!</p>
                                </div>
                            </li>
                      
                            <li class="left clearfix">
                                <span class="chat-img">
                                    <img src="/assets/images/uploads/team_06.jpg" alt="" class="avatar img-circle img-responsive alignleft">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="chat-header">
                                        <strong class="label label-primary supportstaff">Staff</strong> <small class="pull-right text-muted">
                                        <span class="fa fa-clock-o"></span>13 mins ago</small>
                                    </div>
                                    <p>Hey Jenny! Welcome to the Helper support chat!</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <input id="btn-input" type="text" class="form-control" placeholder="Type your message here..." />
                        <button class="btn btn-raised btn-primary gr" id="btn-chat">Send</button>
                    </div><!-- end panel-footer -->
                </div><!-- end panel-collapse -->
            </div><!-- end panel -->
        </div><!-- end chat-wrapper -->
      
        <!-- NOTIFICATION -->
<!--         <div class="notif-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading" id="chatcordion">
                    <a class="open-notif btn btn-raised btn-info" data-toggle="collapse" data-parent="#chatcordion" href="#chatcordion2">
                        <i class="material-icons">notifications</i>
                    </a>
                </div>
                <div class="panel-collapse collapse" id="chatcordion2">
                    <span class="chat-logo"><i class="material-icons">notifications</i> Pemberitahuan</span>
                    <div class="panel-body">
                        <ul class="chat">
                            <li class="left clearfix">
                                <span class="chat-img">
                                    <img style="width: 20%" src="assets/images/uploads/team_05.jpg" alt="" class="avatar img-circle img-responsive alignleft">
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="chat-header">
                                        <strong class="primary-font">Jenny DOE</strong> <small class="pull-right text-muted">
                                        <span class="fa fa-clock-o"></span>12 mins ago</small>
                                    </div>
                                    <p>Hello anyone here? I need to purchase web hosting!</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Modal -->
        <div id="LoginModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Login Account</h4>
                    </div>
                    <div class="modal-body">
                        <div class="widget clearfix">
                            <div class="panel panel-primary">
                                <div class="panel-body">
<!--                                     <div class="login-buttons">
                                    <a href="#" class="btn btn-raised btn-facebook btn-block"><i class="fa fa-facebook"></i> Login with Facebook</a>
                                    </div> -->

                                    <form class="sidebar-login" method="POST" action="/login">
                                        {{ csrf_field() }}
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                                        @if ($errors->has('email'))
                                          <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                        @endif
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                          <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                        @endif
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> &nbsp;&nbsp;Remember me
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-raised btn-info gr">Login</button>
                                    </form> 
                                </div>
                            </div>
                            <small>No account? <a href="/register">Register</a></small>
                        </div><!-- end widget -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->

    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/ripples.min.js"></script>
    <script src="/assets/js/material.min.js"></script>
    <script src="/assets/js/custom.js"></script>

</body>
</html>