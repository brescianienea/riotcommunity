<?php
if (!$_GET['section']) {
    header("Location: /index.php");
    exit();
}
?>
    <!DOCTYPE html>
    <html lang="en" xml:lang="en">
    <?php include('head.php'); ?>
    <?php $_SESSION['page'] = 'feed' ?>
    <body>
    <?php include('header.php'); ?>
    </header>
    <main>
        <div class="column">
            <div class="wrapper">
                <h1>Feed</h1>
                <section class="section-selection">
                    <h2 hidden="hidden">Section selection:</h2>
                    <ul>
                        <li class="<?php if ($_SESSION['logged'] == "false"): ?> hidden <?php endif; ?>    <?php if ($_GET['section'] == "friends"): ?> _selected <?php endif; ?>">
                            <a href="/home.php?section=friends">Friends</a>
                        </li>
                        <li class="<?php if ($_GET['section'] == "discover"): ?> _selected <?php endif; ?>">
                            <a href="/home.php?section=discover">Discover</a>
                        </li>
                        <?php /*
                        <li class="<?php if ($_GET['section'] == "news"): ?> _selected <?php endif; ?>">
                            <a href="/home.php?section=news">News</a>
                        </li> */ ?>
                    </ul>
                </section>
                <?php if ($_GET['section'] == "friends"): ?>
                    <?php include('home/friends.php'); ?>
                <?php elseif ($_GET['section'] == "discover"): ?>
                    <?php include('home/discover.php'); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php include('navbar.php'); ?>
    </main>
    </body>
    <?php include('footer.php'); ?>


    </html>
<?php /*
<?php include('head.php'); ?>
<?php include('session.php'); ?>    
    <body>
	<?php include('navbar.php'); ?>
			<div id="masthead">  
				<div class="container">
					<?php include('heading.php'); ?>
				</div><!-- /cont -->
				<div class="container">
					<div class="row">
					<div class="col-md-12">
						<div class="top-spacer"> </div>
					</div>
					</div> 
				</div><!-- /cont -->
			</div>
<div class="container">
  <div class="row">
    <div class="col-md-12"> 
      <div class="panel">
        <div class="panel-body">
          <!--/stories-->
          <div class="row">    
            <br>
				<?php
	$query = $conn->query("select * from post LEFT JOIN members on members.member_id = post.member_id order by post_id DESC");
	while($row = $query->fetch()){
	$posted_by = $row['firstname']." ".$row['lastname'];
	$posted_image = $row['image'];
	$id = $row['post_id'];
	?>
            <div class="col-md-2 col-sm-3 text-center">
             <img  src="<?php echo $posted_image; ?>" style="width:100px;height:100px" class="img-circle"></a>
            </div>
            <div class="col-md-10 col-sm-9">
             	<div class="alert"><?php echo $row['content']; ?></div>
              <div class="row">
                <div class="col-xs-9">
                  <h4><span class="label label-info"> <?php echo $row['date_posted']; ?></span></h4><h4>
                  <small style="font-family:courier,'new courier';" class="text-muted">Posted By:<a href="#" class="text-muted"><?php echo $posted_by; ?></a></small>
                  </h4></div>
                <div class="col-xs-3"><a href="delete_post.php<?php echo '?id='.$id; ?>" class="btn btn-danger"><i class="icon-trash"></i> Delete</a></div>
              </div>
              <br><br>
            </div>
	<?php } ?>		
          </div>
          <hr>
        </div>
      </div>
                                                                                       
	                                                
                                                      
   	</div><!--/col-12-->
  </div>
</div>
                                                
                                                                                
<?php include('footer.php'); ?>
        
    </body>
</html> */ ?>