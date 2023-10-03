Gestión de Inmobiliaria - Documentación del Proyecto

Este proyecto ha sido desarrollado siguiendo criterios específicos para crear una aplicación web de gestión interna para una inmobiliaria. A continuación, se detalla la estructura, funcionalidades y diseño implementados en este proyecto.
Estructura del Proyecto

    controllers/: Contiene los controladores de la aplicación, como controller.php que gestiona las operaciones principales y controlUsuario.php que maneja el acceso y autenticación mediante el login.
    models/: Contiene las clases que representan los objetos de la aplicación, como Foto, Usuario y Vivienda. Se utilizan métodos get y set mágicos para el acceso a los atributos.
    views/: Contiene las vistas HTML y CSS que se muestran al usuario para interactuar con la aplicación.
    config/: Contiene archivos de configuración, incluyendo db.php para la conexión a la base de datos.
    logout.php: Cierra la sesión del usuario.
    session.php: Controla las sesiones de usuario.
    indexModelo.php: Contiene funciones compartidas por todas las clases, como mostrar, eliminar y paginación.

Funcionalidades Implementadas
1. Autenticación y Usuarios

    Los usuarios se autentican mediante un sistema de login.
    El usuario "admin" tiene privilegios para añadir nuevos usuarios y modificar su contraseña.
    Las contraseñas se generan aleatoriamente y se almacenan cifradas en la base de datos.

2. Página Principal y Listado de Viviendas

    La página principal muestra un listado paginado de viviendas disponibles, ordenadas por fecha de anuncio.
    Los detalles de cada vivienda incluyen información relevante como tipo, zona, número de dormitorios, tamaño y precio.
    Se pueden ver las fotos de cada vivienda, con la opción de ver varias imágenes si están disponibles.

3. Gestión de Viviendas y Fotos

    Los usuarios pueden añadir nuevos anuncios y editar las viviendas existentes.
    Las fotos se guardan en una carpeta y se almacena la ruta en la base de datos para su visualización.

4. Búsqueda de Viviendas

    Se implementa un formulario de búsqueda para encontrar viviendas según varios campos.
    Los usuarios pueden realizar búsquedas por tipo, zona, número de dormitorios, etc.

Diseño y Estilos

    La aplicación sigue el patrón de diseño MVC (Modelo-Vista-Controlador) para mantener una estructura organizada y modular del código.
    Se utiliza la POO (Programación Orientada a Objetos) para las clases Foto, Usuario y Vivienda, facilitando el mantenimiento y extensión del código.
    Se han creado clases específicas para controlar el acceso del usuario (controlUsuario.php), gestionar las sesiones (session.php) y manejar la base de datos (indexModelo.php).
    Las fotos se gestionan de manera eficiente, permitiendo la visualización de varias imágenes asociadas a una vivienda.
