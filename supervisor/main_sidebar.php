<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="supervisor_home.php" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">ESS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- profile -->
        <li class="nav-item">
          <a href="#" class="nav-link" onclick="supervisorProfile()">
            <i class="nav-icon fas fa-id-badge"></i>
            <p>
              Profile
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Emergency
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="newEmergency()">
                <i class="far fa-circle nav-icon"></i>
                <p>New Emergency</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="actionEmergency()">
                <i class="far fa-circle nav-icon"></i>
                <p>Action Emergency</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="completeEmergency()">
                <i class="far fa-circle nav-icon"></i>
                <p>Complete Emergency</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<audio id="myAudio" style="display: none;" controls>
  <source src="./audio/Let-it-snow-ringtone.mp3" type="audio/mpeg">
  </audio>