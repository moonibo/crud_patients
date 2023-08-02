FROM redis:7.0-alpine

COPY redis.conf /usr/local/etc/redis/redis.conf
USER root:root
RUN mkdir -p /var/run/redis && chown redis:redis /var/run/redis
USER redis:redis
CMD ["redis-server", "/usr/local/etc/redis/redis.conf"]
