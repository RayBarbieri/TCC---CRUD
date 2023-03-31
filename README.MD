# Criação de projeto e CRUD básico no Laravel 9

## Passos

- Criação do Projeto
- Criação do Modelo
- Criação do Banco de Dados
- Criação da Migration
- Criação do Controller
- Criação das Rotas
- Criação das Views

## Comando uteis
- php artisan serve - Inicia o servidor local do Laravel

## Criação do Projeto

É necessário ter o composer instalado na máquina. Para instalar o composer, basta seguir o tutorial do próprio site do composer: https://getcomposer.org/download/

Após a instalação do composer, basta executar o comando abaixo para criar o projeto:

     composer create-project --prefer-dist laravel/laravel GatoFe

GatoFe é o nome do projeto. O nome pode ser qualquer um.

## Criação do Modelo

Um modelo é uma classe que representa uma tabela do banco de dados. Para criar um modelo, basta executar o comando abaixo:

O nome do modelo deve ser no singular e no padrão CamelCase.

    php artisan make:model Gato

O modelo é utilizado para fazer a comunicação com o banco de dados.

Dentro do modelo devemos definir:
- A tabela que ele representa (table)
- Os campos da tabela (fillable)

Os modelos ficam na pasta: app/Models/...

## Criação do Banco de Dados
O banco de dados é o lugar onde as informações são armazenadas. O banco de dados pode ser criado com qualquer tipo de SGBD (Sistema Gerenciador de Banco de Dados). Neste tutorial, será utilizado o MySQL.

Depois de criado devemos configurar o arquivo .env com as informações do banco de dados.

    DB_CONNECTION=mysql
    DB_HOST= - Endereço do banco de dados
    DB_PORT= - Porta do banco de dados
    DB_DATABASE= - Nome do banco de dados
    DB_USERNAME= - Usuário do banco de dados
    DB_PASSWORD= - Senha do banco de dados

## Criação da Migration
As migrations são responsáveis por criar as tabelas no banco de dados. Para criar uma migration, basta executar o comando abaixo:

    php artisan make:migration create_gatos_table

Para criar tabelas o nome do arquivo deve se iniciar com create_ e terminar com _table.

Dentro da migration devemos definir:
- O nome da tabela (table)
- Os campos da tabela (fillable)

As migrations ficam na pasta: database/migrations/...

Para criar os campos dentro da migration devemos utilizar os métodos diponiveis na documentação do laravel: https://laravel.com/docs/9.x/migrations#creating-columns

Após criar a migration, basta executar o comando abaixo para criar a tabela no banco de dados:

    php artisan migrate

## Criação do Controller

O controller é responsável por receber as requisições e retornar as respostas feitas pelo usuário através das views e das rotas. O controller receber um pedido, processa a informação e retorna uma resposta. A resposta pode ser uma view (uma página), um json (formato de dados para javascript*) ou um redirecionamento (redireciona para outra página).

Para criar um controller, basta executar o comando abaixo:

    php artisan make:controller GatosController

O nome do controller deve ser no plural e no padrão CamelCase. O controller deve ser criado dentro da pasta app/Http/Controllers.

Dentro do controller devemos definir as *funções* que serão utilizadas para cada rota (ações do usuário);

Por padrão um CRUD possui as seguintes ações:
- index - Lista todos os registros
- create - Mostra o formulário para criar um registro
- store - Salva o registro no banco de dados
- show - Mostra um registro específico
- edit - Mostra o formulário para editar um registro
- update - Atualiza o registro no banco de dados
- destroy - Deleta o registro no banco de dados

## Criação das Rotas

As rotas são responsáveis por receber as requisições do usuário e direcionar para o controller correto. As rotas ficam na pasta routes/web.php.

Cada rota possui um método (get, post, put, delete) e uma url. O método é utilizado para definir o tipo de requisição que a rota irá receber. A url é a url que o usuário irá acessar para acessar a rota. Por convenção também definimos um nome para a rota. Ex:

    Route::get('/gatos', 'GatosController@index')->name('gatos.index');

No exemplo acima, estamos criando uma rota do tipo get que irá acessar a url /gatos e irá direcionar para o controller GatosController e para a função index. Também definimos um nome para a rota. O nome da rota é utilizado para gerar links para as rotas dentro das telas.

Cada rota possui um método:

    - get - Recebe uma requisição do tipo get. Utilizado para solicitar dados do servidor.
    - post - Recebe uma requisição do tipo post. Utilizado para enviar dados para o servidor.
    - put - Recebe uma requisição do tipo put. Utilizado para atualizar dados no servidor.
    - delete - Recebe uma requisição do tipo delete. Utilizado para deletar dados no servidor.

## Criação das Views

As views são as telas que o usuário irá interagir. As views ficam na pasta resources/views. O laravel disponibiliza um motor de processamento de templates chamado Blade. O Blade é um motor de templates simples e rápido. O Blade é utilizado para gerar as views.

Para criar uma view, basta criar um arquivo com a extensão .blade.php dentro da pasta resources/views.

Por conveniencia as views são organizadas em pastas com o mesmo nome do controller. Ex: O controller GatosController possui as views dentro da pasta resources/views/gatos.

Para utilizar links para as rotas dentro das views, basta utilizar o comando abaixo:

    <a href="{{ route('gatos.index') }}">Gatos</a>

O comando acima irá gerar um link para a rota gatos.index, que é a rota que lista todos os gatos e que foi definida em routes/web.php.

Para utilizar variáveis dentro das views, basta utilizar o comando abaixo:

    {{ $gato->nome }}

O comando acima irá mostrar o nome do gato que está sendo exibido na view. Note que as chaves duplas são utilizadas para mostrar o valor da variável. As chaves simples são utilizadas para executar comandos do Blade.

Os comandos do Blade são definidos na documentação do Laravel: https://laravel.com/docs/9.x/blade

## Preenchendo o Controller e as Views

### Index - Lista com todos os registros

Quando o usuário acessa a rota '/gatos' o controller GatosController irá executar a função index. A função index irá buscar todos os registros da tabela gatos e irá retornar a view gatos.index com os registros.

    public function index()
    {
        $gatos = Gato::all();
        return view('gatos.index', compact('gatos'));
    }

No arquivo de view gatos/index.blade.php, agora possuimos acesso a variável $gatos, nos permitindo utilizar laços de repetição (for, foreach, while) para exibir os registros.

    @foreach ($gatos as $gato)
        <tr>
            <td>{{ $gato->nome }}</td>
            <td>{{ $gato->raca }}</td>
            <td>{{ $gato->idade }}</td>
        </tr>
    @endforeach

### Create - Mostra o formulário para criar um registro

Quando o usuário acessa a rota '/gatos/novo' o controller GatosController irá executar a função create. A função create irá retornar a view gatos.create.

    public function create()
    {
        return view('gatos.create');
    }

Dentro da view gatos/create.blade.php, devemos criar um formulário para criar um novo registro. O formulário deve ser do tipo post e deve apontar para a rota gatos.store.

    <form action="{{ route('gatos.store') }}" method="post">
        @csrf
        <input type="text" name="nome" placeholder="Nome">
        <input type="text" name="raca" placeholder="Raça">
        <input type="number" name="idade" placeholder="Idade">
        <button type="submit">Salvar</button>
    </form>


    Obs: Note o uso do *@csrf* no formulário. O @csrf é um comando do Blade que gera um token de segurança para o formulário. O token de segurança é utilizado para evitar ataques de falsificação de solicitação entre sites.

    Obs: *Cada campo não pode ter o mesmo nome. O nome do campo deve ser o mesmo nome do campo na tabela do banco de dados.*

### Store - Salva o registro no banco de dados

Quando o usuário preenche o formulário e clica em salvar, o formulário irá enviar uma requisição do tipo post para a rota gatos.store. A rota gatos.store irá direcionar para o controller GatosController e para a função store.

    public function store(Request $request)
    {
        $gato = new Gato();

        $gato->nome = $request->nome;
        $gato->raca = $request->raca;
        $gato->idade = $request->idade;
        $gato->save();

        return redirect()->route('gatos.index');
    }

Após salvar o registro no banco de dados, devemos redirecionar o usuário para a rota gatos.show, que mostra os detalhes do gato cadastrado

### Show - Mostra os detalhes de um registro

Quando o usuário acessa a rota '/gatos/{gato}' o controller GatosController irá executar a função show. A função show irá buscar o registro com o id passado na url e irá retornar a view gatos.show com os detalhes do registro.

    public function show(Gato $gato)
    {
        return view('gatos.show', compact('gato'));
    }

### Edit - Mostra o formulário para editar um registro

Quando o usuário acessa a rota '/gatos/{gato}/editar' o controller GatosController irá executar a função edit. A função edit irá buscar o registro com o id passado na url e irá retornar a view gatos.edit com os detalhes do registro para edição.

    public function edit(Gato $gato)
    {
        return view('gatos.edit', compact('gato'));
    }

Dentro da view gatos/edit.blade.php, devemos criar um formulário para editar o registro. O formulário deve ser do tipo post e deve apontar para a rota gatos.update.

    <form action="{{ route('gatos.update', $gato->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="nome" placeholder="Nome" value="{{ $gato->nome }}">
        <input type="text" name="raca" placeholder="Raça" value="{{ $gato->raca }}">
        <input type="number" name="idade" placeholder="Idade" value="{{ $gato->idade }}">
        <button type="submit">Salvar</button>
    </form>

    Obs: Note o uso do *@method('PUT')* no formulário. O @method é um comando do Blade que gera um input hidden com o valor passado no parâmetro. O input hidden é utilizado para informar o método da requisição.

### Update - Salva as alterações do registro no banco de dados

Quando o usuário preenche o formulário e clica em salvar, o formulário irá enviar uma requisição do tipo post para a rota gatos.update. A rota gatos.update irá direcionar para o controller GatosController e para a função update.

    public function update(Request $request, Gato $gato)
    {
        $gato->update($request->all());

        return redirect()->route('gatos.show', $gato->id);
    }

Após salvar as alterações no banco de dados, devemos redirecionar o usuário para a rota gatos.show, que mostra os detalhes do gato cadastrado.

### Destroy - Deleta o registro do banco de dados

Quando o usuário clica em excluir, o formulário irá enviar uma requisição do tipo post para a rota gatos.destroy. A rota gatos.destroy irá direcionar para o controller GatosController e para a função destroy.

    public function destroy(Gato $gato)
    {
        $gato->delete();

        return redirect()->route('gatos.index');
    }

Após deletar o registro do banco de dados, devemos redirecionar o usuário para a rota gatos.index, que mostra a lista de gatos cadastrados.

No lugar onde o usuário vai clicar para excluir o registro, devemos criar um formulário do tipo post e apontar para a rota gatos.destroy.

    <form action="{{ route('gatos.destroy', $gato->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Excluir</button>
    </form>

    Obs: Note o uso do *@method('DELETE')* no formulário. O @method é um comando do Blade que gera um input hidden com o valor passado no parâmetro. O input hidden é utilizado para informar o método da requisição.

# 5. Conclusão

Neste tutorial, aprendemos como criar um CRUD completo utilizando o Laravel. O Laravel é um framework PHP que facilita o desenvolvimento de aplicações web. O Laravel possui uma série de recursos que facilitam o desenvolvimento de aplicações web, como: rotas, controllers, models, migrations, views, entre outros.
