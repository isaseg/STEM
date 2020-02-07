#!/usr/bin/python

import MySQLdb

db = MySQLdb.connect(host="localhost", user="User", passwd="password", db="school")
#create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)

#Create table as per requirement
sql = "UPDATE students SET age=17 WHERE name='Kaiki' "

cur.execute(sql)
	
#disconnect from server
db.close()
