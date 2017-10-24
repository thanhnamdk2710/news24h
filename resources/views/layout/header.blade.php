<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laravel Tin Tức</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/about">Giới thiệu</a>
                </li>
                <li>
                    <a href="/contact">Liên hệ</a>
                </li>
            </ul>

            <form action="/search" method="POST" class="navbar-form navbar-left" role="search">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm" name="keyword">
                </div>
                <button type="submit" class="btn btn-default">Tìm</button>
            </form>

            <ul class="nav navbar-nav pull-right">
                @if(!Auth::user())
                <li>
                    <a href="/signin">Đăng ký</a>
                </li>
                <li>
                    <a href="/login">Đăng nhập</a>
                </li>
                @else
                <li>
                    <a href="/user">
                        <span class ="glyphicon glyphicon-user"></span>
                        {{ Auth::user()->name }}
                    </a>
                </li>

                <li>
                    <a href="/logout">Đăng xuất</a>
                </li>
                @endif

            </ul>
        </div>



        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>