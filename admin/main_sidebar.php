<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="admin_home.php" class="brand-link">
		<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">ESS</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<!-- user menu -->
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>
							Users
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="#" onclick="addArea()" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Area</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" onclick="userList()" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Users List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" onclick="liveUserList()" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Live Users</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>
							Supervisors
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="#" onclick="addSupervisor()" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Supervisor</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" onclick="supervisorList()" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Supervisors List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" onclick="supervisorActivity()" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Supervisors Activity</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" onclick="supervisorLive()" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Live Supervisors</p>
							</a>
						</li>
					</ul>
				</li>
				<!-- complain data -->
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-first-aid"></i>
						<p>
							Services
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="#" onclick="addSevices()" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Services</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-server"></i>
						<p>
							Emergency
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="#" class="nav-link" onclick="emergecyReport()">
								<i class="nav-icon fas fa-copy"></i>
								<p>
									Emergency Report
								</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="#" class="nav-link" onclick="emergecyFeedback()">
								<i class="nav-icon fas fa-copy"></i>
								<p>
									Emergency Feedback
								</p>
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