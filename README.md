# BASE DE DADOS

Para criação da base, criar um data base com o nome `kabum`, e executar este [script]('./outros/script.sql')

# API

A API criada em PHP pode deve ser executada utilizando o comando:

```
$ php -S 127.0.0.1:8000
```

Os endpoints da API podem ser executado via POSTMAN, por esta [coleção]('./outros/Backend.postman_collection.json')


# APP

A aplicação foi desenvolvida em react.js, para executá-la, realize os seguintes comandos:

1. ``npm install``
2. ``yarn start`` ou ``npm start``


# LOGIN

O login pode ser executado por 2 usuários:

```
email: user1@email.com
senha: teste123
```

```
email: user2@email.com
senha: teste123
```

Foram criados 2 usuários para mostrar a divisão de clientes de acordo com o usuário que o criou.





# Futuras implementações

- Frontend possuir o crud de endereços
- Melhorar a tela Home
- Colocar a validação do token em cada chamada REST, para que seja obrigatório seu uso no HEADER
- Implementar o tempo de expiração do token
- Arrumar o logout
- Realizar as tratativas de erros