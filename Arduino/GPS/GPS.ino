char findString, data, latitud[11],longitud[12];

char sentido[2];
int contComa = 0, cLT=0, cLN=0,x=0;

void setup()
{
  Serial1.begin(9600); // inicializa los puertos seriales 0 y 1 del mega
  Serial.begin(9600);
}

//Funcion que detecta la cadena $GPRMC
void stringRMC()
{
  while(true)
  {    
    if (Serial1.available()) //Mientras tengamos datos por leer
    {
      findString = Serial1.read(); //Leemos el GPS
      if (findString == 'R') //Si el caracter leido es la letra //>R> continuamos la lectura
      {            
        while (Serial1.available() == 0); //Si recibimos un caracter y //es la letra 'M' continuamos la lectura
        findString = Serial1.read();        
        if (findString == 'M')
          {
            while (Serial1.available() == 0); //Si recibimos un caracter y //es la letra 'C' continuamos leyendo
            findString = Serial1.read(); //si no es asi seguiremos //verificando al GPS hasta cumplir esta ultima condicion*/
            if (findString == 'C')
            break;
          }
      }
    }
  }
}

void loop()
{   
  stringRMC(); //Funcion para tomar la cadena GPRMC= hora, latitud
  //longitud, velocidad y fecha

  //contadores para tomar cada uno de los datos utiles de la cadena
  cLT=0;
  cLN=0;
  contComa=0;  
  x=0;
  
  while(true)
  {
    if(Serial1.available() > 0) //si recibimos algun valor del GPS
    {
      data=Serial1.read(); //leemos el caracter 
      if (data == '*') //Cuando leamos el caracter <*> finalizamos la lectura, pues indica el fin de la cadena GPRMC
        break;
      else if(data == ',') //Detectamos las comas para saber que 
      //tipo de datos se toma (hora, fecha, etc)
      contComa ++; //Contamos el numero de comas 
      
      else if (contComa == 3) //Despues de la tercer coma 
      //se encuentra la LATITUD
      {
        latitud[cLT] = data; //Almacenamos la latitud en un vector
        cLT ++;        
      }

      else if (contComa == 4) //Despues de la cuarta coma se 
      //encuentra el sentido de la LATITUD (N->norte, S->sur)
      sentido[0] = data;
      
      else if (contComa == 5)
      {//La quinta coma indica la 
      //longitud en un vector
      longitud[cLN] = data;      
      cLN ++;      
      }

      else if (contComa == 6) //La sexta coma indica el sentido de
      //la LONGITUD (W->oeste,E->este)
      sentido[1] = data;
    }
  }
  for(int x=0; x<2;x++)
  {
  switch(sentido[x]){
    case 'N':
    sentido[x]=' ';
    break;
    case 'S':
    sentido[x]='-';
    break;
    case 'E':
    sentido[x]=' ';
    break;
    case 'W':
    sentido[x]='-';
    break;
  }
  }
  Serial.print(sentido[0]);
  Serial.print(latitud);
  Serial.print(",");
  Serial.print(sentido[1]);
  Serial.println(longitud);  

}
