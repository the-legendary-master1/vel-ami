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
		.review-emoji img {
			width: 16px;
		}
	</style>
@endsection

@section('content')
    <h3>List of Reported Reviews</h3>
    <hr>
    <table class="table table-bordered display nowrap my-table" width="100%">
        <thead>
            <tr>
                <th class="text-center" width="30px">More</th>
                <th class="text-center">ID</th>
                <th class="text-center">Review By</th>
                <th class="text-center">Review Comment</th>
                <th class="text-center">Attachments</th>
                <th class="text-center">Reported By</th>
                <th class="text-center">Date Reported</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        	<tr v-for="(reported, key) in reportedReviews">
        		<td class="text-left"></td>
        		<td class="text-center">@{{ reported.id }}</td>
        		<td class="text-center">@{{ reported.review.user.name }} (@{{ reported.review.user.id }})</td>
        		<td class="text-center review-emoji" v-html="reported.review.comment"></td>
        		<td class="text-center review-attachments">
        			<div class="attachements">
	        			<div v-for="item, index in JSON.parse(reported.review.attachments)" >
	        				<img v-if="index == 0" :src="'{{ url('/') }}/' + item.path" class="img-responsive" width="100px">
	        			</div>
	        			<span class="ctr-attachments">@{{ JSON.parse(reported.review.attachments).length }}</span>
        			</div>
        		</td>
        		<td class="text-center">@{{ reported.user.name }} (@{{ reported.user.id }})</td>
        		<td class="text-center">@{{ reported.created_at | moment("from", "now") }}</td>
        		<td class="text-center"><button class="btn btn-primary btn-sm" @click="deleteReview(reported.id)"><span class="fa fa-thumbs-up"></span> Approved</button></td>
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
	            	reportedReviews: {!! json_encode($reported) !!},
	            },
	            mounted() {
	                this.getDatatable();

	                Echo.channel('get-reported-reviews').listen('.get-reported-reviews', () => {
                		this.getReportedReviews();
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
	                getReportedReviews() {
	                	axios.get('{{ url('super-admin/get-reported-reviews') }}')
	                		.then((response) => {
	                			this.reportedReviews = response.data;
	                			this.getDatatable();
	                		})
	                },
	                deleteReview(id) {
	                	swal({
                            title: "Are you sure?",
                            text: "You want to remove this user review on the review section?",
                            icon: "warning",
                            buttons: ["No", "Yes"],
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                this.loading();
                                axios.post( '{{ url('super-admin/remove-user-review') }}', { id:id }).then( response => {

                                    this.removeloading();
                                    swal({
                                        title: 'Nice!',
                                        text: 'User review has been remove!',
                                        icon: 'success',
                                        timer: 1500,
                                        buttons: false,
                                    })
                                })
                                .catch(() => {
                                    this.removeloading();
                                    swal('Oops!', 'You can\'t remove this review, please try again later.', 'warning');
                                })
                            }
                        });
	                },
                    loading() {
                        $('#wait').show();
                    },
                    removeloading() {
                        $('#wait').hide();
                    }, 
	            },
	        })
	    });
	</script>
@endsection
	