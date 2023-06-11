"""
這是一個讀取 ArtworkDb.sql 
與 insert_data.sql 的內容
並初始化資料庫的程式
"""

import pyodbc

SERVER = "410530042-sql,1433"
DBNAME = "master"
USERNAME = "sa"
PASSWORD = "MyDefaultPassword..."
DRIVER = "ODBC Driver 18 for SQL Server"

SCRIPT_PATH = "scripts/insert_data.sql"
CREATE_TABLE_PATH = "scripts/ArtworkDB.sql"

conn_str = (
    f"DRIVER={{{DRIVER}}};"
    f"SERVER={SERVER};"
    f"DATABASE={DBNAME};"
    f"UID={USERNAME};"
    f"PWD={PASSWORD};"
    f"TrustServerCertificate=yes;"
)

conn = pyodbc.connect(conn_str)

cursor = conn.cursor()
conn.autocommit = True

database_name = 'ArtworkDB'
query = f"SELECT COUNT(*) FROM sys.databases WHERE name = '{database_name}'"
cursor.execute(query)
row = cursor.fetchone()

if row[0] > 0:
    print(f"The database '{database_name}' exists.")
else:
    CREATE_DATABASE_QUERY = "CREATE DATABASE ArtworkDB"
    cursor.execute(CREATE_DATABASE_QUERY)
    
    with open(CREATE_TABLE_PATH, 'r') as file:
        content = file.read()
        cursor.execute(content)

    with open(SCRIPT_PATH, 'r') as file:
        for line in file:
            cursor.execute(line)
    
cursor.close()
conn.close()