<?php
Mapper::root("url");
Mapper::connect('/:any','/url/index/$1');