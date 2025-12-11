<!-- .github/copilot-instructions.md - instructions for AI coding agents -->
# BiblioDriveJoan — Copilot Instructions

Short, actionable notes to help an AI agent be productive in this codebase.

- **Project Type**: Small PHP web app (no framework). Files live under the project root served by XAMPP/Apache (`htdocs`).
- **Primary runtime**: PHP (tested on XAMPP), MySQL/MariaDB backend.

**Key Files**
- `index.php`: Front page. Includes `entete.php`, uses `formulaire.php`, and builds a Bootstrap carousel from `livre.photo` values.
- `connexion.php`: PDO connection. DB credentials are hard-coded here (`host=localhost`, `user=root`, empty password). The code expects a database named `bibliodrive` (see `dbname=bibliodrive`).
- `projet-bibliodrive.sql`: Database schema + seed data. Contains tables `livre`, `auteur`, `utilisateur`, `emprunter` and sample rows (including `admin@admin.fr`). Note: SQL uses database name `projet-bibliodrive` in comments—verify that `connexion.php` and the actual database name match.
- `entete.php`, `formulaire.php`, `authentification.php`: small included fragments. `authentification.php` is currently empty (placeholder).
- `images-couvertures/covers/`: image folder referenced by `livre.photo` values.

**Architecture & Data Flow (high level)**
- The app is a single-host PHP site: HTTP request → `index.php` or other top-level PHP file → includes page fragments (`entete.php`, `formulaire.php`) → uses `connexion.php` to open a PDO connection → runs SQL queries against `livre`, `auteur`, `utilisateur`, `emprunter`.
- Book cover filenames stored in `livre.photo` are referenced as `images-couvertures/covers/<photo>` in templates.

**Project-specific patterns & conventions**
- Files and variables use French naming (e.g., `mel` column for emails, `dateajout`, `noauteur`). Use those exact names when writing SQL or code.
- Database connection is created once in `connexion.php` and expected to be available as `$connexion` after `require_once('connexion.php')`.
- Includes: project uses `require` / `require_once` to assemble pages rather than a router or controller pattern.
- No Composer / no dependency manager; external CSS/JS loaded from Bootstrap CDN in pages.

**Important quirks & gotchas (discovered from code)**
- `connexion.php` uses `dbname=bibliodrive` but `projet-bibliodrive.sql` comments mention `projet-bibliodrive`. Ensure you import the SQL into a database named `bibliodrive`, or update `connexion.php`.
- `index.php` carousel loop marks every item as `class='carousel-item active'` — this duplicates the `active` class and will not behave correctly. Also the `echo` that builds the `<img>` tag has malformed quotes. Expect front-end rendering issues in the carousel.
- `authentification.php` is empty — authentication is not implemented; `utilisateur` rows in the SQL contain plaintext passwords.
- Sensitive details: DB credentials are in `connexion.php`. Avoid committing alternative secrets; recommend using environment variables if evolving the project.

**Developer workflows (how to run locally)**
- Place the project in XAMPP `htdocs` (already here). Start Apache + MySQL from XAMPP Control Panel.
- Create the database and import the SQL. Example PowerShell commands (run from project root):
```
mysql -u root -e "CREATE DATABASE IF NOT EXISTS bibliodrive CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
mysql -u root bibliodrive < projet-bibliodrive.sql
```
- Then open: `http://localhost/BiblioDriveJoan/index.php` in a browser.

**Debugging tips specific to this repo**
- If pages are blank, check `connexion.php` exceptions and enable PHP errors temporarily:
```
ini_set('display_errors',1);
error_reporting(E_ALL);
```
add at the top of the entry script while debugging.
- If images don't display, confirm `livre.photo` values match filenames under `images-couvertures/covers/` (watch spaces and encoding). Use `ls`/Explorer to verify.
- To inspect DB contents quickly, use phpMyAdmin bundled with XAMPP or run `SELECT` queries via `mysql` CLI.

**When making changes**
- Keep file-level includes and the `$connexion` variable pattern consistent: most files expect a simple include-based structure.
- If you change the DB name, update `connexion.php` accordingly and mention it in the PR summary.
- Avoid changing the database column names — many templates/queries reference the original French names.

**Examples (copy/paste friendly)**
- Query used by `index.php` to fetch latest 3 covers:
```
$stmt = $connexion->prepare("SELECT photo FROM livre ORDER BY dateajout DESC LIMIT 3");
$stmt->execute();
while ($r = $stmt->fetch(PDO::FETCH_OBJ)) { /* r->photo */ }
```
- Database import (PowerShell):
```
cd C:\xampp\htdocs\BiblioDriveJoan
mysql -u root -e "CREATE DATABASE bibliodrive;"
mysql -u root bibliodrive < projet-bibliodrive.sql
```

If any of the above is unclear or you want me to include small fixes (e.g., carousel markup, DB-name alignment, or add a .env-backed connection), tell me which area to update next.

-- End of file
