FROM php:7.4-cli
COPY . /home/root/projects/weather
WORKDIR /home/root/projects/weather

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Update packages
RUN apt-get update

# Install Unzip
RUN apt-get -y install zip git

RUN cd /home/root/projects/weather
RUN composer install
