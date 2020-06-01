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
	</style>
@endsection

@section('content')
    <h3>Tags Information</h3>
    <hr>

    <div class="text-center">
    	<button class="btn velami_btn" data-toggle="modal" data-target="#new_tag_modal">Crate New Tags</button>
    </div>

    <table class="table table-bordered display nowrap my-table" width="100%">
        <thead>
            <tr>
                <th class="text-center">More</th>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Date Created</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        	<tr v-for="item in allTags">
        		<td class="text-center"></td>
        		<td class="text-center">#@{{ pad(item.id, 5) }}</td>
        		<td class="text-center">@{{ item.name }}</td>
        		<td class="text-center">@{{ item.created_at }}</td>
        		<td class="text-center"><button class="btn btn-primary" @click="editTag(item)"><span class="fa fa-pencil"></span></button></td>
        	</tr>
        </tbody>
    </table>

    @include('pages.back_end.modals.super_admin.new_tag')
    @include('pages.back_end.modals.super_admin.update_tag')
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
	            	allTags: {!! json_encode($tags) !!},

	            	newTagData: {
	            		name: '',
	            	},
	            	updateTagData: '',
	            },
	            mounted() {
	                this.getDatatable();

	                Echo.channel('get-tags')
	                	.listen('.get-tags', () => {
	                		this.getTags();
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
	                    }, 0);
	                },
	                getTags() {
	                	axios.get('{{ url('super-admin/get-tags') }}')
	                		.then((response) => {
	                			this.allTags = response.data;
	                			this.getDatatable();
	                		})
	                },
	                pad(str, max) {
	                    str = str.toString();
	                    return str.length < max ? this.pad("0" + str, max) : str;
	                },

	                submitNewTag() {
	                	if(this.newTagData.name == '') {
	                		swal('Oops!', 'Input are required!', 'warning');
	                		return;
	                	}

	                	axios.post('{{ url('super-admin/new-tag') }}', this.newTagData)
	                		.then(() =>{
	                			$('#new_tag_modal').modal('hide');

	                			swal({
	                				title: 'Good job!',
	                				text: 'Successfully Added!',
	                				icon: 'success',
	                				timer: 1500,
	                				buttons: false,
	                			})

	                			this.newTagData.name = '';
	                		})
	                		.catch(() => {
	                			swal('Oops!', 'Something Went Wrong!', 'warning');
	                		})
	                },
	                editTag(data) {
	                	let result = {
	                		id: data.id,
	                		name: data.name,
	                	}

	                	this.updateTagData = result
	                	$('#update_tag_modal').modal('show');
	                },
	                submitUpdateTag() {
	                	if(this.updateTagData.name == '') {
	                		swal('Oops!', 'Input are required!', 'warning');
	                	}

	                	axios.post('{{ url('super-admin/update-tag') }}', this.updateTagData)
	                		.then(() =>{
	                			$('#update_tag_modal').modal('hide');

	                			swal({
	                				title: 'Good job!',
	                				text: 'Successfully Updated!',
	                				icon: 'success',
	                				timer: 1500,
	                				buttons: false,
	                			})
	                		})
	                		.catch(() => {
	                			swal('Oops!', 'Something Went Wrong!', 'warning');
	                		})
	                },
	            }
	        })
	    });
	</script>
@endsection
	