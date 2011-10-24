<?php
Mapper::root("url");
Mapper::connect('/api/short','/url/index/');
Mapper::connect('/:any','/url/index/$1');