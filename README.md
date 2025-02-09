
![Logo](/screenshots/logo.jpg)


# AFPVentas

AFPVentas es un sistema de gestión integral diseñado para optimizar y administrar operaciones de e-commerce, funcionando como una tienda en línea (online store). Este proyecto está especialmente desarrollado para gestionar ventas, compras, proveedores y clientes de manera eficiente.


## Capturas de Pantalla

![App Screenshot](/screenshots/dashboard.png)
![App Screenshot](/screenshots/dashboard_1.png)
![App Screenshot](/screenshots/dashboard_2.png)
![App Screenshot](/screenshots/config.png)
![App Screenshot](/screenshots/categorias.png)
![App Screenshot](/screenshots/productos.png)
![App Screenshot](/screenshots/compras.png)
![App Screenshot](/screenshots/ventas.png)
![App Screenshot](/screenshots/arqueoscaja.png)



## Características Principales

- **Gestión de E-commerce**: Administración completa de productos, categorías, inventario y transacciones en línea.

- **Ventas en Línea**: Procesamiento de pedidos, seguimiento de ventas y generación de facturas electrónicas.

- **Control de Compras y Proveedores**: Registro y gestión de compras, proveedores y órdenes de abastecimiento.

- **Clientes y Usuarios**: Sistema de registro y autenticación para clientes, con perfiles personalizados y seguimiento de compras.

- **Gráficos y Reportes**: Visualización de datos mediante gráficos interactivos (torta, barras, etc.) para análisis en tiempo real.

- **Interfaz Responsive**: Diseño adaptable a dispositivos móviles y de escritorio, ideal para una tienda en línea.


## Tech Stack

**Frontend**: HTML, CSS, JavaScript, Bootstrap, Highcharts (para gráficos).

**Backend**: Laravel (PHP), MySQL (base de datos).

**Herramientas**: Git (control de versiones), Composer (gestión de dependencias), NPM(dependencias de desarrollo).
## Colores Principales

| Color             | Hex                                                                |
| ----------------- | ------------------------------------------------------------------ |
| Negro | #000
| Blanco | #FFFFFF
| Gris | ##6b7280
| Blanco | ##6b7280
| AzulClaro | #007bff
| AzulClaro | #007bff
| Verde | #28a745
| Morado | #6f42c1
| Naranja | #fd7e14


## Pasos para la Instalación

    1. Clona el repositorio:
    git clone https://github.com/Pipepena2979/AFPVentas.git
    cd afp-ventas

    2. Instala las dependencias de Composer:
    composer install

    3. Configura el archivo .env:
    Copia el archivo .env.example y renómbralo a .env.
    Configura las variables de entorno, especialmente las relacionadas con la base de datos:
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=afp_ventas
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña

    4. Ejecuta las migraciones para crear las tablas en la base de datos:
    php artisan migrate

    5. (Opcional) Si necesitas datos de prueba, ejecuta los seeders:
    php artisan db:seed

    6. (Opcional) Si el proyecto incluye assets compilados con Node.js, instala las dependencias de npm y compila los assets:
    npm install
    npm run dev

    7. Inicia el servidor de desarrollo:
    php artisan serve

    8. Accede a la aplicación en tu navegador:
    http://localhost:8000

    9. Notas Adicionales;
    Configuración del Servidor: Si estás desplegando en un servidor en producción, asegúrate de configurar correctamente el servidor web (Apache, Nginx, etc.) y ajustar los permisos de archivos.
    
    Caché y Optimización: En producción, ejecuta los siguientes comandos para optimizar la aplicación:

    php artisan config:cache
    php artisan route:cache
    php artisan view:cache

    Fin del proceso de instalación de AFPVentas.

    


    
## Autor

- [@Pipepena2979/](https://www.github.com/Pipepena2979)

