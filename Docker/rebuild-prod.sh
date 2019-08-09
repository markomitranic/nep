#!/bin/sh

# Clean everything up.
docker-compose down
docker container stop $(docker container ls -aq)

# Heavy Cleanup
docker system prune -f && docker image prune -f
docker container rm $(docker container ls -aq)

# Start anew
docker-compose build
