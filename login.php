 <!DOCTYPE html>
 <html>
 <head>
	 <meta charset="utf-8" />
	 <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
	 <title>bis</title>
	 <?php require_once('module/head.php'); ?>
	 <link rel="stylesheet" href="css/login.css">
 </head>
 <body>
 <div id="page">
	 <div class="header">
		 <a href="#menu"></a>
	 </div>
	 <div class="content">
		 <h1>login</h1>
		 <form action="login_check.php" method="post">
			 <p>メールアドレス
				 <input type="email" name="mail" pattern="^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$" required>
			 </p>
			 <p>パスワード
				 <input type="password" name="password" maxlength="8" pattern="^[0-9A-Za-z]{8}$" required>
			 </p>
			 <input type="submit" value="送信">
		 </form>
	 </div>
	 <?php require_once('module/menu.php'); ?>
 </div>
 </body>
 </html>

