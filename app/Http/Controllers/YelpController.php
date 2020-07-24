<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class YelpController extends Controller
{
    private const BASE_URL = 'https://api.yelp.com/v3/businesses/';

    /**
     * Make Request.
     *
     * @OA\Get(
     *   path="/api/get-yelp-data/{id}",
     *   tags={"Get Yelp Data"},
     *   summary="Retrieve business information through Yelp API",
     *   @OA\Parameter(
     *     name="id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="User successfully logged in",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Business not found",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Unauthenticated"
     *   )
     * )
     *
     * @param $qry_params
     * @return array
     * @throws \Exception
     */
    private function makeRequest($qry_params)
    {
        $client = new Client();
        $api_key = env('YELP_API_KEY');

        $headers = [
            'headers' => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer '.$api_key
            ]
        ];
        try {
            $response = $client->request('GET',self::BASE_URL."$qry_params", $headers);
            $data_body = [];

            if ($response->getStatusCode() == 200) {
                $data_body = json_decode($response->getBody(), true);
                $code = $response->getStatusCode();
            }
        } catch (\Exception $e) {
            $data_body = ['message'=>'Business Not found'];
            $code = 404;
        }
        return ["data" => $data_body, 'code' => $code];
    }

    /**
     * Get Data.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getData(Request $request)
    {
        $response = $this->makeRequest($request->get('id'));
        return response()->json($response['data']);
    }

}
