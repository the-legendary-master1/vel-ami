
@extends('layouts.profile_layout')

@section('content')
    <div class="main-content profile-content mt2">
        <div class="content-title text-center pt2 pb2">
            <h6 class="strapline">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua </h6>
            <div class="guarrd">
                <figure>
                    <img src="{{ url('/') }}/files/secure.png" width="25px" class="img-responsive">
                </figure>
            </div>
        </div>
        <div class="line"></div>
        <div class="profile-form mt2">
            <form action="">
                <div class="form-group">
                    <div class="row">
                        <label for="id_no" class="col-md-4">Identification No.</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="id_no">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="first_name" class="col-md-4">First Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="first_name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <div class="row">
                        <label for="last_name" class="col-md-4">Last Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="last_name">
                        </div>
                   </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="email" class="col-md-4">Email Address</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="password" class="col-md-4">Password</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" id="password">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('extraJS')
@endsection

