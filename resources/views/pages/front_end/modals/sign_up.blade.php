<div id="sign_up_modal" class="modal fade my-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register an account!</h4>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('sign-up') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name" placeholder="First Name">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="E-mail Address">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Sign-up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>