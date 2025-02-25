<?php

use Symfony\Component\DomCrawler\Crawler;

it('renders the default links correctly', function () {
    $html = (string) $this->blade('<x-favicon::links />');

    $crawler = new Crawler($html);
    expect($crawler->filterXPath('descendant-or-self::link')->count())->toBe(4);
    expect($crawler->filterXPath('descendant-or-self::meta')->count())->toBe(1);

    expect($html)->toEqual('<link rel="icon" type="image/png" sizes="96x96" href="http://localhost/icons/favicon-96x96.png" />
<link rel="shortcut icon" href="http://localhost/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="http://localhost/icons/favicon-180x180-maskable.png" />
<meta name="apple-mobile-web-app-title" content="Laravel" />
<link rel="manifest" href="http://localhost/manifest.json" />');
});
