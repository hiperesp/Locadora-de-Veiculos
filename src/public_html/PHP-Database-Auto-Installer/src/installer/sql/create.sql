CREATE TABLE tbCliente (
         idCliente              INT             NOT NULL        AUTO_INCREMENT
        ,nomeCliente            VARCHAR(255)    NOT NULL
        ,cpfCliente             VARCHAR(11)     NOT NULL
        ,cnhCliente             VARCHAR(11)     NOT NULL
        ,logradouroCliente      VARCHAR(255)    NOT NULL
        ,numCliente             INT             NOT NULL
        ,complCliente           VARCHAR(32)     NOT NULL
        ,bairroCliente          VARCHAR(64)     NOT NULL
        ,cidadeCliente          VARCHAR(128)    NOT NULL
        ,cepCliente             VARCHAR(8)      NOT NULL
        ,ufCliente              VARCHAR(2)      NOT NULL
        ,PRIMARY KEY(idCliente)
);

CREATE TABLE tbUsuario (
         idUsuario              INT             NOT NULL        AUTO_INCREMENT
        ,nomeUsuario            VARCHAR(255)    NOT NULL
        ,loginUsuario           VARCHAR(64)     NOT NULL
        ,senhaUsuario           VARCHAR(32)     NOT NULL
        ,PRIMARY KEY(idUsuario)
);

CREATE TABLE tbMarca (
         idMarca                INT             NOT NULL        AUTO_INCREMENT
        ,nomeMarca              VARCHAR(32)     NOT NULL
        ,PRIMARY KEY(idMarca)
);

CREATE TABLE tbVeiculo (
         idVeiculo              INT             NOT NULL        AUTO_INCREMENT
        ,idMarca                INT             NOT NULL
        ,anoVeiculo             INT(4)          NOT NULL
        ,corVeiculo             INT             NOT NULL
        ,modeloVeiculo          VARCHAR(32)     NOT NULL
        ,valorDiariaVeiculo     DOUBLE          NOT NULL
        ,fotoVeiculo            VARCHAR(64)     NOT NULL
        ,PRIMARY KEY(idVeiculo)
        ,FOREIGN KEY(idMarca) REFERENCES tbMarca(idMarca)
);

CREATE TABLE tbLocacao (
         idLocacao              INT             NOT NULL        AUTO_INCREMENT
        ,idCliente              INT             NOT NULL
        ,idVeiculo              INT             NOT NULL
        ,idUsuario              INT             NOT NULL
        ,dtInicial              TIMESTAMP       NOT NULL        DEFAULT CURRENT_TIMESTAMP
        ,dtFinal                TIMESTAMP       NULL            DEFAULT NULL
        ,valorTotal             DOUBLE          NOT NULL
        ,PRIMARY KEY(idLocacao)
        ,FOREIGN KEY(idCliente) REFERENCES tbCliente(idCliente)
        ,FOREIGN KEY(idVeiculo) REFERENCES tbVeiculo(idVeiculo)
        ,FOREIGN KEY(idUsuario) REFERENCES tbUsuario(idUsuario)
);
