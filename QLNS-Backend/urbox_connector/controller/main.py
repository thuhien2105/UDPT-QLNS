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
    @routes.route("/category-list", methods=["GET"])
    def get_category_list():
        data=None
        if(request.args.get('parent')):
            parent_id=int(request.args.get('parent'))
            data = {"parent_id":parent_id}
        
       
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"category/catbyparent",data=data
            )
            response = result

            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                if( 'data'in response.keys()):
                    return jsonify(response["data"]), 200
                return jsonify([]), 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
                )
                return jsonify({"error": result}), status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID %d: %s",
                id,
                e,
            )
            return jsonify({"error": "An internal error occurred"}), 500
    # get brand  list 
    @staticmethod
    @routes.route("/brand-list", methods=["GET"])
    def get_brand_list():
        cat_id=0
        if(request.args.get('category')):
            cat_id=request.args.get('category')
        per_page=50
        if(request.args.get('per-page')):
            per_page=request.args.get('per-page')
        page=0
        if(request.args.get('page')):
            page=int(request.args.get('page'))-1
        data = {"cat_id":cat_id,"page_no": page, "per_page": per_page}
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"brand/getlist",data=data
            )
            response = result
            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                return jsonify(response["data"]["items"]), 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
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
    @routes.route("/brand/<int:id>", methods=["GET"])
    def get_brand_detail(id):
        
        data = {"brand_id":id}
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"brand/get",data=data
            )
            response = result
            # result, status_code = Connector.call(
            #     "GET", f"clubs/{id}/activities", params=params
            # )
            # response.update({"participants": result})
            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                return jsonify(response["data"]["items"]), 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
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
    @routes.route("/filter", methods=["GET"])
    def get_filter():
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"gift/filter",
            )
            response = result
            # result, status_code = Connector.call(
            #     "GET", f"clubs/{id}/activities", params=params
            # )
            # response.update({"participants": result})
            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                return jsonify(response["data"]["items"]), 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
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
    @routes.route("/categorie123213s/name-list    ", methods=["GET"])
    def get_activity(id):
        params=None
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

    