<?php
        $json = file_get_contents('../data_example/books.json');
        if ($json === false){
            echo "Error al obtener datos";
        
        } else {
            $data = json_decode($json, true);
            foreach ($data as $item) {
                echo $item['author_name'] . "\n";
            }
        }
