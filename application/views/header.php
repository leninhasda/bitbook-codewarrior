<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	

	<title><?php echo $site_title; ?> <?= base_url(); ?></title>

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900,400italic,300italic' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css">
</head>
<body>
    <!-- navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <a href="<?php echo site_url('profile/feed/') ?>" class="navbar-brand">Bitbook</a>
        </div>

        <div class="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-bell" >
                            <span class="badge">4</span>
                        </i> 
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-envelope" >
                            <span class="badge">4</span>
                        </i>  
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-bell" >
                            <span class="badge">4</span>
                        </i>   
                    </a>
                </li> -->
                <?php if(isset($current_user)): ?>
                <li>
                    <?php echo anchor('profile/feed/'.$current_user->id, 'Feed'); ?>                        
                    </a>
                </li>
                <li>
                    <?php echo anchor('profile/', $current_user->display_name); ?>                        
                    </a>
                </li>
                <li>
                    <?php echo anchor('profile/logout', 'Logout'); ?>                        
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            
            <?php echo form_open('user/search', array('class' => 'navbar-form nabvar-left', 'role' => 'form', 'method' => 'get')) ?>
                <div class="form-group">
                    <input type="text" name="query" class="form-control search" placeholder="Search">
                </div>
            </form> 
        
            
            <!--Profile pic-->

        </div><!--/.nav-collapse -->
      </div>
    </div>