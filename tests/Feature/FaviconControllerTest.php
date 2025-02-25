<?php

it('returns favicons in the requested format', function () {
    $response = $this->get('favicon.ico');
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'image/x-icon');
    $response->assertHeader('Content-Disposition', 'inline; filename="favicon.ico"');

    $response = $this->get('icons/favicon-123x123.png');
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'image/png');

    $response = $this->get('icons/favicon-123x123-maskable.png');
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'image/png');
});

it('returns favicons in the requested size', function () {
    $response = $this->get('favicon.ico');
    $response->assertStatus(200);
    ob_start();
    $response->sendContent();
    $data = ob_get_clean();
    $info = getimagesizefromstring($data);
    $this->assertEquals(48, $info[0]);
    $this->assertEquals(48, $info[1]);

    $response = $this->get('icons/favicon-123x123.png');
    $response->assertStatus(200);
    $data = $response->getContent();
    $info = getimagesizefromstring($data);
    $this->assertEquals(123, $info[0]);
    $this->assertEquals(123, $info[1]);

    $response = $this->get('icons/favicon-100x200.png');
    $response->assertStatus(200);
    $data = $response->getContent();
    $info = getimagesizefromstring($data);
    $this->assertEquals(100, $info[0]);
    $this->assertEquals(200, $info[1]);

    $response = $this->get('icons/favicon-321x123-maskable.png');
    $response->assertStatus(200);
    $data = $response->getContent();
    $info = getimagesizefromstring($data);
    $this->assertEquals(321, $info[0]);
    $this->assertEquals(123, $info[1]);
});

it('returns an appropriate web application manifest', function () {
    $response = $this->get('manifest.json');
    $response->assertStatus(200);
    $response->assertJsonStructure([
        'icons' => [
            '*' => [
                'src',
                'sizes',
                'type',
                'purpose',
            ],
        ],
    ]);
    $data = $response->getContent();
    $this->assertEquals($data, '{"name":"Laravel","icons":[{"src":"http:\/\/localhost\/icons\/favicon-192x192-maskable.png","sizes":"192x192","type":"image\/png","purpose":"maskable"},{"src":"http:\/\/localhost\/icons\/favicon-512x512-maskable.png","sizes":"512x512","type":"image\/png","purpose":"maskable"}],"theme_color":"#007bff","background_color":"#007bff","display":"standalone"}');
});
