README - **Projeto Classificados**
# Desenvolvido em PHP - Framework CodeIgniter 4 
**Outras linguagens e bibliotecas utilizadas:**
MySQLi, HTML-5, CSS, Bootstrap - 4, font-awsome link CDN e link.
PlaceHolder.com para simulação de imagens.

Este projeto tem caráter didático, ele é livre para uso e edição.
Para quem está aprendendo a utilizar o CodeIginiter 4, saiba que faço uso das
principais ferramentas, funções, session, renderSection e classes, entre outras.
Nos CRUDs utilizo querys de consulta do CI4, mas também outras do padrão SQL.

**Arquivo .env**
Caso queria utilizar, recomento fazer um clone e configurar o arquivo .env com as
informações abaixo:

database.default.hostname = localhost
database.default.database = classificados
database.default.username = root
database.default.password = ""
database.default.DBDriver = MySQLi

*obs:* Observe acima que não há senha no banco de dados, sendo assim seu banco não poderá
possuir senha, ou se possuir, o arquivo .env deverá corresponder a senha do seu banco.
Est

**Outras considerações**

Segue também o arquivo com da Base de Dados contendo todas as  tabelas utilizadas:
(classificados.sql);

As imagens estão na pasta anunios Path - public/assets/images/anuncios;

OS demais aquivos encontra-se dentro da pasta assest e suas subpastas correspondentes;

A URL padrão e inicial do site está como [http://localhost/classificados/public/],
caso queira mudar deverá alterar o arquivo App.php dentro da pasta config.

Os arquivos de códigos estão dentro das estrutura MVC e na biblioteca de classes
Libraries.

O arquivo .env está comitado neste repositório, consiserando o uso por quem está
iniciando no CodeIgniter 4, lembre-se de renomeá-lo para com um ponto na frente
[.env].

O ambiente está configurado como desenvolvimento *CI_ENVIRONMENT = development*
Caso queira colocar em produção comente a anterior e descomente o
*CI_ENVIRONMENT = production*, colocando e retirando a # no início da linha no
arquivo .env.

**Obs**
Este projeto não foi submetido a um rigoroso teste de segurança, apesar do CodeIgniter 4
possuir intrinsecamente varías ferramentas de validação que garantem uma maior segurança
contra a injeção de SQL injection e outras tentativas de fraude.

**dúvidas - contato**
email: [virgilio.vpr@gmail.com]