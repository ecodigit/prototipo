FROM composer AS BUILDER
COPY ./ /app/
RUN ["composer", "install"]
RUN ["sh", "/app/bin/build.sh"]
FROM php:apache
COPY --from=BUILDER /app/dist/public_html/ /var/www/html/
COPY --from=BUILDER /app/dist/vendor/ /var/www/vendor/
COPY --from=BUILDER /app/dist/src/ /var/www/src/
