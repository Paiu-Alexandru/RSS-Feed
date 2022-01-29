<!DOCTYPE html>
<html>
    <header>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </header>
<body>
<div class="content">
  
        
   
  
<h1>RSS Feeds...</h1>
    
<div class="form">  

<label for="cars">Choose a Feed:</label>
    <form  method="post" action="">
        <select name="rss">
          <option value="">--RSS--</option>
          <option name="cnn" value="https://rss.stirileprotv.ro">Stirile PRO TV</option>
          <option name="bbs" value="http://feeds.bbci.co.uk/news/world/europe/rss.xml">BBC Europe News</option>
          <option value="https://www.bbc.com/sport/rss.xml">BBC Sport News</option>
         
        </select>
         <input type="submit" name="submit">
  </form>
</div>
 <?php
    
if(isset($_POST['submit']) != NULL && $_POST['rss'] != NULL){
    
    $get_rss = $_POST['rss'];
    $feeds = simplexml_load_file($get_rss);


 $i=0;
 if(!empty($feeds)){

  $site = $feeds->channel->title;
  $sitelink = $feeds->channel->link;

  echo "<h1>".$site."</h1>";
  foreach ($feeds->channel->item as $item) {

   $title = $item->title;
   $link = $item->link;
   $description = $item->description;
   $postDate = $item->pubDate;
   $pubDate = date('D, d M Y',strtotime($postDate));


   if($i>=5) break;
  ?>
   <div class="post">
     <div class="post-head">
       <h2><a class="feed_title" href="<?php echo $link; ?>"><?php echo $title; ?></a></h2>
       <span><?php echo $pubDate ; ?></span>
     </div>
     <div class="post-content">
       <?php echo implode(' ', array_slice(explode(' ', $description), 0, 20)) . "..."; ?> 
         <a href="<?php echo $link; ?>">Read more</a>
         
     </div>
   </div>

   <?php
    $i++;
   }
 }
}
 ?>
</div>
</body>
</html>
    