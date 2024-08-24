import logging
from flask import Blueprint, request, jsonify
from werkzeug.exceptions import BadRequest
from ..config import Connector
from ..DTOs import (
    Activity,
)

_logger = logging.getLogger(__name__)

routes = Blueprint("main", __name__)


class MainController:
    @staticmethod
    @routes.route("/activities/<int:id>", methods=["GET"])
    def get_activity(id):
        include_all_efforts = request.args.get("include_all_efforts", "")
        params = {"include_all_efforts": include_all_efforts}
        try:
            result, status_code = Connector.call(
                "GET", f"activities/{id}", params=params
            )

            if status_code == 200:
                _logger.info("Successfully retrieved activity details for ID %d", id)
                return jsonify(result), 200
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

    @staticmethod
    @routes.route("/activities", methods=["POST"])
    def post_activity():
        try:
            data = request.json
            required_params = ["name", "sport_type", "start_date_local", "elapsed_time"]
            missing_params = [param for param in required_params if param not in data]

            if missing_params:
                _logger.error("Missing required parameters: %s", missing_params)
                return jsonify(
                    {
                        "error": f"Missing required parameters: {', '.join(missing_params)}"
                    }
                ), 400

            # Validate and convert inputs
            elapsed_time = int(data.get("elapsed_time"))
            distance = float(data.get("distance", 0.0))
            trainer = int(data.get("trainer", 0))
            commute = int(data.get("commute", 0))

            activity_data = {
                "name": data.get("name"),
                "type": data.get("type"),
                "sport_type": data.get("sport_type"),
                "start_date_local": data.get("start_date_local"),
                "elapsed_time": elapsed_time,
                "description": data.get("description"),
                "distance": distance,
                "trainer": trainer,
                "commute": commute,
            }

            result, status_code = Connector.call(
                "POST", "activities", data=activity_data
            )

            if status_code == 201:
                _logger.info("Successfully created activity")
                return jsonify(result), 201
            else:
                _logger.error("Failed to create activity: %s", result)
                return jsonify({"error": result}), status_code
        except ValueError as ve:
            _logger.error("Value error occurred: %s", ve)
            return jsonify({"error": "Invalid input value"}), 400
        except Exception as e:
            _logger.error("An error occurred while creating activity: %s", e)
            return jsonify({"error": "An internal error occurred"}), 500
