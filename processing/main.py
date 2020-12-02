# main script for image processing
import sys
import numpy as np
from pydicom import dcmread

image_path = sys.argv[1].strip()
dcimage = dcmread(image_path)


print(image_path)

