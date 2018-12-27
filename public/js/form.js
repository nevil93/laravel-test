let refresh = document.getElementById('refresh');

refresh.onclick = function(){
    window.location.reload();
};

let search = document.getElementById('search');


let request = new XMLHttpRequest();
request.open('GET', '/data/get?search=' + JSON.stringify({value: search.value}), true);
request.send();


request.onload = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('.table').append($('<thead>')
            .append($('<tr>')
                .append($('<th>')
                    .text('Persons:')
                    .css('text-align', 'center'))
                .append($('<th>')
                    .text('Messages:')
                    .css('text-align', 'center'))
            ))
            .append($('<tbody>').addClass('person'));

        let persons = [];
        let messages = [];
        JSON.parse(this.response).forEach(person => {
            persons.push(person.name);
            messages.push(Object.values(person.messages));
        });

        for (let p = 0, personsLength = persons.length; p < personsLength; p++) {
                $('.person').append($('<tr>')
                    .append($('<td>').text(persons[p]))
                    .append($('<td>')
                        .addClass('messages')
                        .append($('<table>')
                            .addClass('table' + p))));
            for (let m = 0, messagesLength = messages[p].length; m < messagesLength; m++) {
                $('.table' + p)
                    .append($('<tr>')
                        .append($('<td>')
                            .text(messages[p][m]))
                    );
            }
        }
    }
};


search.addEventListener('keyup', function(){
    request.open('GET', '/data/get?search=' + JSON.stringify({value: search.value}), true);
    request.send();
    $('.table').remove();
    $('.container-fluid').append($('<table>').addClass('table'));
});
