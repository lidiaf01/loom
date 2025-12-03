Lidia Artero Fernández - Curso 2025/26 - DAW
# Análisis del sistema de información
(Requerimientos, historias, modelo de datos y boceto de interfaces)

## ÍNDICE

1. Introducción
1.2. Resumen de la propuesta
2. Requerimientos
3. Historias de usuario
  3.1. Registro y Autenticación
  3.2. Buscar categoría
  3.3. Consultar mensajes
  3.4. Publicación de artículo
  3.5. Personalización de usuario
  3.6. Guardar contenido en biblioteca
4. Interfaces
  4.1. Registro y autenticación
  4.2. Buscar Categoría
  4.3. Consultar mensaje
  4.4. Publicación de artículos
  4.5. Personalización de usuario
  4.6. Biblioteca
5. Modelo de Datos
  5.1. Modelo E/R
  5.2. Tablas
    5.2.1. Usuarios
    5.2.2. Publicación
    5.2.3. Diario
    5.2.4. Categoría
    5.2.5. Lista
    5.2.6. Mensaje
6. Bibliografía

---

## 1. Introducción

Para este proyecto vamos a tomar de referencia el proyecto Loom visto en la propuesta anterior. En este trabajo nos pondremos más técnicos para desarrollar y organizar aspectos iniciales de nuestro proyecto y lo vamos a desarrollar en cuatro aspectos clave.

Como ya he mencionado tomaremos de base el proyecto Loom sobre el que crearemos los requerimientos necesarios, el modelo de datos y también un pequeño esquema visual de cómo se va a ver el resultado usando Figma.

### 1.2. Resumen de la propuesta

Loom es una red social dedicada al bienestar y evitar el consumo excesivo de redes además de fomentar el no uso de pantallas y educarnos en aspectos de la vida diaria. Resumidamente los usuarios pueden ver contenido publicado por los creadores y este contenido ha sido previamente filtrado para comprobar que de verdad aporta. Estos contenidos están divididos en categorías. Además los usuarios cuentan con un diario personal en que pueden escribir sus pensamientos e ideas y una biblioteca donde guardar y organizar el contenido que le puede ser útil. Como toda red social habrá chat, me gustas, comentarios y seguimientos para que los usuarios interactúen entre ellos.

## 2. Requerimientos

Presentamos los requerimientos divididos en distintas secciones que necesitará nuestro proyecto.

- Requerimientos funcionales
  - Registro y autenticación de usuarios
  - Creación y personalización del perfil
  - Publicación de contenido
  - Gestión de diario personal privado
  - Interacciones sociales (me gusta, comentarios, seguir usuarios…)
  - Búsqueda y filtrado de contenidos por temáticas
  - Compartir contenido
  - Algoritmo de recomendación
  - Gestión de contenido para creadores: edición y estadísticas
  - Moderación y gestión de contenidos para administradores

- Requerimientos de rendimiento
  - Respuesta de aplicación de menos de 2 segundos
  - Soporte para 10.000 usuarios activos (inicialmente)
  - Escalabilidad del sistema para un futuro

- Requerimientos de seguridad
  - Comunicación cifrada con HTTPS
  - Almacenamiento seguro de claves
  - Control de permisos por roles
  - Filtrado de contenido inapropiado

- Requerimientos ergonómicos
  - Interfaz responsive
  - Accesibilidad para personas con problemas de visión
  - Navegación sencilla entre secciones

- Requerimientos normativos
  - Cumplimiento de ley de protección de datos
  - Cumplimiento de normativa de copyright para el contenido publicado
  - Normas de accesibilidad web

## 3. Historias de usuario

### 3.1. Registro y Autenticación

Como: usuario nuevo

Quiero: registrarme y autenticarme

Para: acceder a los contenidos y funcionalidades de Loom

Criterios de aceptación:

- Formulario con nombre, email, fecha de nacimiento y clave
- Validación de correo y clave segura
- Inicio de sesión con correo, nombre de usuario y clave
- Mensaje de error en caso de credenciales incorrectas

### 3.2. Buscar categoría

Como: usuario (creador)

Quiero: publicar contenido

Para: compartir conocimientos o experiencia con otros usuarios

Criterios de aceptación:

- Editor de texto, cuerpo y etiquetas
- Contenido público o privado
- Guardado automático y previsualización antes de publicar
- El contenido tiene que pasar por el filtro Loom para aceptarlo en los criterios de publicación
- Indicar categoría a la que pertenece el video

### 3.3. Consultar mensajes

Como: usuario

Quiero: comunicarme y responder a mensajes privados por chat

Para: establecer una conversación o ver nuevo contenido

Criterios de aceptación:

- Ambas cuentas tienen que seguirse mutuamente
- Envío de texto, enlaces, multimedia o publicación de la aplicación
- Notificaciones de mensajes nuevos

### 3.4. Publicación de artículo

Como: usuario

Quiero: publicar contenido en Loom

Para: compartir conocimientos o experiencias con otros usuarios

Criterios de aceptación:

- Editor de video y texto básico
- Artículos público o privado
- Guardado automático y previsualización

### 3.5. Personalización de usuario

Como: usuario

Quiero: personalizar mi perfil

Para: que otros usuarios me reconozcan y el sistema me recomiende contenido

Criterios de aceptación:

- Formulario de edición de perfil
- Selección de intereses
- Vista de perfil pública o privada

### 3.6. Guardar contenido en biblioteca

Como: usuario

Quiero: guardar contenido, en listas

Para: organizar y consultar aprendizajes

Criterios de aceptación:

- CRUD de listas
- Añadir o quitar contenido dentro de cada lista
- Ver listas propias o ajenas (Según privacidad)
- Visibilidad de listas

## 4. Interfaces

### 4.1. Registro y autenticación

Para esta primera historia tenemos 4 pantallas distintas:

- `menu_login_registro`: Esta es la pantalla principal para los nuevos usuarios y simplemente tiene los botones de registrar o hacer login en el caso que tengas cuenta pero sea otro dispositivo o hayas cerrado sesión.
- `pantalla_registro_1`: es un formulario sencillo para pedir el email, un nombre de usuario y la edad.
-- `pantalla_registro_2`: es la continuación del mismo formulario para poner la clave y una confirmación de esta.
- `pantalla_registro_completado`: al final se mostrará una pantalla de confirmación para ver que la cuenta ya está lista y un botón de continuar para acceder ya a la aplicación.

### 4.2. Buscar Categoría

- `pantalla_principal`: Como se ve en la imagen la pantalla consta de varias secciones a las que podemos acceder. Por un lado tenemos al principio el logotipo y después los cuatro bloques principales.
- `Crear`: para la publicación de contenido
- `Búsqueda`: Navegar por las distintas secciones y encontrar el contenido que quieras dependiendo de la sección que escojas
- `Perfil`: vista de tu perfil con tus publicaciones
- `Diario`: lugar donde escribir lo que quieres público o privado y registro de el dia que escribas
- `Estadísticas`: en caso de ser creador muestra unas estadísticas básicas de cómo va tu contenido
- `Biblioteca`: para la creación de listas y poder verla incluso compartirlas
- `Ajustes`: ajustes básicos de la aplicación
- `Banner imagen`: pequeño decorativo animado para dar dinamismo a la aplicación
- `Busqueda_menu`: menú con todas las secciones disponibles, categorías como salud, hobbies, educación…
- `Entrada_seccion`: página principal al entrar a sección con su título y una breve descripción del contenido que hay ahí después de esta puedes disfrutar de las publicaciones de otros creadores.

### 4.3. Consultar mensaje

- `pantalla_principal`: misma distribución que he explicado anteriormente.
- `lista_chats`: pantalla que muestra una lista de todas las conversaciones que ha tenido el usuario, se van ordenando según la última interacción y aparecerá un círculo en aquellas donde haya mensajes que el usuario no ha leído y una vista previa del mensaje del otro usuario.
- `chat`: pantalla de chat normal donde aparece la foto y nombre del otro usuario, se guarda la fecha que hay entre las conversaciones, los mensajes y abajo estaría el campo para escribir, poder añadir otras utilidades a parte de mensajes (fotos, enlaces, archivos…) y el botón de enviar.

### 4.4. Publicación de artículos

- `pantalla_principal`: misma distribución anteriormente explicada.
- `selección_media`: apartado donde el creador puede elegir los archivos para publicar dentro de los permitidos por la aplicación (video, foto, texto…).
- `edición_media`: Sección de edición de videos donde el creador puede tener un pequeño editor, colocar filtros, añadir texto.
- `descripción_video`: configuración para la visibilidad y repercusión del video, añadimos una descripción, hashtags y la visibilidad.
- `confirmacion_publicacion`: Texto y preview del video para confirmar su correcta publicación.

### 4.5. Personalización de usuario

- `pantalla_principal`: pantalla previamente explicada
- `vista_perfil`: vista de cómo se vería el perfil con la foto, la biografía y el contenido publicado. Con un botón de configuración donde se pasaría.
- `personalizacion_perfil`: menú de personalización con la foto para poder cambiar, campo para cambiar el nombre y la biografía y al final la opción de cerrar la sesión y el botón para aplicar los cambios y guardar.

### 4.6. Biblioteca

El usuario después de guardar un contenido podrá introducirlo en carpetas organizadas como quiera.

- `pantalla_principal`: explicación previa
- `vista_perfil`: dentro del perfil se podrá acceder a todas las publicaciones pero también al contenido guardado de la biblioteca. Las listas de la biblioteca tienen un formato de carpeta con nombre y al pulsar sobre estas se abren.
- `vista_lista`: aparece la carpeta con su nombre y dentro todo el contenido guardado en esta lista.

## 5. Modelo de Datos

Primero vamos a partir del modelo E/R creado para el proyecto y después desarrollaremos cada una de las tablas.

### 5.1. Modelo E/R

En base a este esquema he cubierto las necesidades más importantes del proyecto y una breve explicación de su aparición:

- Usuarios: Todos los participantes se unifican ya que un usuario puede ser creador o no. Su función en la app se determina con el atributo rol.
- Publicación: también se unifica el tipo de contenido.
- Diario: solo existe un diario por usuario y entre sus atributos está la visibilidad de este.
- Seguimiento: los usuarios interactúan con otros usuarios al momento de seguirse dentro de la aplicación. Esto se repite de igual manera en los me gusta o comentarios.
- Categorías: se permite que una publicación tenga varias categorías para un filtrado más flexible.
- Listas: funcionan como carpetas organizativas de publicaciones, tienen control de visibilidad y reflejan la idea de un espacio seguro y organizado para los usuarios.

El modelo refleja lo más importante de la plataforma: creación, consumo, interacción y organización.

### 5.2. Tablas

#### 5.2.1. Usuarios

Campo | Tipo
---|---
id_usuario (PK) | int
nombre_usuario | varchar
email | varchar
clave | varchar
fecha_nacimiento | date
biografía | text
foto_perfil | varchar
rol | enum
fecha_registro | datetime

#### 5.2.2. Publicación

Campo | Tipo
---|---
id_publicación (PK) | int
id_usuario (FK) | int
titulo | varchar
descripcion | text
tipo_contenido | enum
url_media | varchar
visibilidad | enum
fecha_publicación | datetime

#### 5.2.3. Diario

Campo | Tipo
---|---
id_diario (PK) | int
id_usuario (FK) | int
título | varchar
contenido | text
visibilidad | enum
fecha_creación | datetime

#### 5.2.4. Categoría

Campo | Tipo
---|---
id_categoría (PK) | int
nombre | varchar
descripción | text

#### 5.2.5. Lista

Campo | Tipo
---|---
id_lista (PK) | int
id_usuario (FK) | int
nombre_lista | varchar
visibilidad | enum

#### 5.2.6. Mensaje

Campo | Tipo
---|---
id_mensaje (PK) | int
id_emisor (FK) | int
id_receptor (FK) | int
contenido | text
fecha_envio | datetime
leido | boolean

## 6. Bibliografía

- Atlassian. (s. f.). Historias de usuario: cómo escribir historias de usuario ágiles efectivas. Atlassian. Recuperado el 30 de octubre de 2025, de https://www.atlassian.com/es/agile/project-management/user-stories
- García, L., & Molina, A. (2020). Arquitectura de software para aplicaciones web: selección de frameworks y buenas prácticas. Revista Iberoamericana de Computación, 18(1), 45–60.
- Hernández, F., & Salazar, M. (2022). Plataformas sociales y educación en sostenibilidad: estrategias para jóvenes. Revista de Educación y Tecnología, 15(3), 101–118.
- López, M., & Ramírez, J. (2021). Plataformas digitales educativas y bienestar juvenil: Una revisión sobre contenidos y su impacto. Revista de Tecnología y Educación, 12(1), 77–95.
- Martínez, C., & Pérez, D. (2021). Uso de contenido filtrado en redes sociales para mejorar el bienestar y la motivación juvenil. Revista Iberoamericana de Comunicación Digital, 10(2), 55–70.
- Pérez, R., & Torres, F. (2021). Requisitos técnicos y recursos humanos en el desarrollo de proyectos web educativos. Revista de Ingeniería de Software, 14(2), 33–50.
- Rodríguez, J. (2020, noviembre 10). Aplicaciones web para el aprendizaje y la autonomía de los jóvenes. El País Tecnología. Recuperado de https://elpais.com/tecnologia/2020-11-10/aplicaciones-web-para-jovenes.html
- Fernández, A., & González, L. (2019). El impacto de las redes sociales en la salud mental de adolescentes: Estrategias de prevención. Revista de Psicología y Sociedad, 34(2), 123–140.

---

**Fin del documento**
