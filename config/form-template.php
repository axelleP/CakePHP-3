<?php
return [
    'formStart' => '<form class="mb-5"{{attrs}}>',
    'inputContainer' => '<div class="form-group">{{content}}</div>',
    'input' => '<input type="{{type}}" name="{{name}}" class="form-control"{{attrs}}/>',
    'textarea' => '<textarea name="{{name}}" class="form-control"{{attrs}}></textarea>',
    'inputContainerError' => '<div class="input {{type}}{{required}} error form-control">{{content}}{{error}}</div>',
    'button' => '<button class="btn btn-primary"{{attrs}}>{{text}}</button>'
];