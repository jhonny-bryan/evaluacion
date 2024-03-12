# Proyecto con Slim 3, React y MySQL

Este proyecto utiliza Slim 3 como framework para el backend, React para el frontend y MySQL como base de datos. Se integra con Apache y se recomienda utilizar XAMPP para simplificar el entorno de desarrollo.

## Configuración del Entorno

Asegúrate de tener instalado lo siguiente en tu sistema:

- [XAMPP](https://www.apachefriends.org/index.html)
- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)

## Instalación

1. Clona el repositorio: `git clone https://github.com/tu-usuario/proyecto-slim-react.git`
2. Navega al directorio del proyecto: `cd proyecto-slim-react`
3. Instala las dependencias del backend: `composer install`
4. Instala las dependencias del frontend: `npm install`

## Configuración de la Base de Datos

1. Crea una base de datos MySQL.
2. Copia el archivo `.env.example` a `.env` y configura las variables de entorno relacionadas con la base de datos.

## Ejecución del Proyecto

1. Inicia XAMPP y asegúrate de que Apache y MySQL estén ejecutándose.
2. Inicia el servidor backend de Slim: `composer start`
3. Inicia el servidor frontend de React: `npm start`

El frontend estará disponible en [http://localhost:3000](http://localhost:3000) y el backend en [http://localhost:8080](http://localhost:8080).

## Estructura del Proyecto
|-- backend/
| |-- public/
| | |-- index.php
|-- frontend/
| |-- src/
| | |-- components/
| | | |-- App.js
|-- .env
|-- .gitignore
|-- README.md

## Contribución

¡Agradecemos las contribuciones! Si deseas contribuir, sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una rama para tu contribución: `git checkout -b mi-contribucion`
3. Realiza tus cambios y haz un commit: `git commit -m "Añadir mi contribución"`
4. Envía tus cambios: `git push origin mi-contribucion`
5. Abre un Pull Request en GitHub.

## Licencia

Este proyecto está bajo la licencia MIT.

## Contacto

Para obtener más información, contacta a jhonny bryan en trabajojhonny1932001@gmail.com.#README
