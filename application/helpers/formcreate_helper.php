<?php

function createForm($data)
{
    $result = null;

    foreach ($data as $element) {
        $result .= $element['type']($element);
    }

    return $result;
}

function text($data)
{
    $required = NULL;
    $helpblock = NULL;

    if ($data['required'] == "true") {
        $required = "required";
    }

    if (isset($data['helpblock'])) {
        $helpblock = '<span class="help-block">' . $data['helpblock'] . '</span>';
    }

    $result = '<div class="form-group">
                   <label class="col-md-2 control-label">' . $data['label'] . '</label>
                   <div class="col-md-4">
                   <input id = "' . $data['id'] . '" name = "' . $data['name'] . '" type="' . $data['type'] . '" ' . $required . '  class="' . $data['class'] . '"  placeholder="' . $data['placeholder'] . '" value="' . $data['value'] . '"> 
                   ' . $helpblock . '
                   </div>

               </div>';

    return $result;
}




function select($data)
{
    $required = NULL;
    $result = NULL;

    if ($data['required'] == "true") {
        $required = "required";
    }

    $result .= '<div class="form-group">
                <label class="col-md-2 control-label">' . $data['label'] . '</label>
                <div class="col-md-4">
                    <select id = "' . $data['id'] . '" name = "' . $data['name'] . '" ' . $required . ' class="' . $data['class'] . '">';

    foreach ($data['option'] as $option) {
        if ($data['value'] == $option[0]) {
            $result .= '<option selected = "selected" value="' . $option[0] . '">' . $option[1] . '</option>';

        } else {
            $result .= '<option value="' . $option[0] . '">' . $option[1] . '</option>';

        }
    }

    $result .= '</select>
                </div>
            </div>';

    return $result;
}

function multiselect($data)
{
    $required = NULL;
    $result = NULL;
    $birimler = $data['option'];

    if ($data['required'] == "true") {
        $required = "required";
    }

    $result .= '<div class="form-group">
                <label class="col-md-2 control-label">' . $data['label'] . '</label>
                <div class="col-md-4">
                    <select multiple id = "' . $data['id'] . '" name = "' . $data['name'] . '" ' . $required . ' class="' . $data['class'] . '">';

    foreach ($birimler as $birim) {

            $result .= '<option value="' . $birim['id'] . '">' . '('.$birim['kod'].')'.' '.$birim['ad'] . '</option>';
    }

    $result .= '</select>
                </div>
            </div>';

    return $result;
}