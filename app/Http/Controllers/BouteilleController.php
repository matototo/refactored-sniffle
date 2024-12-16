<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use Goutte\Client;
use Illuminate\Http\Request;

class BouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bouteilles = Bouteille::All();

        return view('bottle.index', ['bouteilles' => $bouteilles]);
    }

    /**
     * Lance le scraping des bouteilles depuis le site de la SAQ en parcourant plusieurs pages.
     */
    public function scrape()
    {
        set_time_limit(5);

        $client = new Client();
        $nextUrl = "https://www.saq.com/en/products/wine";

        while ($nextUrl) {
            $nextUrl = $this->scrapeSAQWines($nextUrl, $client);
        }

        return;
    }

    /**
     * Scrape les titres des bouteilles sur une page et gère la pagination.
     */
    private function scrapeSAQWines($url, $client)
    {
        $crawler = $client->request('GET', $url);

        $crawler->filter('a.product-item-link')->each(function ($node) {
            $nom = trim($node->text());
            $priceNode = $node->closest('li.product-item')
                            ->filter('.price-box .price')
                            ->first();

            // TODO: Format price
            $price = $priceNode->count() ? trim($priceNode->text()) : 'N/A';

            $identityNode = $node->closest('li.product-item')
                                ->filter('.product .product-item-identity-format')
                                ->first();

            // TODO: Format Type = $identityNode[0]
            // TODO: Format Ml = $identityNode[1]
            // TODO: Format Country = $identityNode[2];
            $identity = trim($identityNode->text());

            // echo "Wine Name: $nom | Price: $price\n | Identity: $identity";

            // Insert
            Bouteille::create([
                'nom' => $nom,
                'prix' => $price,
                'identity' => $identity,
            ]);
        });


        // Handle pagination
        try {
            $nextPage = $crawler->filter('a.action.next')->attr('href');
            return $nextPage ?: null;
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }
}