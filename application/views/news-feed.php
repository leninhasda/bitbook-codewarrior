    
<!--main login page-->
<div class="container newsfeed">
	<!-- show error -->

	<div class="row">
		<?php 
			$count = count($feeds);
			if($count >= 3){
				$feeds = array_chunk($feeds, $count/3);
				$count = count($feeds);
			}
			else{
				$feeds = array($feeds);
				$count = count($feeds);
			}
		?>
		<?php for($i=0; $i<$count; $i++): ?>
		<div class="col-xs-4">
			<?php foreach ($feeds[$i] as $feed) : ?>
				<?php //var_dump($feed) ?>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-xs-2 user-img">
							<a href="<?php echo site_url('profile/view/'.$feed['user_id']) ?>">
								<?php if(isset($feed['pro_pic'])) { ?>
			                		<img src="<?php echo base_url() ?>/uploads/50x50/<?php echo $feed['pro_pic'] ?>" alt="">
			                	<?php } else { ?>
			                		<img src="<?php echo base_url() ?>/img/profile.jpg" width="50" height="50" alt="">
			                	<?php } ?>
		                	</a>
		                </div>
		                <div class="col-xs-10 user-info">
		                	<h4><a href="<?php echo site_url('profile/view/'.$feed['user_id']) ?>"><?php echo $feed['display_name'] ?></a></h4>
		                	<span><a href="<?php echo site_url('post/view/'.$feed['post_id']); ?>"><?php echo humanTiming($feed['date']) ?> ago</a></span>
		                </div>
						<div class="col-xs-12 user-status">
		                	<p><?php echo $feed['post'] ?></p>
		                	<?php if(isset($feed['post_image'])): ?>
			                	<a href="">
			                		<img src="<?php echo base_url() ?>/uploads/300x220/<?php echo $feed['post_image'] ?>" width="255" alt="">
			                	</a>
		                	<?php endif; ?>
		                </div>
					</div>
					<!-- <div class="panel-footer">
						<button class="btn btn-default"><i class="glyphicon glyphicon-user"></i> Add Friend</button>
							<button class="btn btn-default"><i class="glyphicon glyphicon-thumbs-down"></i>Disike</button>
							<button class="btn btn-default pull-right"><i class="glyphicon glyphicon-thumbs-bar"></i>Comment</button>
					</div> -->
				</div>
			<?php endforeach; ?>
		</div>
		<?php endfor; ?>

		

	</div>

</div>
