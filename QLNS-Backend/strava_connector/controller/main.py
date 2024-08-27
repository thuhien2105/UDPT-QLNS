import logging
from flask import Blueprint, request, jsonify
from werkzeug.exceptions import BadRequest
from ..config import Connector, mysql_db_connection_activities
from ..DTOs import (
    Activity,
)

_logger = logging.getLogger(__name__)

routes = Blueprint("main", __name__)


class MainController:
    @staticmethod
    @routes.route("/activities", methods=["GET"])
    def get_activities():
        conn = mysql_db_connection_activities()
        try:
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT * FROM activities")
            data = cursor.fetchall()
            cursor.close()
            conn.close()
            return jsonify(data), 200
        except Exception as e:
            _logger.error("An error occurred while retrieving activities")
            return jsonify({"error": e}), 500

    @staticmethod
    @routes.route("/activities", methods=["POST"])
    def post_activities():
        conn = mysql_db_connection_activities()
        try:
            cursor = conn.cursor(dictionary=True)
            activity_data = request.get_json()
            if not activity_data or 'name' not in activity_data or 'id' not in activity_data:
                return jsonify({"error": "Invalid data. Both 'id' and 'name' are required."}), 400
            cursor.execute("SELECT COUNT(*) FROM activities WHERE id = %s", (activity_data['id'],))
            if cursor.fetchone()['COUNT(*)'] > 0:
                return jsonify({"error": "ID already exists."}), 400
            sql = "INSERT INTO activities (id, name) VALUES (%s, %s)"
            cursor.execute(sql, (activity_data['id'], activity_data['name']))
            conn.commit()
            response_data = {
                'id': activity_data['id'],
                'name': activity_data['name']
            }
            cursor.close()
            conn.close()
            return jsonify(response_data), 201
        except Exception as e:
            _logger.error(f"An error occurred while adding activity: {e}")
            return jsonify({"error": str(e)}), 500

    @staticmethod
    @routes.route("/activities/<int:id>", methods=["PUT"])
    def update_activity(id):
        conn = mysql_db_connection_activities()
        try:
            cursor = conn.cursor(dictionary=True)
            activity_data = request.get_json()
            if not activity_data or 'name' not in activity_data:
                return jsonify({"error": "Invalid data. 'name' is required."}), 400
            cursor.execute("SELECT COUNT(*) FROM activities WHERE id = %s", (id,))
            if cursor.fetchone()['COUNT(*)'] == 0:
                return jsonify({"error": "ID does not exist."}), 404
            sql = "UPDATE activities SET name = %s WHERE id = %s"
            cursor.execute(sql, (activity_data['name'], id))
            conn.commit()
            response_data = {
                'id': id,
                'name': activity_data['name']
            }
            cursor.close()
            conn.close()
            return jsonify(response_data), 200
        except Exception as e:
            _logger.error(f"An error occurred while updating activity: {e}")
            return jsonify({"error": str(e)}), 500

    @staticmethod
    @routes.route("/activities/<int:id>", methods=["GET"])
    def get_activity(id):
        params = {"page": 1, "per_page": 30}
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"clubs/{id}", params=params
            )
            response = result
            result, status_code = Connector.call(
                "GET", f"clubs/{id}/activities", params=params
            )
            response.update({"participants": result})
            if status_code == 200:
                _logger.info("Successfully retrieved activity details for ID %d", id)
                return jsonify(response), 200
            else:
                _logger.error(
                    "Failed to retrieve activity details for ID %d: %s", id, result
                )
                return jsonify({"error": result}), status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID %d: %s",
                id,
                e,
            )
            return jsonify({"error": "An internal error occurred"}), 500

    