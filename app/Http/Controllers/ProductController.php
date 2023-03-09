<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function getDataFromApi()
    {

        $client = new Client([
            'base_uri' => 'https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/',
            'auth'     => ['ck_2682b35c4d9a8b6b6effac126ac552e0bfb315a0', 'cs_cab8c9a729dfb49c50ce801a9ea41b577c00ad71'],
        ]);

        $request = $client->request('GET', 'products');
        $totalPages = Arr::first($request->getHeader('X-WP-TotalPages'));
        $allData = [];

        for ($page = 1; $page <= $totalPages; $page++) {
            $response = $client->request('GET', 'products', [
                'query' => ['page' => $page, 'status' => 'publish'],
            ]);

            $jsonDatas = json_decode($response->getBody(), true);

            foreach ($jsonDatas as $jsonData) {
                $jsData = Arr::only($jsonData, ['id', 'name']);
                $jsData['image_url'] = Arr::first($jsonData['images'])['src'];
                array_push($allData, $jsData);
            }
        }
        Product::postProduct($allData);

        return 'Saved successfully';
    }

    public function index()
    {
        $products = Product::paginate(7);

        return view('catalogue', compact('products'));
    }

}
