    
<!--main login page-->
<div class="container newsfeed">
	<!-- show error -->
	<?php $target = count($users)/3; $cnt=0;?>
	<div class="row">
	<?php foreach ($users as $user): $cnt++ ?>
		<div class="col-xs-4">
			<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-xs-2 user-img">
							<a href="<?php echo site_url('profile/view/'.$user['id']) ?>">
								<?php if(isset($user['filename'])  && $user['filename'] ): ?>
		                			<img src="<?php echo base_url() ?>/uploads/50x50/<?php echo $user['filename'] ?>" width="50" height="50" alt="">
								<?php else: ?>
		                			<img src="<?php echo base_url() ?>/img/profile.jpg" width="50" height="50" alt="">
		                		<?php endif; ?>
							</a>
	                	</div>
	                	<div class="col-xs-10 user-info">
	                		<h4>
								<?php echo anchor('profile/view/'.$user['id'], $user{'display_name'}) ?>
	                		</h4>
	                		<span>From <?php echo $user['place']; ?></span>
	                	</div>
						<!-- <div class="col-xs-12 user-status">
	                		<p>this is a status</p>
	                	</div> -->
					</div>
					<div class="panel-footer">
						<?php if($this->user_model->is_friend($current_user->id, $user['id'])): ?>
							<a href="<?php echo site_url('user/removefriend/'.$user['id']) ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Unfriend</a>
						<?php else: ?>
							<a href="<?php echo site_url('user/addfriend/'.$user['id']) ?>" class="btn btn-default"><i class="glyphicon glyphicon-user"></i> Add Friend</a>
						<?php endif; ?>
						<!-- <button class="btn btn-default"><i class="glyphicon glyphicon-thumbs-down"></i>Disike</button>
						<button class="btn btn-default pull-right"><i class="glyphicon glyphicon-thumbs-bar"></i>Comment</button> -->
					</div>					
				</div>
		</div>
		<?php if($cnt%3 == 0) {?>
			<div class="clearfix"></div>
		<?php } ?>
	<?php endforeach; ?>
	</div>

</div>
