FROM node:8-jessie AS base
ENV NPM_CONFIG_LOGLEVEL info

WORKDIR /home/node/app/

RUN npm install -g yarn \
    && npm install yarn

RUN chmod a+rwx  /usr/local/lib/node_modules/yarn/bin/yarn* \
    && chmod a+rwx  /usr/local/bin/yarn*

RUN yarn install

FROM base AS prod
COPY entrypoint-prod.sh /home/node/entrypoint.sh
RUN ["chmod", "+x", "/home/node/entrypoint.sh"]

FROM base AS dev
COPY entrypoint-dev.sh /home/node/entrypoint.sh
RUN ["chmod", "+x", "/home/node/entrypoint.sh"]
