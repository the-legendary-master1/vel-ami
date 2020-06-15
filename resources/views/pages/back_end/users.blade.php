@extends('layouts.app')

@section('extraCSS')
	{{-- Datatable CSS --}}
	<link rel="stylesheet" href="{{ asset('css/extra_css/datatables/datatables.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extra_css/datatables/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extra_css/datatables/responsive.css') }}">

	<style>
		thead{
			background-color: #ede7f1;
		}		 
		.pagination > .active > a, .pagination > .active > a:hover, .pagination > .active > a:focus, .pagination > .active > span, .pagination > .active > span:hover, .pagination > .active > span:focus{
			background-color: #ede7f1 !important;
			color: #000000 !important;
			border-color: #ede7f1 !important;
			outline:none;
		}
		.user_img{
			border-radius: 100px;
		}
	</style>
@endsection

@section('content')
    <h3>Users Information</h3>
    <hr>

    <table class="table table-bordered display nowrap my-table" width="100%">
        <thead>
            <tr>
                <th class="text-center">More</th>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email Address</th>
                <th class="text-center">User Type</th>
                <th class="text-center">Date Created</th>
                <th class="text-center">Shop</th>
                <th class="text-center">Upgrade Request</th>
            </tr>
        </thead>
        <tbody>
        	<tr v-for="item in allUsers">
        		<td class="text-center"></td>
        		<td class="text-center">#@{{ pad(item.id, 5) }}</td>
        		<td class="text-center">
        			<img src="{{ asset('files/default_user.jpg') }}" class="user_img" height="50" alt="">
        			<div>@{{ item.name }}</div>
        		</td>
        		<td class="text-center">@{{ item.email }}</td>
        		<td class="text-center">@{{ item.role }}</td>
        		<td class="text-center">@{{ item.created_at }}</td>
        		<td class="text-center">
        			<a :href="'{{ url('/shop') }}/'+item.my_shop.shop_url" class="btn btn-primary" v-if="item.role == 'User-Premium' && item.my_shop != null" target="_blank">View Shop</a>
        			<span v-else>---</span>
        		</td>
        		<td class="text-center">
        			<div class="btn-group" v-if="item.role != 'Super-Admin' && item.for_upgrade == 1">
        				<button class="btn btn-success" @click="approveUserRequest(item)">Approve</button>
        				<button class="btn btn-warning">Disapprove</button>
        			</div>
        			<span v-else-if="item.role == 'User-Premium'">Approved</span>
        			<span v-else>---</span>
        		</td>
        	</tr>
        </tbody>
    </table>
@endsection

@section('extraJS')
	{{-- Datatable JS --}}
	<script src="{{ asset('js/extra_js/datatables/datatables.js') }}"></script>
	<script src="{{ asset('js/extra_js/datatables/bootstrap.js') }}"></script>
	<script src="{{ asset('js/extra_js/datatables/responsive.js') }}"></script>

	<script>
	    $(document).ready(function() {
	        const app = new Vue({
	            el: '#app',
	            data: {
	            	allUsers: {!! json_encode($users) !!},
	            },
	            mounted() {
	                this.getDatatable();

	                Echo.channel('get-users')
	                	.listen('.get-users', () => {
	                		this.getUsers();
	                	})
	            },
	            methods: {
	                getDatatable() {
	                    $('.my-table').DataTable().destroy();
	                    setTimeout(function(){
	                        var allDatatable = $('.my-table').DataTable({
	                            // dom: 'Bfrtip',
	                            stateSave: true,
	                            responsive: {
	                                details: {
	                                    type: 'column',
	                                    renderer: function ( api, rowIdx, columns ) {
	                                        var data = $.map( columns, function ( col, i ) {
	                                            return col.hidden ?
	                                                '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
	                                                    '<td>'+col.title+':'+'</td> '+
	                                                    '<td>'+col.data+'</td>'+
	                                                '</tr>' :
	                                                '';
	                                        } ).join('');
	                     
	                                        return data ?
	                                            $('<table/>').append( data ) :
	                                            false;
	                                    },
	                                }
	                            },
	                            columnDefs: [ 
	                                { responsivePriority: -1, targets: -1 }, 
	                                { className: 'control', orderable: false, targets:   0 } 
	                            ],
	                            order: [ 1, 'desc' ],
	                            lengthMenu: [
	                                [ 10, 25, 50, -1 ],
	                                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
	                            ],
	                            buttons: [
	                                'pageLength'
	                            ]
	                        });

	                        // setInterval(function(){
	                        //     allDatatable.columns.adjust();
	                        // }, 0);
	                    }, 0);
	                },
	                getUsers() {
	                	axios.get('{{ url('super-admin/get-users') }}')
	                		.then((response) => {
	                			this.allUsers = response.data;
	                			this.getDatatable();
	                		})
	                },
	                pad(str, max) {
	                    str = str.toString();
	                    return str.length < max ? this.pad("0" + str, max) : str;
	                },
	                approveUserRequest(data) {
		                swal({
		                    title: "Are you sure?",
		                    text: "If approve user will be premium and can create its shop!",
		                    icon: "warning",
		                    buttons: true,
		                    dangerMode: true,
		                  })
		                  .then((willDelete,) => {
		                      if (willDelete) {
		                          axios.post('{{ url('super-admin/approve-user-request') }}', {id: data.id})
		                            .then(() => {
		                                swal({
		                                	title: 'Good job!',
		                                	text: 'Successfully Approved',
		                                	icon: 'success',
		                                	timer: 1500,
		                                	buttons: false,
		                                });
		                            })
		                            .catch(() => {
		                                swal('Oops!', 'Something Went Wrong!', 'warning');
		                            })
		                      }
		                  });
	                }
	            }
	        })
	    });
	</script>
@endsection
	