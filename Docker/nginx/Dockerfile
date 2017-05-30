FROM nginx:stable

ENV DEBIAN_FRONTEND noninteractive

MAINTAINER Manichev Aleksandr

RUN apt-get update -y && apt-get install -y supervisor

ADD nginx.conf /etc/nginx/
ADD sites-available/ /etc/nginx/sites-available

RUN mkdir /etc/nginx/sites-enabled && ln -s /etc/nginx/sites-available/* /etc/nginx/sites-enabled/

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

ADD supervisor.conf /etc/supervisor/conf.d/supervisor.conf

RUN usermod -u 1000 www-data

EXPOSE 80
EXPOSE 443

CMD ["/usr/bin/supervisord"]