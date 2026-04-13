<?php
  if (file_exists(__DIR__ . "/install.lock")) {
    /* output html saying installer is already completed */
    header("Location: ./complete.php");
    exit;
  }
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Installer</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .monospace { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
  </style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-9">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h1 class="h3 mb-0">Install OpenPBBG</h1>
        </div>

        <div id="globalAlert" class="alert d-none" role="alert"></div>

        <div class="card shadow-sm">
          <div class="card-body p-3 p-md-4">

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="installTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-req" data-bs-toggle="tab" data-bs-target="#pane-req" type="button" role="tab">
                  1) Requirements
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-db" data-bs-toggle="tab" data-bs-target="#pane-db" type="button" role="tab">
                  2) Database
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-admin" data-bs-toggle="tab" data-bs-target="#pane-admin" type="button" role="tab">
                  3) Admin User
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-install" data-bs-toggle="tab" data-bs-target="#pane-install" type="button" role="tab">
                  4) Install
                </button>
              </li>
            </ul>

            <div class="tab-content pt-3" id="installTabsContent">

              <!-- Requirements -->
              <div class="tab-pane fade show active" id="pane-req" role="tabpanel" aria-labelledby="tab-req" tabindex="0">
                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                  <div>
                    <h2 class="h5 mb-1">Server Requirements</h2>
                    <div class="text-muted small">Checks PHP extensions like <span class="monospace">zip</span>.</div>
                  </div>
                  <button class="btn btn-outline-primary" id="btnCheckReq" type="button">Check requirements</button>
                </div>

                <hr class="my-3" />

                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="fw-semibold mb-2">Required PHP extensions</div>
                    <ul class="list-group" id="reqList"></ul>
                  </div>
                  <div class="col-md-6">
                    <div class="fw-semibold mb-2">Server info</div>
                    <pre class="bg-body-tertiary border rounded p-2 small mb-0" id="serverInfo">Not checked yet.</pre>
                  </div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                  <button class="btn btn-success" type="button" id="goDb">Next: Database</button>
                </div>
              </div>

              <!-- Database -->
              <div class="tab-pane fade" id="pane-db" role="tabpanel" aria-labelledby="tab-db" tabindex="0">
                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                  <div>
                    <h2 class="h5 mb-1">Database Details</h2>
                    <div class="text-muted small">Enter DB credentials and test connectivity.</div>
                  </div>
                  <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" type="button" id="btnTestDb">Test connection</button>
                    <button class="btn btn-success" type="button" id="goAdmin">Next: Admin</button>
                  </div>
                </div>

                <hr class="my-3" />

                <form id="dbForm" class="needs-validation" novalidate>
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label" for="dbDriver">Driver</label>
                      <select class="form-select" id="dbDriver" required>
                        <option value="mysql" selected>MySQL</option>
                        <option value="pgsql">PostgreSQL</option>
                        <option value="sqlite">SQLite</option>
                      </select>
                      <div class="invalid-feedback">Select a driver.</div>
                    </div>

                    <div class="col-md-5">
                      <label class="form-label" for="dbHost">Host</label>
                      <input class="form-control" id="dbHost" value="localhost" required />
                      <div class="invalid-feedback">Host is required.</div>
                    </div>

                    <div class="col-md-3">
                      <label class="form-label" for="dbPort">Port</label>
                      <input class="form-control" id="dbPort" value="3306" inputmode="numeric" />
                    </div>

                    <div class="col-md-4">
                      <label class="form-label" for="dbName">Database name</label>
                      <input class="form-control" id="dbName" required />
                      <div class="invalid-feedback">Database name is required.</div>
                    </div>

                    <div class="col-md-4">
                      <label class="form-label" for="dbUser">Database user</label>
                      <input class="form-control" id="dbUser" required />
                      <div class="invalid-feedback">Database user is required.</div>
                    </div>

                    <div class="col-md-4">
                      <label class="form-label" for="dbPass">Database password</label>
                      <div class="input-group">
                        <input class="form-control" id="dbPass" type="password" autocomplete="new-password" />
                        <button class="btn btn-outline-secondary" type="button" id="toggleDbPass">Show</button>
                      </div>
                    </div>

                  </div>
                </form>
              </div>

              <!-- Admin -->
              <div class="tab-pane fade" id="pane-admin" role="tabpanel" aria-labelledby="tab-admin" tabindex="0">
                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                  <div>
                    <h2 class="h5 mb-1">Admin Account</h2>
                    <div class="text-muted small">Create the initial administrator.</div>
                  </div>
                  <button class="btn btn-success" type="button" id="goInstall">Next: Install</button>
                </div>

                <hr class="my-3" />

                <form id="adminForm" class="needs-validation" novalidate>
                  <div class="row g-3">

                    <div class="col-md-4">
                      <label class="form-label" for="adminEmail">Email</label>
                      <input class="form-control" id="adminEmail" type="email" required />
                      <div class="invalid-feedback">Valid email is required.</div>
                    </div>

                    <div class="col-md-4">
                      <label class="form-label" for="adminUser">Username</label>
                      <input class="form-control" id="adminUser" minlength="3" required />
                      <div class="invalid-feedback">Username is required (min 3 chars).</div>
                    </div>

                    <div class="col-md-4">
                      <label class="form-label" for="adminPass">Password</label>
                      <div class="input-group">
                        <input class="form-control" id="adminPass" type="password" minlength="3" required autocomplete="new-password" />
                        <button class="btn btn-outline-secondary" type="button" id="toggleAdminPass">Show</button>
                      </div>
                      <div class="invalid-feedback">Password is required (min 8 chars).</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agree" required />
                        <label class="form-check-label" for="agree">
                          I understand this will write configuration and create an admin account.
                        </label>
                        <div class="invalid-feedback">Required.</div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <!-- Install -->
              <div class="tab-pane fade" id="pane-install" role="tabpanel" aria-labelledby="tab-install" tabindex="0">
                <h2 class="h5 mb-1">Install</h2>
                <p class="text-muted small mb-3">
                  Runs the installer using the values you entered in the other tabs.
                </p>

                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                  <button class="btn btn-primary" type="button" id="btnInstall">Install now</button>
                </div>

                <div class="alert alert-warning mt-3 mb-0">
                  After installation, delete/disable these installer scripts.
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // ---------- Helpers ----------
    function showAlert(type, message) {
      const el = document.getElementById("globalAlert");
      el.className = "alert alert-" + type;
      el.textContent = message;
      el.classList.remove("d-none");
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
    function hideAlert() {
      document.getElementById("globalAlert").classList.add("d-none");
    }
    function validate(form) {
      form.classList.add("was-validated");
      return form.checkValidity();
    }
    function togglePassword(btnId, inputId) {
      const btn = document.getElementById(btnId);
      const input = document.getElementById(inputId);
      btn.addEventListener("click", () => {
        const isPw = input.type === "password";
        input.type = isPw ? "text" : "password";
        btn.textContent = isPw ? "Hide" : "Show";
      });
    }
    togglePassword("toggleDbPass", "dbPass");
    togglePassword("toggleAdminPass", "adminPass");

    function goTo(tabButtonId) {
      const el = document.getElementById(tabButtonId);
      bootstrap.Tab.getOrCreateInstance(el).show();
    }

    // Next buttons
    document.getElementById("goDb").addEventListener("click", () => goTo("tab-db"));
    document.getElementById("goAdmin").addEventListener("click", () => {
      hideAlert();
      if (!validate(document.getElementById("dbForm"))) {
        showAlert("warning", "Please complete the database form first.");
        return;
      }
      goTo("tab-admin");
    });
    document.getElementById("goInstall").addEventListener("click", () => {
      hideAlert();
      const dbOk = validate(document.getElementById("dbForm"));
      const adminOk = validate(document.getElementById("adminForm"));
      if (!dbOk || !adminOk) {
        showAlert("warning", "Please complete Database and Admin tabs before installing.");
        return;
      }
      goTo("tab-install");
    });

    // ---------- Requirements ----------
    const requiredExtensions = ["pdo", "pdo_mysql", "mbstring", "json", "openssl", "zip"];
    let requirementsResult = null;

    function renderReqList() {
      const ul = document.getElementById("reqList");
      ul.innerHTML = "";
      requiredExtensions.forEach(ext => {
        const li = document.createElement("li");
        li.className = "list-group-item d-flex justify-content-between align-items-center";
        let status = "Not checked";
        let cls = "text-muted";
        if (requirementsResult) {
          const ok = !!requirementsResult.extensions?.[ext];
          status = ok ? "Installed" : "Missing";
          cls = ok ? "text-success fw-semibold" : "text-danger fw-semibold";
        }
        li.innerHTML = `<span class="monospace">${ext}</span><span class="${cls}">${status}</span>`;
        ul.appendChild(li);
      });
    }

    renderReqList();

    document.getElementById("btnCheckReq").addEventListener("click", async () => {
      hideAlert();
      const serverInfo = document.getElementById("serverInfo");
      serverInfo.textContent = "Checking...";

      try {
        const res = await fetch("./requirements.php", { headers: { "Accept": "application/json" } });
        if (!res.ok) throw new Error("HTTP " + res.status);
        requirementsResult = await res.json();

        serverInfo.textContent =
          `PHP: ${requirementsResult.php_version || "?"}\n` +
          `SAPI: ${requirementsResult.sapi || "?"}\n` +
          `OS: ${requirementsResult.os || "?"}`;

        renderReqList();

        const missing = requiredExtensions.filter(e => !requirementsResult.extensions?.[e]);
        if (missing.length) showAlert("danger", "Missing required PHP extensions: " + missing.join(", "));
        else showAlert("success", "All required PHP extensions are installed.");
      } catch (e) {
        serverInfo.textContent = "Failed to check requirements.";
        showAlert("danger", "Could not reach requirements.php: " + e.message);
      }
    });

    /* auto check requirements on page load */
    document.getElementById("btnCheckReq").click();

    // ---------- DB Test ----------
    document.getElementById("btnTestDb").addEventListener("click", async () => {
      hideAlert();

      const form = document.getElementById("dbForm");
      const out = document.getElementById("globalAlert");
      out.textContent = "";
      out.className = "mt-2 small text-muted";

      if (!validate(form)) {
        showAlert("warning", "Please fill in required database fields.");
        return;
      }

      out.textContent = "Testing connection...";

      const payload = {
        driver: document.getElementById("dbDriver").value,
        host: document.getElementById("dbHost").value,
        port: document.getElementById("dbPort").value,
        name: document.getElementById("dbName").value,
        user: document.getElementById("dbUser").value,
        pass: document.getElementById("dbPass").value
      };

      try {
        const res = await fetch("./test_db.php", {
          method: "POST",
          headers: { "Content-Type": "application/json", "Accept": "application/json" },
          body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (res.ok && data.ok) {
          out.textContent = "Connection OK.";
          out.className = "mt-2 small alert alert-success fw-semibold";
        } else {
          out.textContent = "Connection failed: " + (data.error || "Unknown error");
          out.className = "mt-2 small alert alert-danger fw-semibold";
        }
      } catch (e) {
        out.textContent = "Connection test failed: " + e.message;
        out.className = "mt-2 small alert alert-danger fw-semibold";
      }
    });

    // ---------- Install ----------
    document.getElementById("btnInstall").addEventListener("click", async () => {
      hideAlert();

      const dbOk = validate(document.getElementById("dbForm"));
      const adminOk = validate(document.getElementById("adminForm"));
      if (!dbOk || !adminOk) {
        showAlert("warning", "Please complete Database and Admin tabs before installing.");
        return;
      }

      const out = document.getElementById("globalAlert");
      out.textContent = "Installing...";
      out.className = "mt-3 small text-muted";

      const payload = {
        db: {
          driver: document.getElementById("dbDriver").value,
          host: document.getElementById("dbHost").value,
          port: document.getElementById("dbPort").value,
          name: document.getElementById("dbName").value,
          user: document.getElementById("dbUser").value,
          pass: document.getElementById("dbPass").value
        },
        admin: {
          email: document.getElementById("adminEmail").value,
          username: document.getElementById("adminUser").value,
          password: document.getElementById("adminPass").value
        }
      };

      try {
        const res = await fetch("./install.php", {
          method: "POST",
          headers: { "Content-Type": "application/json", "Accept": "application/json" },
          body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (res.ok && data.ok) {
          out.textContent = "Install complete. " + (data.message || "");
          out.className = "mt-3 small text-success fw-semibold";
          showAlert("success", data.message);
        } else {
          out.textContent = "Install failed: " + (data.message || "Unknown error");
          out.className = "mt-3 small text-danger fw-semibold";
          showAlert("danger", data.message);
        }
      } catch (e) {
        out.textContent = "Install failed: " + e.message;
        out.className = "mt-3 small text-danger fw-semibold";
        showAlert("danger", "Installation failed due to a network/server error.");
      }
    });
  </script>
</body>
</html>