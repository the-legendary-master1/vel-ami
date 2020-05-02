@extends('layouts.app')

@section('extraCSS')
    <style>
        .title_edit{
            position: absolute;
            top: -10px;
            right: -10px;
            cursor: pointer;
            font-size: 15px;
        }
        .profile_form{
            max-width: 600px;
            margin: 0 auto;
            font-size: 18px;
        }
        .profile_form td{
            padding-bottom: 50px;
        }
        .profile_table_edit{
            width: 50px;
            text-align: center;
            font-size: 15px;
            cursor: pointer;
        }
        .profile_title{
            font-size: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="vilami_center_top_content">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 vcenter">
                <p class="profile_title text-center">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                    <span class="title_edit text-primary">edit</span>
                </p>
            </div>
            <div class="col-sm-3 text-right vcenter">
                <img src="{{ asset('files/secure.png') }}" height="30px" alt="">
            </div>
        </div>

        <hr>
    </div>

    <div class="vilami_center_bottom_content">
        <div class="profile_form">
            <table width="100%">
                <tr>
                    <td>Identification No.</td>
                    <td><input type="text" class="form-control" value="{{ Auth::user()->id }}" readonly></td>
                    <td class="profile_table_edit text-center"></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" class="form-control" value="{{ Auth::user()->f_name }}" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary">edit</span></td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td><input type="text" class="form-control" value="{{ Auth::user()->m_name }}" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary">edit</span></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" class="form-control" value="{{ Auth::user()->l_name }}" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary">edit</span></td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary">edit</span></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" class="form-control" value="{{ decrypt(Auth::user()->secret) }}" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary">edit</span></td>
                </tr>
            </table>
        </div>
    </div>
@endsection
