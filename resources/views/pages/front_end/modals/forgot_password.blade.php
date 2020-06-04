 <div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Reset Password</h5>
            </div>
            <div class="modal-body modal-form-icon">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" id="resetPassword">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <input id="email" type="email" class="form-control" placeholder="Enter your email address" name="email" required autofocus>

                        <span class="help-block">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            Send Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>