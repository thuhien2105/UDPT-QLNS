import mysql.connector

def mysql_db_connection_activities():
    connection = mysql.connector.connect(
        host='ptud-qlns-clc-8983.d.aivencloud.com',
        user='avnadmin',
        password='AVNS_zR6m2nlpCGVSxzX8VDS',
        database='activities',
        port=11638
    )
    return connection
