**This is a Docker container with a full installation of Sendy 2.1.2.7 with everything set-up (permissions, apache, cron, php-curl, php-xml, etc) auto-responders will be enabled as well.**

Inspired by :  https://github.com/svtek/Sendy-Docker

I also externalized all mandatory variables as env variables to make it more docker friendly.
I have had to modify the sendy config.php file to do that so keep in mind that if you use another version of sendy you will probably have to re-do these modifications and I can't guarantee that the php version and the loaded libraries will remain the same.

# Building the container
 Once you have setup the project run:  

```
docker build -t sendy
```


# Getting it running
To run apache in a background process, simply start the container using the following command  (example):
```
docker run -p 8080:80 -d sendy -e MYSQL_ROOT_PASSWORD=my_root_passwd -e MYSQL_DATABASE=my_sendy_db -e MYSQL_PORT=my_sendy_port -e SENDY_PATH=http://sendy.my_domain.com
```

-p 8080:80 publishes port 80 in the container to 8080 on the host machine.
-d detaches from the process, use docker ps and docker stop to … stop.
-e add the environment variables to allow Sendy to connect to the MySQL DB

# Docker compose
Here is an example of a docker-compose file that will get you running in minutes

```
  mysql-sendy:
    image: mysql:5.7
    ports:
      - 3306:3306
    volumes:
      - /var/lib/mysql
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: my_passwd
      MYSQL_DATABASE: sendy_db
  sendy:
    build: .
    ports:
      - 80:80
    links:
      - mysql-sendy:mysql
    environment:
      MYSQL_ROOT_PASSWORD: my_passwd
      MYSQL_DATABASE: sendy_db
      MYSQL_PORT : 3306
      SENDY_PATH : http://sendy.my_domain.com
```

To launch it simply replace the env variables and run :
docker-compose up

Send will be running on http://sendy.my_domain.com on this example

And if you want to include it in your web application to be able to use Sendy 's API you'll just have to add this line to your web module, then your app will be able to request the API at http://sendy 

```
    links:
      - sendy
```

# Amazon ECS
I've done all that to be able to deploy it instantly using amazon ECS, there is only one necessary step missing here. 
Since ECS doesn't support build you'll have to build the image and host it somewhere and replace the build line in docker compose by your image like :


```
    image: my_repo/my_sendy_image:v2
```

# Local use
I know how annoying it can be to not be able to test Sendy in local and the provided official solution sucks when your IP is dynamic so here is what I've done.
1. Modify you docker compose
```
  sendy:
    build: .
    ports:
      - 9014:80
    links:
      - mysql-sendy:mysql
    environment:
      MYSQL_ROOT_PASSWORD: my_passwd
      MYSQL_DATABASE: sendy_db
      MYSQL_PORT : 3306
      SENDY_PATH : http://238238736_sendy.my_domain.com
```

Sendy should run on port 9014 but if you set the path to SENDY_PATH : localhost:9014 it won't work because it won't recognize the domain you bought
2. Install local tunnel :
https://github.com/localtunnel/localtunnel
3. run local tunnel with a predefined subdomain (choose something random)
```
    lt --port 9014 --subdomain 238238736_sendy
```
4. Add a CNAME record on the domain you bought Send for
```
    CNAME 238238736_sendy.my_domain.com 238238736_sendy.localtunnel.me
```
5. Go to 238238736_sendy.my_domain.com, you can now test locally without having to check your IP and modify your A record all the time.

If you have more than one developer make the SENDY_PATH a variable on your machine and add as many CNAME records as you have developers.