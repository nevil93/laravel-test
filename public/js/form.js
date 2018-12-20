let refresh = document.getElementById('refresh');

refresh.onclick = function(){
    location.reload();
};

let search = document.getElementById('search');

search.addEventListener('keyup', function(){
    let request = new XMLHttpRequest();
    request.open('GET', '/data', true);
    request.setRequestHeader("Content-Type", "application/json");
    request.send();
    if (request.status >= 500){
        alert('error');
    }
    alert(this.response);
    // request.onreadystatechange = function () {
    //     if (this.readyState === 4 && this.status === 200) {
    //         alert(search.value);
    //     }
    //
    // };
});

