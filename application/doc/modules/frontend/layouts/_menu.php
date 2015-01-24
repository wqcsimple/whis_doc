<?php 
use fayfox\models\Page;
use fayfox\models\Category;
use fayfox\models\Post;
?>
    
    
    	
        <li class="chapter active done" data-level="0" data-path="index.html">
            
                
                    <a href="<?php echo $this->url();?>">
                        <i class="glyphicon glyphicon-ok"></i>
                        <?php $about = Page::model()->getByAlias('about');
                        	echo $about['title'];
                        ?>
                         
                    </a>
                
            
            
        </li>
        
        <?php $cats = Category::model()->getAll('_system_post','id,title'); ?>
        <?php foreach ($cats as $key1 => $cat) {?>
        <li class="chapter" data-level="1">
            
            <span><b><?php echo $key1+1;?>.</b><?php echo $cat['title']?></span>
            <ul class="articles">
            	<?php $posts = Post::model()->getByCatId($cat['id'],0,'id,title',false,'publish_time ASC');
            		foreach ($posts as $key2 => $post){
            	?>
		        <li class="chapter  done" data-level="1.1" data-path="introduction.html">
		                    <a href="<?php echo $this->url('post/'.$post['id'])?>">
		                        <i class="fa fa-check"></i>
		                            <b><?php echo $key1+1;?>.<?php echo $key2+1?>.</b><?php echo $post['title'];?>
		                    </a>
		        </li>
		        <?php }?>
            </ul>
           
        </li>
    	<?php }?>