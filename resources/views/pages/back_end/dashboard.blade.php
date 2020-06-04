@extends('layouts.app')

@section('extraCSS')

@endsection

@section('content')
    Welcome to Dashboard!
@endsection
	
@section('extraJS')
    <script>
        $(document).ready(function() {	
            const app = new Vue({
                el: '#app',
                data: {

                }, 
                mounted() {
                },
                methods: {
                	
                }
            })
        });
    </script>
@endsection
