<?php
if (!class_exists("mainTemplate")) {
	class mainTemplate {
		public $pageMain =  '<!DOCTYPE html>
<html lang="en">
<head>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="author" content="DashboardKit">
	<!-- Favicon icon -->
	<link rel="icon" href="themes/{_theme}/assets/images/favicon.svg" type="image/x-icon">
	<!-- font css -->
	<link rel="stylesheet" href="themes/{_theme}/assets/fonts/feather.css" />
	<link rel="stylesheet" href="themes/{_theme}/assets/fonts/material.css" />
	<!-- vendor css -->
	<link rel="stylesheet" href="themes/{_theme}/assets/css/style.css" />
	<link rel="stylesheet" href="themes/{_theme}/assets/css/admin.css?ver={timestamp}" />
	<link rel="stylesheet" href="themes/{_theme}/assets/css/chosen.css?ver={timestamp}" />
	<link rel="stylesheet" href="themes/{_theme}/3rdparty/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
	<link rel="stylesheet" href="themes/{_theme}/3rdparty/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" />
	<link rel="stylesheet" href="themes/{_theme}/3rdparty/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" />
	<link rel="stylesheet" href="themes/{_theme}/3rdparty/summernote/summernote.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
	{#if moduleCSSFile}
	<link href="{moduleCSSFile}" rel="stylesheet" />
	{/if}
	{#each CSSFiles}
	<link href="{.}" rel="stylesheet" />
	{/each}
	<title>{game_name} - {page}</title>
</head>
<body>

<!-- [ Pre-loader ] start -->
<div class="loader-bg">
	<div class="loader-track">
		<div class="loader-fill"></div>
	</div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Mobile header ] start -->
<div class="pc-mob-header pc-header">
	<div class="pcm-logo">
		<a class="logo" href="?page=admin">{game_name} - ACP</a>
	</div>
	<div class="pcm-toolbar">
		<a href="#!" class="pc-head-link" id="mobile-collapse">
			<div class="hamburger hamburger--arrowturn">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
		</a>
		<a href="#!" class="pc-head-link" id="headerdrp-collapse">
			<i class="fa fa-align-right fa-fw"></i>
		</a>
		<a href="#!" class="pc-head-link" id="header-collapse">
			<i class="fa fa-more-vertical fa-fw"></i>
		</a>
	</div>
</div>
<!-- [ Mobile header ] End -->

<!-- [ navigation menu ] start -->
<nav class="pc-sidebar ">
	<div class="navbar-wrapper">
		<div class="m-header">
			<a href="index.html" class="b-brand">
				<a class="logo" href="?page=admin">{game_name} - ACP</a>
			</a>
		</div>
		<div class="navbar-content">
			<ul class="pc-navbar">
				{#each menus}
				<li class="pc-item{#each items} pc-hasmenu{#if active} pc-trigger{/if}{/each}">
					<a href="#!" class="pc-link">
						<span class="pc-micon"><i class="{icon}"></i></span>
						<span class="pc-mtext">{title}</span>
						<span class="pc-arrow"><i class="fa fa-chevron-right fa-fw"></i></span>
					</a>
					<ul class="pc-submenu">
						{#each items}
						<li class="pc-item {#if active}active{/if}">
							<a href="{url}" class="pc-link">
								{text}
							</a>
						</li>
						{/each}
					</ul>
				</li>
				{/each}
			</ul>
		</div>
	</div>
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="pc-header bg-dark">
	<div class="header-wrapper">
		
		<div class="me-auto">
			<ul class="list-unstyled">
				<li class="pc-h-item admin-search">
        			<input class="form-control" type="search" placeholder="Search" aria-label="Search"id="acpSearch" />
				</li>
			<ul>
		</div>

		<div class="ms-auto">
			<ul class="list-unstyled">
				<li class="pc-h-item">
					<a class="pc-head-link" href="?page={_setting "landingPage"}"><i class="fa fa-circle-chevron-left fa-fw me-2"></i>The Game</a>
				</li>
				<li class="pc-h-item">
					<a class="pc-head-link" href="?page={adminModule}"><i class="fa fa-eye fa-fw me-2"></i>View Module</a>
				</li>
			</ul>
		</div>
	</div>
</header>
<!-- [ Header ] end -->
<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ tabs ] start -->
        <div class="page-header">
            <div class="page-block page-tabs-menu">
			{#if moduleActions.items}
				<ul class="nav nav-pills mb-0">
					{#each moduleActions.items}
					{#if hide}
						{#if active}
					<li class="nav-item"><a class="nav-link active" href="#">{text}</a></li>
						{/if}
					{else}
					<li class="nav-item"><a class="nav-link {#if active}active{/if}" href="{url}">{text}</a></li>
					{/if}
					{/each}
				</ul>
			{/if}
            </div>
        </div>
        <!-- [ tabs ] end -->
        <!-- [ Main Content ] start -->
		<div class="py-5">
			{{game}}
		</div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->

<!-- Required Js -->
<script src="themes/{_theme}/assets/js/vendor-all.js"></script>
<script src="themes/{_theme}/assets/js/plugins/bootstrap.min.js"></script>
<script src="themes/{_theme}/assets/js/pcoded.js"></script>
<script src="themes/{_theme}/assets/js/plugins/feather.min.js"></script>
<!--
-->
<script src="themes/{_theme}/3rdparty/jquery/jquery.min.js"></script>

<script src="themes/{_theme}/3rdparty/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="themes/{_theme}/3rdparty/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="themes/{_theme}/3rdparty/pdfmake/build/pdfmake.min.js"></script>
<script src="themes/{_theme}/3rdparty/pdfmake/build/vfs_fonts.js"></script>
<script src="themes/{_theme}/3rdparty/jszip/dist/jszip.min.js"></script>

<script src="themes/{_theme}/3rdparty/summernote/summernote.js"></script>
<script src="themes/{_theme}/assets/js/admin.js?ver={timestamp}"></script>
{#if moduleJSFile}
<script src="{moduleJSFile}"></script>
{/if}
{#each JSFiles}
<script src="{.}"></script>
{/each}
</body>
</html>
		';
	}
}