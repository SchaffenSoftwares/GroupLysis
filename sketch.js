var txt;
function loadFile(){
    loadFile("commonWords.txt",fileLoaded);
}
function fileLoaded(data){
    createP(join(data,"<br/>"));
}

function setup(){
    noCanvas();
    var button=select("#loadfile");
    button.click(loadFile);
    createFileInput();
}