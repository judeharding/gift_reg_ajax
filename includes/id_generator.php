<?php
    function id_generator()
    {
        $id = md5 (uniqid (mt_rand(),true));
        return ($id);
    }
?>
