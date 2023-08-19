<div>
    <div class="logo-wrapper">
        <a href="/">
            <img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="">
            <img class="img-fluid for-dark" src="../assets/images/logo/logo-dark.png" alt="">
        </a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-left"> </i></div>
    </div>
    <div class="logo-icon-wrapper">
        <a href="/">
            <img class="img-fluid for-light" src="../assets/images/logo/logo-icon.png" alt="">
            <img class="img-fluid for-dark" src="../assets/images/logo/logo-icon-dark.png" alt="">
        </a>
    </div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn">
                    <a href="/">
                        <img class="img-fluid for-light" src="../assets/images/logo/logo-icon.png" alt="">
                        <img class="img-fluid for-dark" src="../assets/images/logo/logo-icon-dark.png" alt="">
                    </a>
                    <div class="mobile-back text-end">
                        <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                    </div>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h4 class="lan-1">General </h4>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('user.index')}}">
                        <i data-feather="user"> </i><span>Admin Users</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav  {{active_nav('job-seeker.index')}}"
                        href="{{route('job-seeker.index')}}">
                        <i data-feather="user"> </i><span>Job Seekers</span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('consultant.index')}}">
                        <i data-feather="user"> </i><span>Consultants</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('appointment.index')}}">
                        <i data-feather="book"> </i><span>Appointments</span>
                    </a>
                </li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="airplay"></i><span class="lan-6">Widgets</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="general-widget.html">General</a></li>
                      <li><a href="chart-widget.html">Chart</a></li>
                    </ul>
                  </li>

            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
