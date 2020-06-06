FROM nginx:latest

RUN rm /etc/nginx/conf.d/default.conf

COPY . /web

RUN touch /etc/nginx/fastcgi.conf

COPY build/nginx/default.conf /etc/nginx/conf.d/default.conf
