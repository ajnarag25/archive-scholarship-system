// PRINT TABLE
function printData(){
    const columnIndices = [0,1,2,3,4,5]; // indices of the desired columns (starting from 0)
    const originalTable = document.getElementById('accountTable');
    const newTable = document.createElement('table');
    
    // Copy the table headers to the new table
    const originalHeaderRow = originalTable.rows[0];
    const newHeaderRow = document.createElement('tr');
    for (let i = 0; i < originalHeaderRow.cells.length; i++) {
    if (columnIndices.includes(i)) {
        const originalHeaderCell = originalHeaderRow.cells[i];
        const newHeaderCell = document.createElement('th');
        newHeaderCell.textContent = originalHeaderCell.textContent + '   '; // add 3 spaces
        newHeaderRow.appendChild(newHeaderCell);
    }
    }
    newTable.appendChild(newHeaderRow);
    
    // Copy the desired columns from the original table to the new table
    for (let i = 1; i < originalTable.rows.length; i++) {
        const originalRow = originalTable.rows[i];
        const newRow = document.createElement('tr');
        for (let j = 0; j < originalRow.cells.length; j++) {
          if (columnIndices.includes(j)) {
            const originalCell = originalRow.cells[j];
            const newCell = document.createElement('td');
            newCell.textContent = originalCell.textContent;
            newRow.appendChild(newCell);
          }
        }
        newTable.appendChild(newRow);
      }
      
    
    // Open a new window and write the new table to the window
    const newWindow = window.open();
    newWindow.document.write(newTable.outerHTML);
    
    // Call the window.print() method to print the contents of the new window
    newWindow.print();
    newWindow.close();
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
