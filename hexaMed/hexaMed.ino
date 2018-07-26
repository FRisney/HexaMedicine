                               //Inclus�o das bibliotecas SPI, Ethernet, TimeLib e Servo
#include <SPI.h>
#include <Ethernet.h>
#include <TimeLib.h>
#include <Servo.h>

byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};      //Define o endere�o MAC do Ethernet Shield
IPAddress ip(192, 168, 0, 177);                         //Define o ip do Ethernet Shield
IPAddress myDns(1, 1, 1, 1);                            //Define o DNS a ser utilizado
EthernetClient client;                                  //Define o Ethernet Shield como uma esp�cie de Navegador WEB
IPAddress server(192, 168, 0, 2);                       //Informa o ip do servidor para realizar a conex�o
     
unsigned long lastConnectionTime = 0;                   //Define o tempo da ultima conex�o, em milisegundos
const unsigned long postingInterval = 10L * 1000L;      //Intervalo de tempo entre as conex�es, em milisegundos

Servo servo1;
Servo servo2;
Servo servo3;
Servo servo4;
Servo servo5;
Servo servo6;

time_t t;       //Variavel de tempo para sincroneza��o e ativa��o dos nichos
int piezo = 9;  //Pino a ser utilizado pelo piezo
char lido[261]; //Vetor de caracteres que ser�o lidos da resposta do servidor
int libera = 0; //Variavel que definir� se os nichos poder�o ou n�o serem ativados
int cont = 0;   //Variavel de contagem de caracteres para o vator lido[]
int sync = 0;   //Variavel de contagem de sincronizado realizadas
int nicho[6];   //vetor para armazenar os nichos programados
int hora[6];    //vetor para armazenar as horas dos horarios programados
int minuto[6];  //vetor para armazenar os minutos dos horarios programados
int horaRef, minutoRef, segundoRef, diaRef, mesRef, anoRef; //Define as variaves dos horarios referenciais
Servo servo[6] = {servo1,servo2,servo3,servo4,servo5,servo6};

void setup() {
	
  Serial.begin(9600);     //Inicia a porta Serial na frequencia 9600
  pinMode(piezo, OUTPUT); //Define o pino piezo, com valor 9, como um pino de saida
  for(int n=0;n<6;n++){
    int pin = n+14;
    servo[n].attach(pin);      //Define a porta para controlar o servo 
  }
  for(int a=0;a<6;a++){
    servo[a].write(0);       // Posiciona o Servo em 0 - posicao inicial
  }
  delay(1000);
  Ethernet.begin(mac, ip, myDns);     //Inicia o Ethernet SHield com MAC, IP e DNS informados previamente
  Serial.print("IP do Arduino: ");
  Serial.println(Ethernet.localIP()); //Imprime no Serial o IP do Arduino - IP Local
  
}

void loop() {

  if (client.available()){         //Verifica se uma conexao com o servidor foi estabelecida
    if (cont < 261) {              //Verifica se o contador exedeu o limite do vetor lido, de 261 posi��es, a 261� posi��o DEVE ser um espa�o em branco
      lido[cont] = client.read();  //L� um caracter recebido de resposta do servidor e o atibui a posi��o 'cont' do vetor lido
      Serial.print(lido[cont]);    //Imprime o caracter lido
      cont ++ ;                    //Incrementa o contador de caracteres lidos
    }
  }

  if (millis() - lastConnectionTime > postingInterval){
                           //Verifica se o milisegundo atual menos o tempo da ultima conex�o 
						   //� menor que o intervalo m�nimo para conex�o, ou seja, menor que 10 segundos
						   //Se sim:
    httpRequest();         //Chama a fun��o de conex�o com o servidor
    if(sync>1){                                                   //Verifica se o relogio ja foi sincronizado pelo menos 1 vez
      separacao(lido);                                            //Envia os caracteres lidos so Client para o processo de Parse
      settime(horaRef,minutoRef,segundoRef,diaRef,mesRef,anoRef); //Sincroniza o relogio do arduino para os valores referenciais obtidos atraves do Client
      t = now();                                                  //Grava o horario atual como time_t para a verifica��o dos horarios programados 
      printParsed();
    }
  }
  
  
  
  if(sync>2){                                          //Verifica se o relogio ja foi sincronizado pelo menos 2 vezes
    if(libera == 1){                                   //verifica se a libera��o ja foi feita neste c�clo de conex�o Arduino/PHPServer
      for(int w=0;w<6;w++){                            //itera pelos vetores nicho[], hora[] e minuto[]
        bool condHora = hora[w] == hour(t);            // Verifica se a hora atual � igual � programada
        bool condMinuto = minuto[w] == minute(t);      // Verifica se o minuto atual � igual ao programado
        if(condHora && condMinuto){                    //se as duas verifica��es anteriores forem verdadeiras
          servos(nicho[w]-1);                            //ativa o servomotor com o id correnspondente ao horario programado
          printNichoLiberado(nicho[w]);
          Piezo(2);                                    //Ativa o piezo com o som de tipo 2
        }
      libera = 0;                                      //Informa que as libera��es j� foram feitas neste c�clo de conex�o Arduino/PHPServer
      }
	  Serial.println(" ");                             //Pula uma linha no Serial
    }
  }
}

void httpRequest() {
  client.stop();                                                 //Para qualquer atividade de Client do Arduino
  if (client.connect(server, 8080)) {                            //Verifica se � possivel conectar o Arduino com ip da variavel 'server' no port 8080 do servidor, se sim:
    libera = 1;                                                  //Abilita a libera��o dos nichos para esse c�clo
    cont = 0;                                                    //Reinicia a contagem de caracteres a serem lidos 
    sync++;                                                      //Incrementa a contagem de sincroniza��es realizadas desde o inicio de funcionamento do sistema
    Serial.println("Conectando...");                             //Imprime no Serial Conectando
    client.println("GET /ardquery.php?equip=666 HTTP/1.1");     //Faz a solicita��o � p�gina ardquery.php com o equipamento de numero 4321
    client.println("Host: 192.168.0.4");                         //Informa o IP do Servidor
    client.println("User-Agent: arduino-ethernet");              //Informa ao servidor o tipo de usuario, no caso Arduino via ethernet
    client.println("Connection: close");                         //Informa ao servidor o fim da conex�o
    client.println();                                            //Pula linha no Serial
    //Piezo(1);                                                    //Ativa o piezo com o som de tipo 1 - Conex�o realizada com sucesso
    lastConnectionTime = millis();                               //define a dura��o da ultima conex�o
  } else {                                                       //Se n�o:
    Serial.println("Conexao falhou");                            //Imprime no Serial "falha na conex�o"
    Piezo(0);                                                    //Ativa o piezo com o som de tipo 0 - Falha na conex�o
  }
}

void separacao(char * input){         //Essa fun��o recebe como argumento o endere�o de memoria para o vetor de caracteres lido[], 
                                      //com isso esse vetor sera modificado durante o processo de Parse
  strtok(input,"#");                         //Seleciona todos caracteres ate o primeiro # do vetor
  anoRef = atoi(strtok(NULL,"-"));           //A variavel anoRef receber�, todos os caracteres at� o proximo -, mas convertidos em numeros com a fun��o atoi
  mesRef = atoi(strtok(NULL,"-"));           //A variavel mesRef receber�, todos os caracteres at� o proximo -, mas convertidos em numeros com a fun��o atoi
  diaRef = atoi(strtok(NULL,"#"));           //A variavel diaRef receber�, todos os caracteres at� o proximo #, mas convertidos em numeros com a fun��o atoi
  horaRef = atoi(strtok(NULL,":"));          //A variavel horaRef receber�, todos os caracteres at� o proximo :, mas convertidos em numeros com a fun��o atoi
  minutoRef = atoi(strtok(NULL,":"));        //A variavel minutoRef receber�, todos os caracteres at� o proximo :, mas convertidos em numeros com a fun��o atoi
  segundoRef = atoi(strtok(NULL,"#"))+11;    //A variavel segundoRef receber�, todos os caracteres at� o proximo #, 
                                             //mas convertidos em numeros com a fun��o atoi + 11, com a inten��o de remover o atraso de 11 segundos, 
                                             //gerados pelo intervalo de conex�o somado ao tempo de leitura, parse e sincroniza��o
  for(int j=0;j<6;j++){                  //Navega pelo restante dos caracteres no vetor lido[], com 6 itera��es � possivel:
    nicho[j] = atoi(strtok(NULL,"@"));   //Atribuir para cada indice o id de um nicho
    hora[j] = atoi(strtok(NULL,":"));    //Atribuir para cada indice a hora progrmada para o nicho de mesmo indice
    minuto[j] = atoi(strtok(NULL,"@"));  //Atribuir para cada indice o minuto progrmado para o nicho de mesmo indice
  }
}
void servos(int id){      //Recebe como parametro o id do nicho a ser ativado
  servo[id].write(180);      //posiciona o servo em 180 - posicao de despejo
  delay(500);
  servo[id].write(0);      // Posiciona o Servo em 0 - posi��o inicial
  delay(250);
  
}
void Piezo(int tipo){  //A fun��o piezo requer na sua chamada que seja informado o tipo de som
  if(tipo == 0){       //Falha de conexao
   tone(piezo,230);    //Envia uma frequencia 230Hz para o piezo
   delay(200);
   tone(piezo,180);    //Envia uma frequencia 180Hz para o piezo
   delay(400);
   tone(piezo,0,1000); //Envia uma frequencia 0Hz para o piezo
  }
  else if(tipo == 1){  //Sucesso na conexao
   tone(piezo,180);    //Envia uma frequencia 180Hz para o piezo
   delay(200);
   tone(piezo,230);    //Envia uma frequencia 230Hz para o piezo
   delay(400);
   tone(piezo,0,1000); //Envia uma frequencia 0Hz para o piezo
  }
  else if(tipo == 2){  //Quando os nichos sao ativados
   tone(piezo,2100);   //Envia uma frequencia 2100Hz para o piezo
   delay(200);
   tone(piezo,2000);   //Envia uma frequencia 2000Hz para o piezo
   delay(200);
   tone(piezo,2200);   //Envia uma frequencia 2200Hz para o piezo
   delay(400);
   tone(piezo,0,1000); //Envia uma frequencia 0Hz para o piezo
  }
}

void settime(int horaRef, int minutoRef, int segundoRef, int diaRef, int mesRef, int anoRef){      //Fun��o de sincroniza��o do rel�gio interno do arduino
  setTime(horaRef,minutoRef,segundoRef,diaRef,mesRef,anoRef); 
  //Fun��o setTime sendo executada com os valores referenciais adquiridos no Parse dos dados lidos da resposta do servidor
}
void printParsed(){
  Serial.print(day());                                        //Imprime o dia de hoje
  Serial.print("/");
  Serial.print(month());                                      //Imprime o mes de hoje
  Serial.print("/");
  Serial.print(year());                                       //Imprime o ano atual
  Serial.print(" ");
  Serial.print(hour());                                       //Imprime a hora atual
  Serial.print(":");
  Serial.print(minute());                                     //Imprime o minuto atual
  Serial.print(":");
  Serial.println(second());                                   //Imprime o segundo atual
  Serial.println("-- ");

  for(int j=0;j<6;j++){                //loop para imprimir todos os nichos programados e seus respectivos horarios no Serial
    Serial.print("Nicho: ");
    Serial.print(nicho[j]);            //Imprime o nicho de indice J
    Serial.print(" | ");
    Serial.print(hora[j]);             //Imprime a hora programada de indice J
    Serial.print(":");
    Serial.println(minuto[j]);         //Imprime o minuto programado de indice J
  }
  Serial.println("--");
}
void printNichoLiberado(int id){
  Serial.print("----------- nicho ");
  Serial.print(id);
  Serial.println(" liberado -------------");
}

