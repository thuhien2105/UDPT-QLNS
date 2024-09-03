<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //  public function test_get_activities()
    // {
    //     $response = $this->json('GET', '/api/activities');
    //     $responseData = $response->decodeResponseJson();
    //     $response->assertJsonStructure([
    //             'response' => [
    //                 '*' => [
    //                     'id',
    //                     'name',
    //                 ],
    //             ]
    //     ]);
    // }
    public function test_get_activity()
    {
        $response = $this->json('GET', '/api/activities/1287633');
        $responseData = $response->decodeResponseJson();
        $response->assertJsonStructure([
                'response' => [
                    'id',
                    'name',
                ]
        ]);
    }
    public function test_edit_activities()
    {
        $response = $this->json('PUT', '/api/activities/1287633', [
            'name' => 'demo2',
            'id' => '1287633',
        ]);
        $responseData = $response->decodeResponseJson();
        // dd($responseData);
        $response->assertJsonStructure([
            'response' => [
                'id',
                'name',
            ],
        ]);
    }
    // public function test_create_activities()
    // {
    //     $response = $this->json('POST', '/api/activities', [
    //         'name' => '1231123',
    //         'id' => '119',
    //     ]);
    //     $responseData = $response->decodeResponseJson();
    //     $response->assertJsonStructure([
    //         'response' => [
    //             'id',
    //             'name',
    //         ],
    //     ]);
    // }
}
