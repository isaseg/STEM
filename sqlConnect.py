#!/usr/bin/python

import MySQLdb

#create the connection
db = MySQLdb.connect(host="localhost", user="User", passwd="password", db="school")

#create cursor
cur = db.cursor(MySQLdb.cursors.DictCursor)

#Create table as per requirement
sql = "SELECT * from students"

#execute the cursor
cur.execute(sql)

#print the rows
rows = cur.fetchall()
for row in rows:
	print(row)
	
#disconnect from server
db.close()
