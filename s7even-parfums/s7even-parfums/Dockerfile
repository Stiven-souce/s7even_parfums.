FROM php:8.2-cli

WORKDIR /app

# Copiar todo el contenido del repositorio
COPY . /app

# Mover archivos desde s7even_parfums (con guión bajo) a la raíz si existe
RUN if [ -d "/app/s7even_parfums" ]; then cp -r /app/s7even_parfums/* /app/ 2>/dev/null || true; fi

# También mover desde s7even-parfums (con guión medio) por si acaso
RUN if [ -d "/app/s7even-parfums" ]; then cp -r /app/s7even-parfums/* /app/ 2>/dev/null || true; fi

# Permisos totales de lectura/escritura
RUN mkdir -p /app/data && chmod -R 777 /app

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000", "-t", "/app"]
