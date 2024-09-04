<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\RabbitMQConnection;

class ActivityController extends Controller
{
    protected $rabbitMQService;

    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function getActivities()
    {
        try {
            $message = json_encode([
                'action' => 'get_activities',
                'data' => [],
            ]);
            $response = $this->rabbitMQService->sendToActivityQueue($message);
            if (is_string($response))
                $responseData = json_decode($response, true);
            else
                $responseData = $response;

            if (isset($responseData['error'])) {
                return response()->json(['status' => 'Error', 'error' => $responseData['error']], 400);
            }

            return response()->json(['response' => $responseData], 200);
        } catch (\Exception $e) {
            Log::error("An error occurred while sending get_activities message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function postActivities(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
        ]);

        try {
            $message = json_encode([
                'action' => 'add_activity',
                'data' => [
                    'id' => $request->input('id'),
                    'name' => $request->input('name'),
                ],
            ]);
            $response = $this->rabbitMQService->sendToActivityQueue($message);
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
            Log::error("An error occurred while sending add_activity message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function updateActivity(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $message = json_encode([
                'action' => 'update_activity',
                'data' => [
                    'id' => $id,
                    'data' => [
                        'name' => $request->input('name'),
                    ],
                ],
            ]);
            $response = $this->rabbitMQService->sendToActivityQueue($message);
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
            Log::error("An error occurred while sending update_activity message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function getActivity(int $id)
    {
        try {
            $message = json_encode([
                'action' => 'get_activity',
                'data' => [
                    'id' => $id,
                ],
            ]);
            $response = $this->rabbitMQService->sendToActivityQueue($message);
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
            Log::error("An error occurred while sending get_activity message: {$e->getMessage()}");
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function activity_authorize(Request $request)
    {
        try {
            $redirectUri = url('callback');
            $message = json_encode([
                'action' => 'handle_authorize',
                'data' => [
                    'redirect_uri' => $redirectUri,
                ],
            ]);

            $response = $this->rabbitMQService->sendToActivityQueue($message);
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
            Log::error('Error during authorization: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function activity_callback(Request $request)
    {
        $authorizationCode = $request->query('code');

        if (!$authorizationCode) {
            Log::error('Authorization code not found in callback');
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }

        try {
            $message = json_encode([
                'action' => 'handle_token_exchange',
                'data' => [
                    'authorization_code' => $authorizationCode,
                ],
            ]);

            $response = $this->rabbitMQService->sendToActivityQueue($message);
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
            Log::error('Exception during token exchange: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function activity_refreshToken(Request $request)
    {
        try {
            $message = json_encode([
                'action' => 'handle_refresh_token',
                'data' => [],
            ]);

            $response = $this->rabbitMQService->sendToActivityQueue($message);
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
            Log::error('Exception during token refresh: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
