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
        #profile_field_modal .modal-dialog{
            width: 400px;
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
                    <td><input type="text" class="form-control" :value="pad(thisUser.id, 5)" readonly></td>
                    <td class="profile_table_edit text-center"></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" class="form-control" :value="thisUser.f_name" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary" @click="updateProfileField('First Name')">edit</span></td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td><input type="text" class="form-control" :value="thisUser.m_name" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary" @click="updateProfileField('Middle Name')">edit</span></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" class="form-control" :value="thisUser.l_name" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary" @click="updateProfileField('Last Name')">edit</span></td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><input type="email" class="form-control" :value="thisUser.email" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary" @click="updateProfileField('Email Address')">edit</span></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" class="form-control" :value="thisUser.secret" readonly></td>
                    <td class="profile_table_edit text-center"><span class="text-primary" @click="updateProfileField('Password')">edit</span></td>
                </tr>
            </table>
        </div>
    </div>

    @include('pages.back_end.modals.profile_field')
@endsection

@section('extraJS')
    <script>
        $(document).ready(function() {
            const app = new Vue({
                el: '#app',
                data: {
                    thisUser: {!! json_encode($user) !!},

                    fieldType: '',
                    profileFieldData: '',
                },
                mounted() {
                    Echo.channel('get-users')
                        .listen('.get-users', () => {
                            this.getUser();
                        })
                },
                methods: {
                    getUser() {
                        axios.get('{{ url('get-user') }}/'+this.thisUser.id)
                            .then((response) => {
                                this.thisUser = response.data;
                            })
                    },
                    pad(str, max) {
                        str = str.toString();
                        return str.length < max ? this.pad("0" + str, max) : str;
                    },

                    updateProfileField(data) {
                        this.fieldType = data;

                        let result = {
                            id: this.thisUser.id,
                            f_name: this.thisUser.f_name,
                            m_name: this.thisUser.m_name,
                            l_name: this.thisUser.l_name,
                            email: this.thisUser.email,
                            secret: this.thisUser.secret,
                        }

                        this.profileFieldData = result;
                        console.log(this.profileFieldData)
                        $('#profile_field_modal').modal('show');
                    },
                    submitProfileField() {
                        if(this.profileFieldData.f_name == '' || this.profileFieldData.l_name == '' || this.profileFieldData.email == '' || this.profileFieldData.password == '') {
                            swal('Oops!', 'Field con\'t be emty', 'warning');
                            return;
                        }

                        axios.post('{{ url('update-profile-field') }}', this.profileFieldData)
                            .then((response) => {
                                $('#profile_field_modal').modal('hide');

                                swal({
                                    title: 'Good job!',
                                    text: 'Successfully Added',
                                    icon: 'success',
                                    timer: 1500,
                                    buttons: false,
                                })

                                window.history.pushState("", "", '{{ url('/') }}/'+response.data.url_name);
                            })
                            .catch(() => {
                                swal('Oops!', 'Something went wrong', 'warning');
                            })
                    }
                }
            })
        });
    </script>
@endsection
