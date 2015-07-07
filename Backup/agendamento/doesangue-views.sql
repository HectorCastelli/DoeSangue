-- Copiando estrutura para view doesangue.campanhas_ativas
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `campanhas_ativas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `campanhas_ativas` AS 	SELECT campanhas.*, cidades.nome FROM campanhas INNER JOIN cidades ON campanhas.cidade_fk = cidades.id ;


-- Copiando estrutura para view doesangue.cidades_ativas
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `cidades_ativas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `cidades_ativas` AS SELECT cidades.id , cidades.nome FROM cidades, campanhas WHERE campanhas.ativa = 1 AND campanhas.cidade_fk = cidades.id ;


-- Copiando estrutura para view doesangue.doadores_totais
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `doadores_totais`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `doadores_totais` AS SELECT * from doadores ;


-- Copiando estrutura para view doesangue.reservas_horarios_doadores
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `reservas_horarios_doadores`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `reservas_horarios_doadores` AS SELECT reserva_horarios.horario, doadores.nome, doadores.telefone, doadores.email, doadores.cpf, reserva_horarios.doador_fk, reserva_horarios.campanha_fk from reserva_horarios INNER JOIN doadores ON reserva_horarios.doador_fk = doadores.id ;


-- Copiando estrutura para view doesangue.reserva_horarios
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `reserva_horarios`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `reserva_horarios` AS select reservas.*, doadores.cpf from reservas inner join doadores on reservas.doador_fk = doadores.id ;
