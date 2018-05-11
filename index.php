<?php

	//RSS FLux : https://medium.com/feed/@ow
	
	$username = "ow";
	$getFeed = file_get_contents("https://medium.com/@$username/latest?format=json");
	
	// Delete prevent JSON Hijacking 
	$pos=strpos($getFeed,"{");
	$getFeed=substr($getFeed,$pos);
	$feed = json_decode($getFeed);
	//print_r($getFeed);
	//print_r($feed);

	// Get post id
	$postIds = $feed->payload->references->Post;
	//print_r($postIds);
	//print_r($postId);
	$i = 0;

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Mediums Posts</title>

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	
	<section class="articles-wrapper">
		<img id="header-logo" src="https://cdn-images-1.medium.com/max/1600/1*TGH72Nnw24QL3iV9IOm4VA.png" alt="logo medium"/>
			<br/>
		<?php
			foreach($postIds as $postId) {
		?>
		<a href="https://www.medium.com/@<?php echo $username; ?>/<?php echo $postId->id; ?>" target=_blank><div class="article-card">
			<img class="article-img" src="https://miro.medium.com/fit/c/1400/420/<?php echo $postId->virtuals->previewImage->imageId; ?>" alt="<?php echo $postId->title; ?>"/>
			<h4 class="article-title"><?php echo $postId->title; ?></h4>
			<h5 class="article-autor"><?php echo $feed->payload->user->name; ?></h5>
			<button class="article-btn">Read more</button>
		</div></a>
		<?php
				if (++$i == 6) break;
			}
		?>
	</section>


</body>
</html>