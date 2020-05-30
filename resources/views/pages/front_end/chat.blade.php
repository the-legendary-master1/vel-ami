
@extends('layouts.frontend_layout')

@section('content')
    <section class="header-content sticky-header-shop shop-seller">
        <div class="content-title text-center pb2 clearfix">
            <figure>
                <img src="{{ url('/') }}/files/shop.png" class="img-responsive img-thumbnail img-circle">
            </figure>
            <div class="shop-info-container">
                <h2 class="page-title">Shop Name</h2>
                <div class="line"></div>
                <h6 class="strapline">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua </h6>
            </div>
        </div>
    </section>
    <div class="main-content shop-seller mt2">
        <div class="chat-wrapper">
            <section class="msger mt2">
                <main class="msger-chat">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="msg left-msg">
                            <div class="msg-img" style="background-image: url({{ url('/') }}/files/shop.png)">
                                <span class="fa fa-circle text-online online-indicator"></span>
                            </div>
                            <div class="msg-wrappe">
                                <div class="msg-bubble">
                                    <div class="msg-text">
                                        <span>Hi, welcome to SimpleChat! Go ahead and send me a message. 😄</span>
                                    </div>
                                </div>
                                <div class="msg-info">
                                    <div class="msg-info-time"><span>12:45 PM, Wednesday</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="msg right-msg">
                            <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)">
                                <span class="fa fa-circle text-grey online-indicator"></span>
                            </div>
                            <div class="msg-wrappe">
                                <div class="msg-bubble">
                                    <div class="msg-text">
                                        <span>You can change your name in JS section!</span>            
                                    </div>
                                </div>
                                <div class="msg-info">
                                    <div class="msg-info-time"><span>12:46, Wednesday</span></div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="msg left-msg">
                        <div class="msg-img" style="background-image: url({{ url('/') }}/files/shop.png)">
                            <span class="fa fa-circle text-online online-indicator"></span>
                        </div>
                        <div class="msg-wrappe">
                            <div class="msg-bubble">
                                <div class="msg-text typing">
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </section>
        </div>
        <section class="input">
            <div class="input-container clearfix">
                <div class="inputtts">
                    <label for="input-msg" class="show-desktop">Write a message</label>
                    <div class="input-group">
                        <label for="review-imgs" class="cursor show-mobile upload-photos-mbl">
                            <span class="fa fa-camera"></span>
                        </label>
                        <textarea name="chat" id="input-msg" placeholder="Write a message..."></textarea>
                        <div class="input-options">
                            <div class="input-imgs">
                                <input type="file" name="chat-imgs" class="d-none hidden" id="chat-imgs">
                                <label for="chat-imgs" class="cursor show-desktop"><span class="fa fa-camera"></span></label>
                            </div>
                            <div class="input-emots">
                                <button class="chat-emots">
                                    <span class="fa fa-smile-o"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

