M07
wiki Jose: https://docencia.proven.cat/jmoreno/wiki/doku.php?id=docencia:dawbi:m07:uf4:laravel
user: student
pass: proven

22/09
https es el protocol d'intercanvi de informació, HTTPS vol dir que es segur. La infomració va xifrada. 
http no es segur. La informació va amb text pla.

Nom complert de domini (Full qualified domain name): www.proven.cat. Especifica univocamnet el servidor. DNS
.cat: domini arrel.
:80 es el port de comunicació determinat, per defecte es el 80.
/intraweb/index.php: aixo es el recurs. 

El client va una petició get al servidor, es un mode de petició per obtenir un recurs.
Però no li dona el fitxer php, sino el resultat de la seva executació, el server executa la pagina php i el resultat es el que li dona el server al client.
Al final el resultat li envia el client. Es html, javascript, que es el que enten el navegador.
Resposta 200 OK
         404 not found

Les cookies viatgen al header de la peticio.


Servidor web: volem un servidor local com a servidor de desenvolupament, per fer proves.
Apache2.
Apache te el seu propi usuari, i no podra escriure a la carpeta publictarda. 
var/www on es pengen les pag web per publicar.

http://localhost/~tarda/index.html

tarda@tarda:~/public_html$ php index.php

PHP no es un llenguatge compilat.
No es declara el tipus de les variables.


25/09
si el doc es nomes de php, l'etiqueta de tancament no es posa.
$x=== $y mira si el valor i el tipus son igual: exemple:
$x=5;
$y= "5"; 
tenen el mateix valor pero diferent tipus.

include i require serveixen per incloure fitxers php a un altre.

2 funcions per imprimir a la pantalla:
- echo "Hola";
- print ("Hola");


empty vs isset, hi ha petites diferencies
isset comprova si la variable esta creada
unset destrueix una variable de la memoria.

29/09
Les constants no tenen $, es defineixen
Les cometes simples mantenen el text i no tradueixen les var en el seu valor. Les dobles si que el tradueixen

heredoc:contrueix un string <<< EOT
                           EOT;
es com posarho tot amb una linia, pero visualment surt amb els canvis de linia correctes.
nowdoc equivalent pero tanca amb comentes simples. 
Es util quan volem escriure un codi HTML llarg.

Funcio explode: per contar paraules per exemple delimitades per un delimitador.

Funcions multibyte serveixen per treballar amb UTF8.
Al header diem si volem que treballem amb UTF8

VARIABLES SUPERGLOBALS
son variables de varis scripts php.
$_SERVER: informacio de la conecció al servidor
$_GET
$_POST



A partir de php 7, a una funcio li podem dir de quin tipus es el parametre. 

03/11/20
Com que cada peticio cap al servidor es independent de una altra, ja que diversos PC poden fer moltes peticions a la vegada, ens cal una manera d'identificar el client.

**COOKIE**
Informacio en format text que el servidor envia al client i el client ho guarda a la memoria del navegador.
Quan el client torna a enviar la peticio, a la capcelera posa la cookie. Es una manera didentificar el client per part del servidor. 
Hi ha un array associatiu per les cookies: $_COOKIES

 Les cookies són parelles nom:valor que s'emmagatzemen a l'ordinador client i que viatgen a les capçaleres (headers) de les peticions http. Aquesta informació s'utilitza per a finalitats molt diverses, com ara autenticació, selecció de preferències, etc.).

Normalment, és el servidor qui crea les cookies i les inclou a la capçalera de la resposta a una petició http. El navegador del client desa les cookies (nom i valor) així com la identificació del servidor que les ha enviades.

PHP proporciona per a la creació de cookies la funció setcookie(). Al igual que la resta d'elements de l'encapçalament, les cookies s'han de crear abans de generar cap sortida, és a dir, abans d'escriure el contingut de la pàgina de resposta.  (abans de fer cap echo)

Cada cookie va associada a un domini concret que es el que lha creat. (domini = pag web)

Quan generem headers, ha de començar abans d'imprimir el resultat. Abans de la sortida, de contigut de la resposta
En una peticio http hi ha el header i el body.

Una cookie s'esborra fent que caduqui, i li posem un temps de vida anterior al actual.
Cada vegada que refresquem la pag la data de caducitat es renova.
La data de caducitat es obligatoria i es posa en segons. 

**Sessions**
Les sessions s'utilitzen per preservar dades entre successives peticions del mateix client. 
Serveix per guardar dades del client pero al servidor.
Cada sessió té associat un identificador únic i un espai de memòria per a emmagatzemar variables de sessió. Aquestes variables són accessibles en PHP amb l'array associatiu superglobal $_SESSION. 


## POO
Les classes:
El nom del fitxer i de la la classe no cal que sigui igual com a Java: exemple: person.class.php i class Person {}
Només hi ha un contructor: _construct.
Els metodes que comencen en _ son metodes magics.
El punt es per concatenar strings, no per accedir a metodes. Per accedir a metodes es fa: ->

El to String tambe es un metode magic i l'ha classe l'ha de tenir. El to string es pel programador, no per la vista. Es per depurar.

Les classes abstracte tenen metodes que encara no hem definit, aixi no les podem instanciar.
Normalment te la informació bàsica, que te tothom de la seva herencia. 

::_ operador de resolucio dambit

Els namescpaces es fan servir per eviatar declarar variables o metodes que ja existeixin i que entrin en conflicte. 
No te res a vure amb el directori (com si els paquets de Java)




22/01/2021

### UF2. Arquitectura client servidor
Sempre per obrir fitxers es  millor en binari, per evitar conflicte en editors.
-> Servix quan donat un obj accedir a una propietat daquell obj

feof marca el final del fitxer quan hi hem arribat, quan hem Intentat llegir i no avancem.

self:: per accedir (el nom de la classe = self) a un atribut estatic o constant = fa referencia a un classe, en canvi this fa referencia a un obj, cal haver fet un new abans.

## MVC
Les peticions sempre a index.html.


26/02/2021
mySQLi es de mes baix nivell, i ara casi no es fa servir.
La PDO te una capa de absatraccio mes gran i permet programar la mateixa base de dades de qualsevol manera.



09/04/2021
## LARAVEL
Aplications hibrides: https://www.fhios.es/ca/desenvolupant-apps-hibrides-natives/

/****rutes anidables***/
composer es un gestor de paquets per php
localhost/app/user/name -> ruta anidables, tot amb barres. Es el que fan servir els webservices

cal dir a apache q instali un modul q sigui capaç de interpretar les rutes anidables: sudo a2enmod rewrite


16/04/2021
LARAVEL es un framework que permet implementar l'arquitectura MVC en php i tambe el mapeig obj-relacional.
Estructura de directoris del projecte Laravel:
- public: dir arrel
- config
- storage i bootstrap/cache: cal que el servidor web tingui permisos descriptura a aquestes carpetes

.htaccess es posa en cada dir de laplicacio o com a min a larrel i defineix permisos a cada directori. Es el que mira apache per accedir els dir.

URL no amigable: localhost/myapp/index.php?action=list_all_products
URL amigable: localhost/myapp/products/all

En el segon cas no li diem quin fitxer php executar. Aixo funciona amb el modul activat rewrite. Cal definir un mapeig per traduir una ruta a una altra. Es fa dintre del fitxer htaccess


**SINTAXIS LARAVEL**
Conecta automaticament la vista, html amb el control -> Blade
{{ $user->name }} : injection,permet injectar una variable dintre de la vista

@if - @endif : per si volem que elements es vegin o n, com el ngIf* de angular
@foreach - @endforeach

*Directives:
@yield: directiva per definir la posicio duna seccio en una plantilla
@extends: la vista que estic creant es una extencio dun altre, es base en lesquema predefinit abans. Aixi canviant lesquema general es canvien totes
@section: defineix una secccio que anira colocada on posi @yield


*Generar fixers
php artisan make:controller nom-controlador

*Rutes
Es defineixen en el fitxer app/Http/routes.php
- Rutes amb funcions anonimes:
  

```Route::get('/', function(){
	return view('welcome');
}
```

- Rutes amb controladors 

```Route::get('notes', [NotesController::class, index')];```

Veure les rutes: ```php artisan route:list```

La funcio Request() per obtenir les dades enviades en una petició.




23.04.2021
**TINKER**
php artisan tinker
DB::table('items')->insert(['title' =>'title01', 'content'=>'content01']);

DB::table('items')->get(); //format json per obtenir totes les dades
DB::table('items')->where('title', 'title02')->first();





    









