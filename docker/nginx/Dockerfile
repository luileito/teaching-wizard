FROM nginx:1.19-alpine

RUN rm /etc/nginx/conf.d/default.conf

COPY snippets/wizard.conf /etc/nginx/snippets/wizard.conf

ARG config=site.conf
COPY ${config} /etc/nginx/templates/default.conf.template
