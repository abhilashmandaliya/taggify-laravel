<?php

namespace AbhilashMandaliya\GCPVisionAPI;

use Illuminate\Http\Request;
use Google\Cloud\Vision\VisionClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

    public function printLabels(Request $request)
    {
        $fileName;

        if(request()->hasFile('content'))
        {
            $fileName = $request->file('content')->store('content');
            $fileName = strrev(implode(strrev('/storage/app/'), explode(strrev('/public'), strrev(public_path()), 2))).$fileName;
        }
        else
        {
            //$fileName = __DIR__.'/'.'demo-image.jpg';            
            $fileName = __DIR__.'/'.'cat.gif';            
        }
        
        $vision = new VisionClient([
            'keyFilePath' => $this->keyFile,
        ]);

        # Prepare the image to be annotated
        $image = $vision->image(fopen($fileName, 'r'), [
            'LABEL_DETECTION'
        ]); 

        # Performs label detection on the image file
        $labels = $vision->annotate($image)->labels();
        
        $labels_array = array();
        foreach ($labels as $label) {
           array_push($labels_array, $label->description());
        }

        return json_encode(['labels' => $labels_array]);
    }
}