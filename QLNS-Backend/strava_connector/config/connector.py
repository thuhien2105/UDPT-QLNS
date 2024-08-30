import requests
from urllib.parse import urlencode
from datetime import datetime, timedelta


class Connector:
    base_url = "https://www.strava.com/api/v3/"
    client_id = 131833
    client_secret = "d020ae592b91c7a6c02028bf119d8d3d7d020680"
    access_token = None
    refresh_token = None
    token_expiry = None

    @classmethod
    def call(cls, method, endpoint, params=None, data=None, headers=None):
        try:
            url = f"{cls.base_url}{endpoint}"
            if headers is None:
                token, status = cls.get_token()
                if not status:
                    return {"Authorization URL": token}, 200
                headers = {
                    "Authorization": f"Bearer {token}",
                    "Content-Type": "application/json",
                }

            response = requests.request(
                method, url, params=params, json=data, headers=headers
            )

            # Ghi lại thông tin công việc
            cls.record_job(method, url, params, data, headers, response.json())

            # Kiểm tra lỗi HTTP
            response.raise_for_status()

            response_json = response.json()
            job = {
                "method": method,
                "url": url,
                "params": params,
                "json": data,
                "headers": headers,
                "response": response_json,
            }

            if response.status_code == 200:
                print("API call successful: %s", job)
            else:
                print("API call failed: %s", job)

            return response_json, response.status_code

        except requests.exceptions.HTTPError as http_err:
            print("HTTP error occurred: %s", http_err)
            return {"error": str(http_err)}, response.status_code

        except Exception as e:
            print("An error occurred: %s", e)
            return {"error": str(e)}, 500

    @classmethod
    def record_job(cls, method, url, params, data, headers, response_json):
        """Lưu thông tin công việc vào cơ sở dữ liệu."""
        try:
            job_data = {
                "method": method,
                "url": url,
                "params": params,
                "json": data,
                "headers": headers,
                "response": response_json,
            }
            print("Recorded job: %s", job_data)
        except Exception as e:
            print("Error recording job: %s", str(e))

    def get(self, endpoint, params=None):
        return self.call("GET", endpoint, params=params)

    def post(self, endpoint, data=None):
        return self.call("POST", endpoint, data=data)

    def put(self, endpoint, data=None):
        return self.call("PUT", endpoint, data=data)

    def delete(self, endpoint, data=None):
        return self.call("DELETE", endpoint, data=data)

    @classmethod
    def get_token(
        cls,
        redirect_uri="http://localhost:8000/api/callback",
        scope="read,read_all,profile:read_all,profile:write,activity:read,activity:read_all,activity:write",
    ):
        """Retrieve access token, refresh if necessary. Redirect to authorize if no token."""
        if cls.access_token is None:
            auth_url = cls.get_authorization_url(redirect_uri, scope)
            return auth_url, False
        elif cls.is_token_expired():
            cls.refresh_access_token()

        return cls.access_token, True

    @classmethod
    def token_exchange(cls, authorization_code):
        """Exchange authorization code for an access token."""
        url = "https://www.strava.com/api/v3/oauth/token"
        params = {
            "client_id": cls.client_id,
            "client_secret": cls.client_secret,
            "grant_type": "authorization_code",
            "code": authorization_code,
        }

        try:
            response = requests.post(url, data=params)
            response.raise_for_status()
            tokens = response.json()
            cls.access_token = tokens.get("access_token")
            cls.refresh_token = tokens.get("refresh_token", cls.refresh_token)
            cls.token_expiry = datetime.utcnow() + timedelta(
                seconds=tokens.get("expires_in", 0)
            )
            print("Token exchange successful: %s", tokens)
            return tokens
        except requests.exceptions.HTTPError as http_err:
            print("HTTP error occurred during token exchange: %s", http_err)
            return {"error": str(http_err)}

    @classmethod
    def refresh_access_token(cls):
        """Refresh access token using refresh token."""
        url = "https://www.strava.com/api/v3/oauth/token"
        params = {
            "client_id": cls.client_id,
            "client_secret": cls.client_secret,
            "grant_type": "refresh_token",
            "refresh_token": cls.refresh_token,
        }

        try:
            response = requests.post(url, data=params)
            response.raise_for_status()
            tokens = response.json()
            cls.access_token = tokens.get("access_token")
            cls.refresh_token = tokens.get("refresh_token", cls.refresh_token)
            cls.token_expiry = datetime.utcnow() + timedelta(
                seconds=tokens.get("expires_in", 0)
            )

            print("Token refresh successful: %s", tokens)
            return tokens
        except requests.exceptions.HTTPError as http_err:
            print("HTTP error occurred during token refresh: %s", http_err)
            return {"error": str(http_err)}

    @classmethod
    def is_token_expired(cls):
        """Check if the token is expired."""
        if cls.token_expiry is None:
            return True
        current_time = datetime.utcnow()
        return current_time >= cls.token_expiry

    @classmethod
    def get_authorization_url(
        cls, redirect_uri="http://localhost:5000/callback", scope="read"
    ):
        """Generate authorization URL for user consent."""
        params = {
            "client_id": cls.client_id,
            "redirect_uri": redirect_uri,
            "response_type": "code",
            "scope": scope,
        }
        query_string = urlencode(params)
        auth_url = f"https://www.strava.com/oauth/authorize?{query_string}"
        print("Authorization URL: %s", auth_url)
        return auth_url
