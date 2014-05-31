<!--main login page-->
<div class="container profile photo-feed">   
   <div class="row">
   		<div class="col-xs-12 main-banner">
   			<div class="panel panel-default user-banner clearfix" style="background: url('<?php echo base_url() ?>/uploads/930x310/<?php echo $cover_image->filename ?>') no-repeat bottom right;">
	   			<div class="col-xs-5">
	   				<a href="#">
	   					<img class="thumbnail" src="<?php echo base_url() ?>/uploads/150x150/<?php echo $pro_image->filename ?>" width="150" height="150" alt="">
				    </a>	   				
					<div class="user-info text-left" >
						<h2><?php echo $user->display_name; ?></h2>
						<h4>From <?php echo $user->place; ?></h4>
					</div>
	   			</div>

	   			<div class="col-xs-12 user-menu">
					<ul class="nav nav-pills">
						<!-- <li><a href="#">About</a></li> -->
						<li><?php echo anchor('profile/', 'Home') ?></li><li>
						<!-- <li><?php echo anchor('profile/about', 'About') ?></li> -->
						<li><?php echo anchor('profile/photo', 'Photos') ?></li>
						<li><?php echo anchor('profile/friend/'.$user->id, 'Friends') ?></li>
                        <?php if ($current_user->id == $user->id): ?>
						<li class="pull-right"><?php echo anchor('profile/edit', 'Edit') ?></li>
                        <?php else: ?>
                            <?php if($this->user_model->is_friend($current_user->id, $user->id)): ?>
                            <li class="pull-right">
                                <a href="<?php echo site_url('user/removefriend/'.$user->id); ?>" class="btn btn-default">Unfriend</a>
                            </li>
                            <?php else: ?>
                            <li class="pull-right">
                                <a href="<?php echo site_url('user/addfriend/'.$user->id); ?>" class="btn btn-default">Add Friend</a>
                            </li>
                            <?php endif; ?>
                        <?php endif; ?>
					</ul>
	   			</div>
   			</div>
   		</div>

       <div class="col-xs-12 sidebar">

            <div class="panel panel-default">
            	<div class="panel-heading">
            		<h4>Photos</h4>
            	</div>
                <div class="panel-body">
                	<?php if(isset($photos) && $photos): ?>
                		<?php foreach ($photos as $photo) :?>
	                		<a href="<?php echo base_url() ?>/uploads/<?php echo $photo->filename ?>" class="fancybox" data-fancybox-group="gallery">
		                    	<img src="<?php echo base_url() ?>/uploads/300x220/<?php echo $photo->filename ?>" alt="">                    	
		                    </a>
	                	<?php endforeach; ?>
                	<?php else: ?>
                		No Photo
                	<?php endif; ?>	                	
                </div>
            </div>
  
       </div>
		 
   </div>
</div>

