CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `senha` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;


CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `idusuario` bigint NOT NULL,
  `nome` varchar(256) NOT NULL,
  `data_nascimento` varchar(256) NOT NULL,
  `cpf` varchar(256) NOT NULL,
  `rg` varchar(256) NOT NULL,
  `telefone` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (idusuario) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;


CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `idcliente` bigint NOT NULL,
  `rua` varchar(256) NOT NULL,
  `cep` varchar(256) NOT NULL,
  `bairro` varchar(256) NOT NULL,
  `cidade` varchar(256) NOT NULL,
  `estado` varchar(256) NOT NULL,
  `numero` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (idcliente) REFERENCES clientes(id) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;


INSERT INTO usuarios(id, nome, email, senha) VALUES (1,'user1','user1@email.com','$2y$10$f51kBVRmignDrloIZsXoi.r06eMRAOT/dI0FYkO1aXrbSfOoad3DK');
INSERT INTO usuarios(id, nome, email, senha) VALUES (2,'user2','user2@email.com','$2y$10$f51kBVRmignDrloIZsXoi.r06eMRAOT/dI0FYkO1aXrbSfOoad3DK');

INSERT INTO clientes(
	id, idusuario, nome, data_nascimento, cpf, rg, telefone)
	VALUES (1,1,'Fernando Lima', '1992-02-17 00:00:00', '12312312312', '121231231', '123451234');
	
INSERT INTO enderecos( idcliente, rua, cep, bairro, cidade, estado, numero) 
VALUES (1,'rua teste 1','cep teste 1','bairro teste 1','cidade teste 1','estado teste 1','numero teste 1');

INSERT INTO enderecos( idcliente, rua, cep, bairro, cidade, estado, numero) 
VALUES (1,'rua teste 2','cep teste 2','bairro teste 2','cidade teste 2','estado teste 2','numero teste 2');

INSERT INTO clientes(
	id, idusuario,nome, data_nascimento, cpf, rg, telefone)
	VALUES (2, 2,'Testando Dois', '1992-02-18 00:00:00', '11122233344', '112223334', '123451234');
	
INSERT INTO enderecos( idcliente, rua, cep, bairro, cidade, estado, numero) 
VALUES (2,'rua teste 3','cep teste 3','bairro teste 3','cidade teste 3','estado teste 3','numero teste 3');

INSERT INTO enderecos( idcliente, rua, cep, bairro, cidade, estado, numero) 
VALUES (2,'rua teste 4','cep teste 4','bairro teste 4','cidade teste 4','estado teste 4','numero teste 4');