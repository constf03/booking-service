# Booking Service

## Overview

this is just a hobby project including fundamental web development concepts such as user authentication, form validation, database operations and more.

## Local Development

Requirements:

- PHP (https://www.php.net/downloads.php)
- Composer (https://getcomposer.org/download/)
- Docker Desktop (https://www.docker.com/products/docker-desktop/)

1. Clone the repo:

```
git clone https://github.com/constf03/booking-service
```

2. Install dependencies:

```
php composer.phar update
```

3. Setup DB secret

Windows:

```
powershell -executionpolicy bypass -File .\setup-db.ps1
```

Linux:

```
.\setup-db.sh
```

3. Create Docker containers:

```
docker compose up --build
```

Website should be running on localhost:9000

## Technology Stack

- HTML
- CSS
- Javascript
- PHP
- MySQL
- Docker
