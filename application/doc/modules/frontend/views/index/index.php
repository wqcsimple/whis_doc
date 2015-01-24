<?php
use fayfox\models\Option;
use fayfox\models\Page;
?>
            <div class="page-wrapper" tabindex="-1">
                <div class="page-inner">
                
                
                    <section class="normal" id="section-gitbook_19">
                    
                       
							<?php $about = Page::model()->getByAlias('about');
								echo $about['content'];
							?>
                    
                    </section>
                
                
                </div>
            </div>
        </div>