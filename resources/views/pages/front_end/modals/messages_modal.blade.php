 <div class="modal fade" id="msgsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Messages</h5>
            </div>
            <div class="modal-body mobile-message">
                <ul id="message-list">
                    <li v-if="!allMessages">No messages...</li>
                    <li v-else v-for="(parentMessage, index) in allMessages">
                        {{-- <div v-for="(message, key) in parentMessage"> --}}
                        <div v-if="parentMessage.length">
                            <div v-for="(message, key) in parentMessage" v-if="key == 0">
                                <a :href="`{{ url('chat-seller') }}/${message[0].product.url}/${message[0].product.id}?ref=${message[0].ref_id}`"
                                @click="readMessage(message[0])" class="unread-message">
                                    <div class="item">
                                        <div class="item-img">
                                            <div :style="'background-image:url({{ asset('/') }}' + message[0].product.image.path +')'"></div>
                                        </div>
                                        <div class="qty">
                                            <span class="label label-qty">@{{ message.length }}</span>
                                        </div>
                                        <div class="item-name-price">
                                            <div class="i-name">
                                                <span v-cloak>@{{ message[0].product.name }}</span>
                                            </div>
                                            <div class="i-price">
                                                <span v-cloak>P @{{ parseFloat(message[0].product.price.toFixed(2)).toLocaleString() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div v-else>
                            {{-- seen messages --}}
                            <div v-for="(message, key) in parentMessage">
                                <a :href="`{{ url('chat-seller') }}/${message[0].product.url}/${message[0].product.id}?ref=${message[0].ref_id}`"
                                @click="readMessage(message[0])" class="seen-message">
                                    <div class="item">
                                        <div class="item-img">
                                            <div :style="'background-image:url({{ asset('/') }}' + message[0].product.image.path +')'"></div>
                                        </div>
                                        <div class="qty">
                                            <span class="label label-qty">0</span>
                                        </div>
                                        <div class="item-name-price">
                                            <div class="i-name">
                                                <span v-cloak>@{{ message[0].product.name }}</span>
                                            </div>
                                            <div class="i-price">
                                                <span v-cloak>P @{{ parseFloat(message[0].product.price.toFixed(2)).toLocaleString() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>