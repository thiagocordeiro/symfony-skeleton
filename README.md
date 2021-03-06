## Skeleton for Symfony & DDD  

This project was created for a simple purpose, tryout php7.4 and setup Symfony framework to have better [Domain Driven Design (DDD)](https://www.amazon.com/Domain-Driven-Design-Distilled-Vaughn-Vernon/dp/0134434420/ref=sr_1_3?crid=MKD98M6X7PBW&keywords=domain%20driven%20design&qid=1561282981&s=books&sprefix=domain%20d,stripbooks-intl-ship,215&sr=1-3) approach.

Since php7.4 is still only available under alpha version, **I do not recommend** using this on production environments.

Also I started with DDD a few time ago, so please, if you find mistakes and things you may think *"it's not DDD"*, please open an issue and let me know your thoughts and why you think it's wrong, how should we approach this better or even create a PR with you ideas.

I would like to have this repo for us to bring ideas and share knowledge between our different experiences, so please feel free and don't hesitate to ask/argue about any topic present here such as DDD, docker, mysql, php7.4, tests and others, they are all welcomed for discussion.

### Easy to run
all you need is [docker](https://www.docker.com/get-started) and [docker-compose](https://docs.docker.com/compose/overview/).

    git clone git@github.com:thiagocordeiro/symfony-skeleton.git
    cd symfony-skeleton
    ./console upd # or docker-compose up --build --detach

`./console` makes even easier to run commands on `php-fpm` container, for ex.

    ./console exec composer install
    ./console exec bin/console doctrine:migrations:migrate
    ./console tests
  
or just run `./console help` to see all commands available, of course you can create your own command if needed.

### Try it out
Good to go, we should have now an nginx container running on `port 80` and an api exposing a simple user CRUD, you can try on postman by importing `.dev/User.postman_collection.json` into your postman, create and select a environment (top/right corner), the `{{id}}` on urls should be automatically if you set the environment properly.
![Postman setup](https://drive.google.com/uc?id=1m9vHuXWrv7liIRz_zN4c1hqBS31ijAeF)

### Running tests:

    ./console tests
    
### Stoping/Starting container

    ./console down
    ./console up # ./console upd start detached environment
