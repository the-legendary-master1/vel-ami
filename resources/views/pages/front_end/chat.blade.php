@extends('layouts.frontend_layout')

@section('content')
    <section class="header-content sticky-header-shop shop-seller">
        <div class="content-title text-center pb2 clearfix cht-pg">
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
    <div class="main-content shop-seller msg-seller mt2">
        <div class="chat-wrapper">
            <section class="msger mt2">
                <main class="msger-chat" v-chat-scroll="{always: false, smooth: true, notSmoothOnInit: true}">
                    <div class="msg-content">
                        <div v-for="(message, index) in messages">
                            <div v-if="message.customer_id == userId" class="msg right-msg" :key="index">
                                <div class="msg-img" :style="'background-image:url({{ asset('/') }}'+message.user.img_path+')'">
                                    <span class="online-indicator text-online"></span>
                                </div>
                                <div class="msg-wrappe">
                                    <div class="msg-attach" v-if="message.attachments">
                                        <div v-for="(file, index) in message.attachments" :style="'background-image:url({{ asset('/') }}'+file.path+')'"></div>
                                    </div>
                                    <div class="msg-bubble">
                                        <div class="msg-text">
                                            <span v-html="$options.filters.renderEmoji(message.message)"></span>         
                                        </div>
                                    </div>
                                    <div class="msg-info">
                                        <div class="msg-info-time"><span v-cloak>@{{ message.created_at | moment("from", "now") }}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="msg left-msg">
                                <div class="msg-img" :style="'background-image:url({{ asset('/') }}'+message.user.img_path+')'">
                                    <span class="online-indicator" 
                                    :class="(user.status == 'online') ? 'text-online' : 'text-muted'"></span>
                                </div>
                                <div class="msg-wrappe">
                                    <div class="msg-attach" v-if="message.attachments">
                                        <div v-for="(file, index) in message.attachments" :style="'background-image:url({{ asset('/') }}'+file.path+')'"></div>
                                    </div>
                                    <div class="msg-bubble">
                                        <div class="msg-text">
                                            <span v-html="$options.filters.renderEmoji(message.message)"></span>   
                                        </div>
                                    </div>
                                    <div class="msg-info">
                                        <div class="msg-info-time"><span v-cloak>@{{ message.created_at | moment("from", "now") }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Typing --}}
                    <div class="msg left-msg" v-if="isTyping.id != userId && isTyping">
                        <div class="msg-img" :style="'background-image:url({{ asset('/') }}'+isTyping.img_path+')'">
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
            @auth
                <div class="msg-seller input-container clearfix" >
                    <div class="inputtts">
                        {{-- <div class="replying-to" v-if="showReply">
                            <div><span style="color:#111">Replying to <strong v-text="replyToUser"></strong></span></div>
                            <div><i style="color:#777" v-text="replyContent"></i></div>
                            <button class="pull-right btn btn-default btn-sm" @click="removeReply">&times;</button>
                        </div> --}}
                        {{-- <div class="review-attachements" v-if="review.attachments.length">
                            <ul>
                                <li v-for="(photo, index) in review.attachments" :key="`thumb-${index}`">
                                    <div :style="{ 'background-image': `url(${photo.preview})` }" class="preview-images"></div>
                                    <button @click="deletePhoto(index)" class="btn btn-danger remove-preview" type="button">&times;</button>
                                </li>
                            </ul>
                        </div> --}}

                        <div class="review-attachements msg-attachment" v-if="attachments.length">
                            <ul>
                                <li v-for="(photo, index) in attachments" :key="`thumb-${index}`">
                                    <div :style="{ 'background-image': `url(${photo.preview})` }" class="preview-images"></div>
                                    <button @click="removeAttachment(index)" class="btn btn-danger remove-preview" type="button">&times;</button>
                                </li>
                            </ul>
                        </div>
                        <label for="input-review" class="show-desktop">Write a review</label>
                        <div class="input-group" id="commentary" tabindex="-1">
                            <label for="attachments" class="cursor show-mobile upload-photos-mbl"><span class="fa fa-camera"></span></label>
                            <textarea name="message" id="message" placeholder="Write a message..."></textarea>
                            
                            <div class="input-options">
                                <div class="input-imgs">
                                    <input type="file" ref="attachments" class="d-none hidden" @change="handleAttachments" id="attachments" multiple>
                                    <label for="attachments" class="cursor show-desktop"><span class="fa fa-camera"></span></label>
                                </div>
                                <div class="input-emots">
                                    <button class="review-emots" @click="openEmoji">
                                        <span class="fa fa-smile-o"></span>
                                    </button>
                                </div>
                                <div class="input-submit">
                                    {{-- <button v-if="showReply" class="btn-send-reply re" @click="submitReply"><i class="fa fa-paper-plane"></i></button> --}}
                                    <button class="btn-send-reply se" @click="submitMessage"><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
        </section>
    </div>
@endsection
@section('extraCSS')
    <style>
        .sticky-sidebar .sidebar-wrapper {
            max-height: calc(100vh - 62px);
            overscroll-behavior: contain;
        }
        .shop-seller .msger {
            height: calc(100vh - 287px);
            overscroll-behavior: contain;
        }
        .ads-wrapper {
            overflow-y: auto;
            max-height: calc(100vh - 62px);
            overscroll-behavior: contain;
        }
    </style>
@endsection
@section('extraJS')
    <script>
        $(function() {
            const app = new Vue({
                el: '#app',
                data: {
                    userId: '{{ Auth::user()->id }}',
                    productId: '{{ $product_id }}',
                    ownerId: '{{ $owners_id }}',
                    ref_id: '{{ $request->ref }}',
                    url: '{{ url(strtolower(Auth::user()->role)) }}',
                    messages: {!! json_encode($messages) !!},
                    receiver_id: '',
                    attachments: [],
                    emojiPicker: '',
                    isTyping: false,
                    typingTImer: false,
                    user: {!! json_encode($user) !!},

                    // Header
                    unreadNotification: {!! json_encode($unreadNotification) !!},
                    showMessages: false,
                    loading: false,
                    allMessages: [],
                },
                mounted() {
                    let dataMessage = {
                        auth_id: this.userId, // customer id
                        product_id: this.productId, // product id
                        owner_id: this.ownerId, // tag-iya
                        ref_id: this.ref_id
                    };
                    this.emojiPicker =  $('#message').emojioneArea({
                        recentEmojis: false,
                        inline: true,
                        saveEmojisAs: 'shortname',
                        events: {
                            keydown: (editor, event) => {
                                if (event.which == 13) {
                                    this.submitMessage()
                                } else {
                                    axios.post('{{ url('is-typing') }}', dataMessage);
                                }
                            },
                            click: () => {
                                axios.post( this.url + '/read-message', dataMessage);
                            }
                        }
                    });

                    Echo.channel('get-messages').listen('.get-messages', (data) => {
                        if (data.chat.ref_id == this.ref_id)
                            this.messages.push(data.chat)
                    })

                    Echo.channel('get-unread-notifications').listen('.get-unread-notifications', (data) => {
                        console.log(data);
                        console.log(this.userId);
                        if (data.user.id == this.userId)
                            this.unreadNotification = data.unread
                    })
                    Echo.channel('get-message-notifications').listen('.get-message-notifications', (data) => {
                        if (data.user == this.userId)
                            this.allMessages = data.message;
                    })
                    Echo.channel('is-typing').listen('.is-typing', (data) => {
                        if (data.msg.ref == this.ref_id) {
                            this.isTyping = data.msg;
                            if (this.typingTImer) {
                                clearTimeout(this.typingTImer);
                            }
                            this.typingTImer = setTimeout(() => {
                                this.isTyping = false;
                            }, 3000);
                        }
                    })
                    setInterval(() => {
                        this.checkUserStatus()
                    }, 1000*20);

                    // var height = $('.ads-wrapper').outerHeight();
                    // $(window).resize(function(event) {
                    //     var height = $('.ads-wrapper').outerHeight();
                    //     console.log(height);
                    // });
                    $('.navbar-menu--click').on('click', function(e) {
                        var nxt = $(this).next();
                        
                        $('#navbar-menu').find('.dropdown-menu').removeClass('show');
                        nxt.toggleClass('show');
                        $(this).toggleClass('active');

                        e.stopPropagation();
                        $(document).click(function() {
                            nxt.removeClass('show'); 
                        });
                    });
                },
                methods: {
                    handleAttachments(e) {
                        Array.from(e.target.files).forEach(file => {
                            const reader = new FileReader()
                            
                            if (!/\.(jpe?g|png)$/i.test(file.name)) {
                                swal('Invalid File Upload', 'File must be in: JPG, JPEG, PNG.', 'warning')
                                return false;
                            }
                            reader.onload = () => {
                                this.attachments.push({
                                    preview: reader.result,
                                    file
                                })
                            }
                            reader.readAsDataURL(file)
                        })
                    },
                    removeAttachment(index) {
                        this.attachments.splice(index, 1)
                    },
                    submitMessage() {
                        let message = this.emojiPicker[0].emojioneArea.getText();
                        let ref = this.messages[0];
                        let ref_id;

                        if (message === '') {
                            swal('Oops!', 'Please write a message.', 'warning');
                            return false;
                        }

                        if (ref)
                            ref_id = ref.ref_id;
                        else
                            ref_id = this.ref_id;

                        let formData = new FormData();
                            formData.append('product_id', this.productId);
                            formData.append('owner_id', this.ownerId);
                            formData.append('customer_id', this.userId);
                            formData.append('message', message);
                            formData.append('ref_id', ref_id);

                        this.attachments.forEach((photo, index) => {
                            formData.append('attachments[' + index + ']', photo.file);
                        })
                        axios.post( this.url + '/store-message', formData).then( response => {
                            this.resetInputs();
                        })
                    },
                    openEmoji() {
                        $('.emojionearea-button').trigger('click');
                    },
                    resetInputs() {
                        var el = $('textarea[name="message"]').emojioneArea();
                            el[0].emojioneArea.setText('');
                            this.attachments = [];
                    },
                    checkUserStatus() {
                        axios.get( `{{ url('check-user-status') }}/${this.productId}/${this.ref_id}`).then((response) => {
                            console.log(response.data);
                            this.user = response.data;
                        })
                    },

                    // Header
                    getMessages() {
                        axios.get( this.url + '/get-messages', { params: { id: this.userId }} ).then( response => {
                            this.loading = false
                        })
                    },
                    openMessages() {
                        this.loading = true
                        this.showMessages = !this.showMessages;
                        this.unreadNotification = 0;
                        this.getMessages()
                    },
                    readMessage(data) {
                        axios.post( this.url + '/read-message', data );
                    },
                },
                filters: {
                    renderEmoji(value) {
                        if (!value) return ''
                        return emojione.toImage(value)
                    }
                }
            });
        });
    </script>
@endsection


