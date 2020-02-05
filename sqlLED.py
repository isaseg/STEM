import RPi.GPIO as GPIO
import pymysql
import time

GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)
ledPin = 3
GPIO.setup(ledPin, GPIO.OUT)

def checker():
	db = pymysql.connect(host="localhost", user="piControl", passwd="f103", db="piLight")
	cur = db.cursor(pymysql.cursors.DictCursor)
	sql = "SELECT switchLight FROM lightState"
	cur.execute(sql)
	row = cur.fetchall()
	print(row[0]["switchLight"])
	if row[0]["switchLight"] is 0:
		GPIO.output(ledPin, GPIO.LOW)
	elif row[0]["switchLight"] is 1:
		GPIO.output(ledPin, GPIO.HIGH)
	cur.close()
	db.close()
	time.sleep(0.5)
	checker()
	
checker()




	
