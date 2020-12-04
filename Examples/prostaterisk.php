<?php
# Matthew Falcione
# BMES 550 Fall 2020
// if form has not been submitted before
if(!isset($_REQUEST['submit']))
{
echo "
    <form method='get'>        
        Family History of Prostate Cancer: <br>
        <input type='checkbox' name='history' value='1'>
        <label for='history'> I have family history.</label><br><br>

        What percentage of your ethnicity is european? (please enter a number from 0 to 100):<br> <input name='europe' value='$_REQUEST[europe]'><br><br>
        
        How many AR_GGC reapeats?:<br> <input name='ar_ggc' value='$_REQUEST[ar_ggc]'><br><br>
        
        <label for='haplotype'>What type of CYP3A4/CYP3A5 haplotype do you have? <br></label>
        <select name='haplotype'>
            <option value='AA'>AA</option>
            <option value='GA'>GA</option>
            <option value='AG'>AG</option>
            <option value='GG'>GG</option>
        </select><br>
        
        <br>
        <input type='submit' name='submit' value='Submit'><br>
    </form>
    ";
}
else {
    $PYEXE='python';
    if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
        if(file_exists($try='C:\Users\matth\Anaconda3\python.exe')) $PYEXE=$try;
    }
    else{
        // On MAC, python is probably on the path already. So, nothing to do.
    }
    $cmd="\"$PYEXE\" C:\Users\matth\Dropbox\bmes550.MatthewFalcione.mjf378\web\prostaterisk.py ".escapeshellarg($_REQUEST['history'])." ".escapeshellarg($_REQUEST['europe'])." ".escapeshellarg($_REQUEST['ar_ggc'])." ".escapeshellarg($_REQUEST['haplotype']);
    // echo "Running command: $cmd";
    
    exec($cmd, $out);
    $out = implode("\n", $out);
    
    // echo "<pre>"; print_r($out); echo "</pre>";

    echo "Your risk of prostate cancer is: <b>$out<b>";
}
?>
