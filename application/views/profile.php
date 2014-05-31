<div class="modal fade bs-example-modal-sm" id="theModal"role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <?php echo form_open_multipart('upload/', array( 'role' => 'form')) ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Upload Photos</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="user_id" class="user_id" value="<?php echo $user->id; ?>">
                        <textarea name="post" id="post" class="form-control" rows="3" placeholder="has something to say..."></textarea> 
                        Upload new: <input type="file" name="userfile">
                </div>
                <div class="panel-footer">
                    <input type="submit" value="Save" id="upload_pic_submit" name="save_account_submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<!--main login page-->
<div class="container profile">   
   <div class="row">
   		<div class="col-xs-12 main-banner">
   			<div class="panel panel-default user-banner clearfix"
                <?php if(isset($cover_image) && $cover_image){ ?>
                 style="background: url('<?php echo base_url() ?>/uploads/930x310/<?php echo $cover_image->filename ?>') no-repeat bottom right;" <?php } ?>>
	   			<div class="col-xs-5">
	   				<a href="#">
                        <?php if(isset($pro_image) && $pro_image){ ?>
                        <img class="thumbnail" src="<?php echo base_url() ?>/uploads/150x150/<?php echo $pro_image->filename ?>" width="150" height="150" alt="">
                        <?php }else{ ?>
	   					<img class="thumbnail" src="<?php echo base_url() ?>/img/profile.jpg" width="150" height="150" alt="">
                        <?php } ?>
				    </a>	   				
					<div class="user-info text-left" >
						<h2><?php echo $user->display_name; ?></h2>
						<h4>From <?php echo $user->place; ?></h4>
					</div>
	   			</div>

	   			<div class="col-xs-12 user-menu">
					<ul class="nav nav-pills">
						<!-- <li><a href="#">About</a></li> -->
						<li><?php echo anchor('profile/view/'.$user->id, 'Home') ?></li><li>
						<!-- <li><?php echo anchor('profile/about', 'About') ?></li> -->
						<li><?php echo anchor('profile/photo/'.$user->id, 'Photos') ?></li>
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

       <div class="col-xs-5 sidebar">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">About
                        <?php if ($current_user->id == $user->id): ?>
                    	<?php echo anchor('profile/edit', 'Edit', array('class'=>'pull-right')) ?>
                        <?php endif ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $user->about; ?></p>
                </div>
            </div>

            <div class="panel panel-default photo-feed-quick">
                <div class="panel-heading">
                    <h3 class="panel-title">Photos</h3>
                </div>
                <div class="panel-body">
                    <?php if(isset($images) && $images): ?>
                        <?php foreach ($images as $image) : ?>
                            <a href="<?php echo base_url() ?>/uploads/<?php echo $image->filename ?>" class="fancybox" data-fancybox-group="gallery">
                                <img src="<?php echo base_url() ?>/uploads/300x220/<?php echo $image->filename ?>" width="110" height="90" alt="">
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No Photos</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="panel panel-default friend-feed-quick">
                <div class="panel-heading">
                    <h3 class="panel-title">Friends</h3>
                </div>
                <div class="panel-body">
                    <?php if(isset($friends) && $friends): ?>
                        <?php foreach($friends as $friend): ?>
                            <a href="<?php echo site_url('profile/view/'.$friend['friend_id']) ?>">
                                <?php if($friend['filename']) : ?>
                                   <img src="<?php echo base_url() ?>/uploads/50x50/<?php echo $friend['filename'] ?>" width="50" height="50" alt="">
                                <?php else: ?>
                                   <img src="<?php echo base_url() ?>/img/profile.jpg" width="50" height="50" alt="">
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Not friends yet!
                    <?php endif; ?>
                </div>
            </div>    
       </div>

       <div class="col-xs-7 user-feed">
           	
            <?php if ($current_user->id == $user->id): ?>
           	<div class="panel panel-default status">
               	<?php echo form_open('post/create', array('id' => 'post_status', 'role' => 'form')) ?>
               		<input type="hidden" name="user_id" class="user_id" value="<?php echo $user->id; ?>">
                    <div class="panel-body">
                        <textarea name="post" id="post" class="form-control" rows="3" placeholder="has something to say..."></textarea>  
                    </div>
                    <div class="panel-footer clearfix">  
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#theModal"><i class="glyphicon glyphicon-picture"></i> Add Photo</button>

                        <input type="submit" class="btn btn-success pull-right post" id="post_submit" value="Post" />
                    </div>
                </form>
            </div>
            <?php endif; ?>
		 
		<?php if(count($posts) && $posts): ?>
			<?php foreach ($posts as $post) : ?>
            <div class="panel panel-default block">
                <div class="panel-body row">      		
                	<div class="col-xs-2 user-img">
                        <?php if(isset($pro_image) && $pro_image): ?>
                            <a href=""><img src="<?php echo base_url() ?>/uploads/50x50/<?php echo $pro_image->filename; ?>" width="50" height="50" alt=""></a>
                        <?php else: ?>
                		  <a href=""><img src="<?php echo base_url() ?>/img/profile.jpg" width="50" height="50" alt=""></a>
                        <?php endif; ?>
                	</div>
                	<div class="col-xs-10 user-info">

                        <?php if ($current_user->id == $user->id): ?>
                        <span class="post-remove pull-right">
                            <?php echo anchor('post/remove/'.$post->id, '<i class="glyphicon glyphicon-remove"></i>'); ?>
                        </span>
                        <?php endif; ?>

                		<h4><a href=""><?php echo $user->display_name; ?></a></h4>
                		<span><?php echo humanTiming($post->date); ?> ago</span>
                	</div>
                	<div class="col-xs-12 user-status">
                		<p><?php echo $post->post; ?></p>
                        <?php if($post->post_image) {
                            $image = $this->image_model->get_by_id($post->post_image); ?>
                            <a href="<?php echo base_url() ?>/uploads/<?php echo $image->filename ?>" class="fancybox" data-fancybox-group="gallery">
                                <img src="<?php echo base_url() ?>/uploads/300x220/<?php echo $image->filename ?>" width="255" alt="">
                            </a>
                        <?php } ?>
                	</div>
                	<!-- <div class="col-xs-12 post-detail">
                		<a href="">Like </a>
                		<a href="">comment </a>                		
                	</div> -->
                </div>
                <!-- <div class="panel-footer clearfix">
                	<div class="comment-box">
                		<div class="col-xs-2">
                			<a href=""><img src="http://placehold.it/50x50" alt=""></a>
                		</div>
                		<div class="col-xs-10">
                			<p><a href=""><strong>Yasir taher:</strong></a> Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                		</div>
                	</div>
                </div>
                <div class="panel-footer">
                	<textarea name="" class="form-control" rows="2"></textarea>
                </div> -->
            </div>
        	<?php endforeach; ?>
        <?php endif; ?>

        	<!-- <div class="panel panel-default block">
                <div class="panel-body row">      		
                	<div class="col-xs-2 user-img">
                		<a href=""><img src="http://placehold.it/50x50" alt=""></a>
                	</div>
                	<div class="col-xs-10 user-info">
                		<h4><a href=""><? echo $user->display_name; ?></a></h4>
                		<span>1 hour ago</span>
                	</div>
                	<div class="col-xs-12 user-status">
                		<p><? echo $post->post; ?></p>
                	</div>
                	<div class="col-xs-12 post-detail">
                		<a href="">Like </a>
                		<a href="">comment </a>                		
                	</div>
                </div>
                <div class="panel-footer clearfix">
                	<div class="comment-box">
                		<div class="col-xs-2">
                			<a href=""><img src="http://placehold.it/50x50" alt=""></a>
                		</div>
                		<div class="col-xs-10">
                			<p><a href=""><strong>Yasir taher:</strong></a> Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                		</div>
                	</div>
                </div>
                <div class="panel-footer">
                	<textarea name="" class="form-control" rows="2"></textarea>
                </div>
            </div> -->
 
       </div>
   </div>
</div>


