 <div class="modal fade" id="msgsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Messages</h5>
            </div>
            <div class="modal-body">
                <ul class="other" id="item-list">
                    <li>
                        @for ($i = 0; $i < 12; $i++)
                            <a href="#">
                                <div class="item">
                                    <div class="item-img">
                                        <img src="{{ asset('files/shop.png') }}" class="img-circle img-responsive img-thumbnail" width="45px">
                                    </div>
                                    <div class="qty">
                                        <span class="label label-qty">{{ $i + 99 }}</span>
                                    </div>
                                    <div class="item-name-price">
                                        <div class="i-name">
                                            <span>Mechanical Red Dragon Keyboard RGB</span>
                                        </div>
                                        <div class="i-price">
                                            <span>P 750.00</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endfor
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>