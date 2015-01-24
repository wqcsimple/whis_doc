<?php 

use fayfox\models\Option;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta charset="UTF-8">
        <title><?php echo Option::get('sitename')?></title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $this->staticFile('images/book.png')?>">
        <link rel="shortcut icon" href="<?php echo $this->staticFile('images/favicon.ico')?>" type="image/x-icon">
        <link rel="stylesheet" href="http://libs.useso.com/js/bootstrap/3.2.0/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" href="<?php echo $this->staticFile('css/style.css')?>">
  
</head>
<body>
        
        



        
    <div class="book" data-level="0" data-basepath="." data-revision="1411990509164">
    

<div class="book-summary">
    <div class="book-search">
        <input type="text" placeholder="Type to search" class="form-control">
    </div>
    <ul class="summary">
        
    <?php include '_menu.php';?>
    
    
    


        
        <li class="divider"></li>
        <li>
            <a href="http://whis.fayfox.com" target="blank" class="gitbook-link">Power By whis...</a>
        </li>
        
    </ul>
</div>

    <div class="book-body">
        <div class="body-inner">
            <div class="book-header">
    <!-- Actions Left -->
    <a href="" class="btn pull-left toggle-summary" aria-label="Toggle summary"><i class="glyphicon glyphicon-list"></i></a>
    <a href="" class="btn pull-left toggle-search" aria-label="Toggle search"><i class="glyphicon glyphicon-search"></i></a>
    
    <div id="font-settings-wrapper" class="dropdown pull-left">
        <a href="" class="btn toggle-dropdown" aria-label="Toggle font settings"><i class="glyphicon glyphicon-font"></i>
        </a>
        <div class="dropdown-menu font-settings">
    <div class="dropdown-caret">
        <span class="caret-outer"></span>
        <span class="caret-inner"></span>
    </div>

    <div class="buttons">
        <button type="button" id="reduce-font-size" class="button size-2">A</button>
        <button type="button" id="enlarge-font-size" class="button size-2">A</button>
    </div>

    <div class="buttons font-family-list">
        <button type="button" data-font="0" class="button">Serif</button>
        <button type="button" data-font="1" class="button">Sans</button>
    </div>

    <div class="buttons color-theme-list">
        <button type="button" id="color-theme-preview-0" class="button size-3" data-theme="0">White</button>
        <button type="button" id="color-theme-preview-1" class="button size-3" data-theme="1">Sepia</button>
        <button type="button" id="color-theme-preview-2" class="button size-3" data-theme="2">Night</button>
    </div>
</div>

    </div>


    <!-- Title -->
    <h1>
        <i class="fa fa-circle-o-notch fa-spin"></i>
        <a href="<?php echo $this->url()?>"><?php echo Option::get('sitename')?></a>
    </h1>
</div>


        <?php echo $content;?>
        
    </div>
</div>

<?php include '_footer.php';?>

</body>
</html>