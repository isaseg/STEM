#!/usr/bin/python

import MySQLdb

db = MySQLdb.connect(host="localhost", user="User", passwd="password", db="school")
#create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)

#Create table as per requirement
sql = "SELECT * from students"

cur.execute(sql)

rows = cur.fetchall()
for row in rows:
	print(row)
	
#disconnect from server
db.close()
