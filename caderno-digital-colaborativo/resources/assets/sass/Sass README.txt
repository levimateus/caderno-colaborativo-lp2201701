*Breve explicação*
	O sass é um pré compilador de Css, ou seja quando vc for fazer alguma alteração nunca altere o ar-
quivo .cssaltere sempre os arquivos com .scss, com o sass nós conseguimos utilizar variáveis, funções, ex-
tenções muito mais fácil.
	Vocês podem aprender mais no link oficial deles: http://sass-lang.com/

*Como utilizar o Sass.*

1: Instalar o Ruby em sua máquina, acesse o link: http://rubyinstaller.org/downloads e baixe o mais recente;

2: Instalar o gitbash, acesse o link: https://git-scm.com/download/win;

3: Após clonar o repositório em sua máquina vá em \seu_caminho\caderno-digital-colaborativo\Templates\dist;

4: Clique com o botão direito em algum lugar da pasta e selecione: "Git bash Here";

5: Caso você colocou alguma senha em sua chave ssh, insira ela e pressione enter;

6: Digite: gem install sass;

7: Verifique se o sass foi instalado corretamente digitando: sass -v

8: Agora você pode rodar o sass com o comando:
sass --watch sass/main.scss:css/main.css

*Explicação do comando*
	Esse comando ele vai ficar assistindo toda e qualquer alteração em tempo real em todos os arquivos
listados no main.scss compilando para o arquivo: main.css (por isso sempre que adicionar um novo arquivo, 
importar ele no main.scss)

*Explicação da organização dos arquivos*
	Todos os arquivos de Css(bibliotecas, fontes etc) e scss(SASS) são importados no main.scss para
que sejam compilados em um unico arquivo, a sintaxe é bem similar ao Css usual, a diferença é que com o
"Nesting" fica mais legível o código e mais fácil de se dar manutenção, o que ajuda muito em trabalhos
como esse em que não é uma única pessoa que vai mexer com o Front-End.

Luís Takahashi, 1560859
08/04/2017



