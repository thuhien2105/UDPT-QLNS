import logging
import time
import qrcode
from flask import Blueprint, request, jsonify
from flask import send_from_directory
from ..config import Connector, mysql_db_connection_employee,mysql_db_connection_reward,Connector
from werkzeug.exceptions import BadRequest
import json

_logger = logging.getLogger(__name__)
# routes = Blueprint("main", __name__)


class MainController:
    @staticmethod
    # @routes.route("/static/<path:path>", methods=["GET"])
    def get_resource(path):
        return send_from_directory('urbox_connector/static',path)
    @staticmethod
    # @routes.route("/employee/<string:id>/gift", methods=["GET"])
    def get_employee_gift(data={}):
        if(not 'id' in data or data['id'] == None):
            return {"error": "Missing Employee ID"}, 404
        id=data["id"]
        per_page=10
        if('per-page' in data and data['per-page'] != None):
            per_page=data['per-page']
        page=0
        if('page'in data and data['page'] != None):
            page=int(data['page'])-1
        conn = mysql_db_connection_reward()
        
        try:
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT id,gift_name,gift_price,gift_price_format,gift_image,gift_code,gift_qr,employee_id FROM gift where employee_id=%(emp_no)s limit %(perpage)s offset %(page)s ",{'emp_no':id,'perpage':per_page,'page':page*per_page})
            data = cursor.fetchall()
            cursor.execute("SELECT count(*) total FROM gift where employee_id=%(emp_no)s ",{'emp_no':id})
            total = cursor.fetchone()
            total_page=int(total['total']/per_page)
            if(total['total']%per_page>0):
                total_page+=1
            cursor.close()
            conn.close()
            return {'items':data,'total_page': +total_page}, 200
        except Exception as e:
            _logger.error("An error occurred while retrieving activities: %s", e)
            return {"error": str(e)}, 500
    @staticmethod
    # @routes.route("/employee/<string:id>", methods=["GET"])
    def get_employee_gift_account(data={}):
        if(not 'id' in data or  data['id'] == None):
            return {"error": "Missing Employee ID"}, 404
        id=data["id"]
        conn = mysql_db_connection_reward()
        try:
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT employee_id,point FROM gift_account where employee_id=%(emp_no)s ",{'emp_no':id})
            data = cursor.fetchone()
            if(not data):
                try:
                    result= cursor.execute("INSERT INTO gift_account (employee_id,point,created_at,updated_at) values (%(emp_no)s,%(point)s,CURTIME(),CURTIME())",{'emp_no':id,'point':2000})
                    conn.commit()
                    cursor.execute("SELECT * FROM gift_account where employee_id=%(emp_no)s ",{'emp_no':id})
                    data = cursor.fetchone()
                except Exception as e:
                    _logger.error("An error occurred while creating account: %s", e)
                    return {"error": str(e)}, 500
            cursor.close()
            conn.close()
            return data, 200
        except Exception as e:
            _logger.error("An error occurred while retrieving activities: %s", e)
            return {"error": str(e)}, 500
    @staticmethod
    # @routes.route("/employee/<string:id>/gift/<int:gift_id>", methods=["GET"])
    def get_employee_gift_detail(data={}):
        # id,gift_id
        if(not 'id' in data or data['id'] == None):
            return {"error": "Missing Employee ID"}, 404
        id=data["id"]
        if(not 'gift_id' in data or data['gift_id'] == None):
            return {"error": "Missing Gift ID"}, 404
        gift_id=data["gift_id"]
        conn = mysql_db_connection_reward()
        try:
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT id,gift_name,gift_price,gift_price_format,gift_image,gift_code,gift_qr,employee_id FROM  gift g  where g.employee_id=%(emp_no)s and g.id=%(gift_id)s ",{'emp_no':id,'gift_id':int(gift_id)})
            data = cursor.fetchone()
            cursor.close()
            conn.close()
            return data, 200
        except Exception as e:
            _logger.error("An error occurred while retrieving activities: %s", e)
            return {"error": str(e)}, 500
    @staticmethod
    # @routes.route("/gift/<int:gift_id>/<int:id>", methods=["POST"])
    def buy_gift_subitem(data={}):
        if(not 'employee_id' in data or data['employee_id'] == None) :
            return {"error": "Missing Employee ID"}, 404
        if(not 'id' in data or data['id'] == None):
            return {"error": "Missing Gift ID"}, 404
        # Read Input
        # data =json.loads(request.get_data())
        # Find Gift
        if("id" not in data):
            return {"error": "Missing Item"}, 404
        try:
            item, status_code = Connector.call(
                "GET", f"gift/item",data={"id":data["id"]}
            )
            if status_code != 200:
                return {"error": "Item not found"}, 404
            item=item["data"]
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving item %d: %s",
                id,
                e,
            )
            return {"error": "An internal error occurred"}, 500
        #Get Employee Account
        conn = mysql_db_connection_reward()
        try:
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT * FROM gift_account where employee_id=%(emp_no)s ",{'emp_no':data["employee_id"]})
            emp = cursor.fetchone()
            cursor.close()
            if(len(emp)==0):
                return {"error": str("not found employee")}, 500
        except Exception as e:
            _logger.error("An error occurred while retrieving employee : %s", e)
            return {"error": str(e)}, 500
        # Change Point
        if(int(emp["point"])*1000>=int(item["price"])):
            try:
                cursor = conn.cursor(dictionary=True)
                cursor.execute("UPDATE gift_account set point=point-%(price)s where employee_id=%(emp_no)s ",{'emp_no':data["employee_id"],'price':int(item["price"])/1000})
                cursor.close()
                conn.commit()
            except Exception as e:
                _logger.error(
                "An error occurred while retrieving item %d: %s",
                id,
                e,
                )
                return {"error": "An internal error occurred"}, 500
        else:
            return {"error":"Not enough Point"}, 404
        
        # Create Gift Code
        gift_code={
            "gift_name":item["title"],
            "gift_price":int(item["price"]),
            "gift_price_format":item["price_format"],
            "gift_image":item["images"],
            "gift_code":"%s%s%s" % (emp["employee_id"],item["id"],int(time.time())),
           
            "employee_id":emp["employee_id"]
        }
        try:
                qr = qrcode.QRCode(version=1,
                   box_size=10,
                   border=5)
                qr.add_data(gift_code["gift_code"])
                qr.make(fit=True)
                img = qr.make_image(fill_color='black', back_color='white')
                img.save(f'urbox_connector/static/{gift_code["gift_code"]}.png')
                gift_code["gift_qr"]=f'/static/{gift_code["gift_code"]}.png'
                cursor = conn.cursor(dictionary=True)
                cursor.execute("""INSERT INTO gift (gift_name,gift_price,gift_price_format,gift_image,gift_code,gift_qr,created_at,updated_at,employee_id) values (%(gift_name)s,%(gift_price)s,%(gift_price_format)s,%(gift_image)s,%(gift_code)s,%(gift_qr)s,CURTIME(),CURTIME(),%(employee_id)s)""",gift_code)
                cursor.close()
        except Exception as e:
                _logger.error(
                "An error occurred while retrieving item %d: %s",
                id,
                e,
                )
                cursor = conn.cursor(dictionary=True)
                cursor.execute("UPDATE gift_account set point=point+%(price)s where employee_id=%(emp_no)s ",{'emp_no':data["employee_id"],'price':int(item["price"])/1000})
                cursor.close()
                return {"error": "An internal error occurred"}, 500
        conn.commit()
        conn.close()
        return {"result":"ok"}, 200
        
        
    @staticmethod
    # @routes.route("/gift/<int:gift_id>/<int:id>", methods=["GET"])
    def get_gift_subitem( data={}):
       
        if(not 'gift_id' in data or data['gift_id'] == None):
            return {"error": "Missing Gift ID"}, 404
        if(not 'id' in data or data['id'] == None):
            return {"error": "Missing Sub Gift ID"}, 404
        
        id=data['id']
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"gift/item",data ={"id" :id,}
            )
            response = result

            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                if( 'data'in response.keys()):
                    return response['data'], 200
                return  {}, 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
                )
                return {"error": result}, status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID %d: %s",
                id,
                e,
            )
            return {"error": "An internal error occurred"}, 500
    @staticmethod
    # @routes.route("/gift/<int:id>", methods=["GET"])
    def get_gift_detail(data={}):
        
        if(not 'id' in data or data['id'] == None):
            return {"error": "Missing Gift ID"}, 404
        id=data["id"]
        id_gift_set=0
        if('id_gift_set' in data and data['id_gift_set'] != None):
            id_gift_set=int(data['id_gift_set'])
       
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"gift/detail",data={"id" :id,
            "id_gift_set":id_gift_set,
        }
            )
            response = result

            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                if( 'data'in response.keys()):
                    return response["data"], 200
                return [], 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
                )
                return {"error": result}, status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID %d: %s",
                id,
                e,
            )
            return {"error": "An internal error occurred"}, 500
    @staticmethod
    # @routes.route("/gift/list", methods=["GET"])
    def get_gift_list(data={}):
        brand_id=0
        city_id=0
        is_hot=0
        cat_id=0
        per_page=10
        page_no=0
        id_gift_set=0
        # print("hello")
        if('brand' in data and data['brand'] != None ):
            brand_id=int(data['brand'])
        if('city' in data and data['city'] != None ):
            city_id=int(data['city'])
        if('category' in data and  data['category'] != None  ):
            cat_id=int(data['category'])
        if('is_hot' in data and  data['is_hot'] != None ):
            is_hot=int(data['is_hot']  )
        if('per_page' in data and data['per_page']!= None ):
            per_page=int(data['per_page'])
        if('page' in data  and data['page'] != None  ):
            page_no=int(data['page'])-1
        if('id_gift_set' in data and data['id_gift_set']!= None ):
            id_gift_set=int(data['id_gift_set'])
                                            

        try:
            response = {}
           
            result, status_code = Connector.call(
                "GET", f"gift/getlist", data ={"brand_id" :brand_id,
            "city_id" :city_id,
            "cat_id" : cat_id, 
            "is_hot" : is_hot, 
            "per_page" : per_page, 
            "page_no" :  page_no, 
            "id_gift_set":id_gift_set,
        }
            )
            response = result

            if status_code == 200:
           
                _logger.info("Successfully retrieved gift filter",)
                
                if( 'data'in response.keys()):
                    return {'items':response["data"]["items"],'total_page':response["data"]["totalPage"]}, 200
                return {'items':[],'total_page':0}, 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
                )
                return {"error": result}, status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID: %s",
               
                e,
            )
            return {"error": "An internal error occurred"}, 500
    @staticmethod
    # @routes.route("/category/list", methods=["GET"])
    def get_category_list(data={}):
        data_body=None
        if('parent' in data and data['parent'] != None):
            parent_id=int(data['parent'])
            data_body = {"parent_id":parent_id}
        
       
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"category/catbyparent",data=data_body
            )
            response = result

            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                if( 'data'in response.keys()):
                    return {"items":response["data"],'total_page':1}, 200
                return {'items':[],'total_page':0}, 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
                )
                return {"error": result}, status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID : %s",
           
                e,
            )
            return {"error": "An internal error occurred"}, 500
    # get brand  list 
    @staticmethod
    # @routes.route("/brand/list", methods=["GET"])
    def get_brand_list(data={}):
        cat_id=0
        per_page=10
        page=0
        if('category' in data and data['category'] != None ):
            cat_id=int(data['category'])
        if('per_page' in data and data['per_page'] != None):
            per_page=int(data['per_page'])
        if('page' in data  and data['page'] != None):
            page=int(data['page'])-1
    
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"brand/getlist",data= {"cat_id":cat_id,"page_no": page, "per_page": per_page}
            )
            response = result
            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                if( 'data'in response.keys()):
                    return {"items":response["data"]["items"],'total_page':response["data"]["totalPage"]}, 200
                return {'items':[],'total_page':0}, 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
                )
                return {"error": result}, status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID %d: %s",
                id,
                e,
            )
            return {"error": "An internal error occurred"}, 500
    @staticmethod
    # @routes.route("/brand/<int:id>", methods=["GET"])
    def get_brand_detail(data={}):
        if(not 'id' in data or data['id'] == None):
            return {"error": "Missing Brand ID"}, 404
        id=data["id"]
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"brand/get",data={"brand_id":id}
            )
            response = result
            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                return response["data"]["items"], 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
                )
                return {"error": result}, status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID %d: %s",
                id,
                e,
            )
            return {"error": "An internal error occurred"}, 500
    @staticmethod
    # @routes.route("/filter", methods=["GET"])
    def get_filter(data={}):
        try:
            response = {}
            result, status_code = Connector.call(
                "GET", f"gift/filter",
            )
            response = result
            if status_code == 200:
                _logger.info("Successfully retrieved gift filter",)
                return response["data"]["items"], 200
            else:
                _logger.error(
                    "Failed to retrieve gift filter: %s", result
                )
                return {"error": result}, status_code
        except Exception as e:
            _logger.error(
                "An error occurred while retrieving activity details for ID : %s",
    
                e,
            )
            return {"error": "An internal error occurred"}, 500

    # @staticmethod
    # @routes.route("/categorie123213s/name-list    ", methods=["GET"])
    # def get_activity(id):
    #     params=None
    #     try:
    #         response = {}
    #         result, status_code = Connector.call(
    #             "GET", f"clubs/{id}", params=params
    #         )
    #         response = result
    #         result, status_code = Connector.call(
    #             "GET", f"clubs/{id}/activities", params=params
    #         )
    #         response.update({"participants": result})
    #         if status_code == 200:
    #             _logger.info("Successfully retrieved activity details for ID %d", id)
    #             return jsonify(response), 200
    #         else:
    #             _logger.error(
    #                 "Failed to retrieve activity details for ID %d: %s", id, result
    #             )
    #             return jsonify({"error": result}), status_code
    #     except Exception as e:
    #         _logger.error(
    #             "An error occurred while retrieving activity details for ID %d: %s",
    #             id,
    #             e,
    #         )
    #         return jsonify({"error": "An internal error occurred"}), 500

    