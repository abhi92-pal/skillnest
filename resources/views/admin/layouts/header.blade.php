<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <!-- <img src="" alt="user-image" class="rounded-circle"> -->
                    <span class="pro-user-name ml-1">
                        {{auth()->user()->name}} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item" data-toggle="modal" data-target="#editProfile">
                        <!-- <i class="fe-user"></i> -->
                        <i class="fe-lock"></i>
                        <!-- <span>My Account</span> -->
                        <span>Change Password</span>
                    </a>

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a> -->

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Lock Screen</span>
                    </a> -->

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a> -->

                    <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i class="fe-log-out"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>

            <!-- <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li> -->

        </ul>

        <!-- LOGO -->
        <div class="logo-box">

            <a href="{{url('/home')}}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo.png') }}" style="filter: invert(1);" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo.png') }}" style="filter: invert(1);" alt="" height="40">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->

<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                  <!-- <h2>Change Password</h2> -->
                  <form class="row" action="{{route('password.update')}}" method="POST" id="update_password">
                    @csrf
                  <div class="col-12">
                      <div class="row form-group">
                          <div class="col-12">
                              <label for="u_name">Current Password</label>
                              <input type="password" class="form-control" name="current_password" placeholder="Current Password" value="" required>
                              <div class="error text-danger" id="current_password_error"></div>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col-12">
                              <label for="pasw">New Password</label>
                              <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New Password" value="" data-parsley-equalto="#confirm_password" data-parsley-minlength="6" required>
                              <div class="error text-danger" id="new_password_error"></div>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col-12">
                              <label for="c_pasw">Confirm Password</label>
                              <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password" value="" data-parsley-equalto="#new_password" required>
                              <div class="error text-danger" id="confirm_password_error"></div>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary mt-3 w-100 submit_btn">Update</button>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
