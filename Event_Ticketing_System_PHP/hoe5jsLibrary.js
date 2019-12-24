
// checks for invalid characters in a string

function hasInvalidChars(aControl)
{
    //create a regular expression literal to identify invalid characters

    var reg = /[^a-zA-Z0-9\s\&\!\?\.,]/;

   //use the regular expression method - test - to check whether the string contains invalid characters

   return reg.test(aControl.value.trim());
}

// displays a message box with an appropriate message

function showAlert(aControl, aMessage)
{
    alert(aMessage);
    aControl.focus(); // sets the focus on the appropriate control
}

// this function receives a form object as its argument and performs multiple validations

function checkForm(aForm)
{
    //   to check how date is passed in Chrome (yyyy-mm-dd)     
    //   alert(aForm.dateintheaters.value);
    //   return false;
    
    if (hasInvalidChars(aForm.summary))
    {
       showAlert(aForm.summary, "Summary has invalid characters");
       return false;      
    }
//    else if (isDate(aForm.dateintheaters.value)== false)
//    {
//        aForm.dateintheaters.focus();
//        return false;
//    }
    
    else return true;
}











