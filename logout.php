<?php

require('admin/ess.php');
session_start();
session_destroy();
redirect('index.php');

?>