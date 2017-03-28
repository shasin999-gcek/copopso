import bcrypt
import MySQLdb
import string
import random

#Make necessary changes when using with your database
db = MySQLdb.Connect(host="host", port=3306, user="username", passwd="password", db="database")
cursor = db.cursor()

try:
	cursor.execute("""SELECT COUNT(*) FROM user;""")
	no_of_users = cursor.fetchone()[0]

	for i in range(1,no_of_users+1):
		#Generating a random 6 character string
		password = b"".join(random.choice(string.ascii_uppercase + string.digits)for _ in range(6))
		
		#Encrypting the randomly generated 6 character string
		encrypted_password = bcrypt.hashpw(password, bcrypt.gensalt())

		cursor.execute("""UPDATE user SET password = (%s) WHERE id = (%s) """,(encrypted_password,int(i)))
		db.commit()
	
except:     
	#Reverts changes made if any error occurs
	db.rollback()
		
db.close()
