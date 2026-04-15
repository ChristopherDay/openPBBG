<?php
// Simple server-side requirement checks (tweak as needed)
$reqs = [];
$reqs[] = [
	'name' => 'PHP version >= 7.4',
	'passed' => version_compare(PHP_VERSION, '7.4.0', '>=' ),
	'current' => PHP_VERSION
];
$reqs[] = [
	'name' => 'PDO or mysqli extension',
	'passed' => extension_loaded('pdo_mysql') || extension_loaded('mysqli'),
	'current' => implode(', ', array_filter([extension_loaded('pdo_mysql') ? 'pdo_mysql' : '', extension_loaded('mysqli') ? 'mysqli' : '']))
];
$reqs[] = [
	'name' => 'mbstring extension',
	'passed' => extension_loaded('mbstring'),
	'current' => extension_loaded('mbstring') ? 'loaded' : 'missing'
];
$reqs[] = [
	'name' => 'Writable installer directory',
	'passed' => is_writable(__DIR__),
	'current' => is_writable(__DIR__) ? 'writable' : 'not writable'
];

$all_ok = array_reduce($reqs, function($carry, $r){ return $carry && $r['passed']; }, true);

// new: load app version from modules/installed/core/module.json (fallback to PHP_VERSION or 'unknown')
$appVersion = 'unknown';
$moduleJsonPath = __DIR__ . '/../modules/installed/core/module.json';
if (is_readable($moduleJsonPath)) {
	$content = file_get_contents($moduleJsonPath);
	$data = json_decode($content, true);
	if (is_array($data) && !empty($data['version'])) {
		$appVersion = (string)$data['version'];
	} else {
		// try some common keys if needed
		if (is_array($data) && !empty($data['version_string'])) {
			$appVersion = (string)$data['version_string'];
		}
	}
} else {
	// fallback to PHP version for visibility if module.json missing
	$appVersion = PHP_VERSION ?: 'unknown';
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>openPBBG — Installer</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/installer.css">
</head>
<!-- enable Bootstrap's built-in dark theme -->
<body data-bs-theme="dark" class="bg-dark text-light"> <!-- changed to dark -->

<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8">
			<div class="card shadow-sm"> <!-- card styling handled in CSS -->
				<div class="card-body p-4">
                    <div class="text-center mb-4">

                        <div class="mb-3">
                            <a href="https://openpbbg.com" target="_blank" rel="noopener noreferrer">
                                <img src="https://openpbbg.com/themes/market/assets/img/logo-light.png" alt="openPBBG logo" class="rounded installer-logo">
                            </a>
                        </div>
                        <div>
                            <h4 class="mb-0">openPBBG Installer</h4>
                            <small class="text-muted">Follow the steps to configure your game</small>
                        </div>
                    </div>

					<!-- Stepper -->
					<div class="mb-4">
						<div class="d-flex align-items-center justify-content-between stepper">
							<div class="step active" data-step="0"><div class="circle">1</div><div class="label">Welcome</div></div>
							<div class="step" data-step="1"><div class="circle">2</div><div class="label">Requirements</div></div>
							<div class="step" data-step="2"><div class="circle">3</div><div class="label">Database</div></div>
							<div class="step" data-step="3"><div class="circle">4</div><div class="label">Admin</div></div>
							<div class="step" data-step="4"><div class="circle">5</div><div class="label">Install</div></div>
						</div>
						<div class="progress mt-3" style="height:6px">
							<div id="installerProgress" class="progress-bar" role="progressbar" style="width:0%"></div>
						</div>
					</div>

					<!-- Steps container -->
					<form id="installerForm" novalidate>
						<div class="steps">

							<!-- Step 1: Welcome -->
							<section class="step-body" data-step="0">
								<h5>Welcome</h5>
								<p class="text-muted">Thank you for choosing openPBBG. This installer will guide you through configuration. Click Next to continue.</p>
								<div class="mt-3 text-end">
									<button type="button" class="btn btn-primary btn-next">Next <i class="bi bi-arrow-right ms-1"></i></button>
								</div>
							</section>

							<!-- Step 2: Requirements -->
							<section class="step-body d-none" data-step="1">
								<h5>Requirements</h5>
								<p class="text-muted">The installer checked a few server requirements.</p>

								<ul class="list-group mb-3" id="reqList">
									<?php foreach($reqs as $r): ?>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<div>
												<strong><?php echo htmlspecialchars($r['name']); ?></strong>
												<div class="small text-muted"><?php echo htmlspecialchars($r['current']); ?></div>
											</div>
											<span class="badge rounded-pill <?php echo $r['passed'] ? 'bg-success' : 'bg-danger'; ?>">
												<?php echo $r['passed'] ? 'OK' : 'Missing'; ?>
											</span>
										</li>
									<?php endforeach; ?>
								</ul>

								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-outline-secondary btn-prev"><i class="bi bi-arrow-left me-1"></i> Back</button>
									<button type="button" class="btn btn-primary btn-next" <?php echo $all_ok ? '' : 'disabled'; ?>>Next <i class="bi bi-arrow-right ms-1"></i></button>
								</div>
							</section>

							<!-- Step 3: Database -->
							<section class="step-body d-none" data-step="2">
								<h5>Database</h5>
								<p class="text-muted">Enter database connection info.</p>

								<div class="row g-3">
									<div class="col-md-6">
										<label class="form-label">DB Host</label>
										<input name="db_host" class="form-control" value="127.0.0.1" required>
									</div>
									<div class="col-md-6">
										<label class="form-label">DB Port</label>
										<input name="db_port" class="form-control" value="3306" required>
									</div>
									<div class="col-md-6">
										<label class="form-label">DB Name</label>
										<input name="db_name" class="form-control" required>
									</div>
									<div class="col-md-6">
										<label class="form-label">DB User</label>
										<input name="db_user" class="form-control" required>
									</div>
									<div class="col-md-12">
										<label class="form-label">DB Password</label>
										<input name="db_pass" type="password" class="form-control">
									</div>
								</div>

								<div class="d-flex justify-content-between mt-4">
									<button type="button" class="btn btn-outline-secondary btn-prev"><i class="bi bi-arrow-left me-1"></i> Back</button>
									<button type="button" class="btn btn-primary btn-next">Next <i class="bi bi-arrow-right ms-1"></i></button>
								</div>
							</section>

							<!-- Step 4: Admin account -->
							<section class="step-body d-none" data-step="3">
								<h5>Admin Account</h5>
								<p class="text-muted">Create the first administrator account.</p>

								<div class="row g-3">
									<div class="col-md-6">
										<label class="form-label">Username</label>
										<input name="admin_user" class="form-control" required>
									</div>
									<div class="col-md-6">
										<label class="form-label">Email</label>
										<input name="admin_email" type="email" class="form-control" required>
									</div>
									<div class="col-md-6">
										<label class="form-label">Password</label>
										<input name="admin_pass" type="password" class="form-control" required>
									</div>
									<div class="col-md-6">
										<label class="form-label">Confirm</label>
										<input name="admin_pass_confirm" type="password" class="form-control" required>
									</div>
								</div>

								<div class="d-flex justify-content-between mt-4">
									<button type="button" class="btn btn-outline-secondary btn-prev"><i class="bi bi-arrow-left me-1"></i> Back</button>
									<button type="button" class="btn btn-primary btn-next">Next <i class="bi bi-arrow-right ms-1"></i></button>
								</div>
							</section>

							<!-- Step 5: Install -->
							<section class="step-body d-none" data-step="4">
								<h5>Install</h5>
								<p class="text-muted">Review and start installation. This demo shows a simulated install progress.</p>

								<div class="card mb-3">
									<div class="card-body">
										<h6 class="mb-2">Summary</h6>
										<ul class="list-unstyled small" id="summaryList">
											<li><strong>DB:</strong> <span id="s_db">—</span></li>
											<li><strong>Admin:</strong> <span id="s_admin">—</span></li>
										</ul>
									</div>
								</div>

								<div id="installProgressWrap" class="mb-3 d-none">
									<div class="progress" style="height:10px">
										<div id="installProgress" class="progress-bar progress-bar-striped progress-bar-animated" style="width:0%"></div>
									</div>
									<div id="installStatus" class="small text-muted mt-2">Preparing...</div>
								</div>

								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-outline-secondary btn-prev"><i class="bi bi-arrow-left me-1"></i> Back</button>
									<button type="button" id="startInstall" class="btn btn-success">Install <i class="bi bi-play-fill ms-1"></i></button>
								</div>
							</section>

						</div>
					</form>

					<!-- Done -->
					<div id="doneBox" class="d-none mt-4 text-center">
						<i class="bi bi-check-circle-fill text-success display-4"></i>
						<h5 class="mt-3">Installation Complete</h5>
						<p class="text-muted">Your openPBBG instance has been configured.</p>
						<a href="../" class="btn btn-primary">Go to game</a>
					</div>

				</div>
			</div>
			<div class="text-center small text-muted mt-3"><strong>OpenPBBG Version:</strong> v<?php echo htmlspecialchars($appVersion); ?></div>
		</div>
	</div>
</div>

<script>
	// Expose server requirement results to JS
	window.__INSTALLER_REQS = <?php echo json_encode($reqs, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_AMP|JSON_HEX_QUOT); ?>;
	window.__INSTALLER_ALL_OK = <?php echo $all_ok ? 'true' : 'false'; ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/installer.js"></script>
</body>
</html>
