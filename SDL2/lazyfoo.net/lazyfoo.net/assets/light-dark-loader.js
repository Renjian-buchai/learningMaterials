let savedDarkMode = localStorage.getItem("data_bs_theme")

if( savedDarkMode == "light" )
{
    document.documentElement.setAttribute('data-bs-theme','light'); 
}
else
{
    if( savedDarkMode == null )
    {
        localStorage.setItem("data_bs_theme", "dark");
    }
    
    document.documentElement.setAttribute('data-bs-theme','dark'); 
}

/*
let savedDarkMode = document.cookie;

if( savedDarkMode.includes( "data_bs_theme=dark" ) )
{
    document.documentElement.setAttribute('data-bs-theme','dark'); 
}
else if( savedDarkMode.includes( "data_bs_theme=light" ) )
{
    document.documentElement.setAttribute('data-bs-theme','light'); 
}
else
{
    document.cookie = savedDarkMode = "data_bs_theme=dark"; 
}
*/