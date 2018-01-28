<?php

namespace AbhilashMandaliya\GCPVisionAPI;

use Illuminate\Http\Request;
use Google\Cloud\Vision\VisionClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageLabelController extends Controller
{
    /**
     * @var string
     */
    private $keyFile;

    /**
     * @var Google\Cloud\Vision\VisionClient
     */
    private $client;

    /**
     * Instanciate an Object
     */
    public function __construct()
    {
        $this->keyFile = env("GOOGLE_APPLICATION_CREDENTIALS", NULL);
        $this->vision = new VisionClient([
            'keyFilePath' => $this->keyFile,
        ]);
    }
    
    /**
     * Get image labels using Google Cloud Vision API
     * 
     * @param string $filename Name of the file to be processed
     * @return array
     */
    public function getImageLabels(String $fileName)
    {
        $fileName = strrev(implode(strrev('\storage\app\\'), explode(strrev('\public'), strrev(public_path()), 2))).$fileName;
        
        # Prepare the image to be annotated
        $image = $this->vision->image(fopen($fileName, 'r'), [
            'LABEL_DETECTION'
        ]); 

        # Performs label detection on the image file
        $labels = $this->vision->annotate($image)->labels();
        
        $labels_array = array();

        foreach ($labels as $label) {
           array_push($labels_array, $label->description());
        }

        return $labels_array;
    }

    /**
     * For test purpose only
     */
    public function printLabels(Request $request)
    {
        $request->file('content')->store('content');
        return json_encode(['data' => $request->all(), 'hasFile' => request()->hasFile('content')]);

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