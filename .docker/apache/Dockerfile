FROM httpd:2.4-alpine

ARG UID
ARG GID

COPY host.apache.conf /usr/local/apache2/conf/host.apache.conf
RUN echo "Include /usr/local/apache2/conf/host.apache.conf" >> /usr/local/apache2/conf/httpd.conf

RUN addgroup -S -g ${GID} app \
 && adduser -S -D -u ${UID} -s /bin/ash -h /home/app -G app app \
 && chown -R app:app /home/app /usr/local/apache2/logs \
 && chmod -R g+w /home/app /usr/local/apache2/logs

USER app
