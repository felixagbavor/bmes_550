# Felix Agbavor

import numpy as np

def transform_to_hu(medical_image):
    image = medical_image.pixel_array
    image = image.astype(np.int16)
    image[image == -2000] = 0
    
    intercept = medical_image.RescaleIntercept
    slope = medical_image.RescaleSlope
    
    if slope != 1:
        image = slope * image.astype(np.float64)
        image = image.astype(np.int16)
        
    image += np.int16(intercept)
    
    return np.array(image, dtype=np.int16)