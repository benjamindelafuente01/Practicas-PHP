📸 Proyecto de Gestión de Fotos (Galeria Dinámica)

Este proyecto es una pequeña aplicación web donde puedes cargar, visualizar y eliminar fotos desde una
base de datos utilizando tecnologías como PHP y MySQL.

🛠️ Tecnologías utilizadas
* Lenguaje principal: PHP.
* Base de datos: MySQL.
* Frontend: HTML5 y CSS3.

🎯 Funcionalidades
* Subir imagen: El usuario puede cargar imágenes desde su dispositivo.
* Ver galería: Las imágenes se muestran en una galería que puede paginarse.
* Eliminar imagen: Puedes eliminar imágenes de forma segura tanto de la base de datos como del servidor.
* Ver detalles: Cada imagen tiene una descripción que puede ser vista al hacer clic en la miniatura (titulo
  y descripción de la imagen).

🚀 Uso
* Subir fotos: Dirígete a la sección de "Agregar"; selecciona una imagen y dale un título y descripción.
* Ver galería: Navega por la galería para visualizar todas las imágenes subidas.
* Eliminar fotos: Haz clic en una imagen y selecciona "Eliminar" para borrarla.

📂 Estructura de carpetas
/Practica-Galeria-Dinamica
│
├── /Connection         # Archivos de conexión, configuración y consultas a la base de datos
├── /CSS                # Hoja de estilos para el sitio
├── /fotos_subidas      # Carpeta donde se almacenan las imágenes subidas
├── /Icons              # Carpeta con los iconos de la aplicación
├── /imagenes_ejemplo   # Carpeta con imagenes de ejemplo para cargar en el sitio
├── /Views              # Vistas HTML/PHP
├── eliminar_foto.php   # Script llama a la clase que elimina la imagen seleccionada de la base de datos y la carpeta
├── index.php           # Página principal del proyecto
├── mostrar_foto.php    # Script que trae la imagen seleccionada de la base de datos y la muestra en la vista
└── subir_foto.php      # Script que llama a la clase para insertar una nueva foto en la base de datos y añadirla a la carpeta

🛢️ Base de datos
* Un nombre cualquiera en para tu base de datos, recuerda que debes definir el servidor, nombre y usuario en el 
archivo Connection/config.php
* La conexion es al gestor MySQL.
* Se utiliza la librería de PDP 'PDO'.

🗄️ Estructura de la tabla principal 'fotos'
```SQL
-> CREATE TABLE fotos (
                      id INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                      titulo VARCHAR(50) NOT NULL,
                      nombre TEXT NOT NULL,
                      descripcion VARCHAR(200) NOT NULL
                      );

```

⚙️ Funcionalidades clave del código

Subir imágenes al servidor:
* Se verifica que sea una imagen válida accediendo a la variable global $_FILES, en donde mediante el metodo
'getimagesize()', obtenemos un arreglo con las características principales de la imagen, y en caso de no ser
una imagen devuelve 'false'.
* Se define la carpeta donde se almacenarán las imagenes que el usuario suba.
* Accedemos nuevamente a la variable global $_FILES, en 'tmp_name' donde se almacena el archivo subido por el
usuario de manera temporal y mediante el método 'move_uploaded_file()' movemos a la carpeta seleccionada.

```php
// En tmp_name se guarda temporalmente y almacena las caracteristicas. Obtenemos un arrreglo
$verificar_imagen = @getimagesize($_FILES['archivo_foto']['tmp_name']);
// Nombre de la carpeta destino
$carpeta_destino = 'fotos_subidas/';                     
// Carpeta destino + Nombre del archivo subido (recuperamos el nombre para mantenerlo)
$archivo_subido = $carpeta_destino. $_FILES['archivo_foto']['name'];    
// Guardamos archivo (lo sacamos de la ruta temporal y colocamos en la ruta destino)
move_uploaded_file($_FILES['archivo_foto']['tmp_name'], $archivo_subido);
```

Eliminar imágenes del servidor:
* Nuevamente definimos la carpeta donde se almacenan las imagenes que sube el usuario.
* Obtenmos la imagen y en caso de tener alguna ruta o caracteres especiales, accedemos al nombre base 
y sanitizamos mediante 'filter_var()'.
* Convertimos a una ruta relativa.
* Verificamos que el archivo exista.
* Eliminamos imagen de la carpeta mediante 'unlink()'.


```php
// Nombre de la carpeta
$carpetaImagenes = 'fotos_subidas/';
// Obtenemos el nombre de la imagen enviado (eliminamos rutas en caso de ternerlas y sanitizamos)
$nombre_imagen = filter_var(basename($_GET['nombre']), FILTER_SANITIZE_STRING);
// Convertimos una ruta relativa en una ruta absoluta
$rutaArchivo = realpath($carpetaImagenes . $nombre_imagen);
/*
Aseguramos que el archivo esté dentro de la carpeta. strpos() busca la posición donde la ruta de la imagen 
($rutaArchivo) comienza en relación con la ruta de la carpeta de imágenes (realpath($carpetaImagenes)).
*/
if (strpos($rutaArchivo, realpath($carpetaImagenes)) !== 0) {
    die('Acceso denegado.');
}
// Verificamos que el archivo exista (pasamos la ruta completa generada por realpath())
if (file_exists($rutaArchivo)) 
    /*
        Eliminamos imagen de la carpeta
    */
    if (unlink($rutaArchivo))
```