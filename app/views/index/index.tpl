<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Twitter Tracker</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>

	<div id="header">
		<h1>Twitter Tracker</h1>
	</div>
	
	<div id="content">
		<div id="sidebar">
			<ul>
        {section name=row loop=$users}
          <div class="content">
            <a class="user-tweet-link user-thumb" href="?user={$users[row].userid}">
              <span class="username"><s>@</s><span class="js-username">{$users[row].userid}</span></span>
            </a>
          </div>
        {/section}
			</ul>
		</div>
		
		<div id="main-content">
      <h1>{$tweet.user}</h1> <br/>
      <ul>
      {section name=row loop=$tweet.tweets}
        <li>{$tweet.tweets[row].text}</li>
      {/section}
		</div>
		
		<div class="clear"></div>
	</div>

</body>

</html>
