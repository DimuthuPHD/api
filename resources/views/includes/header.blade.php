<!-- Page Header Start-->
<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="nav-right col-12 pull-right right-header p-0">
            <ul class="nav-menus">
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="d-flex profile-media"><img class="b-r-50" src="../assets/images/dashboard/profile.png"
                            alt="">
                        <div class="flex-grow-1"><span>{{auth()->user()->name}}</span>
                            <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="user-profile.html"><i data-feather="user"></i><span>Account </span> </a>
                        </li>
                        <li>
                            <form action="{{route('logOut')}}" method="POST">
                                @csrf
                            <button type="submit"><i data-feather="log-in"> </i><span>Logout</span></button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Header Ends -->
