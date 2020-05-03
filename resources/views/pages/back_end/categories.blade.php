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
        #new_category_modal .modal-content, #update_category_modal .modal-content{
            width: 400px;
            margin: 0 auto;
        }
	</style>
@endsection

@section('content')
    <h3>Categories Information</h3>
    <hr>

    <div class="text-center">
    	<button class="btn velami_btn" data-toggle="modal" data-target="#new_category_modal">Crate New Category</button>
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
        	<tr v-for="item in allCategories">
        		<td class="text-center"></td>
        		<td class="text-center">#@{{ pad(item.id, 5) }}</td>
        		<td class="text-center">@{{ item.name }}</td>
        		<td class="text-center">@{{ item.created_at }}</td>
        		<td class="text-center"><button class="btn btn-primary" @click="editCategory(item)"><span class="fa fa-pencil"></span></button></td>
        	</tr>
        </tbody>
    </table>

    @include('pages.back_end.modals.super_admin.new_category')
    @include('pages.back_end.modals.super_admin.update_category')
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
	            	allCategories: {!! json_encode($categories) !!},

	            	newCategoryData: {
	            		name: '',
	            	},
	            	updateCategoryData: '',
	            },
	            mounted() {
	                this.getDatatable();

	                Echo.channel('get-categories')
	                	.listen('.get-categories', () => {
	                		this.getCategories();
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
	                getCategories() {
	                	axios.get('{{ url('super-admin/get-categories') }}')
	                		.then((response) => {
	                			this.allCategories = response.data;
	                			this.getDatatable();
	                		})
	                },
	                pad(str, max) {
	                    str = str.toString();
	                    return str.length < max ? this.pad("0" + str, max) : str;
	                },

	                submitNewCategory() {
	                	if(this.newCategoryData.name == '') {
	                		swal('Oops!', 'Input are required!', 'warning');
	                		return;
	                	}

	                	axios.post('{{ url('super-admin/new-category') }}', this.newCategoryData)
	                		.then(() =>{
	                			$('#new_category_modal').modal('hide');

	                			swal({
	                				title: 'Good job!',
	                				text: 'Successfully Added!',
	                				icon: 'success',
	                				timer: 1500,
	                				buttons: false,
	                			})

	                			this.newCategoryData.name = '';
	                		})
	                		.catch(() => {
	                			swal('Oops!', 'Something Went Wrong!', 'warning');
	                		})
	                },
	                editCategory(data) {
	                	let result = {
	                		id: data.id,
	                		name: data.name,
	                	}

	                	this.updateCategoryData = result
	                	$('#update_category_modal').modal('show');
	                },
	                submitUpdateCategory() {
	                	if(this.updateCategoryData.name == '') {
	                		swal('Oops!', 'Input are required!', 'warning');
	                	}

	                	axios.post('{{ url('super-admin/update-category') }}', this.updateCategoryData)
	                		.then(() =>{
	                			$('#update_category_modal').modal('hide');

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
	