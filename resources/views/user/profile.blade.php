@extends('layouts.app', ['page_title' => "User | {$user->first_name} | Profile"])
@section('content')
<div class="edit-profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h2 class="card-title mb-0">My Profile</h2>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-2">
                            <div class="profile-title">
                                <div class="d-flex"> <img class="img-70 rounded-circle" alt=""
                                        src="/assets/images/user/7.jpg">
                                    <div class="flex-grow-1"><a href="#" data-bs-original-title="" title="">
                                            <h3 class="mb-1 f-20 txt-primary">{{$user->full_name}}</h3>
                                        </a>
                                        <p class="f-12">{{$user->role_name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4 class="form-label">Notes</h4>
                            <p>{{$user->notes}}</p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8">

            <x-utils.forms.post :route="route('user.profile.update', $user->id)" :cancel="route('dashboard')"
                title="Edit Profile" :files="true">
                <div class="card-header pb-0">
                    <h2 class="card-title mb-0">Edit Profile</h2>
                    <div class="card-options"><a class="card-options-collapse" href="javascript:void(0)"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="javascript:void(0)" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">First name</label>
                                <input class="form-control" type="text" placeholder="First Name" name="first_name"
                                    value="{{old('first_name', $user->first_name)}}">
                                <span class="text-danger">{{$errors->first('first_name')}}</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" placeholder="Last Name" name="last_name"
                                    value="{{old('last_name', $user->last_name)}}">
                                <span class="text-danger">{{$errors->first('last_name')}}</span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input class="form-control" type="email" placeholder="Email" value="{{ $user->email}}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input class="form-control" type="text" placeholder="Phone Number" name="phone"
                                    value="{{old('phone', $user->phone)}}">
                                <span class="text-danger">{{$errors->first('phone')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" placeholder="Password" name="password">
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input class="form-control" type="password" placeholder="Confirm Password"
                                    name="password_confirmation">
                                <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                            </div>
                        </div>
                    </div>

                    @if ($user->isConsultant())
                    @php
                    $user_country_ids = $user->countries->pluck('id')->toArray();
                    @endphp
                    <label class="form-label">Country</label>
                    <div class="row">
                        @php $count = 1; @endphp
                        @foreach ($countries as $id => $name)
                        @if ($count % 5 === 1) @if ($count > 1) </div> @endif <div class="col-md-6"> @endif
                        <label class="d-block" for="user_cntry_{{$id}}">
                            <input class="checkbox_animated" type="checkbox" id="user_cntry_{{$id}}" value="{{$id}}" name="countries[]" {{in_array($id, $user_country_ids) ? 'checked' : false}}>
                            {{$name}}
                        </label>

                        @php $count++; @endphp
                        @endforeach
                        @if ($count > 1)
                    </div> @endif
                    <span class="text-danger">{{$errors->first('countries')}}</span>
                    @endif
                </div>
        </div>

    </div>
    </x-utils.forms.post>
</div>
</div>
</div>
@endsection
