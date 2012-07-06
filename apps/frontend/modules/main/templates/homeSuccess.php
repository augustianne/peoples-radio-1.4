<!doctype html>  
    <html lang="en" class="no-js">  
    <head>  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
	<link rel="shortcut icon" href="/images/favicon.ico" />
    <link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:700,700italic' rel='stylesheet' type='text/css'>	
    <link href='/css/grid.css' rel='stylesheet' type='text/css'>	
	<link rel="stylesheet" type="text/css" media="screen" href="/css/reset.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/styles.css?v=1.0" />
	<script type="text/javascript" src="/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="/js/jquery.all.js"></script>
<script type="text/javascript" src="/js/modernizr-1.0.min.js"></script>
      <meta charset="utf-8">  
      <title>People's Radio</title>  
      <meta name="description" content="PeoplesRadio">  
      <meta name="author" content="PeoplesRadio">  
      <!--[if lt IE 9]>  
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>  
      <![endif]-->  
    </head>  
    <body>
    	 <header class="container_12">
    	 	<h1>Lets Rock the World!</h1>
    		<div class="signup">
    			<button class="button create">Create a Channel</button>
    		</div>
    	</header> 
    	<div id="content" class="container_12 home">
    	<div id="topper" class="grid_12">

		</div>
    		<div id="container" class="grid_8 clear">
			<div class="solid">
				<h2 class="chn">Join the Channels below or <a href="">Create a new Channel</a></h2>
				<article class="chn clear">
					<a href=""><span>Pls Join my Rock channel ty...</span><img src="/images/chn1.jpg" border="0" align="left"></a>
					<a href=""><span>Random Music around the World</span><img src="/images/chn2.jpg" border="0" align="left"></a>
					<a href=""><span>Asian Song here...</span><img src="/images/chn3.jpg" border="0" align="left"></a>
					<a href=""><span>Lets Relax</span><img src="/images/chn4.jpg" border="0" align="left"></a>	
					<a href=""><span>Party Rock!!!</span><img src="/images/chn5.jpg" border="0" align="left"></a>
					<a href=""><span>Yes they got Bee Gees</span><img src="/images/chn6.jpg" border="0" align="left"></a>
					<a href=""><span>Beatles Forever Join me!</span><img src="/images/chn7.jpg" border="0" align="left"></a>
					<a href=""><span>OMG its Justin</span><img src="/images/chn8.jpg" border="0" align="left"></a>								
				</article>
			</div> 
		</div>
<div id="sidebar" class="grid_4">
	<div class="side">
		<article class="que clear">
			<div class="radio">
				<!-- Put Player Here -->                  
				<div id="cover_art">
					<?php include_partial('main/coverArt', $vars); ?>
				</div>
				<audio controls="controls" autoplay="autoplay" class="player">
                  <source src="http://www.icecast-streaming.com.local:8000/main" type="audio/mpeg" />
                </audio>
			</div>
			<h3>Playlist</h3>                                            
						
			<div id="community" data-channel="<?php echo $channelId; ?>">
				<ul>
					<?php include_component('main', 'playlist', array('channelId' => 'main')); ?>
				</ul>
			</div>
		</article>
		<article class="blg">
			<h3>People's News</h3>
			<ul>
				<li>
					<a href="#">Lorem ipsum</a>
					<p>Mauris in leo nisl, quis varius felis. Donec suscipit tempor convallis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
				</li>
				<li>
					<a href="#">Lorem ipsum</a>
					<p>Mauris in leo nisl, quis varius felis. Donec suscipit tempor convallis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
				</li>
			</ul>
		</article>
	</div>
</div><div id="chat"> 
	<div class="cht">
		<ul>
			<li>
				<p><a href="#">Janvan Valleramos</a> pls vote for Justin Beiber boyfriend song pls pls pls <3</p>
			</li>
			<li>
				<p><a href="#">Andamon A. Abilar</a> me too i wub justin so much!!!!</p>
			</li>
			<li class="frm">
				<textarea></textarea><input type="submit" value="Send" class="mt10"/>     				
			</li>
		</ul>
	</div>
</div>
    	
		<div id="footer" class="clear">
     		<p class="statement"><em>Lets talk about how we can help People's Radio.</em><br><a href="#">People's Forum</a>. Made in Philippines. 2012.</p>
     	</div></div>
  </body>
</html>