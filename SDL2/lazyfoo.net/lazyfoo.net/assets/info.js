infoButton = document.getElementById('btnInfo');

infoButton.addEventListener('click',()=>{
    var rawData = [
        116,
        101,
        110,
        46,
        111,
        111,
        102,
        121,
        122,
        97,
        108,
        64,
        111,
        111,
        102,
        121,
        122,
        97,
        108
    ];
    
    var str = new TextDecoder().decode( Uint8Array.from( rawData.reverse() ) );
    infoButton.innerHTML = str + " copied to your clipboard!";
    navigator.clipboard.writeText( str );
})