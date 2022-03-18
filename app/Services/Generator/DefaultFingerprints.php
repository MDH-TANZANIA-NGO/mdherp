<?php

namespace App\Services\Generator;

trait DefaultFingerprints
{
    public function getDefaultFingerprints(){
        return "RSOSGoEAU0IxAgCkiRaCEE8MKMKhpAYhw0CpCRqDsKgGLcPQSosthUCkixuFkKuDCwWwAY4fxfBQ
                        gT6GcKOJJgbBqgYGxxBdCAuIEASEFYhQAYshiQCuhQgJUFuHFolQWgYOSgEDBxCLMFuJOQuxRgkc
                        DLABhzWNIKWHOk1BnwYxDiCpByuPAE4HP8+wR4NFEDChhzFQsKaHIlEhAAUaEUFdhC+SEKkJPFMA
                        oocf07AEiC3UoKuL////////CRATFhYYF////////////wYKDxMUFhUWFBb/////////BAkNDxIS
                        FBMVFBUW//////8GBwoODw8PERITFBUXF////wEEBwkLDAsLDxIUFRYXFxn/aXUBBQcJCgoLDhET
                        FRUWFxkZb3R2AwYHCQkKCw0QEhMUFhgZb3J0dwIEBwgKCwwPEBERFBcYcHN0dncCBAYICQwPDxAR
                        FBYXbXFxc3N3AwUHCQwODxESFBUWbHBwc3R3AgQGCAsODxITFRYXbG5vcnR3AgQFBwoNERQXFxcY
                        bG5wcnR2dwIEBgkOEhUYGBkZa25vcXN0dXcCBQgNERUZGRoabG5vcHFzdHYBBQgOERQXGRoaaW1u
                        cHFydHYCBQkOEhYZGhsb/29vcHBydHYCBgsQFBcZGhsb/29wcG9wc3YCBgoQFRgaGxwb//9xcG9w
                        cnYCBgoQFBYYGRsb////cG9vcXQCBQoPFBYXGRv//////3FwcXQBBQoPFBYXGBv///////9wcXQB
                        BAgNEhUXF///FBH///////8CBAcJDA8O////BwX//////////////3Z2////BAP/////////////
                        //93AXd1AwL///////////////93AXd2";
    }

    public function getFingerprintLength(): int
    {
        return 12;
    }


}
