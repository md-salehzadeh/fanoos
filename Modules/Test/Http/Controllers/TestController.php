<?php

namespace Modules\Test\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
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

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('test::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('test::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('test::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
