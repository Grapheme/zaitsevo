<?php

return array(

    'fields' => function() {

        return array(
            'special_description' => array(
                'title' => 'Описание (каждый пункт - с новой строки)',
                'type' => 'textarea',
            ),
            'special_photo' => array(
                'title' => 'Фотография',
                'type' => 'image',
                'params' => array(
                    'maxFilesize' => 2, // MB
                    'acceptedFiles' => 'image/*',
                    #'maxFiles' => 2,
                ),
            ),
            'special_plan' => array(
                'title' => 'План',
                'type' => 'image',
                'params' => array(
                    'maxFilesize' => 2, // MB
                    'acceptedFiles' => 'image/*',
                    #'maxFiles' => 2,
                ),
            ),
        );
    },

    'seo' => 0,

    'versions' => 0,

);