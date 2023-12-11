# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Install necessary packages
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    mariadb-server \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql zip gd

# Enable Apache modules
RUN a2enmod rewrite

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

#Create DB, create user untuk di php, privilege,dan query file .sql
RUN service mariadb start && \
    mysql -e "CREATE USER 'baymed'@'localhost' IDENTIFIED BY 'B@yM3d123';" && \
    mysql -e "source /var/www/html/database.sql" && \
    mysql -e "GRANT ALL PRIVILEGES ON baymed.* TO 'baymed'@'localhost';" 

# Install & enable mysql client serta mysqli untuk php server
RUN apt-get update && \
    apt-get install -y default-mysql-client && \
    docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli

RUN chmod +x /var/www/html/script.sh

# Expose port 80 for Apache
EXPOSE 80

# CMD to start Apache
CMD ["/var/www/html/script.sh"]