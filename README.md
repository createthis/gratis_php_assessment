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
3. Make sure you don't already have an instance of MySQL running on port 3306. If you do, shut it down.
   It may not matter if you follow this guide verbatim, but this step is just in case you want to 
   connect to mysql using a different tool.
4. Clone repo and change directory into it
   ```bash
   git clone https://github.com/createthis/gratis_php_assessment.git
   cd gratis_php_assessment
   ```
5. In a terminal:
   ```bash
   cp .env.example .env # copy dotenv example file
   docker-compose up -d
   ```
6. Open a terminal in the docker container and install backend dependencies via composer:
   ```bash
   docker exec -it app /bin/bash
   composer install
   ```

   Next, run database migrations, creating the users table:
   ```bash
   vendor/bin/phalcon-migrations run
   ```
7. In another terminal tab, start following the docker logs so you can see apache logs:
   ```bash
   docker logs app --follow
   ```
8. Visit http://localhost:8080/ in browser


# Utility How To
## List docker containers
```bash
docker ps -a
```

## Entering the docker container to execute code manually
```bash
docker exec -it app /bin/bash
```

## Rebuild docker image or view image build logs
If you make a Dockerfile change and want to build and view the build logs you can use:
```bash
docker-compose build --progress plain
```

Or to force a rebuild of everything:
```bash
docker-compose build --no-cache --progress plain
```

## Inspect MySQL from the CLI tool
pw is `root`
```bash
docker exec -it mysql /bin/bash
mysql -u root -p -h localhost phalcon_app
```

Now you can run normal mysql cli commands. For example:
```sql
show tables;
select * from users;
describe users;
```
