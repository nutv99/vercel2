<?php

header('X-PHP: test');
http_response_code($_GET['code'] ?? 200);

echo 'Test output99999';

