<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\RabbitMQConnection;

class GiftController extends Controller
{
    protected $rabbitMQService;

    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }
    public function getGiftList(Request $request)
    {
        try {
            $message = json_encode([
                'action' => 'get_gift_list',
                'data' => [
                    "brand_id" => $request->brand_id,
                    "city_id" => $request->city_id,
                    "cat_id" => $request->cat_id,
                    "is_hot" => $request->is_hot,
                    "per_page" => $request->per_page,
                    "page_no" =>  $request->page_no,
                    "id_gift_set" => $request->id_gift_set,

                ],
            ]);
            $response = $this->rabbitMQService->sendToGiftQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending post_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function getGiftDetail(Request $request,$id)
    {
        try {
            $message = json_encode([
                'action' => 'get_gift_detail',
                'data' => [
                    "id"  => $id,
                    "id_gift_set" => $request->id_gift_set,
                ],
            ]);
            $response = $this->rabbitMQService->sendToGiftQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending post_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function buyGiftSubitem(Request $request,$gift_id,$id)
    {
        try {
            $message = json_encode([
                'action' => 'buy_gift_subitem',
                'data' => [
                    "id"  => $request->id,
                    "employee_id"  => $request->employee_id,

                ],
            ]);
            $response = $this->rabbitMQService->sendToGiftQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending post_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function getGiftSubitem(Request $request,$gift_id,$id)
    {
        try {
            $message = json_encode([
                'action' => 'get_gift_subitem',
                'data' => [
                    "id"  => $id,
                    "gift_id"=>$gift_id

                ],
            ]);
            $response = $this->rabbitMQService->sendToGiftQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending post_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function getCategoryList(Request $request)
    {
        try {
            $message = json_encode([
                'action' => 'get_category_list',
                'data' => [
                    "parent"  => $request->parent,
                ],
            ]);
            $response = $this->rabbitMQService->sendToGiftQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending post_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function getBrandList(Request $request)
    {
        try {
            $message = json_encode([
                'action' => 'get_brand_list',
                'data' => [
                    "category"  => $request->category,
                    "per_page" => $request->per_page,
                    "page_no" =>  $request->page_no,
                ],
            ]);
            $response = $this->rabbitMQService->sendToGiftQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending post_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function getBrandDetail(Request $request,$id )
    {
        try {
            $message = json_encode([
                'action' => 'get_brand_detail',
                'data' => [

                    "id"  =>$id,
                ],
            ]);
            $response = $this->rabbitMQService->sendToGiftQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending post_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function getFilter(Request $request )
    {
        try {
            $message = json_encode([
                'action' => 'get_filter',
                'data' => [

                ],
            ]);
            $response = $this->rabbitMQService->sendToGiftQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending post_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

}
