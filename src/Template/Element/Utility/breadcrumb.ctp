<?php
$this->Breadcrumbs->setTemplates([
    'wrapper' => ''
    . '<nav aria-label="breadcrumb" class="row d-flex mb-3">'
    . '<ol class="breadcrumb"{{attrs}}>{{content}}</ol>'
    . '</nav>',
    'item' => '<li class="breadcrumb-item" {{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>{{separator}}',
]);

echo $this->Breadcrumbs->render();