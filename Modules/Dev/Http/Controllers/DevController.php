<?php

namespace Modules\Dev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;

class DevController extends Controller
{
	
    public function index()
    {
        $html = file_get_contents('http://www.tgju.org/');

		$crawler = new Crawler($html);

		$crawler->filter('[data-header-links-tab="global-market-1"] > a + ul > li:first-child + li a')->each(function ($node) {
			print $node->text()."\n";
		});
		die;

		$client = new Client();

		$crawler = $client->request('GET', 'http://www.tgju.org/');

		$crawler->filter('[data-header-links-tab="global-market-1"] > a + ul > li:first-child + li a')->each(function ($node) {
			print $node->text()."\n";
		});

		die;
		dd($crawler);
        return view('test::index');
	}
	
}