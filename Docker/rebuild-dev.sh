#!/bin/sh

# Clean everything up.
docker-compose -f docker-compose-dev.yml down
docker-sync stop
docker container stop $(docker container ls -aq)

# Heavy Cleanup
docker-sync clean
docker system prune -f && docker image prune -f
docker container rm $(docker container ls -aq)

# Start anew
docker-sync start
docker-compose -f docker-compose-dev.yml build
