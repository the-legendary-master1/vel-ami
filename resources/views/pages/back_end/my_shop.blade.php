@extends('layouts.app')

@section('extraCSS')
	{{-- Select Picker CSS --}}
	<link rel="stylesheet" href="{{ asset('css/extra_css/selectpicker.css') }}">

	<style>
        .title_edit{
            position: absolute;
            top: -15px;
            right: 80px;
            cursor: pointer;
            font-size: 15px;
        }
        .shop_desc{
        	font-size: 15px;
        	vertical-align: top;
        }
        .shop_options{
        	padding: 10px 0;
        }
        .shop_option_btn{
        	background-color: #ede7f1;
        	padding: 5px;	
        	width: 100px;
        }
        .shop_product_img{
        	max-height: 150px;
        	background-color: red;
        }
        .shop_product_item{
        	padding: 20px;
        	border: solid 1px #cccccc;
        }
        .shop_product_details{
        	margin-top: 20px;
        	padding: 20px 0 0 0;
        	font-size: 17px;
        	border-top:solid 1px #cccccc;
        	text-align: center;
        }
        .shop_product_details p{
        	margin: 5px 0;
        }
        .shop_product_wrapper{
        	padding: 20px 0;
        }
	</style>
@endsection

@section('content')
    <div class="vilami_center_top_content">
        <div class="vilami_center_top_content_left vcenter">
        	<img :src="'{{ asset('files') }}/'+myShopData.shop_img" class="shop_img" alt="" v-if="myShopData.shop_img">
        	<img src="{{ asset('files/shop.png') }}" class="shop_img" alt="" v-else>

        	<div class="shop_img_btn" data-toggle="modal" data-target="#shop_img_modal">
               <div><span class="fa fa-camera"></span></div>
               Update
        	</div>
        </div>

        <div class="vilami_center_top_content_right vcenter">
        	<h3 class="text-center" v-cloak>@{{ myShopData.name }}</h3>
        	<hr>
        	<div style="position: relative;">
			    <p class="text-center" v-cloak>
			        @{{ myShopData.desc }}
			        <span class="title_edit text-primary" @click="updateShopDesc()">edit</span>
			    </p>
        	</div>
        </div>
    </div>

    <div class="vilami_center_bottom_content">
    	<div class="shop_options text-right">
    		<button class="btn shop_option_btn" data-toggle="modal" data-target="#new_product_modal">ADD</button>
    	</div>

    	<div class="shop_product_wrapper">
    		<div class="row">
    			<div class="col-md-3">
    				<div class="card shop_product_item">
    					<center><img src="{{ asset('files/profile-guard.png') }}" class="img-responsive shop_product_img" alt=""></center>
    					<div class="card-body shop_product_details">
    						<p>Product Name</p>
    						<p>P100.00</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-3">
    				<div class="card shop_product_item">
    					<center><img src="{{ asset('files/profile-guard.png') }}" class="img-responsive shop_product_img" alt=""></center>
    					<div class="card-body shop_product_details">
    						<p>Product Name</p>
    						<p>P100.00</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-3">
    				<div class="card shop_product_item">
    					<center><img src="{{ asset('files/profile-guard.png') }}" class="img-responsive shop_product_img" alt=""></center>
    					<div class="card-body shop_product_details">
    						<p>Product Name</p>
    						<p>P100.00</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    @include('pages.back_end.modals.user_premium.shop_img')
    @include('pages.back_end.modals.user_premium.shop_desc')
    @include('pages.back_end.modals.user_premium.new_product')
@endsection

@section('extraJS')
	{{-- Select Picker JS --}}
	<script src="{{ asset('js/extra_js/selectpicker.js') }}"></script>

    <script>
        $(document).ready(function() {
            const app = new Vue({
                el: '#app',
                data: {
                	myShopData: {!! json_encode($shop) !!},
                	allCategories: {!! json_encode($categories) !!},

                	shopDescData: '',
                }, 
                mounted() {
                    // Dropify
                    $('.dropify').dropify();

	                // Selectpicker
	                $('#student_list').selectpicker();

                    Echo.channel('get-shops')
                        .listen('.get-shops', () => {
                            this.getShop();
                        })

	                Echo.channel('get-categories')
	                	.listen('.get-categories', () => {
	                		this.getCategories();
	                	})
                },
                methods: {
                	getShop() {
                        axios.post('{{ url('user-premium/get-my-shop') }}/'+this.myShopData.id)
                            .then((response) => {
                                this.myShopData = response.data;
                            })
                	},
	                getCategories() {
	                	axios.get('{{ url('get-categories') }}')
	                		.then((response) => {
	                			this.allCategories = response.data;

	                            $('#categories_list').empty();
	                            $.each(this.allCategories, function(index, val) {
	                               $('#categories_list').append('<option value="' + val.id + '">' + val.name + '</option>');
	                            });
	                            $("#categories_list").selectpicker("refresh");
	                            $("#categories_list").selectpicker("render");
	                		})
	                },

                    submitShopIMG() {
                        let shop_img_file = this.$refs.shop_img_file.files[0];
                        let shop_img = '';

                        if(shop_img_file) {
                            shop_img = shop_img_file;         
                        } else {
                            shop_img = ''; 
                        }

                        if(shop_img == '') {
                            swal('Oops!', 'Field is required!', 'warning');
                            return;
                        }

                        let formData = new FormData();
                        formData.append('id', this.myShopData.id);
                        formData.append('shop_img', shop_img);

                        axios.post('{{ url('user-premium/upload-shop-img') }}', formData)
                            .then(() => {
                                $('#shop_img_modal').modal('hide');

                                swal({
                                    title: 'Good job!',
                                    text: 'successfully Added!',
                                    icon: 'success',
                                    timer: 1500,
                                    buttons: false,
                                })

                                $('#shop_img_file').val('');
                                var shop_img_file = "";
                                var passport_drEvent = $('#shop_img_file').dropify();
                                passport_drEvent = passport_drEvent.data('dropify');
                                passport_drEvent.resetPreview();
                                passport_drEvent.clearElement();
                                passport_drEvent.settings.defaultFile = shop_img_file;
                                passport_drEvent.destroy();
                                passport_drEvent.init();    
                                $('.dropify#shop_img_file').dropify({
                                    defaultFile: shop_img_file,
                                });  
                            })
                            .catch(() => {
                                swal('Oops!', 'Something Went Wrong!', 'warning');
                            })
                    },
                    updateShopDesc() {
                    	let result = {
                    		id: this.myShopData.id,
                    		desc: this.myShopData.desc,
                    	}

                    	this.shopDescData = result;
                    	$('#shop_desc_modal').modal('show');
                    },
                    submitShopDesc() {
                    	axios.post('{{ url('user-premium/update-shop-desc') }}', this.shopDescData)
                    		.then(() => {
                    			$('#shop_desc_modal').modal('hide');

                    			swal({
                    				title: 'Good job!',
                    				text: 'successfully Added!',
                    				icon: 'success',
                    				timer: 1500,
                    				buttons: false,
                    			})
                    		})
                    		.catch(() => {
                    			swal('Oops!', 'Something Went Wrong!', 'warning');
                    		})
                    },
                    submitNewProduct() {
                    	console.log('test')
                    }
                }
            })
        });
    </script>
@endsection
