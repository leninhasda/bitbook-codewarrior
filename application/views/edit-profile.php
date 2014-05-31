    
<!--main login page-->
<div class="container edit-profile">
	<!-- show error -->

	<div class="modal fade bs-example-modal-sm" id="theModal"role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
				</div>
			</div>
		</div>
	</div>

	<!-- show success -->
	
	<div class="row">
	    <div class="col-xs-6">
	    	<div class="panel panel-default account-info edit-block clearfix">
		    <?php echo form_open('user/save_account', array( 'id' => 'account_form', 'class'=>'form-horizontal', 'role' => 'form')) ?>
		    	<input type="hidden" name="user_id" class="user_id" value="<?php echo $user->id; ?>">
		    	<div class="panel-heading clearfix">
		    		<div class="col-xs-10">
		    			<h3>Account</h3>
		    		</div>
		    		<div class="col-xs-2 text-right">
		    			<input type="submit" value="Save" id="save_account_submit" name="save_account_submit" class="btn btn-success">
		    		</div>
		    	</div>
		        <div class="panel-body row">

					<div class="form-group">
						<label for="inputEmail3" class="col-xs-3 control-label">Email</label>
						<div class="col-xs-8">
							<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $user->email; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-xs-3 control-label">Password</label>
						<div class="col-xs-8">
							<input type="password" name="password" class="form-control" id="password" placeholder="keep it blank if not changed">
						</div>
					</div>
		        </div>
		    </form>
		    </div>
	    </div>

	    <div class="col-xs-6">
	    	<div class="panel panel-default edit-block clearfix">
		    <?php echo form_open_multipart('upload/', array( 'role' => 'form')) ?>
		    	<input type="hidden" name="user_id" class="user_id" value="<?php echo $user->id; ?>">
		    	<input type="hidden" name="pro_pic" value="1">
		    	<div class="panel-heading clearfix">
		    		<div class="col-xs-10">
		    			<h3>Profile Picture</h3>
		    		</div>
		    		<div class="col-xs-2 text-right">
		    			<input type="submit" value="Save" id="upload_pic_submit" name="save_account_submit" class="btn btn-success">
		    		</div>
		    	</div>
		        <div class="panel-body row">
					<div class="col-xs-5">
						<?php if(isset($pro_image) && $pro_image): ?>
						<img src="<?php echo base_url() ?>/uploads/150x150/<?php echo $pro_image->filename ?>" alt="">
						<?php else: ?>
							<img src="<?php echo base_url() ?>/img/profile.jpg" width="150" alt="">
						<?php endif; ?>
					</div>
					<div class="col-xs-7">
						Upload new:
						<input type="file" name="userfile">
					</div>
		        </div>
		    </form>
		    </div>
	    </div>
    </div>

	<div class="row">
		<div class="col-xs-6">
			<div class="panel panel-default basic-info edit-block">
		    <?php echo form_open('user/save_basic', array( 'id' => 'basic_form', 'class'=>'form-horizontal', 'role' => 'form')) ?>
		    	<input type="hidden" name="user_id" class="user_id" value="<?php echo $user->id; ?>">
		    	<div class="panel-heading clearfix">
		    		<div class="col-xs-10">
		    			<h3>Basic Info</h3>
		    		</div>
		    		<div class="col-xs-2 text-right">
		    			<input type="submit" value="Save" id="save_basic_submit" name="save_account_submit" class="btn btn-success">
		    		</div>
		    	</div>
		        <div class="panel-body row">

		        	<div class="form-group">
						<label for="inputEmail3" class="col-xs-3 control-label">First Name</label>
						<div class="col-xs-8">
							<input name="firstname" class="form-control" id="firstname" value="<?php echo $user->firstname; ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="inputEmail3" class="col-xs-3 control-label">Last Name</label>
						<div class="col-xs-8">
							<input name="lastname" class="form-control" id="lastname" value="<?php echo $user->lastname; ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="inputEmail3" class="col-xs-3 control-label">Display Name</label>
						<div class="col-xs-8">
							<input name="display_name" class="form-control" id="display_name" value="<?php echo $user->display_name; ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="inputEmail3" class="col-xs-3 control-label">About</label>
						<div class="col-xs-8">
							<textarea name="about" class="form-control" id="about" rows="3"><?php echo $user->about; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-xs-3 control-label">Date of birth</label>
						<div class="col-xs-8">
							<input type="text" id="date_field" name="date_of_birth" class="form-control" value="<?php echo $user->date_of_birth; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-xs-3 control-label">Place</label>
						<div class="col-xs-8">
							<input type="text" id="place" name="place" class="form-control" value="<?php echo $user->place; ?>">
						</div>
					</div>
		        </div>
		    </form>
		    </div>
		</div>
		   
		<div class="col-xs-6">
	    	<div class="panel panel-default edit-block clearfix">
		    <?php echo form_open_multipart('upload/', array( 'role' => 'form')) ?>
		    	<input type="hidden" name="user_id" class="user_id" value="<?php echo $user->id; ?>">
		    	<input type="hidden" name="cover_pic" value="1">
		    	<div class="panel-heading clearfix">
		    		<div class="col-xs-10">
		    			<h3>Cover Photo</h3>
		    		</div>
		    		<div class="col-xs-2 text-right">
		    			<input type="submit" value="Save" id="upload_pic_submit" name="save_account_submit" class="btn btn-success">
		    		</div>
		    	</div>
		        <div class="panel-body ">
		        	Upload new:
					<input type="file" name="userfile"><br>
					<div class="text-center">
						<?php if(isset($cover_image) && $cover_image): ?>
							<img src="<?php echo base_url() ?>/uploads/300x220/<?php echo $cover_image->filename ?>" alt="">
						<?php else: ?>
							<img src="<?php echo base_url() ?>/img/bg.png" width="300" alt="">
						<?php endif; ?>
					</div>
		        </div>
		    </form>
		    </div>
	    </div>
	</div>
</div>

