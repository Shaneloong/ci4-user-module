const searchBar = document.getElementById('search');
const usernameColumn = document.getElementsByClassName('username');
const tableRow = document.querySelector('table').getElementsByTagName('tbody')[0];

searchBar.addEventListener('keyup', () =>{
    let result =[];

    console.log(searchBar.value);

    Array.from(usernameColumn).forEach(element => {
        // console.log(element.outerText);
        if(element.outerText.toLowerCase().includes(searchBar.value.toLowerCase())){
            element.parentNode.style.display = '';
            result.push(element.outerText);
        }
        else{
            element.parentNode.style.display = 'none';
        }
    });

    if(result.length ==  0){
        if(tableRow.querySelectorAll('tr').length === usernameColumn.length){
            var newRow = tableRow.insertRow();
            var newCell = newRow.insertCell();
            newCell.colSpan = 6;
            var newText = document.createTextNode('No Result Found');
            newCell.appendChild(newText);
        }
    }else {
        if(tableRow.querySelectorAll('tr').length !== usernameColumn.length){
            tableRow.deleteRow(-1);
        }
    }

});
