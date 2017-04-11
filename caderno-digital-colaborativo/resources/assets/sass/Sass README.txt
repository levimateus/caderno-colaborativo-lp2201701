*Breve explica��o*
	O sass � um pr� compilador de Css, ou seja quando vc for fazer alguma altera��o nunca altere o ar-
quivo .cssaltere sempre os arquivos com .scss, com o sass n�s conseguimos utilizar vari�veis, fun��es, ex-
ten��es muito mais f�cil.
	Voc�s podem aprender mais no link oficial deles: http://sass-lang.com/

*Como utilizar o Sass.*

1: Instalar o Ruby em sua m�quina, acesse o link: http://rubyinstaller.org/downloads e baixe o mais recente;

2: Instalar o gitbash, acesse o link: https://git-scm.com/download/win;

3: Ap�s clonar o reposit�rio em sua m�quina v� em \seu_caminho\caderno-digital-colaborativo\Templates\dist;

4: Clique com o bot�o direito em algum lugar da pasta e selecione: "Git bash Here";

5: Caso voc� colocou alguma senha em sua chave ssh, insira ela e pressione enter;

6: Digite: gem install sass;

7: Verifique se o sass foi instalado corretamente digitando: sass -v

8: Agora voc� pode rodar o sass com o comando:
sass --watch sass/main.scss:css/main.css

*Explica��o do comando*
	Esse comando ele vai ficar assistindo toda e qualquer altera��o em tempo real em todos os arquivos
listados no main.scss compilando para o arquivo: main.css (por isso sempre que adicionar um novo arquivo, 
importar ele no main.scss)

*Explica��o da organiza��o dos arquivos*
	Todos os arquivos de Css(bibliotecas, fontes etc) e scss(SASS) s�o importados no main.scss para
que sejam compilados em um unico arquivo, a sintaxe � bem similar ao Css usual, a diferen�a � que com o
"Nesting" fica mais leg�vel o c�digo e mais f�cil de se dar manuten��o, o que ajuda muito em trabalhos
como esse em que n�o � uma �nica pessoa que vai mexer com o Front-End.

Lu�s Takahashi, 1560859
08/04/2017



