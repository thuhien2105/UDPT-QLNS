import json
from ..config import Connector


class MessageHandler:
    @staticmethod
    def handle_authorize(data):
        try:
            redirect_uri = data.get("redirect_uri", "")
            auth_url = Connector.get_authorization_url(redirect_uri)
            print(f"Authorization URL generated: {auth_url}")
            return f"Authorization URL generated: {auth_url}", 200
        except Exception as e:
            print(f"Error generating authorization URL: {str(e)}")
            return f"Error generating authorization URL: {str(e)}", 200

    @staticmethod
    def handle_token_exchange(data):
        try:
            authorization_code = data.get("authorization_code", "")
            print(authorization_code)
            tokens = Connector.token_exchange(authorization_code)
            if "access_token" in tokens:
                print(f"Tokens exchanged successfully: {tokens}")
                return f"Tokens exchanged successfully: {tokens}", 200
            else:
                print(f"Error exchanging authorization code: {tokens}")
                return f"Error exchanging authorization code: {tokens}", 500
        except Exception as e:
            print(f"Error exchanging authorization code: {str(e)}")
            return f"Error exchanging authorization code: {str(e)}", 500

    @staticmethod
    def handle_refresh_token(data={}):
        try:
            tokens = Connector.refresh_access_token()
            if "access_token" in tokens:
                print(f"Tokens refreshed successfully: {tokens}")
                return f"Tokens refreshed successfully: {tokens}", 200
            else:
                print(f"Error refreshing access token: {tokens}")
                return f"Error refreshing access token: {tokens}", 500
        except Exception as e:
            print(f"Error refreshing access token: {str(e)}")
            return f"Error refreshing access token: {str(e)}", 500
