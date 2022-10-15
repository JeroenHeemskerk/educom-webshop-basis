<?php
function input($type = 'text', $id = '', $value = '', $name = '', $class = '', $content = '', $shecked, $placeholder = '')
{
    return '<input type="' . $type .  '" id="' . $id . '" name="' . $name . '" class="' . $class . '" value="' . $value . '"  ' .  $shecked . ' placeholder="' . $placeholder . '"> ' . $content . '</input>';
}


function label($for = '', $id = '', $class = '', $content = '')
{

    return '<label for="' . $for .  '" id="' . $id . '" class="' . $class . '"> ' . $content . '</label>';
}


function select($id = '', $name = '', $class = '', $required = '', $options =
array('naam' => 'value'))
{
    $sel = '<select class="' . $class . '" id="' . $id . '" name="' . $name . '">';
    foreach ($options as $option) {
        $sel .= '<option value="' . $option['value'] . '" ' . $option['selected'] . ' > ' . $option['content'] . '</option>';
    }
    $sel .= '</select>';
    return $sel;
}


function textarea($class = '', $id = '', $name = '', $message = '')
{
    return '<textarea class="' . $class . '" id="' . $id . '" name="' . $name . '" rows="4" cols="50">' . $message . '</textarea>';
}

function div($class = '', $content = '')
{
    return '<div  class="' . $class . '">' . $content . '</div>';
}
function h1($content)
{
    return '<h1>' . $content . '</h1>';
}
function p($content)
{
    return '<p>' . $content . '</p>';
}
function hr()
{
    return '<hr>';
}
function form($id = '', $action = '', $method = '', $content)
{
    return '<form  id="' . $id . '" action="' . $action . '" method="' . $method . '">' .  $content . '</form>';
}
function span($class, $content)
{

    return '<span class="' . $class . '">' . $content . '</span>';
}
function b($content = '')
{
    return '<b>' . $content . '</b>';
}
