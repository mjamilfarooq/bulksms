FROM linode/lamp
RUN apt update
RUN apt install -y wget zip php5-mysql libphp-phpmailer
RUN cd /tmp && \
    wget https://github.com/mjamilfarooq/bulksms/archive/master.zip && \
    unzip master.zip && \
    mkdir /var/www/html/bulksms/ && \
    mv bulksms-master/* /var/www/html/bulksms/
COPY bulksms.conf /etc/apache2/sites-available/
RUN a2dissite example.com && a2ensite bulksms && a2enmod rewrite && service apache2 restart


############## setting up database ##################
RUN echo 'service mysql start\nservice apache2 start' >> ~/.bashrc && \
	service mysql start && \
	mysql --user=root --password=Admin2015 < /var/www/html/bulksms/db.sql 
