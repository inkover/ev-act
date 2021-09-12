#!/bin/bash
sudo -u apache php artisan queue:listen redis  --timeout=1200 --queue=activity