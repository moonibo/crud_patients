FROM node:18-alpine

ARG UID
ARG GID

RUN deluser --remove-home node \
 && addgroup -S -g ${GID} app \
 && adduser -S -D -u ${UID} -s /bin/ash -h /home/app -G app app \
 && mkdir -p /app \
 && chown -R app:app /app \
 && chmod -R g+w /app

RUN npm install --location=global npm@latest

USER app
WORKDIR /app
