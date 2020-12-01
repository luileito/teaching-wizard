FROM nginx:1.19-alpine

RUN rm /etc/nginx/conf.d/default.conf

#COPY ssl /etc/nginx/ssl

ARG config=site.conf
COPY ${config} /etc/nginx/conf.d/default.conf
