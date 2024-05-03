#!/bin/bash

# Define the name of the Docker network
NETWORK_NAME=fake-twitter-network

# Check if the network exists
if ! docker network inspect $NETWORK_NAME >/dev/null 2>&1; then
    # Create the network if it doesn't exist
    docker network create $NETWORK_NAME
fi

# Bring up containers using Docker Compose
docker-compose up -d

# Connect containers to the network
docker network connect $NETWORK_NAME fake-twitter-backend-container
docker network connect $NETWORK_NAME db-mariadb
