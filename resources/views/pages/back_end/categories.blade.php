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
    <h3>Categories Information</h3>
    <hr>

    <table class="table table-bordered display nowrap my-table" width="100%">
        <thead>
            <tr>
                <th class="text-center">More</th>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Descreption</th>
                <th class="text-center">Date Created</th>
                <th class="text-center">Date Updated</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        	</tr>
        	<tr>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
        		<td class="text-center">test</td>
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

	            },
	            mounted() {
	                this.getDatatable();
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

	                        setInterval(function(){
	                            allDatatable.columns.adjust();
	                        }, 0);
	                    }, 0);
	                },
	            }
	        })
	    });
	</script>
@endsection
	