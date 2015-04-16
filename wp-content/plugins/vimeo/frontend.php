      	<main id="main" class="row-fluid" role="main">
      		 
      		<div id="main-inner" class="container">
      			<div class="span-16">
      				
      				<div class="yt_header">
                        <div class="logo"><?php echo $vimeo->get_profile_image($user_details)?><p><?php echo $vimeo->get_author($user_details)?></p></div>
                    </div>
                            <div class="summary">
                            <?php echo $vimeo->get_summary($user_details);
										$url = get_permalink();
							
							?>
                            </div><br><br>
      				
       				<nav class="gallery-nav">
       					<div class="tabs">
       						<a id="uploads" class="tab <?php if($displaylist==="uploads"){?>active<?php }?>" href="<?php echo add_query_arg(array('videos' => 'uploads'), $url)?>">Uploads</a>
       						<a id="playlists" class="tab <?php if($displaylist==="likes"){?>active<?php }?>" href="<?php echo add_query_arg(array('videos' => 'likes'), $url)?>">Likes</a>
       						<a id="subscriptions" class="tab <?php if($displaylist==="subscriptions"){?>active<?php }?>" href="<?php echo add_query_arg(array('videos' => 'subscriptions'), $url)?>">Subscriptions</a>
       						<a id="tagged" class="tab <?php if($displaylist==="tagged"){?>active<?php }?>" href="<?php echo add_query_arg(array('videos' => 'tagged'), $url)?>">Tagged</a>
       					</div>
       				</nav><!-- gallery-nav-->
       					
	      			<div class="radium-gallery-wrapper">
	      			
	      				<div id="radium-gallery-1" class="radium-gallery  radium-video-gallery four-columns">
	      				
                        	<?php
                            
							
							if(count($videos) > 0){
							foreach ($videos as $video){
								
									$link = "http://vimeo.com/".$vimeo->get_video_id($video) ;	
							
							?>
                        
	      					<!--<div class="page-grid-item ic_container">-->
	      						
                                <div class="page-grid-item ic_container" style="width:292px">
	      							<img src="<?php echo $vimeo->get_video_thumbnail($video)?>" alt="slide-template"  style="height:180px; width:292px;">
                                 <a rel="gallery[1]" href="<?php echo $link?>" >
                                        <div class="ic_caption"><div class="overlay" style="display:none;"></div>
                                            <!--<p class="ic_category">Category</p>
                                            <h3>Amazing Image Title</h3>-->
                                            <div class="play-button"></div>
										<?php if($displaylist==="playlist"){?>
                                              <p class="ic_text"> <?php echo $video['title']['$t']?>
                                                (<?php echo $vimeo->get_playlist_no_of_videos($video)?> videos)</p> 
                                        <?php }else{?>
                                              <p class="ic_text"> <?php echo $vimeo->get_video_title($video)?>
                                                </p> 
                                        <?php }?>
                                            
                                        </div></a>
                           </div>
                            
                            <?php
							}
							}
							?>

	      					
	      				</div><!-- /.radium-gallery --> 
	      				
	      			</div><!-- /.radium-gallery-wrapper --> 
	      			
	      		</div><!-- /.span-16 --> 
	      		
	      	</div><!-- /.container --> 				
	      		 		 	
      	</main><!-- /main --> 

 

