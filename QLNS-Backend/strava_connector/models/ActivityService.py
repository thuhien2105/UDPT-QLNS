import logging
from flask import request, jsonify
from werkzeug.exceptions import BadRequest
from ..config import mysql_db_connection_activities, Connector

_logger = logging.getLogger(__name__)

class ActivityService:
    @staticmethod
    def get_activities(data={}):
        conn = mysql_db_connection_activities()
        try:
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT * FROM activities")
            data = cursor.fetchall()
            cursor.close()
            conn.close()
            return data, 200
        except Exception as e:
            _logger.error("An error occurred while retrieving activities: %s", e)
            return {"error": str(e)}, 500

    @staticmethod
    def post_activities(data):
        conn = mysql_db_connection_activities()
        try:
            if not data or 'name' not in data or 'id' not in data:
                return {"error": "Invalid data. Both 'id' and 'name' are required."}, 400
            
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT COUNT(*) FROM activities WHERE id = %s", (data['id'],))
            if cursor.fetchone()['COUNT(*)'] > 0:
                return {"error": "ID already exists."}, 400
            
            sql = "INSERT INTO activities (id, name) VALUES (%s, %s)"
            cursor.execute(sql, (data['id'], data['name']))
            conn.commit()
            response_data = {
                'id': data['id'],
                'name': data['name']
            }
            cursor.close()
            conn.close()
            return response_data, 201
        except Exception as e:
            _logger.error("An error occurred while adding activity: %s", e)
            return {"error": str(e)}, 500

    @staticmethod
    def update_activity(data):
        id_activity = data.get('id', False)
        data_activity = data.get('data', False)
        conn = mysql_db_connection_activities()
        try:
            if not data_activity or 'name' not in data_activity:
                return {"error": "Invalid data. 'name' is required."}, 400
            
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT COUNT(*) FROM activities WHERE id = %s", (id_activity,))
            if cursor.fetchone()['COUNT(*)'] == 0:
                return {"error": "ID does not exist."}, 404
            
            sql = "UPDATE activities SET name = %s WHERE id = %s"
            cursor.execute(sql, (data_activity['name'], id_activity))
            conn.commit()
            response_data = {
                'id': id_activity,
                'name': data_activity['name']
            }
            cursor.close()
            conn.close()
            return response_data, 200
        except Exception as e:
            _logger.error("An error occurred while updating activity: %s", e)
            return {"error": str(e)}, 500

    @staticmethod
    def get_activity(data):
        id_activity = data.get('id', False)
        params = {"page": 1, "per_page": 30}
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"clubs/{id_activity}", params=params
            )
            response = result
            result, status_code = Connector.call(
                "GET", f"clubs/{id_activity}/activities", params=params
            )
            response.update({"participants": result})
            if status_code == 200:
                _logger.info("Successfully retrieved activity details for ID %d", id_activity)
                return response, 200
            else:
                _logger.error("Failed to retrieve activity details for ID %d: %s", id_activity, result)
                return {"error": result}, status_code
        except Exception as e:
            _logger.error("An error occurred while retrieving activity details for ID %d: %s", id_activity, e)
            return {"error": "An internal error occurred"}, 500
