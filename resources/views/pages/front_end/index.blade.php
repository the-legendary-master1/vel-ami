@extends('layouts.front_end_layout')

@section('extraFrontEndCSS')

@endsection

@section('back_end_main_contents')
	<button class="btn btn-success" data-toggle="modal" data-target="#sign_up_modal">Sign-up</button>

	@include('pages.front_end.modals.sign_up')
@endsection

@section('extraFrontEndJS')
	<script>
	    jQuery(document).ready(function($) {
	        const app = new Vue({
	            el: '#app',
	            data: {

	            },
	            mounted() {

	            },
	            methods: {

	            }
	        });
	    });
	</script>
@endsection