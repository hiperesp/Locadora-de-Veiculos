CREATE TABLE tb_cliente (
	 idCliente			INT				NOT NULL
	,nomeCliente		VARCHAR(255)	NOT NULL
	,cpfCliente			VARCHAR(11)		NOT NULL
	,cnhCliente			VARCHAR(11)		NOT NULL
	,logradouroCliente	VARCHAR(255)	NOT NULL
	,numCliente			INT				NOT NULL
	,complCliente		VARCHAR(32)		NOT NULL
	,bairroCliente		VARCHAR(64)		NOT NULL
	,cidadeCliente		VARCHAR(128)	NOT NULL
	,cepCliente			VARCHAR(8)		NOT NULL
	,ufCliente			VARCHAR(2)		NOT NULL
	,PRIMARY KEY(idCliente)
);

CREATE TABLE tb_usuario (
	 idUsuario			INT				NOT NULL
	,nomeUsuario		VARCHAR(255)	NOT NULL
	,loginUsuario		VARCHAR(64)		NOT NULL
	,senhaUsuario		VARCHAR(32)		NOT NULL
	,PRIMARY KEY(idUsuario)
);

CREATE TABLE tb_marca (
	 idMarca			INT				NOT NULL
	,nomeMarca			VARCHAR(32)		NOT NULL
	,PRIMARY KEY(idMarca)
);

CREATE TABLE tb_veiculo (
	 idVeiculo			INT				NOT NULL
	,idMarca			INT				NOT NULL
	,anoVeiculo			INT(4)			NOT NULL
	,corVeiculo			INT				NOT NULL
	,modeloVeiculo		VARCHAR(32)		NOT NULL
	,valorDiariaVeiculo	DOUBLE			NOT NULL
	,fotoVeiculo		VARCHAR(64)		NOT NULL
	,PRIMARY KEY(idVeiculo)
	,FOREIGN KEY(idMarca) REFERENCES tb_marca(idMarca)
);

CREATE TABLE tb_locacao (
	 idLocacao			INT				NOT NULL
	,idCliente			INT				NOT NULL
	,idVeiculo			INT				NOT NULL
	,idUsuario			INT				NOT NULL
	,dtInicial			TIMESTAMP		NOT NULL	DEFAULT CURRENT_TIMESTAMP
	,dtFinal			TIMESTAMP		NULL		DEFAULT NULL
	,valorTotal			DOUBLE			NOT NULL
	,PRIMARY KEY(idLocacao)
	,FOREIGN KEY(idCliente) REFERENCES tb_cliente(idCliente)
	,FOREIGN KEY(idVeiculo) REFERENCES tb_veiculo(idVeiculo)
	,FOREIGN KEY(idUsuario) REFERENCES tb_usuario(idUsuario)
);
