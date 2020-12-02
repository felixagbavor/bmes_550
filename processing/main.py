# main script for image processing
import sys
import os.path
import numpy as np
from pydicom import dcmread
from matplotlib import pyplot as plt
from transform_to_hu import transform_to_hu
import cv2
image_path = sys.argv[1].strip()

dmc_filename = image_path.split("/")[-1]
png_filename = dmc_filename.split(".")[0]

dcimage = dcmread(image_path)
# testing
image_hu = transform_to_hu(dcimage)
isWritten = cv2.imwrite('../uploads/test.png', image_hu)
plt.imshow(image_hu,cmap=plt.cm.bone)
plt.show()
