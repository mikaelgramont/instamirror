<?php
/*
	TODO:
	- sauver les images en local en full size
	- sauver le titre, la date, le 'code' et l'utilisateur en DB
	- quand le cache est vide, scraper, et comparer avec le contenu de la DB et du disque.
	  Sauver les choses qui manquent.


*/
set_include_path(__DIR__.'/../php');
require("constants.php");
require('Blacklist.php');
require('Instagram.php');
require('Renderer.php');

require('Zend/Loader.php');
require('Zend/Cache.php');
require('Zend/Exception.php');
require("cache.php");

$cache = Cache::getCache(CACHE_METHOD);
$ig = new Instagram(TAG, $cache, Blacklist::MEMBERS);
$photos = Renderer::grid($ig->getPhotos());
?>
<html>
	<head>
		<title>PONPON2017</title>
		<style>
			body {
				margin: 0;
				background: #000;
			}
			ul {
				list-style: none;
				padding: 0;
			}
			.grid {
				display: flex;
				flex-wrap: wrap;
				width: 100%;
			}
			.photo {
				width: 25%;
				box-sizing: border-box;
			}
			.photo-img {
				max-width: 100%;
			}
		</style>
	</head>
	<body>
		<?php echo $photos; ?>		
	</body>
</html>