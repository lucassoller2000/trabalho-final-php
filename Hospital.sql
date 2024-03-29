CREATE DATABASE Hospital;
USE Hospital;

CREATE TABLE medico(
idMedico BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
nome VARCHAR(50) NOT NULL,
dataNascimento VARCHAR(10) NOT NULL,
especializacao VARCHAR(50) NOT NULL,
cpf VARCHAR(14) NOT NULL UNIQUE,
sexo VARCHAR(9) NOT NULL,
telefone VARCHAR (13),
salarioFixo DOUBLE NOT NULL,
PRIMARY KEY(idMedico)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE planoDeSaude(
idPlano BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
nome VARCHAR(50) NOT NULL UNIQUE,
beneficios TINYINT NOT NULL,
dataEmissao VARCHAR(10) NOT NULL,
validade VARCHAR(10) NOT NULL,
empresaPlano VARCHAR(30) NOT NULL,
PRIMARY KEY(idPlano)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE paciente(
idPaciente BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
nome VARCHAR(50) NOT NULL,
tipoSanguineo VARCHAR (3) NOT NULL,
dataNascimento VARCHAR(10) NOT NULL,
estadoCivil VARCHAR (8) NOT NULL,
cpf VARCHAR(14) NOT NULL UNIQUE,
sexo VARCHAR(9) NOT NULL,
peso DOUBLE NOT NULL,
renda DOUBLE NOT NULL,
telefone VARCHAR (13),
telefoneFamilia VARCHAR (13),
idPlano BIGINT NULL,
FOREIGN KEY (idPlano) REFERENCES planoDeSaude(idPlano) ON UPDATE CASCADE,
PRIMARY KEY(idPaciente)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE endereco(
idEndereco BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
rua VARCHAR(30) NOT NULL,
bairro VARCHAR(20) NOT NULL,
numero SMALLINT NOT NULL,
complemento VARCHAR(15),
cidade VARCHAR(30) NOT NULL,
estado VARCHAR(30) NOT NULL,
pais VARCHAR(30) NOT NULL,
cep VARCHAR(9) NOT NULL,
idPaciente BIGINT NOT NULL,
FOREIGN KEY(idPaciente) REFERENCES paciente(idPaciente) ON UPDATE CASCADE,
PRIMARY KEY(idEndereco)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cirurgia(
idCirurgia BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
tipo VARCHAR(30) NOT NULL,
descricao VARCHAR(255),
dataCirurgia VARCHAR(10) NOT NULL,
hora VARCHAR(5) NOT NULL,
duracao VARCHAR(5) NOT NULL,
sala TINYINT NOT NULL,
preco DECIMAL(10,2) NOT NULL,
precoComDesconto DECIMAL(10,2) NOT NULL,
idPaciente BIGINT NOT NULL,
idMedico BIGINT NOT NULL,
statusCirurgia VARCHAR(14) NOT NULL,
PRIMARY KEY(idCirurgia),
FOREIGN KEY(idPaciente) REFERENCES paciente(idPaciente) ON UPDATE CASCADE,
FOREIGN KEY(idMedico) REFERENCES medico(idMedico) ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE ferramenta(
idFerramenta BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
nome VARCHAR(30) NOT NULL,
tipoFerramenta VARCHAR(30) NOT NULL,
material VARCHAR(30) NOT NULL,
quantidade TINYINT NOT NULL,
PRIMARY KEY(idFerramenta)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE medicamento(
idMedicamento BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
nome varchar(30) NOT NULL,
tipo varchar(30) NOT NULL,
quantidade TINYINT NOT NULL,
observacao VARCHAR(255),
PRIMARY KEY(idMedicamento)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE consulta (
idConsulta BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
descricao VARCHAR(255) NOT NULL,
dataConsulta VARCHAR(10) NOT NULL,
hora VARCHAR(5) NOT NULL,
duracao VARCHAR(5) NOT NULL,
sala TINYINT NOT NULL,
preco DECIMAL(10,2) NOT NULL,
precoComDesconto DECIMAL(10,2) NOT NULL,
idPaciente BIGINT NOT NULL,
idMedico BIGINT NOT NULL,
PRIMARY KEY(idConsulta),
FOREIGN KEY(idPaciente) REFERENCES paciente (idPaciente) ON UPDATE CASCADE,
FOREIGN KEY(idMedico) REFERENCES medico (idMedico) ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE doacaoSangue (
idDoacao BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
nomeDoador VARCHAR(50) NOT NULL,
cpfDoador VARCHAR(14) NOT NULL UNIQUE,
tipoSanguineo VARCHAR(3) NOT NULL,
dataDoacao VARCHAR(10) NOT NULL,
hora VARCHAR(5) NOT NULL,
PRIMARY KEY(idDoacao)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE usuario (
idUsuario BIGINT UNIQUE NOT NULL AUTO_INCREMENT,
usuario VARCHAR(20) NOT NULL,
senha VARCHAR(20) NOT NULL UNIQUE,
PRIMARY KEY(idUsuario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
