# gratis_php_assessment
Gratis PHP Assessment

# What is this?
The assessment asked me to use XAMPP. However:
- I wanted to play with Phalcon since you mentioned using it in the interview.
- I use a Mac for development and I wanted to see if Docker would help standardize the environment.

## Backend
Therefore, I built a Docker container with XAMPP, PHP 8.2, and Phalcon 5.6.0. The backend PHP packages are managed
using composer. I'm utilizing Phalcon's built-in ORM for database access and their custom migration system. I'm not
a huge fan of their migration system, so I might recommend the Phinx migration system instead, as that is what the
example Vokuro app uses. It seems a little more robust.

## Frontend
The frontend is a hybrid single page application with Phalcon MVC backend, utilizing NPM + React + Babel + Webpack.

What do I mean by hybrid? Well, the single page application is compiled to `public/bundle.js`. However, there can
be multiple single page applications within the bundle. They are "routed" or "mounted" to the DOM in `src/client/index.js`.

More than one bundle can be created in `webpack.config.js`, in case the developer wants to avoid namespace conflicts
between frontend applications.

NPM provides convenient package management for frontend modules, including security vulnerability information.
It could easily be augmented with frontend unit tests (Jest + React Testing Library) and even Typescript.

## Limitations
One noteable limitation of this current environment is the lack of frontend hot loading for React components. The
whole bundle needs to be recompiled in order to view changes (see `npm run build` below). This is a significant barrier
to developer productivity and must be addressed before this environment can be seriously considered. When I used 
hapi.js as a backend I used nodemon and a hapijs webpack plugin for hot reloading. I'm sure there is a relatively
straight forward way to implement something similar here, but I didn't have time to research possible solutions.

## Advantages
The docker images (app and mysql) take up about 2 Gb on my system and takes about 10 minutes to build from scratch.
Being a docker system, this example should theoretically run on any system on which docker desktop can be installed.
For example: Windows, Linux, Mac, or even AWS ECS. Multiple docker containers could be spun up at the same time in a
production environment and placed behind a load balancer in order to facilitate scalability. Redis can be used as a session
manager in this case.

# Getting started

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
6. Open a new terminal tab, then open a terminal in the docker container and install backend dependencies via composer:
   ```bash
   docker exec -it app /bin/bash
   composer install
   ```

   Then, install frontend dependencies via npm:
   ```bash
   npm install
   ```

   Now we need to build our frontend js using babel and webpack:
   ```bash
   npm run build
   ```

   Next, run database migrations, creating the users table and seeding it with our one test user:
   ```bash
   vendor/bin/phalcon-migrations run
   ```

   Keep in mind that all of these commands should be run in the docker container, not in your local terminal.
7. In another terminal tab, start following the docker logs so you can see apache logs:
   ```bash
   docker logs app --follow
   ```
8. Visit http://localhost:8080/ in browser
9. The login credentials for testing are:
   - Email: spongebob@example.com
   - Password: IAmSpongeBobsPassword


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
