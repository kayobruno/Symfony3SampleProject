# SampleProject

A Symfony project created on November 21, 2019, 2:15 pm.

Exemplo de projeto Symfony, com login no Google, além da base da API, das exceções, etc.

## Pré-requisitos
Para execução, é necessário [PHP](http://php.net/) 7.2 ou superior e [Composer](https://getcomposer.org/), para instalação das dependências.

## Instalação

Assim como a maioria dos projetos PHP modernos, instala-se as dependências com o seguinte comando, que, ao final, solicitará a configuração dos parâmetros da aplicação:

```bash
composer install
```

Em seguida, criar as chaves para geração e validação dos JWTs.
```bash
openssl genrsa -out var/jwt/private.pem -aes256 4096
openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
```

É necessário criar o esquema do banco de dados. As _migrations_ serão desenvolvidas no futuro.
```bash
bin/console doctrine:schema:update --force
```

## Execução

Para criar um usuário, o seguinte comando é útil:

```bash
bin/console fos:user:create
```
Serão solicitados: `username`, `email` e `password` do novo usuário.

Para efetuar o login, deve-se enviar um POST para `/api/login`, com o seguinte payload:
```json
{
  "username": "my_username",
  "password": "12345"
}
```
Será gerado um JWT, que deve ser utilizado nas próximas requisições, através do cabeçalho "`Authorization`" e conteúdo "`Bearer <jwt>`".

### Desenvolvimento

O projeto já está pronto para execução em ambiente de desenvolvimento.

```bash
bin/console server:run
```

### Produção

Um requisito importante do Symfony é que o diretório `var` deve ter permissão de escrita pelo servidor, seja ele Apache, Nginx ou outro.
Para isso, os passos da [documentação oficial](https://symfony.com/doc/3.4/setup/file_permissions.html) devem ser seguidos.

Abaixo segue o modelo para SOs que suportam `setfacl` (Linux/BSD).

```bash
HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
```

No macOS (menos comumente utilizado em produção) deve-se escolher a opção que utiliza `chmod +a`.

Tambem é necessario configurar os comandos descritos [aqui](src/AppBundle/Command/cron-jobs.md)



