// PRINT TABLE
function printData(){
    var divToPrint=document.getElementById("accountTable");
    newWin= window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}
$('#make_report').on('click',function(){
    printData();
})

// LETTERS ONLY INPUT
function lettersOnly(input) {
    var regex = /[^a-z ]/gi;
    input.value = input.value.replace(regex, "");
}

// DATA AOS DELAY
AOS.init({
    duration: 3000,
    once: true,
});

// DATA TABLE
$('#accountTable').DataTable()
