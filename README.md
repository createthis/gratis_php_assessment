# gratis_php_assessment
Gratis PHP Assessment

# Getting started
The assessment asked me to use XAMPP. However:
- I wanted to play with Phalcon since you mentioned using it in the interview.
- I use a Mac for development and I wanted to see if Docker would help standardize the environment.

Therefore, I built a Docker container with XAMPP, PHP 8.2, and Phalcon 5.6.0.
It takes up about 2 Gb on my system and takes about 10 minutes to build from scratch. Here's how:

1. Install docker-desktop https://www.docker.com/products/docker-desktop/
2. Make sure docker-desktop is running in the background.
3. In a terminal:
   ```bash
   docker-compose up -d
   ```
4. Open a terminal in the docker container and install backend dependencies via composer:
   ```bash
   docker exec -it app /bin/bash
   composer install
   ```
5. Visit http://localhost:8080/ in browser


# List docker containers
```bash
docker ps -a
```

# Entering the docker container to execute code manually
```bash
docker exec -it app /bin/bash
```

# Rebuild docker image or view image build logs
If you make a Dockerfile change and want to build and view the build logs you can use:
```bash
docker-compose build --progress plain
```

Or to force a rebuild of everything:
```bash
docker-compose build --no-cache --progress plain
```

# To open a terminal inside the docker container
```bash
docker exec -it app /bin/bash
cd /app
```
