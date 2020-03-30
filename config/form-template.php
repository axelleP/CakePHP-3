<?php
return [
    'formStart' => '<form {{attrs}}>',
    'inputContainer' => '<div class="form-group">{{content}}</div>',
    'input' => '<input type="{{type}}" name="{{name}}" class="form-control"{{attrs}}/>',
    'textarea' => '<textarea name="{{name}}" class="form-control"{{attrs}}>{{value}}</textarea>',
    'select' => '<select name="{{name}}" class="form-control"{{attrs}}>{{content}}</select>',
    'inputContainerError' => '<div class="form-group error">{{content}}{{error}}</div>',
    'error' => '<div class="error-message" style="color:red;">{{content}}</div>',
    'button' => '<button class="btn btn-primary"{{attrs}}>{{text}}</button>'
];