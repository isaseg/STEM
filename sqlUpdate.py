#!/usr/bin/python

import MySQLdb

db = MySQLdb.connect(host="localhost", user="api", passwd="f103", db="people")
#create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)

#Create table as per requirement
sql = "UPDATE students SET age=17 WHERE name='Ian' "

cur.execute(sql)
	
#disconnect from server
db.close()
