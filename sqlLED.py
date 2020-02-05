import RPi.GPIO as GPIO
import pymysql
import time

#setup the GPIO board and set the pin that we are using
GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)
ledPin = 3
GPIO.setup(ledPin, GPIO.OUT)

def checker():
	#connect to the server
	db = pymysql.connect(host="localhost", user="piControl", passwd="f103", db="piLight")
	cur = db.cursor(pymysql.cursors.DictCursor)
	#get the switchLight value
	sql = "SELECT switchLight FROM lightState"
	cur.execute(sql)
	row = cur.fetchall()
	#print the switchLight value
	print(row[0]["switchLight"])
	#if switchLight is 0, turn the LED off
	if row[0]["switchLight"] is 0:
		GPIO.output(ledPin, GPIO.LOW)
	#if switchLight is 1, turn the LED on
	elif row[0]["switchLight"] is 1:
		GPIO.output(ledPin, GPIO.HIGH)
	cur.close()
	db.close()
	#wait a bit, and then rerun checker()
	time.sleep(0.5)
	checker()
	
checker()




	
