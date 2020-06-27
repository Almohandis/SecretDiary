

$("#userStateLink").click(function(){
    if($(this).text()=="Log in"){
        $(this).text("Sign up!");
        $("#submitButton").text("Log in");
        $("#userStateLabel").text("Log in using your username and password");
    }
    else if($(this).text()=="Sign up!"){
        $(this).text("Log in");
        $("#submitButton").text("Sign up!");
        $("#userStateLabel").text("Interested? Sign up now!");
    }
});

/*$("#logOut").click(function(){
    alert(4);
});
*/
