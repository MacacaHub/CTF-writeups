FROM ubuntu:18.04
RUN apt-get update -y 
RUN apt-get upgrade -y 
RUN apt-get install -y tzdata 
ENV TZ "Europe/Amsterdam" 
RUN echo "Europe/Amsterdam" > /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata 
RUN apt-get install -y git curl apache2 php libapache2-mod-php php-mysql php-xml php-zip php-gd 
RUN rm -f /etc/localtime 
RUN ln -fs /usr/share/zoneinfo/Europe/Amsterdam /etc/localtime
RUN apt install -y host 

RUN rm -rf /var/www/html/* 
RUN rm -f /etc/apache2/sites-available/000-default.conf 
ADD ./settings/000-default.conf /etc/apache2/sites-available/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite 
RUN chown -R www-data:www-data /var/www/html/ 
ENV APACHE_RUN_USER www-data 
ENV APACHE_RUN_GROUP www-data 
ENV APACHE_LOG_DIR /var/log/apache2 
ENV APACHE_LOCK_DIR /var/lock/apache2 
ENV APACHE_PID_FILE /var/run/apache2.pid

EXPOSE 80 

COPY run.sh /run.sh 
RUN chmod a+rx /run.sh 
CMD ["/bin/bash", "/run.sh"]
