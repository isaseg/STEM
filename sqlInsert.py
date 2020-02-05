import MySQLdb

db = MySQLdb.connect(host="localhost", user="api", passwd="f103", db="people")

cur = db.cursor(MySQLdb.cursors.DictCursor)
db.autocommit(True)

sql = "INSERT INTO students (name,age,gradeLevel) VALUES ('Kaiki','16','11')"

cur.execute(sql)

cur.close()
db.close()
