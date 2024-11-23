lightDarkToggle = document.getElementById('btnToggle');

if (document.documentElement.getAttribute('data-bs-theme') == 'light')
{
    lightDarkToggle.innerHTML = "Dark Mode";
    lightDarkToggle.className = "btn btn-dark my-10";
}

lightDarkToggle.addEventListener('click',()=>{
    if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
        
        document.documentElement.setAttribute('data-bs-theme','light');

        lightDarkToggle.innerHTML = "Dark Mode";
        lightDarkToggle.className = "btn btn-dark my-10";
        localStorage.setItem("data_bs_theme", "light");
    }
    else {
        
        document.documentElement.setAttribute('data-bs-theme','dark');

        lightDarkToggle.innerHTML = "Light Mode";
        lightDarkToggle.className = "btn btn-light my-10";
        localStorage.setItem("data_bs_theme", "dark");
    }
})

/*
lightDarkToggle = document.getElementById('btnToggle');

if (document.documentElement.getAttribute('data-bs-theme') == 'light')
{
    lightDarkToggle.innerHTML = "Dark Mode";
    lightDarkToggle.className = "btn btn-dark my-10";
}

lightDarkToggle.addEventListener('click',()=>{
    if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
        document.documentElement.setAttribute('data-bs-theme','light');

        lightDarkToggle.innerHTML = "Dark Mode";
        lightDarkToggle.className = "btn btn-dark my-10";
        document.cookie = "data_bs_theme=light";
    }
    else {
        document.documentElement.setAttribute('data-bs-theme','dark');

        lightDarkToggle.innerHTML = "Light Mode";
        lightDarkToggle.className = "btn btn-light my-10";
        document.cookie = "data_bs_theme=dark";
    }
})
*/