import mysql.connector

db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'esp_data'
}

# Use mysql.connector instead of connector
connection = mysql.connector.connect(**db_config)
cursor = connection.cursor()

sensor_data_query = "SELECT * FROM sensor1"
cursor.execute(sensor_data_query)
sensor_data = cursor.fetchall()

if not sensor_data:
    print("No data available in sensor1 table.")
    connection.close()
    exit()

num_records = len(sensor_data)
avg_values = {
    'air_temp': sum(record[1] for record in sensor_data) / num_records,
    'soil_temperature': sum(record[2] for record in sensor_data) / num_records,
    'nitrogen': sum(record[3] for record in sensor_data) / num_records,
    'phosphorus': sum(record[4] for record in sensor_data) / num_records,
    'potassium': sum(record[5] for record in sensor_data) / num_records
}

# Use f-string for cleaner SQL query formatting
insert_query = f"""
    INSERT INTO dailysensor1 (air_temp, soil_temperature, nitrogen, phosphorus, potassium)
    VALUES ({avg_values['air_temp']}, {avg_values['soil_temperature']}, {avg_values['nitrogen']}, {avg_values['phosphorus']}, {avg_values['potassium']})
"""

cursor.execute(insert_query)
connection.commit()

print("Average data inserted into dailysensor1 table successfully.")

# Close the database connection
connection.close()
