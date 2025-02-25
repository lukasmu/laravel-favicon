<?php

arch('preset → php')->preset()->php();
arch('preset → security')->preset()->security()->ignoring('tempnam'); // TODO: Find an alternative for tempname in the code
arch('preset → laravel')->preset()->laravel();
arch('preset → relaxed')->preset()->relaxed();
