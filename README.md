# rssGenerator

Scripts en PHP para generar RSS de las subidas en Hispashare/DescargasDD

1. Genera las entradas en BBDD:
    * **rssgenerator_type**: Contiene los tipos de sitios (Hispashare, DescargasDD)
    * **rssgenerator_cookie**: Contiene las cookies utilizadas para cada tipo de sitio
    * **rssgenerator_site**: Contiene la lista de sitios que se pueden usar en un RSS
    * **rssgenerator_last_site_update**: Contiene la última actualización detectada en un sitio para saber si hay que generar alguna entrada nueva
    * **rssgenerator_user**: Contiene la lista de usuarios que pueden acceder al generador de RSS
    * **rssgenerator_userrss**: Contiene la relación entre usuarios y sitios para saber qué entradas queire ver el usuario en su RSS

2. Llama a **SCRIPT_DE_UPDATES** cada X tiempo mediante un cronjob para detectar posibles actualizaciones en los sitios activados
3. Llama a **SCRIPT_DE_RSS?idUser=XXX** para obtener el RSS del usuario indicado

## Librerías

* Requests for PHP: https://github.com/rmccue/Requests
* PHPQuery: https://github.com/TobiaszCudnik/phpquery | https://code.google.com/archive/p/phpquery/
* ezSQL: https://github.com/ezSQL/ezSQL