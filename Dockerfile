FROM nginx

MAINTAINER Mayank Bhushan <mayankbhusan@iitkgp.a.in>

COPY wrapper.sh /

COPY html /usr/share/nginx/html

CMD ["./wrapper.sh"]
