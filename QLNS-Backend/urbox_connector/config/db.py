import mysql.connector

def mysql_db_connection_employee():
    connection = mysql.connector.connect(
        host='ptud-qlns-clc-8983.d.aivencloud.com',
        user='avnadmin',
        password='AVNS_zR6m2nlpCGVSxzX8VDS',
        database='employee',
        port=11638
    )
    return connection
def mysql_db_connection_reward():
    connection = mysql.connector.connect(
        host='ptud-qlns-clc-8983.d.aivencloud.com',
        user='avnadmin',
        password='AVNS_zR6m2nlpCGVSxzX8VDS',
        database='reward',
        port=11638
    )
    return connection
