<?php

it('does take into account width and height requirements/limitations (thereby enhancing security)', function () {
    $response = $this->get('icons/favicon-1800x180.png');
    $response->assertStatus(404);

    $response = $this->get('icons/favicon-180x1800.png');
    $response->assertStatus(404);

    $response = $this->get('icons/favicon-1800x1800-masked.png');
    $response->assertStatus(404);
});
