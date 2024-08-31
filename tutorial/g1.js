// Function to handle POST requests and store data in Google Sheet
function doPost(e) {
    var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
    var requestData = JSON.parse(e.postData.contents);
    
    // Append a new row with the data
    sheet.appendRow([new Date(), requestData.name || '', requestData.email || '', requestData.password || '']);
    
    return ContentService.createTextOutput(JSON.stringify({ 'status': 'success' })).setMimeType(ContentService.MimeType.JSON);
  }
  