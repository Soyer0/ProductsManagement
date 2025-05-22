<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
  <!-- begin container-fluid -->
  <div class="container-fluid">
    <!-- begin mobile sidebar expand / collapse button -->
    <div class="navbar-header">
      <a href="" class="navbar-brand"><span class="navbar-logo"></span></a>
      <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- end mobile sidebar expand / collapse button -->
    
    <!-- begin header navigation right -->
    <ul class="nav navbar-nav navbar-right">
      <li>
        <form action="admin/search" class="navbar-form full-width">
          <div class="form-group">
            <input name="by" type="text" class="form-control" placeholder="" />
            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </li>
      <li class="dropdown navbar-user">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
        </a>
        <ul class="dropdown-menu animated fadeInLeft">
          <li class="arrow"></li>
          <li><a href="admin/wl_users/my"><i class="fas fa-house-user"></i></a></li>
          <li class="divider"></li>
          <li><a href="logout"><i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
      </li>
    </ul>
    <!-- end header navigation right -->
  </div>
  <!-- end container-fluid -->
</div>
<!-- end #header -->