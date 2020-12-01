from pydicom import dcmread

def loadImage(path):
    dcimage = dcmread(path)
    return dcimage