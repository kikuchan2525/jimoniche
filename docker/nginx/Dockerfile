FROM nginx:1.27

ENV TZ=UTC

# nginxの設定ファイルをコピー
COPY ./nginx/*.conf /etc/nginx/conf.d/

WORKDIR /var/www/html