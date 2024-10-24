<aside class="sidebar navbar-default" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href=><i class="fa fa-bar-chart-o fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href={{ Route('admin.accounts.index') }}><i class="fa fa-sitemap fa-fw"></i> User</a>
            </li>
            <li>
                <a href={{ Route('admin.comments.index') }}><i class="fa fa-edit fa-fw"></i> Comment</a>
            </li>



        </ul>
    </div>
</aside>
<!-- /.sidebar -->
