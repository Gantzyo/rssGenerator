# rssGenerator

rssGenerator is a personal project that I built for a very specific use case. I wanted to play a little bit with Medoo and some PHP features that I never used like namespaces and strong typing.

This project isn't intended for public usage so please avoid reporting any issues.

It's kinda documented in Spanish therefore I'll let it as a public repository and it might help somebody sometime.

Spanish documentation comes right after this line!

## Acerca de

rssGenerator es un proyecto personal que hice para un caso de uso muy concreto. Quería jugar un poco con Medoo y algunas características de PHP que nunca había usado como los namespaces y tipado fuerte.

Este proyecto no está destinado al uso público, por lo tanto, evite reportar cualquier problema.

Está más o menos documentado en español, por lo tanto, lo dejaré como un repositorio público y quizá ayude a alguien en algún momento.

## Uso

Se trata de un par de scripts en PHP para generar RSS de las publicaciones en Hispashare/DescargasDD

1. Llama a `public/update.php` cada X tiempo mediante un cronjob para detectar posibles actualizaciones en los sitios activados
2. Llama a `public/rss.php?id=ID_FEED` para obtener el RSS del feed indicado

## Instalación

1. Descarga el proyecto: `git clone https://github.com/Gantzyo/rssGenerator.git`
2. Instala las dependencias:

    ```bash
    composer install
    ```

3. Importa la estructura de base de datos de `docs/schema/rssgenerator_structure.sql`
4. (Opcional) Importa los datos mínimos para poder generar sitios de `docs/schema/rssgenerator_data.sql` o crea los tuyos propios
5. Genera las entradas en base de datos:
    * **rssgenerator_type**: Contiene los tipos de sitios (Hispashare, DescargasDD)
    * **rssgenerator_cookie**: Contiene las cookies utilizadas para cada tipo de sitio
    * **rssgenerator_site**: Contiene la lista de sitios que se pueden usar en un RSS
    * **rssgenerator_last_site_update**: Contiene la última actualización detectada en un sitio para saber si hay que generar alguna entrada nueva
    * **rssgenerator_user**: Contiene la lista de usuarios que pueden acceder al generador de RSS
    * **rssgenerator_userrss**: Contiene la relación entre usuarios y sitios para saber qué entradas queire ver el usuario en su RSS
6. Configura la conexión a base de datos dentro del fichero `src/config/DbConnection.php`

## Dependencias

Aunque gracias a `composer` ya están declaradas en el fichero `composer.json` dejo los enlaces a los repositorios a continuación:

* Medoo: <https://medoo.in/> | <https://packagist.org/packages/catfan/medoo>
* Requests for PHP: <https://github.com/rmccue/Requests> | <https://packagist.org/packages/rmccue/requests>
* QueryList: <https://github.com/jae-jae/QueryList> | <https://packagist.org/packages/jaeger/querylist>

## TODO

* Montar una API REST con [Slim](http://www.slimframework.com/)
* Montar un MVC en el front con [Vue](https://vuejs.org/)
* Hacer la aplicación multiusuario. Cada usuario puede gestionar:
  * Sus feeds
  * Los sitios de cada feed
  * Su propio método de acceso a la web
* Almacenar más de una entrada de cada sitio
* Permitir autenticación basic para los sitios
* Entender por qué quiero montar algo tan tocho cuando ya existen mil herramientas de este estilo