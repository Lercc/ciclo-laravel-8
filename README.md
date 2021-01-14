# LARAVEL 8.X
  - Laravel v8.22.1 (PHP v7.4.12)

## ELOQUENT
    - Eloquent es el ORM (Object-Relational Mapping) de Laravel que te permite una interacción amigable y 
      rápida concualquier Sistema de Gestión de Base de Datos(SGBD)
    - Permite MAPEAR las estructuras de una BASE_DATOS relacional mediante la lógica OBJETO-RELACIÓN
    - Consultas usuales de Eloquent:
      - ClassName::all()
      - ClassName::where('id','>=','10') -> get()
      - ClassName::where('id','>=','10') -> orderBy('id', 'desc') -> get()
      - ClassName::where('id','>=','10') -> orderBy('id', 'desc') -> talke(3) -> get()
      
      .
      .
      .

    - Relaciones en eloquent
      - uno a muchos: $this->hasMany(ClassName::class) 
      - muchos a uno: $this->belongsTo(ClassName::class)
    - Consultas en relacciones eloquent
      <pre>
        $users = User::all();
        foreach($users as $user) {
          echo "$user->id  $user->name { $user->posts->count() } </br>";
        }
      <pre>
      <pre>
        $posts = Post::all();
        foreach($posts as $post) {
          echo "$post->id  { $post->user->name } $post->name </br>";
        }
      <pre>

## MIGRATIONS
    - Representan a las tablas y los respectivos campos(atributos) de cada entidad(modelo) creada.
    - Para crear las tablas y sus atributos en la BD
      <pre>php artisan migrate</pre>
    - Para actulizar las tablas y sus atributos en la BD
      <pre>php artisan migrate:refresh</pre>

## FACTORY
    - Utiliza la libreria [FAKER](https://github.com/fzaninotto/Faker) para crear datos de prueba en la DB.
    - Permite definir que contenido tendrá los campos de las Entidades en la BD.
    - Será ejecutado ya sea con el comando de SEED o con FACTORY por medio de Tinker.

## TIKER
    - Es una herramienta que nos permite interactuar con la DB en laravel utilizando Eloquent
    - Se utiliza con el objetivo de testear la BD, a travéz de la consola mediante el comando:
      <pre>php artisan tinker</pre>
    - Tinker te permite ejecutar código PHP, exáctamente permite utilizar Eloquent o 
      el Query Builder de laravel para realizar testeos CRUD.  
    - Tinker te también ejecutar los FACTORIES mediante el comando:
      - Para laravel 7.X:
        <pre>factory(App\ClassName::class, 10)->create()</pre>
      - Para laravel 8.X:
        <pre>App\Models\ClassName::factory(10)->create()</pre>

## COLECCIONES DE DATOS
    - Eloquent maneja las respuestas de las peticiones a la BD instanciando
      la clase collections, por ende respuesta contiene métod que podemos usar:
      
      <pre>
        $users = User::all();

        dd($users->contains(5));        //pregunta si existe un usuario con id 5, retorna true o false según si encuentra o no el dato
        dd($users->except([1,2,3]));    //devuelve la consulta excepto los datos de los id pasados por parámetro
        dd($users->only([1,3]));        //solo puede buscar por ID
        dd($users->find([1,2]));        //puede buscar por ID y por MODELOS 
        dd($users->load('posts'));
      </pre>

    - with() : carga las relaciones por adelantado y luego la consulta.
    - load() : ejecuta la consulta y luego las relaciones.
    Por ejemplo para un listado sería conveniente usar with() pero para un elemento podría usar load()

    - only() :solo puede buscar por ID y devuelve un array
    - find() : puede buscar por ID o por MODELO

## SERIALIZACIÓN DE DATOS
    - Manipulación de datos para retornarlos en array o Json:
      <pre>
        dd($users->toArray());  // devuelve los datos contenidos en arrays
        dd($users->toJson());   // devuelve los datos contenidos formato JSON
      </pre>

## PRESENTACIÓN Y MANIPULACIÓN DE DATOS EN LA CAPA DE LÓGICA
    - Aplicable como métodos en las entidades:
      <pre>
        Namespace App\Models\User
        .
        .
        .
        //GETTERS FORMAT ----> get'FormatFunctionName'Attribute 
        public function getNameUppercaseAttribute() {
          return strtouppercase($this->name);
        }
        public function getFullNameAttribute() {
          return "$this->first_name $this->last_name";
        }


        //SETTERS FORMAT ----> set'AttributeName'Attribute 
        public function setNameAttribute($value) {
          $this->attribute['name'] = strtolower($value);
        }
        public function setLastNameAttribute($value) {
          $this->attribute['last_name'] = ucfirst($value);
        }
      </pre>


## LARAVEL LANG ES VALIDATIONS
    - config\app -> locale => 'es'

    - resource\lang
      1. create folder 'es'
      2. capy and paste 'es/validations.php' from https://github.com/Laravel-Lang/lang
      3. run next line to watch changes 
        <pre>php artisan config:cache</pre>

### MIDDLEWARE: FILTROS A PETICIONES HTTP
    - Capa de lógica adicional de filtrado de peticiones HTTP


## ROUTE AVANZADO
    - Route::resource() -> Permite gestionar 7 rutas adjutadas a un Controlador con 7 métodos.
      - NameController@index        -> usualmente para listar
      - NameController@store        -> usualmente para salvar
      - NameController@create       -> usualmente para crear
      - NameController@show         -> usualmente para mostrar un registro
      - NameController@update       -> usualmente para actualizar
      - NameController@destroy      -> usualmente para eliminar
      - NameController@edit         -> usualmente para editar un registro


| Method    | URI               | Name          | Action                                      | Middleware |
|-----------|-------------------|---------------|---------------------------------------------|------------|
| GET|HEAD  | pages             | pages.index   | App\Http\Controllers\PageController@index   | web        |
| POST      | pages             | pages.store   | App\Http\Controllers\PageController@store   | web        |
| GET|HEAD  | pages/create      | pages.create  | App\Http\Controllers\PageController@create  | web        |
| GET|HEAD  | pages/{page}      | pages.show    | App\Http\Controllers\PageController@show    | web        |
| PUT|PATCH | pages/{page}      | pages.update  | App\Http\Controllers\PageController@update  | web        |
| DELETE    | pages/{page}      | pages.destroy | App\Http\Controllers\PageController@destroy | web        |
| GET|HEAD  | pages/{page}/edit | pages.edit    | App\Http\Controllers\PageController@edit    | web        |

    - Generar un controlador:
        <pre>php artisan make:controller [NameController]</pre>

    - Generar un controlador con los 7 métodos necesarios que utilizara Route::resource()
        <pre>php artisan make:controller [NameController] --resource || -r</pre>

    - Generar un controlador con los 7 métodos necesarios, así como el modelo para el controlador:
        <pre>php artisan make:controller [NameController] --resource --model</pre>

    - Generar un modelo con:
        - -a, --all             Generate a migration, seeder, factory, and resource controller for the model
        - -c, --controller      Create a new controller for the model
        - -f, --factory         Create a new factory for the model
        - -m, --migration       Create a new migration file for the model
        - -s, --seed            Create a new seeder file for the model
        - -r, --resource        Indicates if the generated controller should be a resource controller
        - --api             Indicates if the generated controller should be an API controller
        <pre>php artisan make:model [NameController] -a | -c | -f | -m | -s | -r | --api</pre>

## REQUEST
    - Capa de laravle que permite hacer validaciones fuera del controller en un request
      <pre>php artisan make:reques NameRequest</pre>

## LARAVEL UI
    - composer require laravel/ui --dev

    - php artisan ui bootstrap --auth
    - php artisan ui vue --auth
    - php artisan ui react --auth

    - instalar dependiencias de JS
        - npm install
    
    - ver las dependencias desactualizadas
        - npm outdate

    - actualizar las dependencias
        - npm update

    - compilar
        - npm run dev
