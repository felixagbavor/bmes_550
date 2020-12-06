# main script for image processing
# Felix Agbavor

import sys
import os
from pydicom import dcmread
from matplotlib import pyplot as plt
from transform_to_hu import transform_to_hu
from segment_lung_mask import segment_lung_mask
import string
import random

def id_generator(size=6, chars=string.ascii_uppercase + string.digits):

    return ''.join(random.choice(chars) for _ in range(size))

image_path = sys.argv[1].strip()
dcimage = dcmread(image_path)
dmc_filename = image_path.split("/")[-1]

# processing
processed_image = segment_lung_mask(transform_to_hu(dcimage))
os.remove('../temp_uploads/'+dmc_filename)

name = id_generator()
processed_path = '../uploads/{0}_processed.png'.format(name)

plt.imshow(processed_image,cmap='jet')
plt.savefig(processed_path)

plt.close()

original_path = '../uploads/{0}_original.png'.format(name)
plt.imshow(dcimage.pixel_array,cmap=plt.cm.gray)
plt.savefig(original_path)

plt.close()

print("{0}:{1}".format(original_path,processed_path))
