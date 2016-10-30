import serial

lora = serial.Serial('/dev/ttyACM1',115200,timeout=2.0)
Arduino = serial.Serial ('/dev/ttyACM2',9600,timeout=2.0)

print ("Start")

while True:
	comando = Arduino.readline()
	mensaje = "AT+SEND "+comando+"\r"
	print (mensaje)
	lora.write(mensaje.encode())

lora = connection.close()
Arduino = connection.close