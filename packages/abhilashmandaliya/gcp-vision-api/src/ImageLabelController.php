<?php

namespace AbhilashMandaliya\GCPVisionAPI;

use Illuminate\Http\Request;
use Google\Cloud\Vision\VisionClient;
use App\Http\Controllers\Controller;

class ImageLabelController extends Controller
{
    /**
     * @var String
     */
    private $keyFile;

    /**
     * Instanciate an Object
     */
    public function __construct()
    {
        $this->keyFile = env("GOOGLE_APPLICATION_CREDENTIALS", NULL);
    }

    public function printLabels()
    {
        $vision = new VisionClient([
            'keyFilePath' => $this->keyFile,
        ]);

        $fileName = 'demo-image.jpg';

        # Prepare the image to be annotated
        $image = $vision->image(fopen(__DIR__.'/'.$fileName, 'r'), [
            'LABEL_DETECTION'
        ]); 

        # Performs label detection on the image file
        $labels = $vision->annotate($image)->labels();

        echo "Labels:\n";
        foreach ($labels as $label) {
            echo $label->description() . "\n";
        }
    }
}