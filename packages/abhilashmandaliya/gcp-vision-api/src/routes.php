<?php

Route::get('/test_vision_api', 'AbhilashMandaliya\GCPVisionAPI\ImageLabelController@printLabels');
Route::post('/test_vision_api', 'AbhilashMandaliya\GCPVisionAPI\ImageLabelController@printLabels');
