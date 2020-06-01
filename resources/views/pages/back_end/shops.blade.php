@extends('layouts.app')

@section('extraCSS')
	<style>
		.shops-items{
			width: 100%;
			background-color: #f5f5f5;
			padding: 10px 20px;
			border: solid 1px #cccccc;
		}
	</style>
@endsection

@section('content')
    <div class="row">
    	<div class="col-sm-3" v-for="item in allShops">
    		<div class="card shops-items">
	        	<img :src="'{{ asset('files') }}/'+item.shop_img" class="img-responsive" alt="" v-if="item.shop_img">
    			<img src="{{ asset('files/shop.png') }}" class="img-responsive" alt="" v-else>
    		</div>
    	</div>
    </div>
@endsection
	
@section('extraJS')
    <script>
        $(document).ready(function() {
            const app = new Vue({
                el: '#app',
                data: {
                	allShops: {!! json_encode($shops) !!}
                }, 
                mounted() {
                    Echo.channel('get-shops')
                        .listen('.get-shops', () => {
                            this.getShops();
                        })
                },
                methods: {
	                getShops() {
	                	axios.get('{{ url('super-admin/get-shops') }}')
	                		.then((response) => {
	                			this.allShops = response.data;
	                		})
	                },
                }
            })
        });
    </script>
@endsection