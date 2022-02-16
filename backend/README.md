1 - sorted array of products in ProductController.
2 - Try to get the url shorten and then when i receive it redirect. 
In this cases i hadn't enough time to get this in a proper way with request, 
resources and interface segregation with the correct structure/architecture divided
by domain and services.
Any question, just write to david.sadrinas@gmail.com

Build a simple laravel development environment with docker-compose. Compatible with Windows(WSL2), macOS(M1) and Linux.
Usage

    Click Use this template
    Git clone & change directory
    Execute the following command

$ make create-project # Install the latest Laravel project
$ make install-recommend-packages # Optional

http://localhost
Tips

    Read this Makefile.
    Read this Wiki.

Container structures

├── app
├── web
└── db

app container

    Base image
        php:8.1-fpm-bullseye
        composer:2.1

web container

    Base image
        nginx:1.20-alpine
        node:16-alpine

db container

    Base image
        mysql/mysql-server:8.0


