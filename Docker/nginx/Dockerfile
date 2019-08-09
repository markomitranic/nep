FROM nginx:latest AS base

RUN apt-get update
RUN apt-get install nano

RUN rm /etc/nginx/conf.d/*
COPY conf /etc/nginx/conf.d
COPY ssl /etc/nginx/ssl
WORKDIR /usr/share/nginx/html

FROM base AS prod

FROM base AS dev
