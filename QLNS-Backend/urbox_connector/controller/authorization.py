import logging
from flask import Blueprint, request, jsonify, redirect
from werkzeug.exceptions import BadRequest, Unauthorized

from ..config import Connector

_logger = logging.getLogger(__name__)

routes = Blueprint("authorization", __name__)

class AuthorizationController:
    @staticmethod
    @routes.route("/authorize", methods=["GET"])
    def authorize():
        try:
            redirect_uri = request.host_url + 'callback'
            auth_url = Connector.get_authorization_url(redirect_uri)
            return redirect(auth_url)
        except Exception as e:
            _logger.error("Error during authorization: %s", str(e))
            raise BadRequest("Error generating authorization URL")

    @staticmethod
    @routes.route("/callback", methods=["GET"])
    def callback():
        authorization_code = request.args.get("code")
        if not authorization_code:
            _logger.error("Authorization code not found in callback")
            raise BadRequest("Authorization code not found")

        try:
            tokens = Connector.token_exchange(authorization_code)
            if 'access_token' in tokens:
                return jsonify(tokens), 200
            else:
                _logger.error("Error exchanging authorization code: %s", tokens)
                raise Unauthorized("Error exchanging authorization code")
        except Exception as e:
            _logger.error("Exception during token exchange: %s", str(e))
            raise BadRequest("Error exchanging authorization code")

    @routes.route("/refresh_token", methods=["POST"])
    def refresh_token():
        try:
            tokens = Connector.refresh_access_token()
            if "access_token" in tokens:
                return jsonify(tokens), 200
            else:
                _logger.error("Error refreshing access token: %s", tokens)
                raise Unauthorized("Error refreshing access token")
        except Exception as e:
            _logger.error("Exception during token refresh: %s", str(e))
            raise BadRequest("Error refreshing access token")
