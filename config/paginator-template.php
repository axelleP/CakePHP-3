<?php
return [
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="#">{{text}}</a></li>',
    'prevActive' => '<li class="page-item"><a aria-label="Previous" class="page-link" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item disabled"><a aria-label="Previous" class="page-link"><span aria-hidden="true">{{text}}</span></a></li>',
    'nextActive' => '<li class="page-item"><a aria-label="Next" class="page-link" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item disabled"><a aria-label="Next" class="page-link"><span aria-hidden="true">{{text}}</span></a></li>',
];