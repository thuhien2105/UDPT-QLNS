<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\RabbitMQConnection;

class RewardController extends Controller
{
    protected $rabbitMQService;

    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }
    public function getGiftAccount(Request $request,$id)
    {
        try {
            $message = json_encode([
                'action' => 'get_employee_gift_account',
                'data' => [
                    'id' => $id,

                ],
            ]);
            $response = $this->rabbitMQService->sendToRewardQueue($message);
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
    public function getGiftAccountGift(Request $request,$id)
    {
        try {
            $message = json_encode([
                'action' => 'get_employee_gift',
                'data' => [
                    'id' =>$id,
                    'per-page' => $request->input('per-page'),
                    'page' => $request->input('page'),
                ],
            ]);
            $response = $this->rabbitMQService->sendToRewardQueue($message);
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
    public function getGiftAccountGiftDetail(Request $request,$id,$gift_id)
    {
        try {
            $message = json_encode([
                'action' => 'get_employee_gift_detail',
                'data' => [
                    'id' =>$id,
                    'gift_id' => $gift_id
                ],
            ]);
            $response = $this->rabbitMQService->sendToRewardQueue($message);
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
