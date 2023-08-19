@extends('layouts.app')
@section('content')
<div class="container-fluid default-page">
    <div class="row">
        <div class="col-xl-5 col-lg-5">
            <div class="card profile-greeting">
                <div class="card-body">
                    <div>
                        <h1>Welcome,{{auth()->user()->name}}</h1>
                        <p> You have completed 40% of your this week! Start a new goal & improve your
                            result</p>
                        <a class="btn" href="/">Continue<i data-feather="arrow-right"></i></a>
                    </div>
                    <div class="greeting-img">
                        <img class="img-fluid" src="../assets/images/dashboard/profile-greeting/bg.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection