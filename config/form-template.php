<?php
return [
    'formStart' => '<form class="mb-5"{{attrs}}>',
    'inputContainer' => '<div class="form-group" style="margin-bottom:8px;">{{content}}</div>',
    'input' => '<input type="{{type}}" name="{{name}}" class="form-control" style="margin-bottom:0;"{{attrs}}/>',
    'textarea' => '<textarea name="{{name}}" class="form-control" style="margin-bottom:0;"{{attrs}}></textarea>',
    'inputContainerError' => '<div class="form-group">{{content}}{{error}}</div>',
    'error' => '<div class="error-message" style="color:red;">{{content}}</div>',
    'button' => '<button class="btn btn-primary"{{attrs}}>{{text}}</button>'
];