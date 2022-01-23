FROM mysql

WORKDIR /app

COPY . .

EXPOSE 8000

VOLUME [ "/app/data" ]

