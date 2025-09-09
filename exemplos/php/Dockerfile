FROM php:7.4-apache

# Copiar arquivos da aplicação para o diretório do Apache
COPY render /var/www/html/

# Ativar módulos do Apache
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/ && \
    cp /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/

# Copiar configuração personalizada do Apache
COPY my-apache-config.conf /etc/apache2/conf-available/my-apache-config.conf
RUN a2enconf my-apache-config
