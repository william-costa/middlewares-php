# Middlewares em PHP

Implementação básica de Middlewares em PHP sem a utilização de frameworks e seguindo a PSR-15.

Exemplo didático criado para o 2º WapSchool DEV (Dez/2018)

## Teste de requisição

Neste teste foram implementados 3 middlewares:
- **HttpMethodMiddleware**: responsável por validar o método da requisição;
- **AuthenticationMiddleware**: responsável por validar a autenticação do usuário (HTTP HEADER);
- **BodyParamsMiddleware**: Responsável por validar campos obrigatórios no corpo da requisição;

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
