<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
  <!-- Brand Logo Light -->
  <a href="index.php" class="logo logo-light">
    <span class="logo-lg">
      <img src="{{ asset('assets/images/logo.png')}}" alt="logo" />
    </span>
    <span class="logo-sm">
      <img src="{{ asset('assets/images/logo-sm.png')}}" alt="small logo" />
    </span>
  </a>

  <!-- Brand Logo Dark -->
  <a href="index.php" class="logo logo-dark">
    <span class="logo-lg">
      <img src="{{ asset('assets/images/logo-dark.png')}}" alt="dark logo" />
    </span>
    <span class="logo-sm">
      <img src="{{ asset('assets/images/logo-sm.png')}}" alt="small logo" />
    </span>
  </a>

  <!-- Sidebar Hover Menu Toggle Button -->
  <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
    <i class="ri-checkbox-blank-circle-line align-middle"></i>
  </div>

  <!-- Full Sidebar Menu Close Button -->
  <div class="button-close-fullsidebar">
    <i class="ri-close-fill align-middle"></i>
  </div>

  <!-- Sidebar -left -->
  <div class="h-100" id="leftside-menu-container" data-simplebar>
    <!-- Leftbar User -->
    <div class="leftbar-user">
      <a href="pages-profile.php">
        <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm" />
        <span class="leftbar-user-name mt-2">Tosha Minner</span>
      </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">
      <li class="side-nav-title">Navigation</li>

      <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards"
          class="side-nav-link">
          <i class="ri-home-4-line"></i>
          <span class="badge bg-success float-end">2</span>
          <span> Dashboards </span>
        </a>
        <div class="collapse" id="sidebarDashboards">
          <ul class="side-nav-second-level">
            <li>
              <a href="dashboard-analytics.php">Analytics</a>
            </li>
            <li>
              <a href="index.php">Ecommerce</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="side-nav-title">Users</li>

      <li class="side-nav-item">
        <a href="/user-list" class="side-nav-link">
          <i class=" ri-user-line"></i>
          <span> User List </span>
        </a>
      </li>

      @if (auth()->user()->authorizedPages->contains('slug', 'role-list') || auth()->user()->role_id == 1)
      <li class="side-nav-item">
      <a href="/role-list" class="side-nav-link">
        <i class=" ri-seo-line"></i>
        <span> Role List </span>
      </a>
      </li>
    @endif

      @if (auth()->user()->authorizedPages->contains('slug', 'team-list') || auth()->user()->role_id == 1)
      <li class="side-nav-item">
      <a href="/team-list" class="side-nav-link">
        <i class="ri-team-line"></i>
        <span>Team List </span>
      </a>
      </li>
    @endif
      <li class="side-nav-title">Surveys</li>

      <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail"
          class="side-nav-link">
          <i class="ri-chat-poll-line"></i>
          <span> Surveys </span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEmail">
          <ul class="side-nav-second-level">
            <li>
              <a href="apps-email-inbox.php">Surveys List</a>
            </li>
            <li>
              <a href="apps-email-read.php">Surveys Question</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="side-nav-item">
        <a href="response-list.php" class="side-nav-link">
          <i class="ri-list-check-3"></i>
          <span> Response List </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks"
          class="side-nav-link">
          <i class="ri-task-line"></i>
          <span> Reports </span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarTasks">
          <ul class="side-nav-second-level">
            <li>
              <a href="apps-tasks.php">User Wise</a>
            </li>
            <li>
              <a href="apps-tasks-details.php">Surveys Wise</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="side-nav-title">Settings</li>

      @if (auth()->user()->authorizedPages->contains('slug', 'permission') || auth()->user()->role_id == 1)
      <li class="side-nav-item">
      <a href="/permission" class="side-nav-link">
        <i class=" ri-settings-3-line"></i>
        <span> Permission </span>
      </a>
      </li>
    @endif

      <li class="side-nav-item">
        <a href="/profile" class="side-nav-link">
          <i class="ri-user-3-line"></i>
          <span> Profile </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a href="/logout" class="side-nav-link">
          <i class=" ri-arrow-go-back-fill"></i>
          <span> LogOut </span>
        </a>
      </li>

    </ul>
    <!--- End Sidemenu -->

    <div class="clearfix"></div>
  </div>
</div>
<!-- ========== Left Sidebar End ========== -->