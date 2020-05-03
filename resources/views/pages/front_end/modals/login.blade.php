 <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Member Login</h5>
            </div>
            <div class="modal-body login-form">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <i class="fa fa-user"></i>
                        <input type="email" class="form-control" placeholder="Emaill address" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" placeholder="Password" required="required">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group login-options">
                        <div class="remember">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        <div class="forgot-pw">
                            <a href="#" data-toggle="modal" data-target="#forgotPassword">Forgot Your Password?</a>
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