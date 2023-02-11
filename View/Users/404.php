
	<head>
		<link type="text/css" rel="stylesheet" href="././Assets/css/404.css"/> 
		<title>Page not found</title>
	</head>
	<body>
	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>
					4<span>0</span>4
				</h1>
			</div>
			<p>A hely amit keres nem elérhető vagy lehet hogy törölték.</p>
			<?php
			if(isset($_SESSION['name'])) {
                echo '<a href="/home">Vissza</a>';
            } else {
                echo '<a href="/">Bejelentkezés</a>';
            }
			?>
		</div>
	</div>
	</body>
