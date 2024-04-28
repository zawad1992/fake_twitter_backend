FROM mariadb:10.3

# Set root password from environmental variable
ENV MYSQL_ROOT_PASSWORD=root_password

# Install wget
RUN apt-get update && apt-get install -y wget

# Create directory for Adminer
RUN mkdir -p /var/www/html

# Download Adminer
RUN wget "https://www.adminer.org/latest.php" -O /var/www/html/adminer.php

# Remove wget
RUN apt-get remove -y wget

# Clean up apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Expose ports for MariaDB and Adminer
EXPOSE 3306
EXPOSE 8080
