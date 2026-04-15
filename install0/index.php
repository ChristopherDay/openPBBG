<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
	$file = '../class/' . lcfirst($class) . '.php';
	if(file_exists($file)) {
		include $file;
	}
	$moduleClass = '../modules/installed/'.$class.'/' . lcfirst($class) . '.class.php';
	if(file_exists($moduleClass)) {
		include $moduleClass;
	}
});

function heading($step, $text) {
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong class="text-danger">
					<i class="glyphicon glyphicon-remove-circle"></i>
					Step '.$step.'
				</strong> - '.$text.'
			</div>
		</div>';
}

function success($step, $text) {
	echo '
		<div class="panel panel-success">
			<div class="panel-heading">
				<strong class="text-success">
					<i class="glyphicon glyphicon-ok-circle"></i>
					Step '.$step.'
				</strong> - '.$text.'
			</div>
		</div>';
}

function failed($step, $text) {
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong class="text-danger">
					<i class="glyphicon glyphicon-remove-circle"></i>
					Step '.$step.'
				</strong> - '.$text.'
			</div>
		</div>';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Open PBBG - Installer</title>
		<meta charset="UTF-8">
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
		<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="true">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="true">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900&amp;display=swa">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link href="assets/css/theme.css" rel="stylesheet" />
	</head>
	<body data-bs-theme="dark">

	<div class="container pt-md-5">
			<h1 class="text-center">Open PBBG Installer</h1>
			<div class="row g-3">
				<div class="col-md-4 col-lg-3">
					<!-- steps sidebar -->
					<div class="accordion installer-accordion" id="accordionExample">
						<div class="accordion-item">
							<div class="accordion-header" id="headingOne">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#step_1" aria-expanded="true" aria-controls="collapseOne">
									<span>Step 1</span>
									Server Connection
								</button>
							</div>
							<div id="step_1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<ul class="steps-wizard">
										<li class="steps-li">
										<li class="steps-li status-done">
											<div class="steps-status"><i class="fa fa-check fa-fw"></i></div>
											<h4 class="steps-title">Creating Config file</h4>
										</li>
										<li class="steps-li status-done">
											<div class="steps-status"><i class="fa fa-check fa-fw"></i></div>
											<h4 class="steps-title">Database Login</h4>
										</li>
										<li class="steps-li status-active">
											<div class="steps-status"><i class="fa fa-angle-right fa-fw"></i></div>
											<h4 class="steps-title">Create Database</h4>
										</li>
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Insert Data</h4>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingThree">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step_2" aria-expanded="false" aria-controls="step_3">
									<span>Step 2</span>
									Configuration
								</button>
							</h2>
							<div id="step_2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<ul class="steps-wizard">
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Game Name</h4>
										</li>
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Settings</h4>
										</li>
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Payments</h4>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingTwo">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step_3" aria-expanded="false" aria-controls="collapseTwo">
									<span>Step 3</span>
									Chose Package 
								</button>
							</h2>
							<div id="step_3" class="accordion-collapse collapse"  data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<ul class="steps-wizard">
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Chose Package</h4>
										</li>
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Exporting Package</h4>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingThree">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step_4" aria-expanded="false" aria-controls="step_3">
									<span>Step 4</span>
									Accounts
								</button>
							</h2>
							<div id="step_4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<ul class="steps-wizard">
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Create Admin Account</h4>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingThree">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step_5" aria-expanded="false" aria-controls="step_3">
									<span>Step 5</span>
									Finish
								</button>
							</h2>
							<div id="step_5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<ul class="steps-wizard">
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Remove Installer</h4>
										</li>
										<li class="steps-li">
											<div class="steps-circle"></div>
											<h4 class="steps-title">Complete!</h4>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- steps sidebar -->
				</div>
				<div class="col-md-8 col-lg-9">
					<!-- step content here -->
						<?php
							include_once "step/1.php";
							include_once "step/2.php";
							include_once "step/3.php";
							include_once "step/4.php";
						?>
					<!-- step content here -->
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	</body>
</html>