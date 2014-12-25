<?php

return array(

    'fields' => function() {

        return array(
            'show_on_the_map' => array(
                'no_label' => true,
                'title' => 'Показывать на карте',
                'type' => 'checkbox',
                'label_class' => 'normal_checkbox',
            ),
            'map_x' => array(
                'title' => 'Координата X',
                'type' => 'text',
            ),
            'map_y' => array(
                'title' => 'Координата Y',
                'type' => 'text',
            ),
            'map_description' => array(
                'title' => 'Описание для метки на карте',
                'type' => 'textarea',
            ),
            'show_in_the_list' => array(
                'no_label' => true,
                'title' => 'Показывать в списке',
                'type' => 'checkbox',
                'label_class' => 'normal_checkbox',
            ),
            'list_description' => array(
                'title' => 'Описание для элемента списка',
                'type' => 'textarea',
            ),
        );
    },

    'seo' => 0,

    'versions' => 0,

);