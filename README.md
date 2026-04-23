# OpenPBBG

OpenPBBG is an open source browser game framework built with PHP and MySQL.

The engine is modular: gameplay and admin features are delivered as installable modules, and presentation is handled by switchable themes.

## Features

- Modular architecture (modules can be installed, disabled, and managed)
- Built-in web installer
- Admin panel module included by default
- Theme support for both game and admin interfaces
- Hook system for extending behavior without editing core flow

## TODO List:

 - ~~Update themes to use Bootstrap 5~~
 - ~~Update Theme Editor with new BS5 themes and add the import/export pages~~
 - ~~Update login to use cookies rather then sessions, sessions still to be used for backwards compatability~~
 - ~~Update installer~~ 
 	- ~~Check for needed PHP version & modules~~
 	- ~~New UI~~
 - Plugin Management
	- Link to OpenPBBG.com
	- ~~Add plugin dependencies~~
  - ~~Better error handling~~
	- ~~New  UI~~
	- ~~Add the abiility to set `$config["debug"]` to a user ID so that the error will only appear for that user, this would allow you to debug an error in a live enviroment without making the error public~~

## Requirements

OpenPBBG currently checks for and expects:

- PHP 7.4+
- MySQL (via PDO)
- PHP extensions:
	- pdo
	- pdo_mysql
	- mbstring
	- json
	- openssl
	- zip

## Quick Start (XAMPP / Windows)

1. Place this project in your web root (example: xampp/htdocs/OpenPBBG).
2. Create a new empty MySQL database.
3. Ensure these paths are writable by PHP:
	 - config.php
	 - modules/installed/
	 - modules/installing/
	 - modules/disabled/
4. Open your browser and go to:
	 - http://localhost/OpenPBBG/
5. If not installed yet, you will be redirected to the installer automatically.
6. Complete the installer tabs:
	 - Requirements
	 - Database
	 - Admin User
	 - Install

When installation succeeds, install/install.lock is created to prevent re-installation.

## Configuration

Main configuration is stored in config.php.

Default structure:

```php
$config = [
		"debug" => false,
		"db" => [
				"driver" => "mysql",
				"port" => "3306",
				"host" => "localhost",
				"database" => "openPBBG",
				"user" => "root",
				"pass" => ""
		]
];
```

Notes:

- debug can be false/true, and core error handling also supports a user-scoped debug mode.
- Database credentials are read during boot from config.php.

## Project Structure

Top-level layout (simplified):

```text
class/               Core classes (DB, page, module, hooks, user, etc.)
install/             Web installer (requirements checks, schema/data import)
logs/errors/         Error logs
modules/
	installed/         Active modules
	disabled/          Disabled modules
	installing/        Temporary install area
themes/
	default/           Default game theme
	admin/             Default admin theme
config.php           Runtime configuration
index.php            Entry point
init.php             Bootstrap/autoload/session/auth routing
```

## Modules

Each module lives under modules/installed/<moduleName>/ and typically includes:

- module.json (metadata, menu config, dependency data)
- <module>.inc.php (frontend/game behavior)
- <module>.admin.php (admin actions, where applicable)
- <module>.tpl.php (template output)
- Optional assets (.css, .js) and hooks/

Core and management modules shipped in this repository include:

- core
- admin
- pluginManager
- themeManager
- user/auth/profile/stats/news/shoutbox and more

## Themes

Themes are in themes/<themeName>/ with theme metadata in theme.json.

- themes/default/ is the default game theme
- themes/admin/ is the default admin panel theme

## Development Notes

- The app bootstraps from init.php and auto-loads classes from:
	- class/
	- modules/installed/<ClassName>/<className>.php
- Requests are routed by page module name via the page system.
- Session auth supports cookie token restoration for persistent logins.

## Troubleshooting

- Installer says installation is complete:
	- Remove install/install.lock only if you intentionally need to reinstall.
- Cannot write config/modules directories:
	- Fix filesystem permissions so PHP can write required paths.
- Database connection fails:
	- Verify host, port, database name, username, password, and that database is empty for first install.
- Blank/error pages:
	- Check logs/errors/major.txt and logs/errors/minor.txt.

## Security Recommendations

- Use HTTPS in production.
- Use strong database credentials.
- Restrict web access to the install/ directory after installation.
- Keep PHP and dependencies patched.

## License

This project is distributed under the license in the LICENSE file.