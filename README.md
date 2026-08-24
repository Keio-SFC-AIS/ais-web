# AIS Official Website 

The official static website for the **Association for International Students (AIS) at Keio SFC**. This repository houses the main landing page, and various community connection tools. 


## Project Overview 

This website is mostly maintained by the AIS Web / Tech Team. It serves as: 

1. **Landing page:** Introducing AIS's mission, goals, and organizational structure to the public.
2. **Community Touchpoint:** Connecting students with our official LINE groups, Instagram, and alumni network tracking.
3. **AIS Hub:** An essential, student-led survival guide and navigation resource for incoming GIGA and international freshmen.

## Open Source & Contribution 

As a student-led organization, we welcome contributions from Keio SFC students, alumni, and the broader global developer community. Whether you are fixing a typo, improving UI components, or optimizing backend PHP logic, your help makes the SFC experience better for everyone.

To keep our development smooth and organized, here is how you can get involved:

### 1. How to Participate
* **Browse Open Issues:** Check out our open issues to see what we are currently working on. 
* **Claiming an Issue:** If you find an issue you'd like to tackle, please **leave a comment** on it! While we don't always formally "assign" issues to keep things flexible, letting us know you're interested helps avoid overlapping work.
* **Propose New Ideas:** Found a bug or have a cool feature idea? Feel free to open a new Issue to discuss it with the team.

### 2. Submission Guidelines
1. Fork the repository and create your feature branch (`git checkout -b feature/AmazingFeature`).
2. Implement your changes following our existing code style.
3. Commit your changes and open a Pull Request (PR) against our `main` branch.
4. **Security First:** To protect our deployment server, please ensure **absolutely NO private credentials, API keys, or hardcoded tokens** are included in your code.

### 3. Review Process
The AIS Core Web Team actively monitors all PRs. We promise to review your submissions, offer constructive feedback, and merge high-quality code as quickly as possible. Thank you for helping us grow!

## Tech Stack

- Backend: PHP
- Frontend: Vanilla HTML5, CSS3, JavaScript
- Server Environment: Apache 

## Local Development Setup 

Get the project running locally on your machine in two easy steps: 

### 1. Clone the Repo 
```bash
git clone https://github.com/Keio-SFC-AIS/ais-web.git

cd ais-web
```

### 2. Run a local PHP Server
If you have PHP installed, spin up  a quick local server by: 
```bash
php -S localhost:8000
```

## Portal administration

The public portal is rendered from a local SQLite database at `portal/data/portal.sqlite`. The database is ignored by Git, so a deployment pull does not replace cards created by admins.

Before using `/portal/admin/`, copy `portal/admin/config.example.php` to `portal/admin/config.local.php` on the server and set `password_hash` to a hash made with:

```bash
php -r "echo password_hash('choose-a-strong-password', PASSWORD_DEFAULT), PHP_EOL;"
```

The first request to `/portal/` creates and seeds the database with the current cards. Ensure that the Apache/PHP user can write to `portal/data/`, and that PHP has the `pdo_sqlite` extension enabled. The `.htaccess` file in that directory blocks direct database downloads on Apache.
