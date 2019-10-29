FROM node:10-jessie AS base
ENV NPM_CONFIG_LOGLEVEL info

WORKDIR /app/

RUN npm install -g yarn \
    && npm install yarn

RUN chmod a+rwx  /usr/local/lib/node_modules/yarn/bin/yarn* \
    && chmod a+rwx  /usr/local/bin/yarn*

RUN yarn install

FROM base AS prod
COPY entrypoint-prod.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]

FROM base AS dev
COPY entrypoint-dev.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]
