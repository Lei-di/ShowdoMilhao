-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Ago-2025 às 23:02
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `showdomilhao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes`
--

CREATE TABLE `questoes` (
  `id` int(11) NOT NULL,
  `questao` varchar(200) NOT NULL,
  `alternativa1` varchar(50) NOT NULL,
  `alternativa2` varchar(50) NOT NULL,
  `alternativa3` varchar(50) NOT NULL,
  `alternativa4` varchar(50) NOT NULL,
  `correta` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `dificuldade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `questoes`
--

INSERT INTO `questoes` (`id`, `questao`, `alternativa1`, `alternativa2`, `alternativa3`, `alternativa4`, `correta`, `categoria`, `dificuldade`) VALUES
(1, 'Qual é a capital da Argentina?', 'Lima', 'Buenos Aires', 'Brasília', 'Santiago', 'Buenos Aires', 'Geografia', 'Fácil'),
(2, 'Quem foi o primeiro presidente do Brasil?', 'Getúlio Vargas', 'Marechal Deodoro da Fonseca', 'Juscelino Kubitschek', 'Dom Pedro II', 'Marechal Deodoro da Fonseca', 'História', 'Fácil'),
(3, 'Qual planeta é conhecido como o \"Planeta Vermelho\"?', 'Vênus', 'Marte', 'Júpiter', 'Mercúrio', 'Marte', 'Ciências', 'Fácil'),
(4, 'Qual é o plural de “cão”?', 'Cãos', 'Cães', 'Cões', 'Caos', 'Cães', 'Português', 'Fácil'),
(5, 'Quem pintou a Mona Lisa?', 'Michelangelo', 'Leonardo da Vinci', 'Pablo Picasso', 'Salvador Dalí', 'Leonardo da Vinci', 'Artes', 'Fácil'),
(6, 'Qual é o maior país do mundo em extensão territorial?', 'Canadá', 'Estados Unidos', 'Rússia', 'China', 'Rússia', 'Geografia', 'Fácil'),
(7, 'Em que ano o Brasil proclamou a República?', '1822', '1889', '1500', '1930', '1889', 'História', 'Fácil'),
(8, 'Qual o gás essencial para a respiração humana?', 'Nitrogênio', 'Gás Carbônico', 'Oxigênio', 'Hidrogênio', 'Oxigênio', 'Ciências', 'Fácil'),
(9, 'Quem escreveu “O Pequeno Príncipe”?', 'Antoine de Saint-Exupéry', 'Machado de Assis', 'José de Alencar', 'Monteiro Lobato', 'Antoine de Saint-Exupéry', 'Literatura', 'Fácil'),
(10, 'Quantos jogadores um time de futebol tem em campo?', '9', '10', '11', '12', '11', 'Esportes', 'Fácil'),
(11, 'Qual é o maior oceano do mundo?', 'Atlântico', 'Pacífico', 'Índico', 'Ártico', 'Pacífico', 'Geografia', 'Fácil'),
(12, 'Quem descobriu o Brasil em 1500?\r\n', 'Cristóvão Colombo', 'Pedro Álvares Cabral', 'Vasco da Gama', 'Fernão de Magalhães', 'Pedro Álvares Cabral', 'História', 'Fácil'),
(13, 'Qual é o maior mamífero do planeta?', 'Elefante', 'Baleia-Azul', 'Girafa', 'Hipopótamo', 'Baleia-Azul', 'Ciências', 'Fácil'),
(14, 'Qual é o aumentativo de \"pão\"?', 'Pãozão', 'Pãinho', 'Pãozinho', 'Pãozito', 'Pãozão', 'Português', 'Fácil'),
(15, 'Quem é conhecido como “Rei do Rock”?', 'Michael Jackson', 'Elvis Presley', 'Frank Sinatra', 'Freddie Mercury', 'Elvis Presley', 'Música', 'Fácil'),
(16, 'Qual país é famoso pelas pirâmides?\r\n', 'Índia', 'Egito', 'México', 'Grécia', 'Egito', 'Geografia', 'Fácil'),
(17, 'Quem foi o imperador do Brasil no período da independência?', 'Dom Pedro I', 'Dom Pedro II', 'Tiradentes', 'Deodoro da Fonseca', 'Dom Pedro I', 'História', 'Fácil'),
(18, 'Qual órgão bombeia o sangue pelo corpo?', 'Pulmão', 'Fígado', 'Coração', 'Estômago', 'Coração', 'Ciências', 'Fácil'),
(19, 'Quem escreveu “Dom Casmurro”?', 'Machado de Assis', 'Clarice Lispector', 'José de Alencar', 'Jorge Amado', 'Machado de Assis', 'Literatura', 'Fácil'),
(20, 'Em que país nasceu o basquete?', 'Estados Unidos', 'Inglaterra', 'França', 'Canadá', 'Estados Unidos', 'Esportes', 'Fácil'),
(21, 'Qual é o maior arquipélago do mundo?', 'Japão', 'Indonésia', 'Filipinas', 'Maldivas', 'Indonésia', 'Geografia', 'Médio'),
(22, 'Qual vitamina é produzida pelo corpo humano quando exposto ao sol?', 'Vitamina A', 'Vitamina B12', 'Vitamina C', 'Vitamina D', 'Vitamina D', 'Ciências', 'Médio'),
(23, 'O pintor Claude Monet está associado a qual movimento artístico?', 'Expressionismo', 'Impressionismo', 'Surrealismo', 'Cubismo', 'Impressionismo', 'Artes', 'Médio'),
(24, 'Quantos títulos mundiais a seleção brasileira de futebol possui?', '3', '4', '5', '6', '5', 'Esportes', 'Médio'),
(25, 'Quem escreveu Grande Sertão: Veredas?\r\n', 'Guimarães Rosa', 'José de Alencar', 'Machado de Assis', 'Ariano Suassuna', 'Guimarães Rosa', 'Literatura', 'Médio'),
(26, 'Qual país é conhecido como a “terra do sol nascente”?', 'Coreia do Sul', 'China', 'Japão', 'Tailândia', 'Japão', 'Geografia', 'Médio'),
(27, 'Qual o elemento químico representado pelo símbolo Na?\r\n', 'Nitrogênio', 'Níquel', 'Sódio', 'Neônio', 'Neônio', 'Ciências', 'Médio'),
(28, 'Qual é o nome da maior competição de clubes de futebol da Europa?\r\n', 'Copa da UEFA', 'Liga dos Campeões da UEFA', 'Eurocopa', 'Liga Europa', 'Liga dos Campeões da UEFA', 'Esportes', 'Médio'),
(29, 'A técnica de pintura que utiliza pequenos pontos de cor é chamada:\r\n', 'Pontilhismo', 'Surrealismo', 'Cubismo', 'Impressionismo', 'Pontilhismo', 'Artes', 'Médio'),
(30, 'Qual planeta possui o maior número de luas conhecidas?\r\n', 'Terra', 'Marte', 'Júpiter', 'Saturno', 'Júpiter', 'Ciências', 'Médio'),
(31, 'Qual é o país mais populoso da África?\r\n', 'Egito', 'África do Sul', 'Nigéria', 'Etiópia', 'Nigéria', 'Geografia', 'Médio'),
(32, 'Quem é o autor de O Cortiço?\r\n', 'Lima Barreto', 'Machado de Assis', 'Aluísio Azevedo', 'José de Alencar', 'Aluísio Azevedo', 'Literatura', 'Médio'),
(33, 'O sangue humano é composto principalmente por qual substância?\r\n', 'Água', 'Ferro', 'Glóbulos brancos', 'Plaquetas', 'Água', 'Ciências', 'Médio'),
(34, 'Qual país sediou a Copa do Mundo de 2014?\r\n', 'Alemanha', 'Brasil', 'África do Sul', 'Rússia', 'Brasil', 'Esportes', 'Médio'),
(35, 'O quadro A Noite Estrelada foi pintado por:\r\n', 'Picasso', 'Van Gogh', 'Monet', 'Renoir', 'Van Gogh', 'Artes', 'Médio'),
(36, 'Qual é o maior país do mundo em território?\r\n', 'Canadá', 'Estados Unidos', 'Rússia', 'China', 'Rússia', 'Geografia', 'Médio'),
(37, 'Qual é a principal função dos glóbulos vermelhos?\r\n', 'Combater infecções', 'Transportar oxigênio', 'Produzir anticorpos', 'Regular temperatura', 'Transportar oxigênio', 'Ciências', 'Médio'),
(38, 'Quem é o autor de A Moreninha, um dos primeiros romances brasileiros?\r\n', 'Joaquim Manuel de Macedo', 'Castro Alves', 'José de Alencar', 'Raul Pompeia', 'Joaquim Manuel de Macedo', 'Literatura', 'Médio'),
(39, 'Qual esporte é conhecido como “esporte da mente”?\r\n', 'Damas', 'Xadrez', 'Pôquer', 'Sinuca', 'Xadrez', 'Esportes', 'Médio'),
(40, 'Qual o rio que atravessa a cidade do Egito onde ficam as pirâmides de Gizé?\r\n', 'Eufrates', 'Tigre', 'Nilo', 'Jordão', 'Nilo', 'Geologia', 'Médio'),
(41, 'Qual foi o principal objetivo da Doutrina Truman anunciada em 1947?', 'Reconstruir economicamente a Europa Ocidental', 'Contenir o avanço do comunismo no mundo', 'Criar a OTAN como aliança militar', 'Reforçar o poder nuclear dos EUA', 'Contenir o avanço do comunismo no mundo', 'História ', 'Difícil'),
(42, 'O clima mediterrâneo caracteriza-se por:\r\n', 'Invernos secos e verões chuvosos', 'Chuvas o ano inteiro com baixa amplitude térmica', 'Verões secos e invernos chuvosos', 'Baixas temperaturas durante todo o ano', 'Verões secos e invernos chuvosos', 'Geografia', 'Difícil'),
(43, 'Qual estrutura celular é responsável pela síntese de lipídios?\r\n', 'Mitocôndria', 'Lisossomo', 'Retículo endoplasmático liso', 'Complexo de Golgi', 'Retículo endoplasmático liso', 'Biologia', 'Difícil'),
(44, 'Para Kant, a moralidade de uma ação depende de:\r\n', 'Suas consequências práticas', 'O dever e a boa vontade', 'O prazer obtido', 'O contexto histórico', 'O dever e a boa vontade', 'Filosofia', 'Difícil'),
(45, 'Na Teoria da Relatividade Restrita, o tempo medido por um observador em movimento é:\r\n', 'Mais rápido do que em repouso', 'Mais rápido do que em repouso', 'Igual ao tempo do observador em repouso', 'Independente da velocidade', 'Mais rápido do que em repouso', 'Física', 'Difícil'),
(46, 'O dogma central da biologia molecular descreve o fluxo de informação genética como', 'DNA;RNA;Proteína', 'RNA;DNA;Proteína', 'Proteína;RNA;DNA', 'DNA;Proteína;RNA', 'DNA;RNA;Proteína', 'Biologia', 'Difícil'),
(47, 'O conflito conhecido como Guerra dos Seis Dias (1967) envolveu principalmente:\r\n', 'Israel e Irã', 'Israel e países árabes vizinhos', 'Palestina e Turquia', 'Egito e Estados Unidos', 'Israel e países árabes vizinhos', 'Geopolítica', 'Difícil'),
(48, 'A ligação presente na molécula de NaCl é:\r\n', 'Covalente apolar', 'Covalente polar', 'Iônica', 'Metálica', 'Iônica', 'Química', 'Difícil'),
(49, 'O movimento artístico que rompeu com a perspectiva tradicional e explorou formas geométricas fragmentadas foi:', 'Impressionismo', 'Expressionismo', 'Cubismo', 'Surrealismo', 'Cubismo', 'Artes', 'Difícil'),
(50, 'O Ato Institucional nº 5 (AI-5), durante a ditadura militar brasileira, instituiu:\r\n', 'O fim da censura e maior liberdade de imprensa', 'A cassação de mandatos e suspensão de habeas corpu', 'A eleição direta para presidente', 'A abertura política', 'A cassação de mandatos e suspensão de habeas corpu', 'História ', 'Difícil'),
(51, 'O algoritmo Merge Sort possui complexidade de tempo no pior caso igual a:\r\n', ' O(n)', 'O(nlogn)', 'O(n2)', 'O(logn)', 'O(nlogn)', 'Ciências da Computação', 'Difícil'),
(52, 'Segundo Nietzsche, o conceito de “eterno retorno” representa:\r\n', 'A repetição dos ciclos históricos', 'A ilusão do tempo linear', 'A ideia de viver infinitamente a mesma vida', 'O renascimento da alma após a morte', 'A ideia de viver infinitamente a mesma vida', 'Filosofia', 'Difícil'),
(53, 'A teoria de Émile Durkheim sobre o fato social afirma que ele é:\r\n', 'Interno, individual e subjetivo', 'Externo, coercitivo e geral', 'Biológico e hereditário', 'Uma criação puramente estatal', 'Externo, coercitivo e geral', 'Sociologia', 'Difícil'),
(54, 'Na fotossíntese, a fase clara ocorre no:\r\n', 'Estroma', 'Tilacoide', 'Núcleo', 'Mitocôndria', 'Tilacoide', 'Biologia', 'Difícil'),
(55, 'O conceito de “mão invisível”, utilizado por Adam Smith, refere-se a:\r\n', 'Intervenção estatal na economia', 'Força reguladora natural do mercado', 'Planejamento centralizado da produção', 'Aumento da inflação', 'Força reguladora natural do mercado', 'Economia', 'Difícil'),
(56, 'O acordo conhecido como Tratado de Versalhes (1919), que encerrou oficialmente a Primeira Guerra Mundial, impôs duras sanções a:', 'Rússia', 'Alemanha', 'Itália', 'Império Otomano', 'Alemanha', 'Geopolítica', 'Difícil'),
(57, 'A Revolução Cultural Chinesa (1966–1976), liderada por Mao Tsé-Tung, teve como objetivo principal:', 'Implantar o capitalismo de mercado', 'Eliminar elementos “burgueses” e reforçar o social', 'Abrir o país ao comércio internacional', 'Unificar a China com Taiwan', 'Eliminar elementos “burgueses” e reforçar o social', 'História ', 'Difícil'),
(58, 'A queda do Muro de Berlim em 1989 simbolizou:', 'O início da Guerra Fria', 'O auge do nazismo na Alemanha', 'O colapso do bloco socialista no Leste Europeu', 'A unificação imediata da Alemanha', 'O colapso do bloco socialista no Leste Europeu', 'História ', 'Difícil'),
(59, 'Qual molécula é considerada a principal fonte de energia imediata para as células?\r\n', 'DNA', 'ATP', 'Glicogênio', 'RNA', 'ATP', 'Biologia', 'Difícil'),
(60, 'O Círculo de Fogo do Pacífico é conhecido por sua intensa:\r\n', 'Desertificação e secas', 'Atividade vulcânica e sísmica', 'Correntes oceânicas frias', 'Formação de furacões tropicais', 'Atividade vulcânica e sísmica', 'Geografia', 'Difícil');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
