Proyecto de Tienda Web Simple

Este proyecto es una aplicación web de tienda en línea que sigue el patrón de diseño Modelo-Vista-Controlador (MVC). La aplicación permite a los usuarios registrarse, iniciar sesión, explorar productos, agregarlos al carrito de compras y realizar compras. También incluye funcionalidades para crear, modificar y eliminar productos en la base de datos. La aplicación está diseñada como una práctica para aprender sobre conceptos clave como autenticación, gestión de sesiones, cookies y servicios web (SOAP y REST), todo implementado siguiendo el patrón de diseño MVC.

implementado siguiendo el patrón de diseño MVC:

Modelo

    Gestión de Usuarios y Productos: La lógica para manejar usuarios y productos se encuentra en el modelo. Esto incluye operaciones como verificar credenciales, validar contraseñas y manipular información de productos.

Vista

    Interfaz de Usuario Amigable: La interfaz de usuario permite a los usuarios interactuar con la aplicación de manera fácil e intuitiva. Utiliza HTML y CSS.

Controlador

    Gestión de Solicitudes y Respuestas: Los controladores manejan las solicitudes del usuario y coordinan las acciones adecuadas. Se encargan de procesar los datos del modelo y enviar las respuestas adecuadas a la vista.

Características Principales:    

    Inicio de Sesión y Registro de Usuarios
        Los usuarios pueden iniciar sesión con su correo electrónico y contraseña.
        Opción para recordar la contraseña utilizando cookies.
        Los nuevos usuarios pueden registrarse proporcionando su nombre, correo electrónico y una contraseña. Se verifica que el correo electrónico no esté ya en uso y que la contraseña cumpla con ciertos requisitos (mínimo de 8 caracteres, al menos una letra y un número).

    Exploración de Productos
        Los usuarios pueden ver una selección de productos disponibles en la tienda.
        Cada producto muestra información como nombre, descripción y precio.

    Carrito de Compras
        Los usuarios pueden agregar productos al carrito de compras o eliminarlos del mismo.
        Pueden ver una lista de los productos que han seleccionado y su costo total.

    Finalización de Compra
        Los usuarios pueden finalizar su compra desde el carrito, lo que mostrará el total a pagar.

    Gestión de Productos 
        Los usuarios pueden crear nuevos productos, modificar los existentes o eliminarlos de la base de datos.

    Integración de Servicios Web
        Servicio SOAP: Validación de contraseñas durante el registro. La contraseña debe tener un mínimo de 8 caracteres, al menos una letra y un número.
        Servicio REST: Verificación de disponibilidad del correo electrónico durante el registro para asegurar que no esté en uso en la base de datos.
