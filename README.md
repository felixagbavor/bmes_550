# Project
This is an image analysis project with the prime aim of augmenting CT image scans of pulmonary fibrosis so as to make the CT images 'ready' for machine learning classification. Augmentation of the image we believe can help current doctors to diagnosis the disease easily as Chest CT scans in their generic form are hard to read by doctors. The project will consist of a web interface for users to upload chest CT scans where they are processed and the augmented image shown on a results page. the users can always come back to check previous processed images as they will be stored in a table. 
This table will hold the file paths to each of the uploaded and processed files. The files will be grouped by a username field that can be used to retrieve a set of file paths. The username and file name (will need to append the data directory path) will be passed by the user and into a php script that will call the the update/select statments. There will be no way of dropping the files after uploading, but there will be a date and time field that will allow for sorting.

### Project Files
- **ct_ui.php:** this is the main web interface that the user sees. it has a form for uploading and retrival of CT images. 
- **previous_results.php:** This is the interface to display previous results if a user selected that the wish to see previous results on the ct_ui.php page.
- **results.php:** The interface to display the newly processed CT image uploaded on ct_ui.php
- **upload.php:** A helper file which calls functions in backend.php and redirects to either previous_results.php or results.php based on user input.
- **backend.php:** This file contains all the database communication functions including initializing scripts. 
- **image_db.sqlite:** The database for the web project. 
- **requirements.txt:** Contains all the required python packages to make installation easy.
- **pythonexe.txt:** to account for different python paths for different computers, this file contains the python.exe path of the user.
- **main.py:** the main image processing script which calls on other python functions.
- **transform_to_hu:** function which converts the CT image to hounsdfield unit. 
- **segment_lung_mask.py:** function which create a lung mask for the original image by through normalization, dilation, errosion and uise of bounding boxes. 
- **uploads:** this is data directory where processed CT scans are stored.
- **temp_uploads:** this is a temp data directory which stores the original uploaded file and is removed after the web app is done using the file.
- **Test Data:** This contains test CT images new developers/programmers can use for testing the web app.

### Install Project Dependecies
The project is dependent on the following python packages:

```
 pydicom==2.1.1(https://pypi.org/project/pydicom/0.9.7/)
 numpy==1.19.4(https://pypi.org/project/numpy/)
 matplotlib==3.3.3(https://pypi.org/project/matplotlib/)
 skimage==0.17.2(https://scikit-image.org/docs/dev/install.html)
 sklearn==0.23.2(https://scikit-learn.org/stable/install.html)
```
Alternatively one can install all the required packages by running the pip command below.
`pip install -r requirements.txt`

### Runing the Code

Add your full **python.exe path** to **pythonexe.txt** file. **Delete** all other python paths present in pythonexe.txt file. only your python.txt path should be present. 
example path: C:/Users/agbav/AppData/Local/Programs/Python/Python38-32/python.exe

Add the **project folder** as an alias to **httpd.conf** in appache. Click [here](https://serverfault.com/questions/7323/httpd-conf-and-setting-up-an-alias) to learn about adding aliases in apache.

**open ct_ui.php on localhost to view upload page.** 
if the project alias is prjfolder, then open localhost/prjfolder/public/ct_ui.php

### Database Fields

- user VARCHAR(30) - user uploading or retrieving images
- file_id VARCHAR(50) - name of file uploaded by the user
- upload_datetime TEXT - date and time of file upload
- PRIMARY KEY (user, file_id)
