import numpy as np
from skimage import measure, morphology

def segment_lung_mask(image, fill_lung_structures=True):
  
    binary_image = np.array(image >= -700, dtype=np.int8)+1
    labels,num = measure.label(binary_image,return_num=True)

    background_label = labels[0,0]

    binary_image[background_label == labels] = 2
   
    binary_image -= 1 
    binary_image = 1-binary_image 
 
    return binary_image