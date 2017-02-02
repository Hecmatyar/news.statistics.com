<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Главная</title>
	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/media.css" />
	<link rel="stylesheet" href="css/set1.css" />

	<link href="https://fonts.googleapis.com/css?family=Roboto:300&amp;subset=cyrillic" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Corben" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,300' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Comfortaa:700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


	
</head>
<body>	
	<section class="main-section">
		<div class="my-flex">
			<div class="hello">
				<div class="logo">
					<!-- <img style="height: 50px; width: 50px;" src="img/logo.png"> -->
					<span>NEWS STATISTICS</span>
				</div>
				<div class="description">
					<span>Статистика соедержания статей новостных ресурсов</span>
					<span>Проверьте ресурсы на предвзятость</span>
				</div>
				<div class="get-started">
					<div class="block">
						<button id="get-started-button" class="get-started-button">Get started</button>
						<span class="license">Get a license</span>
					</div>
				</div>
			</div>
		</div>
		<div class="main">
			<div class="source">
				<div class="main-logo">
					<img class="img-logo" src="img/logo.png" > 
					<span>lalilulelo</span>				
				</div>				
				<button id="admin-btn" class="admin">Администрирование</button>			
				
				<div class="source-uses">				
					<div class="uses-site" id="used-resource">						
					</div>
					<div class="source-all">
						<div class="list-source-all" id="list-source-all">							
						</div>  
						<div class="rednote">
							<span>Для удобства рекомендуется использовать не более 5 ресурсов</span>
						</div>
					</div>
				</div>
			</div>

			<div class="content-graph">
				<div class="main-content container">
					<div class="first-graph col-lg-12 col-md-12 col-sm-12" style="margin-top: 40px;">
						<div class="date">
							<div class="choose">Выбор даты и времени</div>
							<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: auto; border-radius: 4px;">
								<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
								<span></span> <b class="caret"></b>
							</div>						
						</div>
						<p>График распределения статей</p>
						<div id="graph" style="width: 100%; height: 500px; margin: 0 auto"></div>
						<div class="abbreviation container">
							<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" id='table-res'>
								<!-- тута таблица ресурсов -->
							</div>
						</div>
					</div>
					<div class="n col-lg-6 col-md-6 col-sm-6">
						<div class="second-graph">
							<p>Сравнение по уровням</p>
							<div id="stat" style="width: 100%;  height: 340px; margin: 0 auto"></div>
						</div>				
					</div>		
					<div class="n col-lg-6 col-md-6 col-sm-6">
						<div class="third-graph">
							<p>Сравнение по объему</p>
							<div id="circle-graph" style="width: 100%; height: 340px; margin: 0 auto"></div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="description container">						
						<div class="col-lg-6 col-md-6 col-sm-6" id="subject-description">
							<!-- описание выбранного словаря -->
						</div>					
						<div class="col-lg-6 col-md-6 col-sm-6" id='table-val'>
							<!-- тута таблица диапахонов значений словаря -->
						</div>												
					</div>
				</div>
			</div>
			
			<div class="footer">	
				<div class="select-subjects">
					<p>Тематики новостей</p>
					<div class="msrItems" id='select-subjects'>
						<!-- список моих тем и словарей по ним-->								
					</div>
				</div>		
				<hr>	
				<div class="post-footer">
					<div class="flex">
						<span style="margin:auto;">Дипломная работа Hecmatyar</span>						
					</div>											
				</div>
				<button class="button" id="testclick">testclick</button>	
				<div id="testfield">
				</div>
			</div>
		</div>
	</section>	

	<section class="admin-panel">
		<div class="main-admin">			
			<div class="flex min-admin">
				<div class="close-cross smooth" id="close-admin-panel">
					<span class="close-admin" >&#xD7;</span>
				</div>
			</div>		
			
			<div class="container-fluid content-admin" style="max-width: 1500px;">
				<div class="up-menu">
					<span class="resources smooth">Новостные ресурсы</span>
					<span class="dictionary smooth">Словари для статей</span>					
				</div>
				<div class="down-part">					
					<div class="place">
						<div class="container-fluid" id="list-resource">
							<!-- тут мои списки ресурсов -->
						</div>
					</div>
				</div>
			</div>
		</section>

		<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

		<script src="js/highcharts.js"></script>
		<script src="js/cookie.js"></script>	
		<script src="js/common.js"></script>	
		<script src="js/date.js"></script>		
		<script src="js/masonry.js"></script>	
		
	</body>
	</html>