-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `senha` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(50)   NOT NULL,
  `texto` TEXT   NOT NULL,
  `tag1` varchar(10),
  `tag2` varchar(10),
  `tag3` varchar(10),
  `id_autor` int(11) ,
  `foto`  TEXT   NOT NULL,
  `data_criacao` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 
ALTER TABLE noticia ADD CONSTRAINT fk_id_autor FOREIGN KEY ( id_autor ) REFERENCES pessoa ( id ) ;
