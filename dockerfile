FROM debian:latest
MAINTAINER Florian Ammon <@riesenwildschaf>


RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y apt-utils && \
    apt-get install -y apache2 php php-xml php-simplexml php-zip

# Apache config
COPY apache2/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy website
RUN rm -rf /var/www/html/* && \
    mkdir /var/www/html/upload/ && \
    chmod 777 /var/www/html/upload/

ADD web/* /var/www/html/
ADD secret/* /var/www/

# Define default command.
CMD ["apachectl", "-DFOREGROUND"]

# Expose ports.
EXPOSE 80
