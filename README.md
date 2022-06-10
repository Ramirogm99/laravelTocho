En configuracion xampp, config mysql, my.ini 

[mysqld]
event_scheduler=ON

Añadir al final

Mirar el .env.example, es posible que haya varias directivas importantes a modificar como 


SESSION_DOMAIN=localhost

SANCTUM_STATEFUL_DOMAINS=localhost
