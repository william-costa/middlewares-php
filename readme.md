# Implementation of middleware without frameworks in PHP

A implementação consiste basicamente em um classe que gerencia a sequencia de execução dos middlewares, como se estivessem em uma fila (`\App\middlewares\queue\MiddlewareQueue`).

As filas de middlewares são mapeadas por arrays disponíveis na pasta `app/middlewares/queue/maps` e o mapa deve ter uma estrutura semelhante ao codigo abaixo (alterando apenas os middlewares necessários):
```php
<?php

return [
  "\\App\\middlewares\\request\\MiddlewareRequestPostValidation",
  "\\App\\middlewares\\auth\\MiddlewareAuth",
  "\\App\\middlewares\\request\\MiddlewareRequestBodyValidation",
  "\\App\\middlewares\\response\\MiddlewareJsonResponse",
];

?>
```

Para obter os mapas o seguinte método deve ser utilizado:
```php
<?php

MiddlewareQueue::getMap('mapNameWithoutExtension')

?>
```

A fila de middlewares implementa a interface `MiddlewareInterface` e por isso ela é sempre a instancia `$delegate` dos middlewares e cuida de apontar o próximo middleware que realmente deve ser executado.

Para executar uma fila de middlewares basta instanciar a classe filas passando uma implentação de `RequestInterface` e o array com o mapa dos middlewares.

```php
<?php

echo (new MiddlewareQueue)->run(new \App\request\HttpRequest(),MiddlewareQueue::getMap('default'));

?>
```

____________

## Teste implementado

Neste teste foram implementados 4 middlewares:
- **MiddlewareRequestPostValidation**: responsável por validar se a requisição recebida é do tipo POST;
- **MiddlewareAuth**: responsável por validar a autenticação do usuário (HTTP HEADER);
- **MiddlewareRequestBodyValidation**: Responsável por validar campos obrigatórios no corpo da requisição;
- **MiddlewareJsonResponse**: Responsável por formatar o retorno da API em JSON;

Para obter um response de sucesso, a requisição deve atender aos requisitos abaixo:
- Requisição via POST;
- Headers `user` e `pass` com os valores `usuario` e `1234`, respectivamente;
- Body deve conter os campos `nome` e `valor`, sendo que o nome não pode estar vazio e o valor deve ser numérico.

Caso a sua requisição não atenda a algum dos requisitos, você receberá um response de erro semelhante ao exemplo abaixo:
```json
{
    "error": "Somente requisições POST são permitidas"
}
```

Exemplo de requisição de sucesso:
```bash
curl -X POST \
  http://localhost/ \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -H 'pass: 1234' \
  -H 'user: usuario' \
  -d '{
  "nome":"teste",
  "valor":100.00
}'
```

Response de sucesso:
```json
[
    {
        "middleware": "Requisição POST",
        "sucesso": true
    },
    {
        "middleware": "Autenticação",
        "sucesso": true
    },
    {
        "middleware": "Campos obrigatórios",
        "sucesso": true
    },
    {
        "middleware": "JSON Response",
        "sucesso": true
    }
]
```
