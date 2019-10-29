#!/bin/sh

function gracefulShutdown ()
{
	blue=$(tput setaf 4)
	yellow=$(tput setaf 11)
	normal=$(tput sgr0)
	printf  "%40s\n" "${blue} Pressing Ctrl+C combination again is NOT recommended.${normal}"
	printf  "%40s\n" "${yellow} [SIGINT 2] Stopping all containers. Please wait... ${normal}"
    docker-compose -f docker-compose-dev.yml down
    exit 2
}

# Register shutdown handler
trap "gracefulShutdown" 2

# # Clean everything up.
docker-compose -f docker-compose-dev.yml down

# # Start anew
docker-compose  -f docker-compose-dev.yml build
docker-compose -f docker-compose-dev.yml up --remove-orphans

