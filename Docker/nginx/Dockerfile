FROM nginx:latest

RUN apt-get update
RUN apt-get install nano

RUN rm /etc/nginx/conf.d/*
COPY conf /etc/nginx/conf.d
COPY ssl /etc/nginx/ssl
WORKDIR /app/nep/public
