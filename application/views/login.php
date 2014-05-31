    
<!--main login page-->
<div class="container login login-wrap">
	<?php if(isset($is_error) && $is_error): ?>
	<div class="col-xs-12">
		<p class="bg-danger">
			<?php foreach ($error as $e) {
				echo $e;
			} ?>
		</p>
	</div>
	<?php endif; ?>

	<div class="col-xs-6">
		<?php echo form_open('user/authenticate', array('class'=>'form-signin', 'role' => 'form')) ?>
	        <h2 class="form-signin-heading">Login</h2>
	        <input type="text" class="form-control" placeholder="username or email" name="user" required autofocus>
	        <input type="password" name="pass" class="form-control" placeholder="Password" required>
	        <!-- <label class="checkbox">
	        <input type="checkbox" value="remember-me"> Remember me
	        </label> -->
	        <input class="btn btn-lg btn-primary " type="submit" name="login_submit" value="Sign in">
	    </form>	
	</div>
	<div class="col-xs-6">
		<?php echo form_open('user/register', array('class'=>'form-signin', 'role' => 'form')) ?>
	        <h2 class="form-signin-heading">Create a New Accout</h2>
	        <input name="email" type="text" class="form-control" placeholder="Email address" required autofocus>
	        <input name="password" type="password" class="form-control" placeholder="Password" required>
	        <input name="firstname" type="text" class="form-control" placeholder="First Name" required autofocus>
	        <input name="lastname" type="text" class="form-control" placeholder="Last Name" required autofocus>
	        <label class="radio-inline">
	        	<input name="gender" type="radio" value="remember-me" checked>Male
	        </label>
	        <label class="radio-inline">
	        	<input name="gender" type="radio" value="remember-me">Female
	        </label>
	        <input name="date_of_birth" id="date_field" type="text" class="form-control" placeholder="Date of birth: yy-mm-dd" required autofocus>
	        <input class="btn btn-lg btn-primary " type="submit" name="reg_submit" value="Register" />
	    </form>	
	</div>
    
</div>

