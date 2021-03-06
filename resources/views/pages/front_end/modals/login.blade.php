 <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Member Login</h5>
            </div>
            <div class="modal-body modal-form-icon">
                <form method="POST" id="authenticate">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus>

                        <span class="help-block" style="display:none">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" placeholder="Password" name="password" required="required">

                        <span class="help-block" style="display:none">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group login-options">
                        <div class="remember">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        <div class="forgot-pw">
                            <a href="#" data-toggle="modal" data-target="#forgotPassword" data-dismiss="modal" class="hover-nav-link">Forgot Your Password?</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>