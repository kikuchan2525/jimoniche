FROM node:22

# 開発ディレクトリ設定
ENV WORKDIR /code
WORKDIR ${WORKDIR}

# コンテナ内でパッケージを一括インストール
RUN npm update npm && \
    npm install -g @vue/cli && \
    npm install -g @vue/cli-init && \
    npm install -g axios

USER node