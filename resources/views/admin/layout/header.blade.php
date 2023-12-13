  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
              <div class="user-panel  d-flex">
                  <div class="info">
                      <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                  </div>
                  <div class="image mr-md-4 mr-3">
                      <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle" alt="User Image">
                  </div>
              </div>
          </li>
      </ul>
  </nav>
