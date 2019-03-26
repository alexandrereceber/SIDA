/**
 * Modo de visualização padão sem nenhuma configuração especial, somente mapeamento dos campos
 * @type TabelaHTML
 */
var t = new TabelaHTML("http://"+ Padrao.getHostServer() +"/SistemaOnline/ControladorTabelas/");
/**
 * Nome da tabela que esta no formato MD5 no arquivo de configuração Config/Configuracao.php
 * @type String
 */
t.setTabela = "52c1592330d80979c6df1f8bd9d27be3";
t.setRecipiente = "dados";
t.Name = "t";
t.show();
            