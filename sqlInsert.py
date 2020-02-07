import MySQLdb

#create connection
db = MySQLdb.connect(host="localhost", user="user", passwd="password", db="school")

#create cursor
cur = db.cursor(MySQLdb.cursors.DictCursor)
db.autocommit(True)

sql = "INSERT INTO students (name,age,gradeLevel) VALUES ('Kaiki','16','11')"

cur.execute(sql)

cur.close()
db.close()
