# main script for image processing
import sys
import os.path
import numpy as np
from pydicom import dcmread
from matplotlib import pyplot as plt
from transform_to_hu import transform_to_hu
from segment_lung_mask import segment_lung_mask
import cv2

image_path = sys.argv[1].strip()
dcimage = dcmread(image_path)
dmc_filename = image_path.split("/")[-1]

# processing
processed_image = segment_lung_mask(transform_to_hu(dcimage))
isWritten = cv2.imwrite('../uploads/test.png', processed_image)
os.remove('../temp_uploads/'+dmc_filename)

print('../uploads/test.png')