@extends('layouts.app')

@section('extraCSS')

@endsection

@section('content')
Welcome!
@endsection

@section('extraJS')
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