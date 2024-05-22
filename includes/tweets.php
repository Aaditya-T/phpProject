<?php
$user_id = $_SESSION['user_id'];
// global $tweets;
foreach($tweets as $tweet) { 

$retweet_sign = false;
$retweet_comment =false;
$qoq = false;

if (Tweet::isTweet($tweet->id)) {
  $tweet_user = User::getData($tweet->user_id) ;
  $tweet_real = Tweet::getTweet($tweet->id);
  $timeAgo = Tweet::getTimeAgo($tweet->post_on) ; 
  $likes_count = Tweet::countLikes($tweet->id) ;
  $user_like_it = Tweet::userLikeIt($user_id ,$tweet->id);
  $retweets_count = Tweet::countRetweets($tweet->id) ;
  $user_retweeted_it = Tweet::userRetweeetedIt($user_id ,$tweet->id);
}

$tweet_link = $tweet->id;

if($retweet_sign)
$comment_count = Tweet::countComments($retweeted_tweet->id);
else  $comment_count = Tweet::countComments($tweet->id); 

?>
        <div class="box-tweet feed" style="position: relative;" >
        <a href="status/<?php echo $tweet_link; ?>">
        <span style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 1;"></span>
        </a>
        <?php if ($retweet_sign) { ?>
        <span class="retweed-name"> <i class="fa fa-retweet retweet-name-i" aria-hidden="true"></i> 
        <a style="position: relative; z-index:100; color:rgb(102, 117, 130);" href="<?php echo $retweeted_user->username; ?> "> <?php  if($retweeted_user->id == $user_id) echo "You";
        else echo $retweeted_user->name; ?> </a>  retweeted</span>
        <?php } ?>
        <div class="grid-tweet">
        <a style="position: relative; z-index:1000" href="<?php echo $tweet_user->username;  ?>">
        <img
        src="assets/images/users/default.jpg"
        alt=""
        class="img-user-tweet"
        />
        </a >
        <div>
        <p> 
        <a style="position: relative; z-index:1000; color:black" href="<?php echo $tweet_user->username;  ?>">
        <strong> <?php echo $tweet_user->name ?> </strong> 
        </a>
        <span class="username-twitter">@<?php echo $tweet_user->username ?> </span>
        <span class="username-twitter"><?php echo $timeAgo ?></span>
        </p>
        <p class="tweet-links">
        <?php
        // check if it's quote or normal tweet
        if ($retweet_comment || $qoq)
        echo  Tweet::getTweetLinks($qoute);
        else echo  Tweet::getTweetLinks($tweet_real->status); ?>
        </p>
        <?php if ($retweet_comment == false && $qoq == false) { ?>
        <?php if ($tweet_real->img != null) { ?>
        <p class="mt-post-tweet">
        <img
        src="assets/images/tweets/<?php echo $tweet_real->img; ?>"
        alt=""
        class="img-post-tweet"
        />
        </p>
        <?php } } else { ?>
        <!-- qoued tweet place here --> 

        <div  class="mt-post-tweet comment-post" style="position: relative;">

        <a href="status/<?php echo $tweet_inner->id; ?>">
        <span class="" style="position:absolute; width:100%; height:100%; top:0;left: 0; z-index: 2;"></span>
        </a>
        <div class="grid-tweet py-3 "  > 

        <a style="position: relative; z-index:1000" href="<?php echo $user_inner_tweet->username;  ?>">
        <img
        src="assets/images/users/<?php echo $user_inner_tweet->img; ?>"
        alt=""
        class="img-user-tweet"
        />
        </a >

        <div>
        <p> 
        <a style="position: relative; z-index:1000; color:black" href="<?php echo $user_inner_tweet->username;  ?>">
        <strong> <?php echo $user_inner_tweet->name ?> </strong> 
        </a>
        <span class="username-twitter">@<?php echo $user_inner_tweet->username ?> </span>
        <span class="username-twitter"><?php echo $timeAgo_inner ?></span>
        </p>
        <p>
        <?php
        if ($qoq)
        echo Tweet::getTweetLinks($inner_qoute);
        else  echo  Tweet::getTweetLinks($tweet_inner->status); ?>
        </p>
        <?php   // don't show img if quote of quote
        if ($qoq == false) { 
        if ($tweet_inner->img != null) { ?>
        <p class="mt-post-tweet">
        <img
        src="assets/images/tweets/<?php echo $tweet_inner->img; ?>"
        alt=""
        class="img-post-retweet"
        />
        </p>
        <?php } } ?>

        </div> 

        </div>


        </div>

        <?php } ?>

        <div class="grid-reactions">
        <div class="grid-box-reaction">
        <div class="hover-reaction hover-reaction-comment comment"
        data-user = "<?php echo $user_id; ?>" 
        data-tweet = "<?php 
        if($retweet_sign)
        echo $retweeted_tweet->id;
        else  echo $tweet->id; ?>">

        <i class="far fa-comment"></i>
        <div class="mt-counter likes-count d-inline-block">
        <p> <?php if($comment_count > 0) echo $comment_count; ?>  </p>
        </div>
        </div>
        </div>
        <div class="grid-box-reaction">

        <div  class="hover-reaction hover-reaction-retweet
        <?= $user_retweeted_it ? 'retweeted' : 'retweet' ?> option"
        data-tweet="<?php
        echo $tweet->id ;
        ?>" 
        data-user="<?php echo $user_id; ?>
        "
        data-retweeted = "<?php echo $user_retweeted_it; ?>"
        data-sign = "<?php echo $retweet_sign; ?>"
        data-tmp="<?php echo $retweet_comment; ?>"
        data-qoq="<?php echo $qoq; ?>">



        <!-- <i class="fas fa-retweet"></i> -->
        <div class="mt-counter likes-count d-inline-block">
        <p><?php if($retweets_count > 0)  echo $retweets_count ; ?></p>
        </div>



        </div>

        <div class="options">

            
        </div> 

        </div>
        <div  class="grid-box-reaction"  >
        <a class="hover-reaction hover-reaction-like 
        <?= $user_like_it ? 'unlike-btn' : 'like-btn' ?> " 
        data-tweet="<?php 
        if($retweet_sign) {
            if($retweet->tweet_id != null) {
            echo $retweet->tweet_id;
            } echo $retweet->retweet_id;
        }  else echo $tweet->id ;
        //  echo Tweet::likedTweetRealId($tweet->id);

        ?>" 
        data-user="<?php echo $user_id; ?>">


        <i class="fa-heart <?= $user_like_it ? 'fas' : 'far mt-icon-reaction' ?>"></i>
        <!-- <i class="fas fa-heart liked"></i> -->

        <div class="mt-counter likes-count d-inline-block">
        <p> <?php if($likes_count > 0)  echo $likes_count ; ?> </p>
        </div>
        </a>


        </div>

        <div class="grid-box-reaction">
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="popupTweet">
        </div>
        <div class="popupComment">
        </div>
<?php } ?>