<?php
# Default app config
Config::write('app.name', 'pian.in - Seu link bem curtin.');
Config::write('app.conv.perpage', 10);
Config::write('app.url_base', 'http://pian.in/');

# Other
Config::write("defaultExtension", "htm");

# Language
Config::write('multilang', false);
Config::write('default_language', 'br');
Config::write("environment", 'production');